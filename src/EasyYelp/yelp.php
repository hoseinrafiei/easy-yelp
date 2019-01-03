<?php
namespace EasyYelp;

/**
 * Yelp API Client
 *
 * @author Hosein Rafiei <hoseinrafiei@gmail.com>
 * @class Yelp
 * @version 1.0.0
 */
class Yelp
{
    /**
     * API Endpoint
     * @var string
     */
    private $endpoint = 'https://api.yelp.com/v3';

    /**
     * JSON Results
     * @var string
     */
    private $results;

    /**
     * API Token
     * @var string
     */
    private $token;

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param array $args
     * @return Yelp
     */
    public function businessSearch(array $args = array())
    {
        return $this->_getRequest('businesses/search', $args);
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param array $args
     * @return Yelp
     */
    public function businessPhoneSearch(array $args = array())
    {
        return $this->_getRequest('businesses/search/phone', $args);
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param string $transactionType
     * @param array $args
     * @return Yelp
     */
    public function transactionSearch(string $transactionType = 'delivery', array $args = array())
    {
        return $this->_getRequest('transactions/'.$transactionType.'/search', $args);
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param string $id
     * @param array $args
     * @return Yelp
     */
    public function businessDetails(string $id, array $args = array())
    {
        return $this->_getRequest('businesses/'.$id, $args);
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param array $args
     * @return Yelp
     */
    public function businessMatch(array $args = array())
    {
        return $this->_getRequest('businesses/matches', $args);
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param string $id
     * @param array $args
     * @return Yelp
     */
    public function businessReviews(string $id, array $args = array())
    {
        return $this->_getRequest('businesses/'.$id.'/reviews', $args);
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param array $args
     * @return Yelp
     */
    public function autocomplete(array $args = array())
    {
        return $this->_getRequest('autocomplete', $args);
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param array $args
     * @return Yelp
     */
    public function events(array $args = array())
    {
        return $this->_getRequest('events', $args);
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param string $id
     * @param array $args
     * @return Yelp
     */
    public function eventDetails(string $id, array $args = array())
    {
        return $this->_getRequest('events/'.$id, $args);
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param array $args
     * @return Yelp
     */
    public function featuredEvent(array $args = array())
    {
        return $this->_getRequest('events/featured', $args);
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param array $args
     * @return Yelp
     */
    public function categories(array $args = array())
    {
        return $this->_getRequest('categories', $args);
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param string $alias
     * @param array $args
     * @return Yelp
     */
    public function categoryDetails(string $alias, array $args = array())
    {
        return $this->_getRequest('categories/'.$alias, $args);
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @return array
     */
    public function getArray()
    {
        return json_decode($this->results, true);
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @return array
     */
    public function getObject()
    {
        return json_decode($this->results);
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param array|\stdClass $response
     * @return boolean
     */
    public function hasError($response = NULL)
    {
        // Get Current Response
        if(is_null($response)) $response = $this->getObject();

        // Return Error Status
        if(is_array($response)) return isset($response['error']);
        else return isset($response->error);
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param array|\stdClass $response
     * @return string
     */
    public function getError($response = NULL)
    {
        // Get Current Response
        if(is_null($response)) $response = $this->getObject();

        // Check to See if we have Error
        if(!$this->hasError($response)) return NULL;

        // Return Error Description
        if(is_array($response)) return $response['error']['description'];
        else return $response->error->description;
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param string $route
     * @param array $args
     * @return Yelp
     */
    protected function _postRequest(string $route, array $args = array())
    {
        return $this->_call($route, $args, 'POST');
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param string $route
     * @param array $args
     * @return Yelp
     */
    protected function _getRequest(string $route, array $args = array())
    {
        return $this->_call($route, $args, 'GET');
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param string $route
     * @param array $args
     * @param string $method
     * @return Yelp
     */
    protected function _call(string $route, array $args = array(), string $method = 'POST')
    {
        // API URL to Call
        $url = $this->_url($route);

        // Init the CURL
        $curl = curl_init();

        // Request Method
        if($method == 'POST')
        {
            curl_setopt($curl, CURLOPT_POST, 1);

            // Request Payload
            if(is_array($args) and count($args)) curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($args));
        }
        else
        {
            // Request Payload
            if(is_array($args) and count($args)) $url = sprintf("%s?%s", $url, http_build_query($args));
        }

        // Set CURL Parameters
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        // Generate the Request Headers
        $headers = array('Content-Type: application/json', $this->_getTokenHeader());

        // Set Request Headers
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        // Execute the CURL
        $this->results = curl_exec($curl);

        // Close the CURL
        curl_close($curl);

        // Return the Results
        return $this;
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @param string $route
     * @return string
     */
    protected function _url(string $route)
    {
        return rtrim($this->endpoint.'/'.$route, '/');
    }

    /**
     * @author Hosein Rafiei <hoseinrafiei@gmail.com>
     * @return string
     */
    protected function _getTokenHeader()
    {
        return 'Authorization: Bearer '.$this->token;
    }
}