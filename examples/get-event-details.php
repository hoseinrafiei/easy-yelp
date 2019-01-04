<?php
// Yelp Client
require '../src/yelp.php';

// Telp Token
$token = 'PUT_YOUR_TOKEN_HERE';

// Yelp Instance
$yelp = new EasyYelp\Yelp($token);

// Get Yelp Event
$eventId = 'san-francisco-yelp-10-year-anniversary-celebration';
$event = $yelp->eventDetails($eventId)->getObject();

/**
 * Do something with $event
 */