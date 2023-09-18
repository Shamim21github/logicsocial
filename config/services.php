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

    'facebook' => [
        'client_id' => env('FACEBOOK_APP_ID'),
        'client_secret' => env('FACEBOOK_APP_SECRET'),
        'redirect' => 'http://localhost/logicsocial/public/dashboard/callback/facebook',
    ],           

    

    // 'facebook' => [
    //     'client_id' => '822254012629540',
    //     'client_secret' => 'fba135b587d7ab92c22d6ded29721db2', 
    //     'redirect' => 'http://localhost/logicsocial/public/dashboard/callback/facebook', //https://localhost:8000/facebook/callback
        
    //     //'redirect' => 'http://127.0.0.1:8000/dashboard/callback/facebook', //https://localhost:8000/facebook/callback
    // ],



  

//Sending Env file 
'twitter' => [
    'client_id' => env('TWITTER_API_KEY'),
    'client_secret' => env('TWITTER_API_SECRET'),
    'access_token' => env('TWITTER_ACCESS_TOKEN'),
    'access_token_secret' => env('TWITTER_ACCESS_TOKEN_SECRET'),
    'bearer_token' => env('TWITTER_BEARER_TOKEN'),
    'redirect' => 'http://127.0.0.1:8000/dashboard/callback/twitter-connect',

    
],


    
    // 'twitter' => [
    //     'client_id' => 'c3WGrNiC23HwU7sy1u8yruFbn',
    //     'client_secret' =>'Fg6FqTEExThefYvFMqL671Ewm9uq4lEy2NOJWOfwrk2sXRhou4',
    //     'access_token' => '1296052514693853184-tkKwSKQwi1iQDwcch6PLEdF3kBfjxg',
    //     'acces_token_secret'=> 'SfdAaXusNa3U0A9zyKzzZuQ7QiGrHfy3aO2ZJQiw6la1W',
    //     'bearer_token' => 'AAAAAAAAAAAAAAAAAAAAAHknoQEAAAAAUKou%2FvXk%2FjW4BAlTCsAcB3XdKCQ%3DWc0wGIjjkOndUYIJXm72V0gzNHdCDc7b4QKqPEvDRJ3H8KAxTu',    
    //  'redirect' => 'http://127.0.0.1:8000/dashboard/callback/twitter-connect',         
    //      'redirect_url_apiv2'=>'http://127.0.0.1:800/callback/twitter-connectv2',
    //      'redirect_url_apiv2'=>https://postghost.ourbetazone.com/dashboard/callback/twitter-connect, //live postghost

    // TWITTER_API_KEY=your-api-key
    // TWITTER_API_SECRET=your-api-secret
    // TWITTER_ACCESS_TOKEN=your-access-token  1296052514693853184-rYTVEmJlDT3xtKaYv8QwH7fhBywvfX
    // TWITTER_ACCESS_TOKEN_SECRET=your-access-token-secret OPHqhwZZlZ546HiMTdXfb4XNlQif5mUoPOyIlwsLNhI4s
    // ],


  //Google
  'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
   'redirect' => 'http://127.0.0.1:8000/dashboard/google/callback',
 
],


    'linkedin' => [
        'client_id' => '86pl6k4mngz3un',
        'client_secret' => 'O9qqBj7a9CAHzIZf',
        'redirect' => 'http://127.0.0.1:8000/linkedin/callback',
        

    ],

    'stripe' => [
        'secret' => env('STRIPE_SECRET'),
   ],

];












