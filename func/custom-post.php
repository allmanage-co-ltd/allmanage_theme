<?php

declare(strict_types=1);

// カスタム投稿
// カスタムフィールドを追加
add_action('admin_menu', 'add_mycustom_fields');
add_action('save_post', 'save_mycustom_fields');

// カスタム投稿タイプでカスタムフィールドを表示
function add_mycustom_fields(): void
{
  add_meta_box('my_contents', 'コンテンツ', 'my_custom_fields', ['case']);
  add_meta_box('my_guidelines', '募集要項', 'my_custom_fields', ['recruit']);
  add_meta_box('my_environment', '勤務環境', 'my_custom_fields', ['recruit']);
  add_meta_box('my_other', '備考', 'my_custom_fields', ['recruit']);
  add_meta_box('my_process', '応募選考', 'my_custom_fields', ['recruit']);
}

// カスタムフィールドの値をチェック
function save_mycustom_data($key, $post_id): void
{
  if (isset($_POST['custom_data'][$key])) {
    $data = $_POST['custom_data'][$key];
  } else {
    $data = '';
  }

  // -1になると項目が変わったことになるので、項目を更新する
  if (empty($data)) {
    delete_post_meta($post_id, $key);
  } elseif (0 !== strcmp($data, get_post_meta($post_id, $key, true))) {
    update_post_meta($post_id, $key, $data);
  }
}

// カスタムフィールドの値を保存
function save_mycustom_fields($post_id)
{
  global $post;

  if (isset($_POST['custom_data']) && 1 === $_POST['custom_data_flg']) {
    foreach ($_POST['custom_data'] as $key => $value) {
      if (is_array($value)) {
        update_post_meta($post_id, $key, array_merge(array_filter($value, 'custom_array_filter')));
      } else {
        save_mycustom_data($key, $post_id);
      }
    }
  }
  $extend_edit_field_noncename = filter_input(INPUT_POST, 'extend_edit_field_noncename');
  if (isset($post->ID) && !wp_verify_nonce($extend_edit_field_noncename, plugin_basename(__FILE__))) {
    return $post->ID;
  }
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }
}

// カテゴリが指定していなければデフォルトの値を指定
function save_app_cat($post_id): void
{
  if (isset($_POST['custom_data']) && 1 === $_POST['custom_data_flg']) {
    if ($parent_id = wp_is_post_revision($post_id)) {
      $post_id = $parent_id;
    }

    $defaultcat = get_term_by('name', 'android', 'app_category');

    if (!has_term(['android', 'iphone'], 'app_category', $post_id)) {
      remove_action('save_post_app', 'save_app_cat');
      wp_set_object_terms($post_id, $defaultcat->term_id, 'app_category');
      add_action('save_post_app', 'save_app_cat');
    }
  }
}

// カスタムフィールドの表示テンプレート指定
function my_custom_fields($post, $metabox): void
{
  switch ($post->post_type) {
    case 'case':
      require_once dirname(__DIR__).'/admin/field/case.php';

      break;
  }
}

// 下書きのpost_IDを取得
function get_preview_id($post_id)
{
  global $post;
  $preview_id = 0;
  if (isset($post) && get_the_ID() === $post_id && is_preview() && $preview = wp_get_post_autosave($post->ID)) {
    $preview_id = $preview->ID;
  }

  return $preview_id;
}

// プレビュー時、meta情報をプレビュー用のmeta情報に置き換え
function get_preview_postmeta($return, $post_id, $meta_key, $single)
{
  if ($preview_id = get_preview_id($post_id)) {
    if ($post_id !== $preview_id) {
      $meta = maybe_unserialize(get_post_meta($preview_id, $meta_key, $single));
      if (is_array($meta)) {
        $meta = [array_filter($meta)];
      }
      $return = $meta;
    }
  }

  return $return;
}
add_filter('get_post_metadata', 'get_preview_postmeta', 10, 4);

// カスタムフィールドテンプレートの送信形式による値を取得してプレビューのmeta情報を書き換え
function save_preview_postmeta($post_ID): void
{
  global $wpdb;

  if (wp_is_post_revision($post_ID)) {
    if (!empty($_REQUEST['custom_data']) && is_array($_REQUEST['custom_data'])) {
      foreach ($_REQUEST['custom_data'] as $key => $val) {
        add_metadata('post', $post_ID, $key, maybe_serialize($val));
        // update_post_meta( $post_ID, $key, $val );
      }
    }

    do_action('save_preview_postmeta', $post_ID);
  }
}
add_action('wp_insert_post', 'save_preview_postmeta');

// 一覧にカラムを追加する
function staff_cpt_columns($columns)
{
  $new_columns = [];
  foreach ($columns as $key => $value) {
    $new_columns[$key] = $value;
    if ('title' === $key) {
      $new_columns['staff_store'] = '店舗';
    }
  }

  return $new_columns;
}
function cmp($a, $b)
{
  // "b"は必ず比較で負ける
  if ('date' === $a) {
    return 1;
  }
  if ('date' === $b) {
    return -1;
  }

  // 他は自然な処理
  if ($a === $b) {
    return 0;
  }

  return $a > $b ? 1 : -1;
}
// add_filter('manage_staff_posts_columns' , 'staff_cpt_columns' );
// カスタムフィールドの内容を表示
function add_column($column_name, $post_id): void
{
  if ('staff_store' === $column_name) {
    $stitle = get_post_meta($post_id, 'store', true);
    echo $stitle[0];
  }
}
// add_action( 'manage_staff_posts_custom_column', 'add_column', 10, 2 );

// カスタム投稿のパーマリンクをIDに変更
function custom_post_type_link($link, $post)
{
  if ('recruit' === $post->post_type) {
    return home_url('/recruit/'.$post->ID);
  }

  return $link;
}
// add_filter( 'post_type_link', 'custom_post_type_link',1 , 2 );
function custom_rewrite_rules_array($rules)
{
  $new_rules = [
    'recruit/([0-9]+)/?$' => 'index.php?post_type=recruit&p=$matches[1]',
  ];

  return $new_rules + $rules;
}
// add_filter( 'rewrite_rules_array', 'custom_rewrite_rules_array' );

add_action('init', 'create_post_type');
function create_post_type(): void
{
  register_post_type('news', [ // 投稿タイプ名の定義
    'labels' => [
      'name' => 'NEWS', // 管理画面上で表示する投稿タイプ名
      'singular_name' => 'news',    // カスタム投稿の識別名
    ],
    'public' => true,  // 投稿タイプをpublicにするか
    'has_archive' => true, // アーカイブ機能ON/OFF
    'menu_position' => 5,     // 管理画面上での配置場所
    'show_in_rest' => false,  // 5系から出てきた新エディタ「Gutenberg」を有効にする
    'supports' => ['title', 'editor', 'thumbnail'],
  ]);
}
function add_taxonomy(): void
{
  register_taxonomy(
    'news-term',
    'news',
    [
      'label' => 'NEWSカテゴリー',
      'singular_label' => 'NEWSカテゴリー',
      'labels' => [
        'all_items' => 'NEWSカテゴリー一覧',
        'add_new_item' => 'NEWSカテゴリーを追加',
      ],
      'public' => true,
      'show_ui' => true,
      'show_in_nav_menus' => true,
      'hierarchical' => true,
    ]
  );
}
add_action('init', 'add_taxonomy');
