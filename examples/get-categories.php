<?php
// Yelp Client
require '../src/yelp.php';

// Telp Token
$token = 'PUT_YOUR_TOKEN_HERE';

// Yelp Instance
$yelp = new EasyYelp\Yelp($token);

// Get Yelp Categories
$response = $yelp->categories()->getArray();

/**
 * Do something with $response['categories']
 */