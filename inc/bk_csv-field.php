<?php
session_start();
$post_id = $post->ID;
//メタボックスの作成
function add_my_custom_meta_box()
{
	add_meta_box(
		'custom_setting',  //編集画面の HTML 要素の id 属性
		'機種情報入力',  //画面上に表示されるタイトル文字列
		'my_meta_box_markup', //HTML を出力するコールバック関数（表示用関数）名
		'store-list',
		'normal',
		'low',
		//入力エリアの HTML を出力する表示用関数の第2パラメータを使って参照する値を指定
		array(
			'title_key' => 'my_title',   //カスタムフィールドのキー
			'title_label' => 'ページのタイトル',  //項目別のタイトル
			'description_key' => 'my_description',   //カスタムフィールドのキー
			'description_label' => 'ページの説明'  //項目別のタイトル
		)
	);
}
add_action('add_meta_boxes', 'add_my_custom_meta_box');

//入力エリアの HTML を出力する関数（第2引数 $tb を指定）
function my_meta_box_markup($post, $tb)
{
	wp_nonce_field('meta_box_title_and_description_action', 'my_meta_box_nonce');
	$cf_title_key = trim($tb['args']['title_key']);  //'my_title'
	$cf_title_label = trim($tb['args']['title_label']);  //'ページのタイトル'
	$cf_title_value = esc_html(get_post_meta($post->ID, $cf_title_key, true));  //カスタムフィールド my_title の値
	$cf_description_key = trim($tb['args']['description_key']);  //'my_description'
	$cf_description_label = trim($tb['args']['description_label']);  //'ページの説明'
	$cf_description_value = esc_html(get_post_meta($post->ID, $cf_description_key, true));  //カスタムフィールド my_description の値
?>
<?php
	// テスト用配列
	$storeArry_set = ['cs0' => [
		"'cs_name'" => null,
		"'cs_type'" => null,
		"'mc'" => [
			'' => '',
		],
	],];

	$storeArrys = get_post_meta($post->ID, 'cs', false);
	if (isset($storeArrys[0])) {
		$set_array = $storeArrys[0];
	} else {
		$set_array = $storeArry_set;
	}

	?>

<?php $i = 0; ?>
<form id="cs_form" method="post">
	<?php foreach ($set_array as $value) : ?>

	<div data-set_val="cs<?php echo "['cs" . $i . "']"; ?>['mc']" class="tb_box" id="tb_box-<?php echo $i; ?>">
		<h3>
			レート別：<input class="cs_rate" type="text" placeholder="4円パチンコ・5円スロットなど"
				name="cs<?php echo "['cs" . $i . "']"; ?>['cs_name']" value="<?php echo  $value["'cs_name'"]; ?>" size="50">

			<?php
					$check = $value["'cs_type'"];
					if ($check == 'pachinko') {
						$p_check = 'checked';
					} else {
						$p_check = '';
					}
					if ($check == 'slot') {
						$s_check = 'checked';
					} else {
						$s_check = '';
					}
					?>
			遊技台種別：
			<label class="cs_type-p-l" for="pachi<?php echo $i; ?>">
				<input class="cs_type-p" <?php echo $p_check; ?> type="radio" id="pachi<?php echo $i; ?>"
					name="cs<?php echo "['cs" . $i . "']"; ?>['cs_type']" value="pachinko">パチンコ</label>
			<label class="cs_type-s-l" for="slot<?php echo $i; ?>">
				<input class="cs_type-s" <?php echo $s_check; ?> type="radio" id="slot<?php echo $i; ?>"
					name="cs<?php echo "['cs" . $i . "']"; ?>['cs_type']" value="slot">スロット</label>

			<div class="btn_group">
				<button type="button" class="btn btn-primary add_rate">レートを追加</button>
				<button type="button" class="btn btn-primary add_mc">機種を追加</button>
				<button type="button" class="btn btn-primary btn-success del_rate">レートを削除</button>
			</div>
		</h3>

		<?php $ii = 0; ?>
		<?php if (!is_array($value["'mc'"])) {
					$value["'mc'"] = array($value["'mc'"] => null);
				}; ?>

		<?php foreach ($value["'mc'"] as $key => $data) :  ?>

		<div>
			<span></span>
			<dl>
				<dt>機種名：
					<input type="text" name="cs<?php echo "['cs" . $i . "']"; ?>['mc']" value="<?php echo $key; ?>" size="100"
						data-base_val="cs<?php echo "['cs" . $i . "']"; ?>['mc']" />

				</dt>
				<dd>設置台数：<input type="text" name="cs<?php echo "['cs" . $i . "']"; ?>['mc']" value="<?php echo $data; ?>"
						size="10" data-base_val="cs<?php echo "['cs" . $i . "']"; ?>['mc']" />
				</dd>
				<dd><button type="button" class="btn btn-primary btn-success del_mc">削除</button></dd>
			</dl>
		</div>
		<?php $ii++;
				endforeach; ?>
	</div>
</form>
<?php $i++;
		endforeach; ?>
<?php
	$storeArry = get_post_meta($post->ID, 'cs', false);

	$_SESSION['storeArry'] = $storeArry[0];

?>
<form id="form" class="form_wrap" action="" method="POST" enctype="multipart/form-data">
	<input type="file" name="csv_file">
	<input type="hidden" name="key" value="csv_upload">
	<input type="submit" value="csvインポート実行!!">
</form>
<pre><?php print_r($storeArry[0]); ?></pre>
<div class="btn_group">
	<a class="btn btn-primary" href="<?php echo get_template_directory_uri(); ?>/inc/csv_dl.php">
		csvダウンロード
	</a>
</div>
<?php
}

//入力された情報の保存
function save_my_custom_meta_box($post_id)
{
	//HTML出力用関数で設定した nonce を取得
	$my_meta_box_nonce = isset($_POST['my_meta_box_nonce']) ? $_POST['my_meta_box_nonce'] : null;
	//nonce を検証し値が正しくなければ return（何もしない）
	if (!wp_verify_nonce($my_meta_box_nonce, 'meta_box_title_and_description_action')) {
		return;
	}
	//自動保存ルーチンかどうか。（記事の自動保存処理として呼び出された場合の対策）
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	//ユーザーが編集権限を持っていない場合は何もしない
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	//add_meta_box の第4パラメータ（$screen）で指定した投稿タイプを確認
	if ($_POST['post_type'] == 'store-list') {
		//各カスタムフィールドのキーで繰り返し
		// foreach ($my_cf_keys as $cf_key) {
		// 	if (isset($_POST[$cf_key])) {
		// 		update_post_meta($post_id, $cf_key, $_POST[$cf_key]);
		// 	}
		// }
		if (!empty($_POST['cs'])) { //題名が入力されている場合
			update_post_meta($post_id, 'cs', $_POST['cs']); //値を保存
		} else { //題名未入力の場合
			// delete_post_meta($post_id, 'cs'); //値を削除
		}
	}
}
add_action('save_post', 'save_my_custom_meta_box');