<?php

defined('ABSPATH') || exit;

class Request extends Url
{
    public $inserted_id;

    public function create_table()
    {
        $charset_collate = $this->wpdb->get_charset_collate();
        $query = "CREATE TABLE IF NOT EXISTS $this->table (
                id bigint(20) NOT NULL AUTO_INCREMENT,
                medium_id int(11) NOT NULL,
                visit_duration int(11),
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY id (id)
                ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($query);
    }

    public function insert()
    {
        $new_medium = new Medium();
        $medium_id = $new_medium->get()->id;
        $row = array('medium_id' => $medium_id, 'visit_duration' => 0);
        $db_result = $this->wpdb->insert($this->table, $row);
        $this->inserted_id = $this->wpdb->insert_id;
    }


    protected function get_table_name(){
        return $this->wpdb->prefix . DEGARDC_TI_REQUESTS_TABLE;
    }

    public function get_by_medium_id($medium_id)
    {
        return $this->wpdb->get_results("SELECT * FROM $this->table WHERE medium_id = $medium_id");
    }

}
