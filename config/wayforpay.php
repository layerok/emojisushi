<?php

return [
    /*
     * Test mode for using test credentials
     */
    'testMode' => env("WAYFORPAY_TEST", false),

    /*
     * Merchant domain
     */
    'merchantDomain' => env('WAYFORPAY_DOMAIN', 'demo-shop.rudomanenkovladimir.com'),

    /*
     * Merchant Account ID
     */
    'merchantAccount' => env('WAYFORPAY_ACCOUNT', 'demo_shop_rudomanenkovladimir_com'),

    /*
     * Merchant Secret key
     */
    'merchantSecretKey' => env('WAYFORPAY_SECRET_KEY', '851c44c061eb74e6bfd8fad367a460cd83532f78'),
];
