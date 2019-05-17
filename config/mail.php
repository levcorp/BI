<?php

return [

    'driver' => 'smtp',

    'host' => 'correo.levcorp.bo',

    'port' => 587,

    'from' => [
        'address' => 'admin@levcorp.bo',
        'name' => 'Sistemas',
    ],

    'encryption' =>'tls',

    'username' => 'admin@levcorp.bo',

    'password' => 'larcos',

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
