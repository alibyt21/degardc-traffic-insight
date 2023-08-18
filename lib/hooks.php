<?php

function degardc_ti_front_scripts()
{
    // if (degardc_ti_check_if_special_url()) {
    wp_enqueue_script('degardc-ti-front', DEGARDC_TI_URL . 'assets/js/index.js', array(), '1.0.0', true);
    // }
    wp_localize_script('degardc-ti-front', 'degardc_ti_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'degardc_ti_front_scripts');

function degardc_ti_admin_scripts()
{
    wp_enqueue_style('degardc-ti-data-table', DEGARDC_TI_URL . 'assets/css/datatables.min.css');
    wp_enqueue_script('degardc-ti-data-table', DEGARDC_TI_URL . 'assets/js/datatables.min.js', array(), '1.0.0', false);
}
add_action('admin_enqueue_scripts', 'degardc_ti_admin_scripts');



function degardc_ti_check_if_ad_url()
{
    global $wpdb;
    $table = $wpdb->prefix . DEGARDC_TI_MEDIA_TABLE;
    $full_request_url = $_SERVER['REQUEST_URI'];
    $request_url = $_SERVER['REDIRECT_URL'] ? $_SERVER['REDIRECT_URL'] : false;
    $url_parameters = $_SERVER['QUERY_STRING'] ? $_SERVER['QUERY_STRING'] : false;
    // echo '<pre>';
    // var_dump($_SERVER);
    // echo '</pre>';
    if (!degardc_ti_check_if_special_url()) {
        return;
    }
    $full_request_url = str_replace("/?", "?", $full_request_url);
    //get match url if exists
    $url = $wpdb->get_row("SELECT url FROM $table WHERE url = '$full_request_url'");
    if ($url) {
        return;
    }
    // insert
    $row = array('url' => $full_request_url);
    $db_result = $wpdb->insert($table, $row);
    $insert_id = $wpdb->insert_id;
}
add_action("init", "degardc_ti_check_if_ad_url", 10);


function degardc_ti_check_user_journey()
{
    global $wpdb;
    $url_table = $wpdb->prefix . DEGARDC_TI_MEDIA_TABLE;
    $request_table = $wpdb->prefix . DEGARDC_TI_REQUESTS_TABLE;
    $full_request_url = $_SERVER['REQUEST_URI'];
    $request_url = $_SERVER['REDIRECT_URL'] ? $_SERVER['REDIRECT_URL'] : false;
    $url_parameters = $_SERVER['QUERY_STRING'] ? $_SERVER['QUERY_STRING'] : false;
    if (!degardc_ti_check_if_special_url()) {
        return;
    }
    $full_request_url = str_replace("/?", "?", $full_request_url);
    //get match url if exists
    $url = $wpdb->get_row("SELECT id FROM $url_table WHERE url = '$full_request_url'");
    if (!$url) {
        return;
    }
    $url_id = $url->id;

    // check prev session is still valid
    if (isset($_COOKIE["deg_UJ"])) {
        $serializedData = $_COOKIE['deg_UJ'];
        $decodedData = base64_decode($serializedData);

        // Unserialize the decoded data to get the original array
        $dataArray = unserialize($decodedData);
        if (time() - $dataArray["start"] <= 1800 && $dataArray["source"] == $full_request_url) {
            return;
        }
    }

    // create new session for user
    $row = array('url_id' => $url_id, 'visit_duration' => 0);
    $db_result = $wpdb->insert($request_table, $row);
    $insert_id = $wpdb->insert_id;
    // set cookie
    $data = ["id" => $insert_id, "source" => $full_request_url, "start" => time()];
    $serializedData = base64_encode(serialize($data));
    setcookie("deg_UJ", $serializedData, time() + (1800), "/"); // 1800 = 30 minutes
}
add_action("init", "degardc_ti_check_user_journey", 11);
