# Easy Yelp API Integration 

**Easy Yelp** is a single file PHP client for [Yelp API](https://www.yelp.com/developers/documentation/v3/get_started).

### Installation
You can simply install it using composer.
```
composer require hoseinrafiei/easy-yelp
```
If you're not using composer, you can simply download the file and include it in your project manually.
```php
require 'yelp.php';
```

### Usage
Create an instance and send your API token to the constructor method. Then simply call the methods with proper request and fetch the data from Yelp API **Easily**.
```php
$yelp = new EasyYelp\Yelp('YOUR_API_TOKEN');
$businesses = $yelp->businessSearch([
    'location' => 'Los Angeles, CA',
    'price' => '1,2,3',
    'sort_by' => 'distance',
    'limit' => '30',
])->getArray();
```

### Methods
#### [Business Search](https://www.yelp.com/developers/documentation/v3/business_search)
```php
$request = [];
$yelp->businessSearch($request)->getArray();
```
#### [Phone Search](https://www.yelp.com/developers/documentation/v3/business_search_phone)
```php
$request = [];
$yelp->businessPhoneSearch($request)->getArray();
```
#### [Transaction Search](https://www.yelp.com/developers/documentation/v3/transaction_search)
```php
$request = [];
$yelp->transactionSearch('delivery', $request)->getArray();
```
#### [Business Details](https://www.yelp.com/developers/documentation/v3/business)
```php
$businessId = 'blahblah'; 
$request = [];
$yelp->businessDetails($businessId, $request)->getArray();
```
#### [Business Match](https://www.yelp.com/developers/documentation/v3/business_match)
```php 
$request = [];
$yelp->businessMatch($request)->getArray();
```
#### [Business Reviews](https://www.yelp.com/developers/documentation/v3/business_reviews)
```php 
$businessId = 'blahblah';
$request = [];
$yelp->businessReviews($businessId, $request)->getArray();
```
#### [Autocomplete](https://www.yelp.com/developers/documentation/v3/autocomplete)
```php 
$request = [];
$yelp->autocomplete($request)->getArray();
```
#### [Event Lookup](https://www.yelp.com/developers/documentation/v3/event)
```php 
$eventId = 'blahblah';
$request = [];
$yelp->eventDetails($eventId, $request)->getArray();
```
#### [Event Search](https://www.yelp.com/developers/documentation/v3/event_search)
```php 
$request = [];
$yelp->events($request)->getArray();
```
#### [Featured Event](https://www.yelp.com/developers/documentation/v3/featured_event)
```php 
$request = [];
$yelp->featuredEvent($request)->getArray();
```
#### [All Categories](https://www.yelp.com/developers/documentation/v3/all_categories)
```php 
$request = [];
$yelp->categories($request)->getArray();
```
#### [Category Details](https://www.yelp.com/developers/documentation/v3/category)
```php
$alias = 'blahblah'; 
$request = [];
$yelp->categoryDetails($alias, $request)->getArray();
```
### Examples
You can check examples directory files to see some examples for using API methods.

### Errors
To check if you received an error from Yelp API or not you can use following functions.
```php
$businesses = $yelp->businessSearch($request)->getArray();
if($yelp->hasError()) // We have an error
{
    echo $yelp->getError(); // Print the error message
}
```
### License
This software released under **MIT License**.