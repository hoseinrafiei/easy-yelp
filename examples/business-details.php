<?php
// Yelp Client
require '../src/yelp.php';

// Telp Token
$token = 'PUT_YOUR_TOKEN_HERE';

// Yelp Instance
$yelp = new EasyYelp\Yelp($token);

// Get Yelp Businesses
$businessId = 'gLn9MKqseb1leWZOWqD54g';
$business = $yelp->businessDetails($businessId)->getArray();

/**
 * Do something with $business
 */