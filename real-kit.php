<?php
/*
Plugin Name: real.Kit
Version: 1.3
Plugin URI:
Description: Набор дополнений и улучшений WordPress | <a target="_blank" href="https://wordpress.org/plugins/real-kit/">English Description.</a>
Author: Realist
Author URI:
Text Domain: realkit
Domain Path: /lng/
*/

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

if (is_admin()) {

  // ID
  require_once $realkit['plugin_dir_path'] . 'inc/ids.php';

  // Транслитерация
  require_once $realkit['plugin_dir_path'] . 'inc/translit.php';

  // real.Donate
  if (!function_exists('real_add_real_page')) {
    add_action('admin_menu', 'real_add_real_page');
    function real_add_real_page() {
      add_menu_page('real.', 'real.', 'manage_options', 'real', 'real_donate_page', 'dashicons-businessman');
    }
    function real_donate_page() {
      global $realkit;
      require_once $realkit['plugin_dir_path'] . 'tpl/real.php';
    }
  }

}

// Шорткод с JS
require_once $realkit['plugin_dir_path'] . 'inc/shortcode-js.php';