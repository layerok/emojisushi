<?php

return [
    /*
     * Test mode for using test credentials
     */
    'testMode' => config('settings.wayforpay_test') ?? env("WAYFORPAY_TEST", true),

    /*
     * Merchant domain
     */
    'merchantDomain' => config('settings.wayforpay_domain') ?? env('WAYFORPAY_DOMAIN', 'market.ua'),

    /*
     * Merchant Account ID
     */
    'merchantAccount' => config('settings.wayforpay_account') ?? env('WAYFORPAY_ACCOUNT', 'test_merch_n1'),

    /*
     * Merchant Secret key
     */
    'merchantSecretKey' => config('settings.wayforpay_secret_key') ?? env('WAYFORPAY_SECRET_KEY', 'flk3409refn54t54t*FNJRET'),
];
