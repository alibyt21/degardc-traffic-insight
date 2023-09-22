<?php

defined('ABSPATH') || exit;

class Discount
{
    protected $wpdb;
    private $postTable;
    private $postmetaTable;
    function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->postTable = $this->wpdb->prefix . 'posts';
        $this->postmetaTable = $this->wpdb->prefix . 'postmeta';
    }
    public function get_all()
    {
        return $this->wpdb->get_results("SELECT * FROM $this->postTable WHERE post_type = 'shop_coupon' AND post_status = 'publish' ORDER BY post_name ASC");
    }
}