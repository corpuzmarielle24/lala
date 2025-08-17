<?php

return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'),  // Can be 'sandbox' or 'live'
    'sandbox' => [
        'client_id'     => env('PAYPAL_CLIENT_ID'),
        'client_secret' => env('PAYPAL_SECRET'),
        'app_id'        => '',
    ],
    'live' => [
        'client_id'     => env('PAYPAL_CLIENT_ID'),
        'client_secret' => env('PAYPAL_SECRET'),
        'app_id'        => '',
    ],
    'payment_action' => 'Sale',  // Can be 'Sale', 'Authorization', 'Order'
    'currency'       => env('PAYPAL_CURRENCY', 'USD'),
    'notify_url'     => '',  // Change this accordingly for your application.
    'locale'         => 'en_US',
    'validate_ssl'   => true,  // Validate SSL when creating API client.
];
