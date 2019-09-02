<?php

return [

    'default' => env('FILESYSTEM_DRIVER', 'local'),
    'cloud' => env('FILESYSTEM_CLOUD', 's3'),
    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],
        'usuarios' => [
            'driver' => 'local',
            'root' => base_path().'\public\archivos\usuarios',
        ],
        'perfil' => [
            'driver' => 'local',
            'root' => base_path().'\public\archivos\perfil',
        ],
        'edi' => [
            'driver' => 'local',
            'root' => base_path().'\public\archivos\edi',
        ],
        'gposExcel' => [
            'driver' => 'local',
            'root' => base_path().'\public\archivos\gpos\Excel',
        ],
        'gposLP' => [
            'driver' => 'local',
            'root' => base_path().'\public\archivos\gpos\LaPaz',
        ],
        'gposCO' => [
            'driver' => 'local',
            'root' => base_path().'\public\archivos\gpos\Cochabamba',
        ],
        'gposSC' => [
            'driver' => 'local',
            'root' => base_path().'\public\archivos\gpos\SantaCruz',
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
        'index' => [
            'driver' => 'local',
            'root' => base_path().'/public'
        ],
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],
        'EDIftp' => [
            'driver'   => 'ftp',//ftp://98.142.238.22
            'host'     => '98.142.238.22',
            'username' => 'SRNNJ001',
            'password' => '2R,Q6G5J4P',
            'port'     => 21,
            'ssl'      => false,
            'root'     =>'/send/commit',
        ],
        'EDIftp_PRUEBA' => [
            'driver'   => 'ftp',//ftp://98.142.238.22
            'host'     => '192.168.10.45',
            'username' => 'Administrador',
            'password' => 'Manager1',
            'port'     => 22,
            'ssl'      => false,
            'root'     =>'/send/commit',
        ],

    ],

];
