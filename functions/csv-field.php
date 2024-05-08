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
	$storeArry_set = [
		'cs0' => [
			'レート別' => '未登録',
			'遊技台種別' => 'pachinko',
			'未登録' => '0',
		],
	];
	$storeArrys = get_post_meta($post->ID, 'cs', false);
	$storeName = get_the_title($post->ID);
	// CSV情報を取得
	$get_csv = $_SESSION['get_csv'];

	//CSV情報を取り込んだらセッションを削除
	unset($_SESSION['get_csv']);

	if (empty($get_csv)) {
		//取り込んだCSV情報がなければBDから取得した値をセット
		if (!empty($storeArrys)) {
			//BDからの情報がある場合はセット
			$set_array = $storeArrys[0];
		} else {
			//DBにも情報がなければテスト用の空配列をセット
			$set_array = $storeArry_set;
		}
	} else {
		//取り込んだCSV情報があれば使う
		$set_array = $get_csv;
		$iiii = 1;
		foreach ($set_array as $value) {
			foreach ($value as $item) {
				if (!empty($item)) {
					$get_put['cs' . $iiii][explode(',', $item)[0]] = explode(',', $item)[1];
				}
			}
			$iiii++;
		}
	}
	?>


<?php //CSVに格納する用に配列を書き換え ;
	?>
<?php $iii = 1; ?>
<?php foreach ($set_array as $layers) : ?>

<?php foreach ($layers as $layer_key => $layer_value) : ?>

<?php
			$out_put['cs' . $iii][] = $layer_key . ',' . $layer_value;
			?>

<?php endforeach; ?>
<?php $iii++; ?>
<?php endforeach; ?>

<?php
	if (!empty($get_put)) {
		//CSVから取り込んだデータがある場合、セットするデータを差替える
		$set_array =	$get_put;
	}
	?>


<?php $i = 0; ?>
<form id="cs_form" method="post">
	<?php foreach ($set_array as $value) : ?>

	<div data-set_val="cs<?php echo "['cs" . $i . "']"; ?>" class="tb_box" id="tb_box-<?php echo $i; ?>">
		<h3>
			レート別：<input class="cs_rate" type="text" placeholder="4円パチンコ・5円スロットなど"
				name="cs<?php echo "['cs" . $i . "']"; ?>[レート別]" value="<?php echo  $value['レート別']; ?>" size="50">
			<?php
					$check = $value['遊技台種別'];
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
					name="cs<?php echo "['cs" . $i . "']"; ?>[遊技台種別]" value="pachinko">パチンコ</label>
			<label class="cs_type-s-l" for="slot<?php echo $i; ?>">
				<input class="cs_type-s" <?php echo $s_check; ?> type="radio" id="slot<?php echo $i; ?>"
					name="cs<?php echo "['cs" . $i . "']"; ?>[遊技台種別]" value="slot">スロット</label>

			<div class="btn_group">
				<button type="button" class="btn btn-primary add_rate">レートを追加</button>
				<button type="button" class="btn btn-primary add_mc">機種を追加</button>
				<button type="button" class="btn btn-primary btn-success del_rate">レートを削除</button>
			</div>
		</h3>

		<?php $ii = 0; ?>
		<?php if (!is_array($value)) {
					$value = array($value => null);
				}; ?>

		<?php foreach ($value as $key => $data) :  ?>
		<?php if ($key !== 'レート別') : ?>
		<?php if ($key !== '遊技台種別') : ?>
		<div>
			<span></span>
			<dl>
				<dt>機種名：
					<input type="text" name="cs<?php echo "['cs" . $i . "']"; ?>" value="<?php echo $key; ?>" size="100"
						data-base_val="cs<?php echo "['cs" . $i . "']"; ?>" />

				</dt>
				<dd>設置台数：<input type="text" name="cs<?php echo "['cs" . $i . "']"; ?>" value="<?php echo $data; ?>" size="10"
						data-base_val="cs<?php echo "['cs" . $i . "']"; ?>" />
				</dd>
				<dd><button type="button" class="btn btn-primary btn-success del_mc">削除</button></dd>
			</dl>
		</div>
		<?php endif; ?>
		<?php endif; ?>
		<?php $ii++;
				endforeach; ?>
	</div>
</form>
<?php $i++;
		endforeach; ?>
<?php
	$storeArry = get_post_meta($post->ID, 'cs', false);

	// $_SESSION['storeArry'] = $storeArry[0];
	$_SESSION['storeArry'] = $out_put;

	$_SESSION['storeName'] = $storeName;
?>


</div>
<div class="outside">

	<div class="btn_group csv_field">
		<dl>
			<dt>
				<h3>CSV一括ダウンロード</h3>
			</dt>
			<dd><a class="btn btn-primary" href="<?php echo get_template_directory_uri(); ?>/inc/csv_dl.php">
					csvダウンロード
				</a>
				<p>※現在、保存されているデータが出力されます。編集を行った際は必ず保存してからダウンロードしてください。</p>
			</dd>
		</dl>


	</div>

	<div class="btn_group csv_field">
		<form action="csv_upload/csv_upload.php" method="post" enctype="multipart/form-data">
			<dl>
				<dt>
					<h3>CSV一括登録</h3>
				</dt>
				<dd><input type="file" name="csvfile" size="30" /></dd>
				<dd><input type="submit" value="アップロード" /></dd>
			</dl>



		</form>
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
			delete_post_meta($post_id, 'cs'); //値を削除
		}
	}
}
add_action('save_post', 'save_my_custom_meta_box');