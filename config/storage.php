<?php
use Cake\Core\Configure;

// Container
$container = new \League\Container\Container();
//$container = \App\Container\Container::getSingletonInstance();
$container->delegate(
    new League\Container\ReflectionContainer(),
);

// Storage setup
$storageFactory = new \PhpCollective\Infrastructure\Storage\StorageAdapterFactory($container);
$storageService = new \PhpCollective\Infrastructure\Storage\StorageService(
    $storageFactory,
);

$storageService->setAdapterConfigFromArray([
    'Local' => [
        'class'   => \PhpCollective\Infrastructure\Storage\Factories\LocalFactory::class,
        'options' => [
            'root' => Configure::read('FileStorage.Local.root')
        ]
    ],
    'AwsS3' => [
        'class'   => \PhpCollective\Infrastructure\Storage\Factories\AwsS3v3Factory::class,
        'options' =>     [
            'bucket' => Configure::read('FileStorage.AwsS3.bucket'),
            'client' => [
                'region'      => Configure::read('FileStorage.AwsS3.region'),
                'version'     => Configure::read('FileStorage.AwsS3.version'),
                'credentials' => [
                    'key'    => Configure::read('FileStorage.AwsS3.key'),
                    'secret' => Configure::read('FileStorage.AwsS3.secret')
                ]
            ]
        ]
    ]
]);

$pathBuilder = new \PhpCollective\Infrastructure\Storage\PathBuilder\PathBuilder([
    'randomPathLevels' => 3,
    'sanitizer' => new \PhpCollective\Infrastructure\Storage\Utility\FilenameSanitizer([
        'urlSafe' => true,
        'removeUriReservedChars' => true,
        'maxLength' => 190,
    ]),
]);
$fileStorage = new \PhpCollective\Infrastructure\Storage\FileStorage(
    $storageService,
    $pathBuilder,
);

// Image Manager and Processor
$imageManager = new \Intervention\Image\ImageManager();
$imageProcessor = new \PhpCollective\Infrastructure\Storage\Processor\Image\ImageProcessor(
    $fileStorage,
    $pathBuilder,
    $imageManager,
);
//$imageDimensionsProcessor = new \App\Storage\Processor\ImageDimensionsProcessor(FILE_STORAGE);
$stackProcessor = new \PhpCollective\Infrastructure\Storage\Processor\StackProcessor([
    $imageProcessor,
    //$imageDimensionsProcessor,
]);

// Configure variants
$collectionFiles = \PhpCollective\Infrastructure\Storage\Processor\Image\ImageVariantCollection::create();
$collectionFiles->addNew('160x160')
    ->fit(160, 160)
    ->optimize();

$collectionFilesOpenGraph = \PhpCollective\Infrastructure\Storage\Processor\Image\ImageVariantCollection::create();
$collectionFilesOpenGraph->addNew('200x105')
    ->fit(200, 105)
    ->optimize();

$collectionPostsCover = \PhpCollective\Infrastructure\Storage\Processor\Image\ImageVariantCollection::create();
$collectionPostsCover->addNew('400x250')
    ->fit(400, 250)
    ->optimize();
$collectionPostsCover->addNew('1070x670')
    ->fit(1070, 670)
    ->optimize();


Configure::write('FileStorage.imageVariants', [
    'Files' => [
        'Files' => $collectionFiles->toArray(),
        'OpenGraph' => $collectionFilesOpenGraph->toArray()
    ],
    'Posts' => [
        'Cover' => $collectionPostsCover->toArray()
    ]
]);

Configure::write('FileStorage.behaviorConfig.fileStorage', $fileStorage);
Configure::write('FileStorage.behaviorConfig.fileProcessor', $stackProcessor);
//Configure::write('FileStorage.behaviorConfig.fileValidator', \App\Storage\Validation\ImageValidator::class);