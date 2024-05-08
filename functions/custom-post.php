<?php

/***********************************************************
 * カスタム投稿
 ***********************************************************/
//カスタムフィールドを追加
add_action('admin_menu', 'add_mycustom_fields');
add_action('save_post', 'save_mycustom_fields');

//カスタム投稿タイプでカスタムフィールドを表示
function add_mycustom_fields()
{
	add_meta_box('my_contents', 'コンテンツ', 'my_custom_fields', array('case'));
	add_meta_box('my_guidelines', '募集要項', 'my_custom_fields', array('recruit'));
	add_meta_box('my_environment', '勤務環境', 'my_custom_fields', array('recruit'));
	add_meta_box('my_other', '備考', 'my_custom_fields', array('recruit'));
	add_meta_box('my_process', '応募選考', 'my_custom_fields', array('recruit'));
}

//カスタムフィールドの値をチェック
function save_mycustom_data($key, $post_id)
{
	if (isset($_POST["custom_data"][$key])) {
		$data = $_POST["custom_data"][$key];
	} else {
		$data = '';
	}

	//-1になると項目が変わったことになるので、項目を更新する
	if (empty($data)) {
		delete_post_meta($post_id, $key);
	} elseif (strcmp($data, get_post_meta($post_id, $key, true)) != 0) {
		update_post_meta($post_id, $key, $data);
	}
}

//カスタムフィールドの値を保存
function save_mycustom_fields($post_id)
{
	global $post;

	if (isset($_POST['custom_data']) && $_POST['custom_data_flg'] == 1) {
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
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
}

// カテゴリが指定していなければデフォルトの値を指定
function save_app_cat($post_id)
{
	if (isset($_POST['custom_data']) && $_POST['custom_data_flg'] == 1) {
		if ($parent_id = wp_is_post_revision($post_id)) {
			$post_id = $parent_id;
		}

		$defaultcat = get_term_by('name', 'android', 'app_category');

		if (!has_term(array('android', 'iphone'), 'app_category', $post_id)) {
			remove_action('save_post_app', 'save_app_cat');
			wp_set_object_terms($post_id, $defaultcat->term_id, 'app_category');
			add_action('save_post_app', 'save_app_cat');
		}
	}
}
//add_action( 'save_post_app', 'save_app_cat', 10, 3 );


// カスタム投稿 求人情報
// add_action('init', 'codex_post_init');
// function codex_post_init()
// {

// 	// 	// 導入事例
// 	$labels = array(
// 		'name' => '導入事例',
// 		'singular_name' => '導入事例',
// 		'menu_name' => '導入事例',
// 		'add_new' => '新規追加',
// 		'add_new_item' => '新規追加',
// 		'edit_item' => '導入事例を編集',
// 		'new_item' => '導入事例',
// 		'view_item' => '導入事例を見る',
// 		'all_items' =>  '導入事例一覧',
// 		'search_items' => '導入事例を探す',
// 		'not_found' => '導入事例はありません',
// 		'not_found_in_trash' => '導入事例はありません',
// 		'parent_item_colon' => "",
// 	);
// 	$args = array(
// 		'labels' => $labels,
// 		'public' => true,
// 		'has_archive' => true,
// 		'menu_icon' => 'dashicons-hammer',
// 		'menu_position' => 4,
// 		'taxonomies' => array(),
// 		'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats'),
// 		'supports' => array('title', 'editor', 'thumbnail')
// 	);

// 	register_post_type( 'case', $args );
// 	register_taxonomy( 'industry', 'case', array(
// 			'label' => '業界',
// 			'hierarchical' => true,
// 			'sort' => true,
// 			'public' => true,
// 			'show_admin_column' => true,
// 		)
// 	);
// 	register_taxonomy( 'process', 'case', array(
// 			'label' => '工程',
// 			'hierarchical' => true,
// 			'sort' => true,
// 			'public' => true,
// 			'show_admin_column' => true,
// )
// );

// コラム
// $labels = array(
// 	'name' => '投稿(英語)',
// 	'singular_name' => '投稿(英語)',
// 	'menu_name' => '投稿(英語)',
// 	'add_new' => '新規追加',
// 	'add_new_item' => '新規追加',
// 	'edit_item' => '投稿(英語)を編集',
// 	'new_item' => '投稿(英語)',
// 	'view_item' => '投稿(英語)を見る',
// 	'all_items' =>  '投稿(英語)一覧',
// 	'search_items' => '投稿(英語)を探す',
// 	'not_found' => '投稿(英語)はありません',
// 	'not_found_in_trash' => '投稿(英語)はありません',
// 	'parent_item_colon' => "",
// );
// $args = array(
// 	'labels' => $labels,
// 	'public' => true,
// 	'has_archive' => true,
// 	'menu_icon' => 'dashicons-welcome-write-blog',
// 	'menu_position' => 4,
// 	'taxonomies'=>array('column-tag'),
// 	//'supports' => array( 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats' ),
// 	'supports' => array( 'title','editor','thumbnail'),
// 	'show_in_rest' => true,
// );
// register_post_type( 'column', $args );
// register_taxonomy( 'column-tag', 'column', array(
// 		'label' => 'カテゴリー',
// 		'hierarchical' => true,
// 		'sort' => true,
// 		'public' => true,
// 		'show_admin_column' => true,
// 		'show_in_rest' => true,
// 	)
// );

// function change_post_object_label() {
//   $name = '投稿(日本語)';
//   global $wp_post_types;
//   $labels = &$wp_post_types['post']->labels;
//   $labels->name = $name;
//   $labels->singular_name = $name;
//   $labels->add_new = '新規追加';
//   $labels->add_new_item = $name.'の新規追加';
//   $labels->edit_item = $name.'の編集';
//   $labels->new_item = '新規'.$name;
//   $labels->all_items = $name . '一覧';
//   $menu_icon = &$wp_post_types['post']->menu_icon;
//   $menu_icon = 'dashicons-welcome-write-blog';
// }
// add_action('init', 'change_post_object_label');

// }

// カスタムフィールドの表示テンプレート指定
function my_custom_fields($post, $metabox)
{
	switch ($post->post_type) {
		case 'case':
			require_once(dirname(__DIR__) . '/admin/field/case.php');
			break;
	}
}

// 下書きのpost_IDを取得
function get_preview_id($post_id)
{
	global $post;
	$preview_id = 0;
	if (isset($post) && get_the_ID() == $post_id && is_preview() && $preview = wp_get_post_autosave($post->ID)) {
		$preview_id = $preview->ID;
	}
	return $preview_id;
}

// プレビュー時、meta情報をプレビュー用のmeta情報に置き換え
function get_preview_postmeta($return, $post_id, $meta_key, $single)
{
	if ($preview_id = get_preview_id($post_id)) {
		if ($post_id != $preview_id) {
			$meta = maybe_unserialize(get_post_meta($preview_id, $meta_key, $single));
			if (is_array($meta)) {
				$meta = array(array_filter($meta));
			}
			$return = $meta;
		}
	}
	return $return;
}
add_filter('get_post_metadata', 'get_preview_postmeta', 10, 4);

// カスタムフィールドテンプレートの送信形式による値を取得してプレビューのmeta情報を書き換え
function save_preview_postmeta($post_ID)
{
	global $wpdb;

	if (wp_is_post_revision($post_ID)) {
		if (!empty($_REQUEST['custom_data']) && is_array($_REQUEST['custom_data'])) {
			foreach ($_REQUEST['custom_data'] as $key => $val) {
				add_metadata('post', $post_ID, $key, maybe_serialize($val));
				//update_post_meta( $post_ID, $key, $val );
			}
		}

		do_action('save_preview_postmeta', $post_ID);
	}
}
add_action('wp_insert_post', 'save_preview_postmeta');

// 一覧にカラムを追加する
function staff_cpt_columns($columns)
{
	$new_columns = array();
	foreach ($columns as $key => $value) {
		$new_columns[$key] = $value;
		if ($key == 'title') {
			$new_columns['staff_store'] = '店舗';
		}
	}
	return $new_columns;
}
function cmp($a, $b)
{
	// "b"は必ず比較で負ける
	if ($a == "date") return 1;
	if ($b == "date") return -1;

	// 他は自然な処理
	if ($a == $b) {
		return 0;
	} else {
		return $a > $b ? 1 : -1;
	}
}
//add_filter('manage_staff_posts_columns' , 'staff_cpt_columns' );
// カスタムフィールドの内容を表示
function add_column($column_name, $post_id)
{
	if ($column_name == 'staff_store') {
		$stitle = get_post_meta($post_id, 'store', true);
		echo $stitle[0];
	}
}
//add_action( 'manage_staff_posts_custom_column', 'add_column', 10, 2 );

// カスタム投稿のパーマリンクをIDに変更
function custom_post_type_link($link, $post)
{
	if ($post->post_type === 'recruit') {
		return home_url('/recruit/' . $post->ID);
	} else {
		return $link;
	}
}
//add_filter( 'post_type_link', 'custom_post_type_link',1 , 2 );
function custom_rewrite_rules_array($rules)
{
	$new_rules = array(
		'recruit/([0-9]+)/?$' => 'index.php?post_type=recruit&p=$matches[1]',
	);

	return $new_rules + $rules;
}
//add_filter( 'rewrite_rules_array', 'custom_rewrite_rules_array' );

add_action('init', 'create_post_type');
function create_post_type()
{
	register_post_type('news-list', [ // 投稿タイプ名の定義
		'labels' => [
			'name'          => 'NEWS', // 管理画面上で表示する投稿タイプ名
			'singular_name' => 'news-list',    // カスタム投稿の識別名
		
		],
		'public'        => true,  // 投稿タイプをpublicにするか
		'has_archive'   => true, // アーカイブ機能ON/OFF
		'menu_position' => 5,     // 管理画面上での配置場所
		'show_in_rest'  => false,  // 5系から出てきた新エディタ「Gutenberg」を有効にする
		'supports' => array('title', 'editor', 'thumbnail') ,
	]);
	register_post_type('store-list', [ // 投稿タイプ名の定義
		'labels' => [
			'name'          => '店舗設定', // 管理画面上で表示する投稿タイプ名
			'singular_name' => 'store',    // カスタム投稿の識別名
			'add_new'       => '新店追加',
			'add_new_item'  => '新しい店舗を設定',
		],
		'public'        => true,  // 投稿タイプをpublicにするか
		'has_archive'   => true, // アーカイブ機能ON/OFF
		'menu_position' => 5,     // 管理画面上での配置場所
		'show_in_rest'  => false,  // 5系から出てきた新エディタ「Gutenberg」を有効にする
		'supports' => array('title', 'editor', 'thumbnail') ,
	]);
}
function add_taxonomy()
{
	register_taxonomy(
		'news-term',
		'news-list',
		array(
			'label' => 'NEWSカテゴリー',
			'singular_label' => 'NEWSカテゴリー',
			'labels' => array(
				'all_items' => 'NEWSカテゴリー一覧',
				'add_new_item' => 'NEWSカテゴリーを追加'
			),
			'public' => true,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'hierarchical' => true
		)
	);
	register_taxonomy(
		'store-term',
		'news-list',
		array(
			'label' => '店舗カテゴリー',
			'singular_label' => '店舗カテゴリー',
			'labels' => array(
				'all_items' => '店舗カテゴリー一覧',
				'add_new_item' => '店舗カテゴリーを追加'
			),
			'public' => true,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'hierarchical' => true
		)
	);
	register_taxonomy(
		'pref-term',
		'store-list',
		array(
			'label' => '地域カテゴリー',
			'singular_label' => '地域カテゴリー',
			'labels' => array(
				'all_items' => '地域カテゴリー一覧',
				'add_new_item' => '地域カテゴリーを追加'
			),
			'public' => true,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'hierarchical' => true
		)
	);
}
add_action('init', 'add_taxonomy');