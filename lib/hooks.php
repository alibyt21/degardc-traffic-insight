<?php

function degardc_ti_front_scripts()
{
    $mediumObj = new Medium();
    if ($mediumObj->is_repeatitive()) {
        wp_enqueue_script('degardc-ti-front', DEGARDC_TI_URL . 'assets/js/index.js', array(), '1.0.0');
        wp_enqueue_style('degardc-ti-front', DEGARDC_TI_URL . 'assets/css/index.css');
    }
    wp_localize_script('degardc-ti-front', 'degardc_ti_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'degardc_ti_front_scripts');

function degardc_ti_admin_scripts()
{
    wp_enqueue_style('degardc-ti-data-table', DEGARDC_TI_URL . 'assets/css/datatables.min.css');
    wp_enqueue_script('degardc-ti-data-table', DEGARDC_TI_URL . 'assets/js/datatables.min.js', array(), '1.0.0', false);
}
add_action('admin_enqueue_scripts', 'degardc_ti_admin_scripts');



function degardc_ti_add_new_traffic_source_to_db()
{
    $mediumObj = new Medium();
    if (!$mediumObj->is_repeatitive()) {
        // new
        if ($mediumObj->is_utm) {
            //track new utm source
            $mediumObj->insert();
        }
    }
}
add_action("init", "degardc_ti_add_new_traffic_source_to_db", 10);


function degardc_ti_check_user_journey()
{
    $mediumObj = new Medium();
    if (!$mediumObj->is_repeatitive()) {
        // url is not under track
        return;
    }
    // url is under track
    // check prev session is still valid
    $old_cookie = new Cookie("deg_UJ");
    $old_cookie_data = $old_cookie->get();
    $requestObj = new Request();
    if ($old_cookie_data && time() - $old_cookie_data["start"] <= 1800 && $old_cookie_data["source"] == $requestObj->url) {
        return;
    }

    // create new session for user
    $requestObj->insert();
    $insert_id = $requestObj->inserted_id;

    // set cookie
    $new_cookie = new Cookie();
    $data = ["id" => $insert_id, "source" => $requestObj->url, "start" => time()];
    $new_cookie->set("deg_UJ", $data, time() + (1800), "/"); // 1800 = 30 minutes


    $old_cookie = new Cookie("deg_US");
    $old_cookie_data = $old_cookie->get();
    if ($old_cookie_data && time() - $old_cookie_data["start"] <= (3600 * 24 * 30) && $old_cookie_data["source"] == $requestObj->url) {
        return;
    }
    $fullFill_cookie = new Cookie();
    $fData = ["id" => $insert_id, "source" => $requestObj->url, "start" => time()];
    $fullFill_cookie->set("deg_US", $fData, time() + (3600 * 24 * 30), "/"); // 3600 * 24 * 30 = 30 days
}
add_action("init", "degardc_ti_check_user_journey", 11);



function degardc_ti_show_ads_content()
{
    $mediumObj = new Medium();
    $adsContent = json_decode($mediumObj->ads_content);
    if ($mediumObj->is_repeatitive() && $adsContent->isActive) {
        // tracked medium
        if ($adsContent->type == "modal") {
            include DEGARDC_TI_PATH . 'tpl/front/modal-html.php';
        } else {
            echo $adsContent->content;
        }
    }
}
add_action("wp_body_open", "degardc_ti_show_ads_content");


function degardc_ti_map_order_to_request($order_id)
{
    $cookie = new Cookie("deg_US");
    $cookie_data = $cookie->get();
    $request_id = $cookie_data["id"];
    $requestObj = new Request();
    $data = array('fullfill' => $order_id);
    $where = array('id' => $request_id);
    $requestObj->update($data, $where, 1);
    $cookie->delete();
}
add_action('woocommerce_thankyou', 'degardc_ti_map_order_to_request');


function check_add_to_cart_redirect()
{
    if (isset($_GET['add-to-cart'])) {
        // Check if the URL contains the "add-to-cart" query string
        $checkout_url = wc_get_checkout_url(); // Get the WooCommerce checkout URL
        wp_redirect($checkout_url); // Redirect to the checkout page
        exit;
    }
}
add_action('template_redirect', 'check_add_to_cart_redirect');
