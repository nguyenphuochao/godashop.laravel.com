<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [

        'client_id' => '467247032240-knsffu06c3oudae60p7r2ol66hk5sjn8.apps.googleusercontent.com',
        'client_secret' => 'RCDJg7w6fnh2vFZCw9GDGEGY',
        'redirect' => 'https://godashop.laravel.com/auth/google/callback',

    ],
    'facebook' => [
        'client_id' => '538819190670113',
        'client_secret' => 'f9068fa2fe45e4ecf081d23986dec295',
        'redirect' => 'https://godashop.laravel.com/auth/facebook/callback',
    ],

];
