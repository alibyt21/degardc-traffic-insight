<?php

defined('ABSPATH') || exit;

class Medium extends Url
{
    public $inserted_id;
    private $row;
    private $ads;
    public $ads_content;
    public $auto_discount;
    public $discount_code;
    public $id;

    function __construct($url = false)
    {
        parent::__construct($url);
        $this->row = $this->get();
        if($this->row){
            $this->id = $this->row->id;
            $this->ads = $this->get_ads_content();
            if($this->ads){
                $this->ads_content = $this->ads->ads_content;
                $this->auto_discount = $this->ads->auto_discount;
                $this->discount_code = $this->ads->discount_code;
            }
        }
    }

    protected function get_table_name()
    {
        return $this->wpdb->prefix . DEGARDC_TI_MEDIA_TABLE;
    }

    public function create_table()
    {
        $charset_collate = $this->wpdb->get_charset_collate();
        $query = "CREATE TABLE IF NOT EXISTS $this->table (
                id int(11) NOT NULL AUTO_INCREMENT,
                url varchar(127) NOT NULL,
                utm_source varchar(63),
                utm_medium varchar(63),
                utm_campaign varchar(63),
                utm_content varchar(63),
                discount_code varchar(63),
                auto_discount boolean,
                ads_content text,
                exact_match boolean,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY id (id)
                ) $charset_collate;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($query);
    }



    public function is_repeatitive()
    {
        if ($this->row) {
            return true;
        } else {
            return false;
        }
    }

    private function get()
    {
        return $this->wpdb->get_row("SELECT * FROM $this->table WHERE url = '$this->page' AND utm_source = '$this->utm_source' AND utm_medium = '$this->utm_medium' AND utm_campaign = '$this->utm_campaign' AND utm_content = '$this->utm_content'");
    }

    private function get_ads_content()
    {
        return $this->wpdb->get_row("SELECT * FROM $this->table WHERE url = '$this->page' AND utm_source = '$this->utm_source' AND utm_medium = '$this->utm_medium' AND utm_campaign = '$this->utm_campaign' AND ads_content IS NOT NULL AND ads_content <> '' OR url = '$this->page' AND utm_source = '$this->utm_source' AND utm_medium = '$this->utm_medium' AND ads_content IS NOT NULL AND ads_content <> '' AND exact_match = 0 OR url = '$this->page' AND utm_source = '$this->utm_source' AND ads_content IS NOT NULL AND ads_content <> '' AND exact_match = 0 OR url = '$this->page' AND ads_content IS NOT NULL AND ads_content <> '' AND exact_match = 0 ORDER BY CASE WHEN url = '$this->page' AND utm_source = '$this->utm_source' AND utm_medium = '$this->utm_medium' AND utm_campaign = '$this->utm_campaign' AND ads_content IS NOT NULL AND ads_content <> '' THEN 1 WHEN url = '$this->page' AND utm_source = '$this->utm_source' AND utm_medium = '$this->utm_medium' THEN 2 WHEN url = '$this->page' AND utm_source = '$this->utm_source' THEN 3 WHEN url = '$this->page' THEN 4 END LIMIT 1;");
    }

    public function get_by_id($id)
    {
        return $this->wpdb->get_row("SELECT * FROM $this->table WHERE id = '$id'");
    }

    public function parse($id)
    {
        if (!$id) {
            return;
        }
        $medium = $this->get_by_id($id);
        $url = $medium->url;
        $query = '';
        if ($medium->utm_source) {
            $query .= "?utm_source=" . $medium->utm_source;
        }
        if ($medium->utm_medium) {
            $query .= $medium->utm_source ? "&utm_medium=" . $medium->utm_medium : "?utm_medium=" . $medium->utm_medium;
        }
        if ($medium->utm_campaign) {
            $query .= ($medium->utm_source || $medium->utm_medium) ? "&utm_campaign=" . $medium->utm_campaign : "?utm_campaign=" . $medium->utm_campaign;
        }
        if ($medium->utm_content) {
            $query .= ($medium->utm_source || $medium->utm_medium || $medium->utm_campaign) ? "&utm_content=" . $medium->utm_content : "?utm_content=" . $medium->utm_content;
        }
        return $url . $query;
    }

    public function get_all()
    {
        return $this->wpdb->get_results("SELECT * FROM $this->table");
    }

    public function insert()
    {
        if ($this->is_repeatitive()) {
            return;
        }
        $row = array('url' => $this->page, 'utm_source' => $this->utm_source, 'utm_medium' => $this->utm_medium, 'utm_campaign' => $this->utm_campaign, 'utm_content' => $this->utm_content);
        $db_result = $this->wpdb->insert($this->table, $row);
        $this->inserted_id = $this->wpdb->insert_id;
    }

    public function update($ads_content, $discount_code, $auto_discount, $exact_match = false, $inserted_id = false)
    {
        if ($inserted_id) {
            $this->inserted_id = $inserted_id;
        }
        $data = array('url' => $this->page, 'utm_source' => $this->utm_source, 'utm_medium' => $this->utm_medium, 'utm_campaign' => $this->utm_campaign, 'utm_content' => $this->utm_content, 'ads_content' => $ads_content, 'discount_code' => $discount_code, 'auto_discount' => $auto_discount, 'exact_match' => $exact_match);
        $where = array('id' => $this->inserted_id);
        return $this->wpdb->update($this->table, $data, $where);
    }
}
