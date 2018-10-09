<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => env("FB_APP",'173063836916452'),
        'client_secret' => '5c52fbedf3ce716b8c6c3e3ca5917d94', // Your GitHub Client Secret
        'redirect' => 'http://localhost/elsafwa/public/login/facebook/callback',
    ],

   /* 'facebook' => [
        'client_id' => env('173063836916452'),         // Your GitHub Client ID
        'client_secret' => env('5c52fbedf3ce716b8c6c3e3ca5917d94'), // Your GitHub Client Secret
        'redirect' => 'http://localhost/elsafwa/public/login/facebook/callback',
    ],*/





];
