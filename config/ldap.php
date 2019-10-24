<?php

return [

    'logging' => env('LDAP_LOGGING', false),

    'connections' => [

        'default' => [
            'auto_connect' => env('LDAP_AUTO_CONNECT', true),

            'connection' => Adldap\Connections\Ldap::class,

            'settings' => [

                'schema' => Adldap\Schemas\ActiveDirectory::class,


                'account_prefix' => env('LDAP_ACCOUNT_PREFIX', ''),


                'account_suffix' => env('LDAP_ACCOUNT_SUFFIX', ''),


                'hosts' => explode(' ', env('LDAP_HOSTS')),


                'port' => env('LDAP_PORT', 389),


                'timeout' => env('LDAP_TIMEOUT', 5),


                'base_dn' => env('LDAP_BASE_DN', 'dc=lev,dc=local'),


                'username' => env('LDAP_USERNAME'),
                'password' => env('LDAP_PASSWORD'),

                'follow_referrals' => false,


                'use_ssl' => false,
                'use_tls' => false,
                'custom_options' => [
                        LDAP_OPT_PROTOCOL_VERSION => 3,
                        LDAP_OPT_X_TLS_REQUIRE_CERT => LDAP_OPT_X_TLS_NEVER,
                    ],

            ],

        ],

    ],

];
