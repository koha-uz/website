<?php
use function Cake\Core\env;

return [
    'FileStorage' => [
        'Local' => [
            'root' => FILE_STORAGE,
            'assets' => DS . ASSETS
        ],
        'AwsS3' => [
            'url' => env('FILE_STORAGE_ADAPTER_AWSS3_URL', ''),
            'bucket' => env('FILE_STORAGE_ADAPTER_AWSS3_BUCKET', ''),
            'region' => env('FILE_STORAGE_ADAPTER_AWSS3_REGION', ''),
            'version' => env('FILE_STORAGE_ADAPTER_AWSS3_VERSION', ''),
            'key' => env('FILE_STORAGE_ADAPTER_AWSS3_KEY', ''),
            'secret' => env('FILE_STORAGE_ADAPTER_AWSS3_SECRET', '')
        ],
        'behaviorConfig' => [
            'defaultStorageConfig' => env('FILE_STORAGE_DEFAULT_CONFIG', 'Local')
        ]
    ]
];