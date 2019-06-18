<?php

return [

    'driver' => 'smtp',

    'host' => '192.168.10.17',

    'port' => 587,

    'from' => [
        'address' => 'bi@levcorp.bo',
        'name' => 'Sistemas',
    ],

    'encryption' =>'tls',

    'username' => 'bi@levcorp.bo',

    'password' => 'Manager1000',

    "sendmail" => "/usr/sbin/sendmail -bs",

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],
   
    'log_channel' => env('MAIL_LOG_CHANNEL'),

    'stream' => [
        'ssl' => [
           'allow_self_signed' => true,
           'verify_peer' => false,
           'verify_peer_name' => false,
        ],
     ],

];
