<?php
use Burzum\FileStorage\Storage\Listener\LocalListener;
use Burzum\FileStorage\Storage\Listener\ImageProcessingListener;
use Burzum\FileStorage\Storage\StorageUtils;
use Burzum\FileStorage\Storage\StorageManager;
use Cake\Core\Configure;
use Cake\Event\EventManager;
use Cake\ORM\TableRegistry;

StorageManager::config('Local', [
	'adapterOptions' => [FILE_STORAGE, true],
	'adapterClass' => '\Gaufrette\Adapter\Local',
	'class' => '\Gaufrette\Filesystem'
]);

EventManager::instance()->on('FileStorage.afterSave', function ($event, $entity) {
    TableRegistry::get('Burzum/FileStorage.FileStorage')->deleteOldFileOnSave($entity);
});

// Attach the LocalListener to the global EventManager
EventManager::instance()->on(new LocalListener([
    'imageProcessing' => true
]));

// For automated image processing you'll have to attach this listener as well
EventManager::instance()->on(new ImageProcessingListener());

Configure::write('FileStorage', [
    'imageSizes' => [
        'Posts' => [
            'big' => [
                'thumbnail' => [
                    'mode' => 'outbound',
                    'width' => 837,
                    'height' => 523
                ]
            ],
            'mini' => [
                'thumbnail' => [
                    'mode' => 'outbound',
                    'width' => 398,
                    'height' => 249
                ]
            ],
            'crop100' => [
                'squareCenterCrop' => [
                    'size' => 100
                ]
            ]
        ],
        'file_storage' => [
            'crop160' => [
                'squareCenterCrop' => [
                    'size' => 160
                ]
            ]
        ],
        'Users' => [
            'portrait' => [
                'resize' => [
                    'width' => 150,
                    'height' => 200
                ]
            ],
            'large' => [
                'thumbnail' => [
                    'mode' => 'inbound',
                    'width' => 1200,
                    'height' => 1200
                ]
            ]
        ]
    ]
]);
StorageUtils::generateHashes();
