<?php

defined('ABSPATH') || exit;

class Medium extends Url
{
    private $table;
    private $fetched_url;
    private $inserted_id;
    function __construct()
    {
        parent::__construct();
        $table = $this->wpdb->prefix . DEGARDC_TI_MEDIA_TABLE;
        $this->table = $table;
    }

    public function is_repeatitive()
    {
        $this->fetched_url = $this->get();
        if ($this->fetched_url) {
            return true;
        }else{
            return false;
        }
    }

    public function get()
    {
        return $this->wpdb->get_row("SELECT * FROM $this->table WHERE url = '$this->page' AND utm_source = '$this->utm_source' AND utm_medium = '$this->utm_medium' AND utm_campaign = '$this->utm_campaign' AND utm_content = '$this->utm_content'");
    }

    public function insert()
    {
        $row = array('url' => $this->page, 'utm_source' => $this->utm_source, 'utm_medium' => $this->utm_medium, 'utm_campaign' => $this->utm_campaign, 'utm_content' => $this->utm_content);
        $db_result = $this->wpdb->insert($this->table, $row);
        $this->inserted_id = $this->wpdb->insert_id;
    }

    public function get_id()
    {
        return $this->get()->id;
    }
}
