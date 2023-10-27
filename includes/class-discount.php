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
    public static function calculate_discounted_price($discount_code, $product_id)
    {
        // Load WooCommerce classes and functions
        if (!function_exists('WC')) {
            return null;
        }

        // Get the product object based on the product ID
        $product = wc_get_product($product_id);

        // Check if the product exists and is a valid product type
        if (!$product || !$product->is_type('simple')) {
            // Invalid product ID.
            return null;
        }

        // Create a new cart instance
        $cart = WC()->cart;

        // Add the product to the cart
        $cart->add_to_cart($product_id);

        // Apply the discount code to the cart
        $cart->apply_coupon($discount_code);

        $discounted_price = null;
        // Get the discounted price
        // Remove the product from the cart
        foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
            // Check if the product ID matches
            if ($cart_item['product_id'] == $product_id) {
                // Remove the cart item
                $discounted_price = $cart_item['line_total'];
                $cart->remove_cart_item($cart_item_key);
                break; // Stop looping after removing the item
            }
        }

        // format discounted price
        if ($discounted_price) {
            $discounted_price = number_format($discounted_price, 0, ".", ",");
            $discounted_price = $discounted_price . " تومان ";
        } else {
            $discounted_price = "رایگان";
        }
        return $discounted_price;
    }
}
