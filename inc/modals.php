<?php

$modals_toggle = get_option('realkit_modals_toggle');

if (empty($modals_toggle) or $modals_toggle == 'on') {

  if (isset($_SESSION['realkit']['modals'])) unset($_SESSION['realkit']['modals']);

  // Создает новый тип записей
  add_action('init', 'realkit_modals_init');
  function realkit_modals_init() {

    global $realkit;

    $labels = array(
      'name'                => __('Modals', 'realkit'),
      'singular_name'       => __('Modal', 'realkit'),
      'add_new'             => __('Add New', 'realkit'),
      'add_new_item'        => __('Add New Modal', 'realkit'),
      'edit_item'           => __('Edit Modal', 'realkit'),
      'new_item'            => __('New Modal', 'realkit'),
      'all_items'           => __('All Modals', 'realkit'),
      'view_item'           => __('View Modal', 'realkit'),
      'search_items'        => __('Search Modal', 'realkit'),
      'not_found'           => __('No Modal found', 'realkit'),
      'not_found_in_trash'  => __('No Modal found in Trash', 'realkit'),
      'menu_name'           => __('real.Modals', 'realkit'),
      'parent_item_colon'   => ''
    );

    $args = array(
      'labels'       => $labels,
      'public'       => true,
      'show_in_menu' => true,
      'supports'     => array('title', 'editor')
    );

    register_post_type($realkit['modals_post_type'], $args);

  }

  // Уведомления
  add_filter('post_updated_messages', 'realkit_modals_post_type_messages');
  function realkit_modals_post_type_messages($messages) {
    global $realkit;
    $messages[$realkit['modals_post_type']] = array(
      0  => '',
      1  => __('Modal updated.', 'realkit'),
      5  => isset($_GET['revision']) ? __('Modal restored.', 'realkit') : false,
      6  => __('Modal published.', 'realkit'),
      7  => __('Modal saved.', 'realkit'),
      9  => sprintf(__('Modal scheduled for:', 'realkit') . ' <strong>%1$s</strong>.', date_i18n(__('M j, Y @ G:i'))),
      10 => __('Modal draft updated.', 'realkit')
    );
    return $messages;
  }

  // Добавить колонку с Шорткодом
  add_action('admin_init', 'realkit_modals_admin_init');
  function realkit_modals_admin_init() {
    global $realkit;
    add_action('manage_edit-' . $realkit['modals_post_type'] . '_columns', 'realkit_modals_add_column');
    add_filter('manage_' . $realkit['modals_post_type'] . '_posts_custom_column', 'realkit_modals_column_value', 10, 3);
    add_filter('manage_edit-' . $realkit['modals_post_type'] . '_sortable_columns', 'realkit_modals_add_column');
  }

  // Добавляет колонку с Шорткодом
  function realkit_modals_add_column($columns) {
    $columns['realkit_modals_modal_insert_code'] = __('Shortcode', 'realkit');
    unset($columns['date']);
    return $columns;
  }

  // Добавляет Шорткод в нужную колонку
  function realkit_modals_column_value($column, $id) {
    global $post;
    if ($column == 'realkit_modals_modal_insert_code') {
      echo '[modal open="' . $id . '" id="button_id" class="button_class"]' . __('Button Title', 'realkit') . '[/modal]';
    }
  }

  // Сформировать модальные окна
  add_action('wp_footer', 'realkit_modals_echo_modals');
  function realkit_modals_echo_modals()
  {
    if (isset($_SESSION['realkit']['modals']) and is_array($_SESSION['realkit']['modals'])) {
      global $realkit;
      require $realkit['plugin_dir_path'] . 'tpl/modal.php';
    }
  }

  // CSS/JS
  add_action('init', 'realkit_modals_common');
  function realkit_modals_common() {
    if (!is_admin()) {

      global $realkit;
      $url = $realkit['plugin_dir_url'];

      wp_register_style('realmodals', $url . 'css/modals.css');
      wp_enqueue_style('realmodals');

      wp_register_script('realmodals', $url . 'js/modals.js', array('jquery'));
      wp_enqueue_script('realmodals');

    }
  }

}

// Добавить шорткод
if (shortcode_exists('modal')) remove_shortcode('modal');
add_shortcode('modal', 'realkit_modals_shortcode');
function realkit_modals_shortcode($args, $content) {

  if (!isset($args['open']) or !isset($content) or get_option('realkit_modals_toggle') == 'off') return false;

  $args = shortcode_atts(array(
    'open'  => '',
    'class' => '',
    'id'    => ''
  ), $args);

  global $realkit;

  $modal = get_post($args['open']);
  if (!empty($modal)) {

    setup_postdata($modal);

    $modal_id      = $args['open'];
    $modal_content = apply_filters('the_content', get_the_content());

    $_SESSION['realkit']['modals'][$modal_id] = $modal;

    $id      = (empty($args['id']))    ? '' : ' id="'    . $args['id']    . '"';
    $class   = (empty($args['class'])) ? '' : ' class="' . $args['class'] . '"';
    $target  = ' data-realmodal-target="#realmodal-' . $args['open'] . '"';
    $content = str_replace(array('<p>', '</p>'), '', $content);

    $button  = '
      <button type="button"' . $id . $class . $target . ' data-realmodal="open">' . $content . '</button>
    ';

    wp_reset_query();

    return trim(str_replace(array("\r", "\n"), '', $button));

  }

}

if (is_admin()) {

  // Поле с шорткодов на странице модального окна
  add_action('add_meta_boxes', 'realkit_modals_metabox_shortcode');
  function realkit_modals_metabox_shortcode() {
    global $realkit;
    add_meta_box('realkit_modals_metabox_shortcode', __('Open Button Shortcode', 'realkit'), 'realkit_modals_metabox_shortcode_content', $realkit['modals_post_type'], 'side');
  }
  function realkit_modals_metabox_shortcode_content() {
    if (isset($_GET['post'])) {
      echo '[modal open="' . $_GET['post'] . '" id="button_id" class="button_class"]' . __('Button Title', 'realkit') . '[/modal]';
    }
  }

  // Добавить страницу настроек
  add_action('admin_menu', 'realkit_modals_options_page');
  function realkit_modals_options_page() {
    add_options_page(__('Modals', 'realkit'), __('Modals', 'realkit'), 'manage_options', __FILE__, 'realkit_modals_options_page_content');
  }
  function realkit_modals_options_page_content() {

    $updated = '';
    if (isset($_POST['submit'])) {
      $toggle = (isset($_POST['realkit_modals_toggle'])) ? 'on' : 'off';
      update_option('realkit_modals_toggle', $toggle);
      $updated = '<div class="updated"><p><strong>' . __('Saved') . '. ' . __('Please reload the page (press F5).', 'realkit') .  '</strong></p></div>';
    }

    $modals_toggle = get_option('realkit_modals_toggle');
    $checked = (empty($modals_toggle) or $modals_toggle == 'on') ? ' checked' : '';

    echo '
      <div class="wrap">
        <h2>' . __('Modals options', 'realkit') . '</h2>
        ' . $updated . '
        <form method="post">

          <table class="form-table">
            <tbody>
              <tr>
                <td>
                  <fieldset>
                    <label>
                      <input type="checkbox" name="realkit_modals_toggle"' . $checked . '>
                      <span>' . __('Use modal windows on this site.', 'realkit') . '</span>
                    </label>
                  </fieldset>
                </td>
              </tr>
            </tbody>
          </table>

          <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="' . __('Save Changes') . '"></p>

        </form>
      </div>
    ';

  }

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