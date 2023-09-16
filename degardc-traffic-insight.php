<?php
/*
* Plugin Name: Degardc Traffic Insight
* Plugin URI: https://degardc.com
* Description: بررسی رسانه و تبلیغات هدفمند
* Version: 1.0.0
* Author: ali bayat
* Author URI: https://degardc.com
* License: GPL2
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: fa
* Domain Path: /languages/
*/
defined('ABSPATH') || exit;


define('DEGARDC_TI_URL', plugin_dir_url(__FILE__));
define('DEGARDC_TI_PATH', plugin_dir_path(__FILE__));
define('DEGARDC_TI_MEDIA_TABLE', 'degardc_ti_media');
define('DEGARDC_TI_REQUESTS_TABLE', 'degardc_ti_requests');

include_once DEGARDC_TI_PATH . '/includes/class-url.php';
include_once DEGARDC_TI_PATH . '/includes/class-medium.php';
include_once DEGARDC_TI_PATH . '/includes/class-request.php';
include_once DEGARDC_TI_PATH . '/includes/class-cookie.php';
include_once DEGARDC_TI_PATH . '/lib/hooks.php';
include_once DEGARDC_TI_PATH . '/lib/functions.php';
include_once DEGARDC_TI_PATH . '/lib/shortcodes.php';
include_once DEGARDC_TI_PATH . '/lib/ajax.php';



function degardc_ti_create_db_table()
{
  global $wpdb;
  $url_table_name = $wpdb->prefix . DEGARDC_TI_MEDIA_TABLE;
  $charset_collate = $wpdb->get_charset_collate();
  $sql1 = "CREATE TABLE IF NOT EXISTS $url_table_name (
      id int(11) NOT NULL AUTO_INCREMENT,
      url text(127) NOT NULL,
      utm_source text(63),
      utm_medium text(63),
      utm_campaign text(63),
      utm_content text(63),
      created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY id (id)
    ) $charset_collate;";


  $request_table_name = $wpdb->prefix . DEGARDC_TI_REQUESTS_TABLE;
  $charset_collate = $wpdb->get_charset_collate();
  $sql2 = "CREATE TABLE IF NOT EXISTS $request_table_name (
      id bigint(20) NOT NULL AUTO_INCREMENT,
      medium_id int(11) NOT NULL,
      visit_duration int(11),
      created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY id (id)
    ) $charset_collate;";

  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql1);
  dbDelta($sql2);
}
register_activation_hook(__FILE__, 'degardc_ti_create_db_table');



// START پنل ادمین
add_action('admin_menu', 'degardc_ti_menu_pages');
function degardc_ti_menu_pages()
{
  add_menu_page(
    'آمار بازدید',
    'آمار بازدید',
    'administrator',
    'degardc_ti',
    'degardc_ti_main_page',
    'dashicons-analytics',
    2000
  );
}

function degardc_ti_main_page()
{
  global $wpdb;
  $url_table_name = $wpdb->prefix . DEGARDC_TI_MEDIA_TABLE;
  $request_table_name = $wpdb->prefix . DEGARDC_TI_REQUESTS_TABLE;
  $urls = $wpdb->get_results("SELECT * FROM $url_table_name");
  include DEGARDC_TI_PATH . 'tpl/admin/reports-html.php';
}
