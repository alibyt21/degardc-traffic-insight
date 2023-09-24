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

    public static function apply($coupon_code)
    {
        // Get the WooCommerce cart instance
        $cart = WC()->cart;
        // Check if the coupon is valid
        if (!$cart) {
            return;
        }
        if ($cart->get_coupons() === $coupon_code) {
            // The coupon is already applied, do something
        } else {
            // Remove existing coupons
            $cart->remove_coupons();
            // Create a new coupon object
            $coupon = new WC_Coupon($coupon_code);
            // Apply the coupon to the cart
            $cart->apply_coupon($coupon_code);
            // Calculate totals
            $cart->calculate_totals();
            // Do something after applying the coupon
        }
    }
}
