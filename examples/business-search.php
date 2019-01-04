<?php
// Yelp Client
require '../src/yelp.php';

// Telp Token
$token = 'PUT_YOUR_TOKEN_HERE';

// Yelp Instance
$yelp = new EasyYelp\Yelp($token);

// Get Yelp Businesses
$request = [
    'location' => 'Los Angeles, CA',
    'price' => '1,2,3',
    'sort_by' => 'distance',
    'limit' => '30',
];

$response = $yelp->businessSearch($request)->getArray();

/**
 * Do something with $response['businesses']
 */