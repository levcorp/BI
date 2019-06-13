<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    |
    | This option enables logging all LDAP operations on all configured
    | connections such as bind requests and CRUD operations.
    |
    | Log entries will be created in your default logging stack.
    |
    | This option is extremely helpful for debugging connectivity issues.
    |
    */

    'logging' => env('LDAP_LOGGING', false),

    /*
    |--------------------------------------------------------------------------
    | Connections
    |--------------------------------------------------------------------------
    |
    | This array stores the connections that are added to Adldap. You can add
    | as many connections as you like.
    |
    | The key is the name of the connection you wish to use and the value is
    | an array of configuration settings.
    |
    */

    'connections' => [

        'default' => [
            'auto_connect' => env('LDAP_AUTO_CONNECT', true),

            'connection' => Adldap\Connections\Ldap::class,

            'settings' => [

                'schema' => Adldap\Schemas\ActiveDirectory::class,


                'account_prefix' => env('LDAP_ACCOUNT_PREFIX', ''),


                'account_suffix' => env('LDAP_ACCOUNT_SUFFIX', ''),


                'hosts' => explode(' ', env('LDAP_HOSTS', 'ad-02.lev.local')),


                'port' => env('LDAP_PORT', 389),


                'timeout' => env('LDAP_TIMEOUT', 5),


                'base_dn' => env('LDAP_BASE_DN', 'dc=lev,dc=local'),


                'username' => 'Administrador@lev',
                'password' => 'Manager100',

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
