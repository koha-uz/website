<?php
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
        'class' => \PhpCollective\Infrastructure\Storage\Factories\LocalFactory::class,
        'options' => [
            'root' => FILE_STORAGE
        ]
    ],
    'S3' => [
        'class' => \PhpCollective\Infrastructure\Storage\Factories\AwsS3v3Factory::class,
        'options' =>     [
            'bucket' => env('FILE_STORAGE_ADAPTER_AWS3_BUCKET', ''),
            'client' => [
                'region' => env('FILE_STORAGE_ADAPTER_AWS3_REGION', ''),
                'version' => env('FILE_STORAGE_ADAPTER_AWS3_VERSION', ''),
                'credentials' => [
                    'key'    => env('FILE_STORAGE_ADAPTER_AWS3_KEY', ''),
                    'secret' => env('FILE_STORAGE_ADAPTER_AWS3_SECRET', '')
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
/*$collectionFiles = \PhpCollective\Infrastructure\Storage\Processor\Image\ImageVariantCollection::create();
$collectionFiles->addNew('160x160')
    ->fit(160, 160)
    ->optimize();

$collectionOpenGraph = \PhpCollective\Infrastructure\Storage\Processor\Image\ImageVariantCollection::create();
$collectionOpenGraph->addNew('200x105')
    ->fit(200, 105)
    ->optimize();

$collectionPostCover = \PhpCollective\Infrastructure\Storage\Processor\Image\ImageVariantCollection::create();
$collectionPostCover->addNew('200x125')
    ->fit(200, 125)
    ->optimize();*/

\Cake\Core\Configure::write([
    'FileStorage' => [
        /*'imageVariants' => [
            'Files' => [
                'Files' => $collectionFiles->toArray()
            ],
            'OpenGraph' => [
                'OpenGraph' => $collectionOpenGraph->toArray()
            ],
            'PostCover' => [
                'PostCover' => $collectionPostCover->toArray()
            ]
        ],*/
        'behaviorConfig' => [
            'defaultStorageConfig' => 'S3',
            'fileStorage' => $fileStorage,
            'fileProcessor' => $stackProcessor,
            //'fileValidator' => \App\Storage\Validation\ImageValidator::class,
        ],
    ],
]);