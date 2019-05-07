<?php

return [

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],
        'usuarios' => [
            'driver' => 'local',
            'root' => base_path().'\public\archivos\usuarios',
        ],
        'edi' => [
            'driver' => 'local',
            'root' => base_path().'\public\archivos\edi',
        ],
        'ediLP' => [
            'driver' => 'local',
            'root' => base_path().'\public\archivos\edi\LaPaz',
        ],
        'ediCO' => [
            'driver' => 'local',
            'root' => base_path().'\public\archivos\edi\Cochabamba',
        ],
        'ediSC' => [
            'driver' => 'local',
            'root' => base_path().'\public\archivos\edi\SantaCruz',
        ],
        'ediHUB' => [
            'driver' => 'local',
            'root' => base_path().'\public\archivos\edi\Hub',
        ],
        'logdtw'=>[
            'driver' => 'local',
            'root' =>'C:\Program Files (x86)\SAP\Data Transfer Workbench\error files',
        ],
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],

    ],

];
