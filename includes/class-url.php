<?php

defined('ABSPATH') || exit;

abstract class Url
{
    public $url;
    protected $page;
    protected $wpdb;
    protected $utm_source;
    protected $utm_medium;
    protected $utm_campaign;
    protected $utm_content;
    function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->url = str_replace("/?", "?", $_SERVER['REQUEST_URI']);
        if ($this->is_utm()) {
            $this->split_utm();
        }
    }
    public function is_utm()
    {
        $url_parameters = $_SERVER['QUERY_STRING'] ? $_SERVER['QUERY_STRING'] : false;
        if ($url_parameters && str_contains($url_parameters, 'utm_source')) {
            return true;
        } else {
            return false;
        }
    }
    private function split_utm()
    {
        // Parse the URL to extract the query string
        $queryString = parse_url($this->url, PHP_URL_QUERY);

        // Parse the query string to get the parameters as an associative array
        $params = [];
        parse_str($queryString, $params);

        $this->page = explode('?', $this->url)[0];
        $this->utm_source = isset($params['utm_source']) ? $params['utm_source'] : '';
        $this->utm_medium = isset($params['utm_medium']) ? $params['utm_medium'] : '';
        $this->utm_campaign = isset($params['utm_campaign']) ? $params['utm_campaign'] : '';
        $this->utm_content = isset($params['utm_content']) ? $params['utm_content'] : '';
        
    }
}
