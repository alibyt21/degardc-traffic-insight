<?php

defined('ABSPATH') || exit;

class Request extends Url
{
    private $table;
    private $inserted_id;
    function __construct()
    {
        parent::__construct();
        $table = $this->wpdb->prefix . DEGARDC_TI_REQUESTS_TABLE;
        $this->table = $table;
    }

    public function insert()
    {
        $new_medium = new Medium();
        $medium_id = $new_medium->get_id();
        $row = array('medium_id' => $medium_id, 'visit_duration' => 0);
        $db_result = $this->wpdb->insert($this->table, $row);
        $this->inserted_id = $this->wpdb->insert_id;
    }

    public function get_inserted_id()
    {
        return $this->inserted_id;
    }
}
