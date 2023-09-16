<?php
function degardc_ti_set_journey_time_ajax()
{
    function update($request_table, $data, $where, $try_count)
    {
        // its try as try_count to update
        global $wpdb;
        $db_result = $wpdb->update($request_table, $data, $where);
        if (empty($db_result) && $try_count > 0) {
            $try_count = $try_count - 1;
            return update($request_table, $data, $where, $try_count);
        }
        return $db_result;
    }

    if (!isset($_COOKIE['deg_UJ'])) {
        wp_die();
    }

    global $wpdb;
    $serializedData = $_COOKIE['deg_UJ'];
    $decodedData = base64_decode($serializedData);

    // Unserialize the decoded data to get the original array
    $dataArray = unserialize($decodedData);
    $duration = time() - $dataArray["start"];
    $id = $dataArray["id"];

    // update
    $request_table = $wpdb->prefix . DEGARDC_TI_REQUESTS_TABLE;
    $data = array('visit_duration' => $duration);
    $where = array('id' => $id);
    $result = update($request_table, $data, $where, 3);
    wp_die();
}
add_action('wp_ajax_degardc_ti_set_journey_time_ajax', 'degardc_ti_set_journey_time_ajax');
add_action('wp_ajax_nopriv_degardc_ti_set_journey_time_ajax', 'degardc_ti_set_journey_time_ajax');
