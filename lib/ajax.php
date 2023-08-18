<?php
function degardc_ti_set_journey_time_ajax()
{
    if(!isset($_COOKIE['deg_UJ'])){
        wp_die();
    }
    global $wpdb;
    $serializedData = $_COOKIE['deg_UJ'];
    $decodedData = base64_decode($serializedData);

    // Unserialize the decoded data to get the original array
    $dataArray = unserialize($decodedData);
    $duration = time() - $dataArray["start"];
    $id = $dataArray["id"];
    
    $request_table = $wpdb->prefix . DEGARDC_TI_REQUESTS_TABLE;
    
    // update
    $data = array('visit_duration' => $duration);
    $where = array('id' => $id);
    $db_result = $wpdb->update($request_table, $data, $where);
    wp_die();
}
add_action('wp_ajax_degardc_ti_set_journey_time_ajax', 'degardc_ti_set_journey_time_ajax');
add_action('wp_ajax_nopriv_degardc_ti_set_journey_time_ajax', 'degardc_ti_set_journey_time_ajax');
