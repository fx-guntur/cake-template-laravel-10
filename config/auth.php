<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',       // Default guard
        'passwords' => 'customers', // Default password reset settings
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Here you may define every authentication guard for your application.
    | A great default configuration is defined which uses session storage 
    | and the Eloquent user provider.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'customers', // Ensure this provider exists
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins', // Added admin guard
        ],
        'merchant' => [
            'driver' => 'session',
            'provider' => 'merchants',
        ],
        'customer' => [
            'driver' => 'session',
            'provider' => 'customers'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are retrieved from your database or other storage mechanisms.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin\Admin::class,
        ],
        'customers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Customer\Customer::class,
        ],
        'merchants' => [
            'driver' => 'eloquent',
            'model' => App\Models\Merchant\Merchant::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application.
    |
    */

    'passwords' => [
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'merchants' => [
            'provider' => 'merchants',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'customers' => [
            'provider' => 'customers',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define how long before a password confirmation times out.
    |
    */

    'password_timeout' => 10800,

];
