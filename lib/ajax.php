<?php
function degardc_ti_set_journey_time_ajax()
{
    $old_cookie = new Cookie("deg_UJ");
    $old_cookie_data = $old_cookie->get();
    if (!$old_cookie_data) {
        wp_die();
    }

    $duration = time() - $old_cookie_data["start"];
    $id = $old_cookie_data["id"];

    // update
    $request = new Request();
    $data = array('visit_duration' => $duration);
    $where = array('id' => $id);
    $request->update($data, $where, 3);
    wp_die();
}
add_action('wp_ajax_degardc_ti_set_journey_time_ajax', 'degardc_ti_set_journey_time_ajax');
add_action('wp_ajax_nopriv_degardc_ti_set_journey_time_ajax', 'degardc_ti_set_journey_time_ajax');
