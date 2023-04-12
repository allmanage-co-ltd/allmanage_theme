<?php get_header(); ?>
<?php
$store_id = $_GET['store'];
$store_img = get_post_meta($store_id, 'store_img', true);
$store_address = get_post_meta($store_id, 'address', true);
$app_pr = get_post_meta($store_id, 'app_pr', true);
$app_line = get_post_meta($store_id, 'app_line', true);
$app_group = get_post_meta($store_id, 'app_group', true);
$a_text00 = get_post_meta($store_id, 'work_a_a_text00', true);
$a_text01 = get_post_meta($store_id, 'work_a_a_text01', true);
$a_text02 = get_post_meta($store_id, 'work_a_a_text02', true);
$a_text03 = get_post_meta($store_id, 'work_a_a_text03', true);
$a_text04 = get_post_meta($store_id, 'work_a_a_text04', true);
$a_text05 = get_post_meta($store_id, 'work_a_a_text05', true);
$a_text06 = get_post_meta($store_id, 'work_a_a_text06', true);
$a_text07 = get_post_meta($store_id, 'work_a_a_text07', true);
$a_text08 = get_post_meta($store_id, 'work_a_a_text08', true);
$c_text00 = get_post_meta($store_id, 'work_c_c_text00', true);
$c_text01 = get_post_meta($store_id, 'work_c_c_text01', true);
$c_text02 = get_post_meta($store_id, 'work_c_c_text02', true);
$c_text03 = get_post_meta($store_id, 'work_c_c_text03', true);
$c_text04 = get_post_meta($store_id, 'work_c_c_text04', true);
$c_text05 = get_post_meta($store_id, 'work_c_c_text05', true);
$c_text06 = get_post_meta($store_id, 'work_c_c_text06', true);
$c_text07 = get_post_meta($store_id, 'work_c_c_text07', true);
$c_text08 = get_post_meta($store_id, 'work_c_c_text08', true);
$s_text00 = get_post_meta($store_id, 'work_s_s_text00', true);
$s_text01 = get_post_meta($store_id, 'work_s_s_text01', true);
$s_text02 = get_post_meta($store_id, 'work_s_s_text02', true);
$s_text03 = get_post_meta($store_id, 'work_s_s_text03', true);
$s_text04 = get_post_meta($store_id, 'work_s_s_text04', true);
$s_text05 = get_post_meta($store_id, 'work_s_s_text05', true);
$s_text06 = get_post_meta($store_id, 'work_s_s_text06', true);
$s_text07 = get_post_meta($store_id, 'work_s_s_text07', true);
$s_text08 = get_post_meta($store_id, 'work_s_s_text08', true);
if (in_array('a', (array)$app_group)) {
	$a_active = 'true';
} else {
	$a_active = 'false';
};
if (in_array('c', (array)$app_group)) {
	$c_active = 'true';
} else {
	$c_active = 'false';
};
if (in_array('s', (array)$app_group)) {
	$s_active = 'true';
} else {
	$s_active = 'false';
};
?>
<div class="section-breadcrumb">
	<div class="container">
		<div class="breadcrumb-list">
			<ul class="breadcrumb">
				<li><a href="<?php echo home(); ?>">TOP</a></li>
				<li>&gt;</li>
				<li>募集要項詳細・求人応募フォーム</li>
				<li>&gt;</li>
				<li><?php echo get_the_title($store_id); ?></li>
			</ul>
		</div>
	</div>
</div>
<main>
	<section class="section-store-title">
		<?php
		$pref = get_the_terms($store_id, 'pref-term');
		?>
		<div class="container">
			<h3 class="sub_title"><span><?php echo $pref[0]->name; ?></span><?php echo get_the_title($store_id); ?></h3>
		</div>
	</section>
	<div class="section-store_detail app">
		<div class="container">
			<div class="left">
				<div class="img-box">
					<?php if ($store_img) : ?>
					<img src="<?php echo wp_get_attachment_url($store_img); ?>" alt="" class="img-fluid">
					<?php else : ?>
					<img src="http://placehold.jp/eeeeee/cccccc/410x330.png?text=No%20Image" class="img-fluid" alt="">
					<?php endif; ?>
				</div>
			</div>
			<div class="right app">

				<p class="pr_text"><?php echo nl2br($app_pr); ?></p>

				<ul>
					<li class="btn_area"><a href="#recruitform" class="btn angle">WEBでのご応募</a></li>
					<li class="btn_area"><a href="tel:080-4176-8026" class="btn angle">お電話でのご応募</a></li>
					<?php if ($app_line) : ?>
					<li class="btn_area"><a target="_blank" href="<?php echo $app_line; ?>" class="btn angle">LINE応募</a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
	<section class="section-tab">
		<div class="container">
			<?php
			$tab_check = 'tab-01'; ?>
			<ul class="box-3" data-tab="<?php echo $tab_check; ?>">
				<li class="tab-01 active">アルバイト</li>
				<li class="tab-02">キャリア</li>
				<li class="tab-03">新卒</li>
			</ul>
		</div>
	</section>
	<div class="container detail-01">
		<?php if (!in_array('a', (array)$app_group)) : ?>
		<div class="table-box">
			<p>現在募集はありません</p>
		</div>
		<?php else : ?>
		<div class="table-box">
			<?php if ($a_text00) : ?>
			<dl>
				<dt>雇用形態</dt>
				<dd><?php echo nl2br($a_text00); ?></dd>
			</dl>
			<?php endif; ?>
			<?php if ($a_text01) : ?>
			<dl>
				<dt>勤務時間</dt>
				<dd><?php echo nl2br($a_text01); ?></dd>
			</dl>
			<?php endif; ?>
			<?php if ($a_text02) : ?>
			<dl>
				<dt>休日・休暇</dt>
				<dd><?php echo nl2br($a_text02); ?></dd>
			</dl>
			<?php endif; ?>
			<?php if ($a_text03) : ?>
			<dl>
				<dt>仕事内容</dt>
				<dd><?php echo nl2br($a_text03); ?></dd>
			</dl>
			<?php endif; ?>
			<?php if ($a_text04) : ?>
			<dl>
				<dt>採用までの流れ</dt>
				<dd><?php echo nl2br($a_text04); ?></dd>
			</dl>
			<?php endif; ?>
			<?php if ($a_text05) : ?>
			<dl>
				<dt>給与</dt>
				<dd><?php echo nl2br($a_text05); ?></dd>
			</dl>
			<?php endif; ?>
			<?php if ($a_text06) : ?>
			<dl>
				<dt>採用担当者からひとこと</dt>
				<dd><?php echo nl2br($a_text06); ?></dd>
			</dl>
			<?php endif; ?>

			<dl>
				<dt>勤務地</dt>
				<dd><?php echo $store_address; ?></dd>
			</dl>
			<dl>
				<dt>店舗情報</dt>
				<dd><i class="fas fa-angle-right"></i><a href="<?php the_permalink($store_id); ?>">店舗ページはこちら</a>
				</dd>
			</dl>
		</div>
		<?php if ($a_text07) : ?>
		<div class="table-box">
			<dl>
				<dt>待遇・福利厚生</dt>
				<dd><?php echo nl2br($a_text07); ?></dd>
			</dl>
		</div>
		<?php endif; ?>
		<?php if ($a_text08) : ?>
		<div class="table-box">
			<dl>
				<dt>インセンティブポイント</dt>
				<dd><?php echo nl2br($a_text08); ?></dd>
			</dl>
		</div>
		<?php endif; ?>
		<?php endif; ?>
	</div>
	<div class="container detail-02">
		<?php if (!in_array('c', (array)$app_group)) : ?>
		<div class="table-box">
			<p>現在募集はありません</p>
		</div>
		<?php else : ?>
		<div class="table-box">
			<?php if ($c_text00) : ?>
			<dl>
				<dt>雇用形態</dt>
				<dd><?php echo nl2br($c_text00); ?></dd>
			</dl>
			<?php endif; ?>
			<?php if ($c_text01) : ?>
			<dl>
				<dt>勤務時間</dt>
				<dd><?php echo nl2br($c_text01); ?></dd>
			</dl>
			<?php endif; ?>
			<?php if ($c_text02) : ?>
			<dl>
				<dt>休日・休暇</dt>
				<dd><?php echo nl2br($c_text02); ?></dd>
			</dl>
			<?php endif; ?>
			<?php if ($c_text03) : ?>
			<dl>
				<dt>仕事内容</dt>
				<dd><?php echo nl2br($c_text03); ?></dd>
			</dl>
			<?php endif; ?>
			<?php if ($c_text04) : ?>
			<dl>
				<dt>採用までの流れ</dt>
				<dd><?php echo nl2br($c_text04); ?></dd>
			</dl>
			<?php endif; ?>
			<?php if ($c_text05) : ?>
			<dl>
				<dt>給与</dt>
				<dd><?php echo nl2br($c_text05); ?></dd>
			</dl>
			<?php endif; ?>
			<?php if ($c_text06) : ?>
			<dl>
				<dt>採用担当者からひとこと</dt>
				<dd><?php echo nl2br($c_text06); ?></dd>
			</dl>
			<?php endif; ?>

			<dl>
				<dt>勤務地</dt>
				<dd><?php echo $store_address; ?></dd>
			</dl>
			<dl>
				<dt>店舗情報</dt>
				<dd><i class="fas fa-angle-right"></i><a href="<?php the_permalink($store_id); ?>">店舗ページはこちら</a>
				</dd>
			</dl>
		</div>
		<?php if ($c_text07) : ?>
		<div class="table-box">
			<dl>
				<dt>待遇・福利厚生</dt>
				<dd><?php echo nl2br($c_text07); ?></dd>
			</dl>
		</div>
		<?php endif; ?>
		<?php if ($c_text08) : ?>
		<div class="table-box">
			<dl>
				<dt>インセンティブポイント</dt>
				<dd><?php echo nl2br($c_text08); ?></dd>
			</dl>
		</div>
		<?php endif; ?>
		<?php endif; ?>
	</div>
	<div class="container detail-03">
		<?php if (!in_array('s', (array)$app_group)) : ?>
		<div class="table-box">
			<p>現在募集はありません</p>
		</div>
		<?php else : ?>
		<div class="table-box">
			<?php if ($s_text00) : ?>
			<dl>
				<dt>雇用形態</dt>
				<dd><?php echo nl2br($s_text00); ?></dd>
			</dl>
			<?php endif; ?>
			<?php if ($s_text01) : ?>
			<dl>
				<dt>勤務時間</dt>
				<dd><?php echo nl2br($s_text01); ?></dd>
			</dl>
			<?php endif; ?>
			<?php if ($s_text02) : ?>
			<dl>
				<dt>休日・休暇</dt>
				<dd><?php echo nl2br($s_text02); ?></dd>
			</dl>
			<?php endif; ?>
			<?php if ($s_text03) : ?>
			<dl>
				<dt>仕事内容</dt>
				<dd><?php echo nl2br($s_text03); ?></dd>
			</dl>
			<?php endif; ?>
			<?php if ($s_text04) : ?>
			<dl>
				<dt>採用までの流れ</dt>
				<dd><?php echo nl2br($s_text04); ?></dd>
			</dl>
			<?php endif; ?>
			<?php if ($s_text05) : ?>
			<dl>
				<dt>給与</dt>
				<dd><?php echo nl2br($s_text05); ?></dd>
			</dl>
			<?php endif; ?>
			<?php if ($s_text06) : ?>
			<dl>
				<dt>採用担当者からひとこと</dt>
				<dd><?php echo nl2br($s_text06); ?></dd>
			</dl>
			<?php endif; ?>

			<dl>
				<dt>勤務地</dt>
				<dd><?php echo $store_address; ?></dd>
			</dl>
			<dl>
				<dt>店舗情報</dt>
				<dd><i class="fas fa-angle-right"></i><a href="<?php the_permalink($store_id); ?>">店舗ページはこちら</a>
				</dd>
			</dl>
		</div>
		<?php if ($s_text07) : ?>
		<div class="table-box">
			<dl>
				<dt>待遇・福利厚生</dt>
				<dd><?php echo nl2br($s_text07); ?></dd>
			</dl>
		</div>
		<?php endif; ?>
		<?php if ($s_text08) : ?>
		<div class="table-box">
			<dl>
				<dt>インセンティブポイント</dt>
				<dd><?php echo nl2br($s_text08); ?></dd>
			</dl>
		</div>
		<?php endif; ?>
		<?php endif; ?>
	</div>
	<section class="section-store-title recruit-form" data-recruit-a="<?php echo $a_active; ?>"
		data-recruit-c="<?php echo $c_active; ?>" data-recruit-s="<?php echo $s_active; ?>">
		<span class="anchor" id="recruitform"></span>
		<div class="container">
			<h3 class="sub_title">求人応募フォーム</h3>
			<?php echo do_shortcode('[contact-form-7 id="127" title="求人応募フォーム"]'); ?>
		</div>

		<script>
		var place = '<?php echo get_the_title($store_id); ?>';
		document.querySelector(".place").value = place;
		</script>
	</section>
</main>



<?php
get_footer(); ?>