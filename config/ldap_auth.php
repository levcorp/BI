<?php

return [

    'connection' => env('LDAP_CONNECTION', 'default'),
    'provider' => Adldap\Laravel\Auth\DatabaseUserProvider::class,
    'model' => App\User::class,
    'rules' => [
        Adldap\Laravel\Validation\Rules\DenyTrashed::class,
    ],
    'scopes' => [
    ],
    'identifiers' => [
        'ldap' => [
            'locate_users_by' => 'mail',
            'bind_users_by' => 'distinguishedname',
        ],
        'database' => [
            'guid_column' => 'objectguid',
            'username_column' => 'email',
        ],
        'windows' => [
            'locate_users_by' => 'samaccountname',
            'server_key' => 'AUTH_USER',
        ],
    ],
    'passwords' => [
        'sync' => env('LDAP_PASSWORD_SYNC', true),
        'column' => 'password',
    ],
    'login_fallback' => env('LDAP_LOGIN_FALLBACK', false),
    'sync_attributes' => [
        'email' => 'mail',
        'nombre' => 'givenname',
        'apellido'=>'sn',
        'cargo'=>'title',
        'celular'=>'mobile',
        'ciudad'=>'l',
        'departamento'=>'department',
        'interno'=>'ipphone'
    ],
    'logging' => [
        'enabled' => env('LDAP_LOGGING', true),
        'events' => [
            \Adldap\Laravel\Events\Importing::class => \Adldap\Laravel\Listeners\LogImport::class,
            \Adldap\Laravel\Events\Synchronized::class => \Adldap\Laravel\Listeners\LogSynchronized::class,
            \Adldap\Laravel\Events\Synchronizing::class => \Adldap\Laravel\Listeners\LogSynchronizing::class,
            \Adldap\Laravel\Events\Authenticated::class => \Adldap\Laravel\Listeners\LogAuthenticated::class,
            \Adldap\Laravel\Events\Authenticating::class => \Adldap\Laravel\Listeners\LogAuthentication::class,
            \Adldap\Laravel\Events\AuthenticationFailed::class => \Adldap\Laravel\Listeners\LogAuthenticationFailure::class,
            \Adldap\Laravel\Events\AuthenticationRejected::class => \Adldap\Laravel\Listeners\LogAuthenticationRejection::class,
            \Adldap\Laravel\Events\AuthenticationSuccessful::class => \Adldap\Laravel\Listeners\LogAuthenticationSuccess::class,
            \Adldap\Laravel\Events\DiscoveredWithCredentials::class => \Adldap\Laravel\Listeners\LogDiscovery::class,
            \Adldap\Laravel\Events\AuthenticatedWithWindows::class => \Adldap\Laravel\Listeners\LogWindowsAuth::class,
            \Adldap\Laravel\Events\AuthenticatedModelTrashed::class => \Adldap\Laravel\Listeners\LogTrashedModel::class,
        ],
    ],
];
