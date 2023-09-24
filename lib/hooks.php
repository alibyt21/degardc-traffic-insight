<?php

function degardc_ti_front_scripts()
{
    // if (Url::is_utm()) {
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



function degardc_ti_add_new_traffic_source_to_db()
{
    $mediumObj = new Medium();
    if(!$mediumObj->is_repeatitive()){
        // new
        if ($mediumObj->is_utm) {
            //track new utm source
            $mediumObj->insert();
        }
    }else{
        // old
        echo $mediumObj->row->ads_content;
        // apply discount code if auto_discount is actived
        if($mediumObj->row->auto_discount){
            Discount::apply($mediumObj->row->discount_code);
        }
    }
}
add_action("init", "degardc_ti_add_new_traffic_source_to_db", 10);


function degardc_ti_check_user_journey()
{

    $mediumObj = new Medium();
    if (!$mediumObj->is_repeatitive()) {
        return;
    }
    // check prev session is still valid
    $old_cookie = new Cookie("deg_UJ");
    $old_cookie_data = $old_cookie->get();
    $requestObj = new Request();
    if ($old_cookie_data) {
        if (time() - $old_cookie_data["start"] <= 1800 && $old_cookie_data["source"] == $requestObj->url) {
            return;
        }
    }

    // create new session for user
    $requestObj->insert();
    $insert_id = $requestObj->inserted_id;

    // set cookie
    $new_cookie = new Cookie();
    $data = ["id" => $insert_id, "source" => $requestObj->url, "start" => time()];
    $new_cookie->set("deg_UJ", $data, time() + (1800), "/"); // 1800 = 30 minutes
}
add_action("init", "degardc_ti_check_user_journey", 11);
