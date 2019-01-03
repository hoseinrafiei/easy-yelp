<?php
// Yelp Client
require '../src/EasyYelp/yelp.php';

// Telp Token
$token = 'PUT_YOUR_TOKEN_HERE';

// Yelp Instance
$yelp = new EasyYelp\Yelp($token);

// Get Yelp Featured Event
$request = [
    'location' => 'Los Angeles, CA',
];

$event = $yelp->featuredEvent($request)->getArray();

/**
 * Do something with $event
 */