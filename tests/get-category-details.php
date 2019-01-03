<?php
// Yelp Client
require '../src/EasyYelp/yelp.php';

// Telp Token
$token = 'PUT_YOUR_TOKEN_HERE';

// Yelp Instance
$yelp = new EasyYelp\Yelp($token);

// Get Yelp Categories
$response = $yelp->categories()->getArray();

// Loop Through Categories
foreach($response['categories'] as $c)
{
    // Get Category Details
    $category = $yelp->categoryDetails($c['alias'])->getObject();

    /**
     * Do something with $category
     */
}