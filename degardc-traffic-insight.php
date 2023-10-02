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
include_once DEGARDC_TI_PATH . '/includes/class-discount.php';
include_once DEGARDC_TI_PATH . '/lib/hooks.php';
include_once DEGARDC_TI_PATH . '/lib/functions.php';
include_once DEGARDC_TI_PATH . '/lib/shortcodes.php';
include_once DEGARDC_TI_PATH . '/lib/ajax.php';



function degardc_ti_create_db_table()
{
  $medium = new Medium();
  $request = new Request();
  $medium->create_table();
  $request->create_table();
}
register_activation_hook(__FILE__, 'degardc_ti_create_db_table');



// START پنل ادمین
add_action('admin_menu', 'degardc_ti_menu_pages');
function degardc_ti_menu_pages()
{
  add_menu_page(
    'تبلیغ هدفمند',
    'تبلیغ هدفمند',
    'administrator',
    'degardc-ti',
    'degardc_ti_main_page',
    'dashicons-analytics',
    2000
  );
  add_submenu_page(
    'degardc-ti',
    'آمار بازدید',
    'آمار بازدید',
    'administrator',
    'degardc-ti',
    'degardc_ti_main_page',
  );
  add_submenu_page(
    'degardc-ti',
    'افزودن رسانه',
    'افزودن رسانه',
    'administrator',
    'degardc-ti-new',
    'degardc_ti_new_page',
  );
}

function degardc_ti_main_page()
{
  $mediumObj = new Medium();
  $requestObj = new Request();
  $urls = $mediumObj->get_all();
  $root = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' . '://' . $_SERVER['HTTP_HOST'];
  include DEGARDC_TI_PATH . 'tpl/admin/reports-html.php';
}

function degardc_ti_new_page()
{
  $medium_id = null;
  if(isset($_GET['id'])){
    $medium_id = sanitize_text_field($_GET['id']);
  }

  if (isset($_POST['degardc_ti_save_changes'])) {
    $url = sanitize_text_field($_POST['url']);
    $ads_content = stripslashes($_POST['ads-content']);
    $discount_code = isset($_POST['discount-code']) ? sanitize_text_field($_POST['discount-code']) : "";
    $auto_discount = isset($_POST['auto-discount']) && sanitize_text_field($_POST['auto-discount']) == "on" ? true : false;
    $exact_match = isset($_POST['exact-match']) && sanitize_text_field($_POST['exact-match']) == "on" ? true : false;
    $medium = new Medium($url);
    if ($medium_id) {
      // update
      $medium->update($ads_content, $discount_code, $auto_discount, $exact_match , $medium_id);
    } else {
      // insert
      $medium->insert();
      $medium->update($ads_content, $discount_code, $auto_discount ,$exact_match);
      // redirect
      $redirectURL = $_SERVER['REQUEST_URI'] . '&id=' . $medium->inserted_id;
      header('Location: ' . $redirectURL);
      exit;
    }
    // echo '<div class="updated"><p>تغییرات با موفقیت ذخیره شد</p></div>';
  }

  $medium = new Medium();
  $current_medium = $medium->get_by_id($medium_id);

  $discount = new Discount();
  $all_discounts = $discount->get_all();
  $root = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' . '://' . $_SERVER['HTTP_HOST'];
  include DEGARDC_TI_PATH . 'tpl/admin/ads-html.php';
}