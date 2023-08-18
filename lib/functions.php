<?php

function degardc_ti_check_if_special_url(){
    $url_parameters = $_SERVER['QUERY_STRING'] ? $_SERVER['QUERY_STRING'] : false;
    if ($url_parameters && str_contains($url_parameters, 'utm_source')) {
        return true;
    }else{
        return false;
    }
}