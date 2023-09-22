<?php

defined('ABSPATH') || exit;

abstract class Url
{
    public $url;
    protected $page;
    protected $wpdb;
    protected $table;
    protected $utm_source;
    protected $utm_medium;
    protected $utm_campaign;
    protected $utm_content;
    public $is_utm = false;
    function __construct($url = false)
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        if ($url) {
            $this->url = str_replace("/?", "?", $url);
        } else {
            $this->url = str_replace("/?", "?", $_SERVER['REQUEST_URI']);
        }
        $this->check_utm();
        $this->table = $this->get_table_name();
    }
    private function check_utm()
    {
        if (str_contains($this->url, 'utm_source')) {
            $this->split_utm();
            $this->is_utm = true;
        } else {
            $this->is_utm = false;
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

    public function update($data, $where, $try_count)
    {
        // its try as try_count to update
        $db_result = $this->wpdb->update($this->table, $data, $where);
        if (empty($db_result) && $try_count > 0) {
            $try_count = $try_count - 1;
            return $this->update($data, $where, $try_count);
        }
        return $db_result;
    }

    abstract protected function get_table_name();
}
