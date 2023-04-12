<?php
$tw = get_post_meta($post->ID, 'tw', true);
$address = get_post_meta($post->ID, 'address', true);
$b_start = get_post_meta($post->ID, 'business_hours_business_start', true);
$b_end = get_post_meta($post->ID, 'business_hours_business_end', true);
$cycle = get_post_meta($post->ID, 'cycle', true);
$car_space = get_post_meta($post->ID, 'car_space', true);
$access = get_post_meta($post->ID, 'access', true);
$tel = get_post_meta($post->ID, 'tel', true);
$tab_check = get_post_meta($post->ID, 'tab_check', true);
$store_id = $post->ID;
$store_img = get_post_meta($store_id, 'store_img', true);
if (empty($tab_check)) {
	$tab_check = 'tab-01';
}
$mc_array = get_post_meta($post->ID, 'cs', false);

?>
<?php get_header(); ?>
<section class="section-breadcrumb">
	<div class="container">
		<div class="breadcrumb-list">
			<ul class="breadcrumb">
				<li><a href="<?php echo home(); ?>">TOP</a></li>
				<li>&gt;</li>
				<li><a href="<?php echo home(); ?>store">店舗情報</a></li>
				<li>&gt;</li>
				<li><?php echo get_the_title($post->ID); ?></li>
			</ul>
		</div>
	</div>
</section>
<section class="section-store-title">
	<?php
	global $post;
	$pref = get_the_terms($post->ID, 'pref-term');
	?>
	<div class="container">
		<h3 class="sub_title"><span><?php echo $pref[0]->name; ?></span><?php echo get_the_title($post->ID); ?></h3>
	</div>
</section>
<section class="section-tab">
	<div class="container">
		<ul data-tab="<?php echo $tab_check; ?>">
			<li class="tab-01">店舗情報</li>
			<li class="tab-02">設置機種</li>
			<li class="tab-03">SNS</li>
			<li class="tab-04">MAP</li>
		</ul>
	</div>
</section>
<section class="section-04">
	<div class="container">
		<aside class="tgl-tb">
			<section>
				<h3>AREA</h3>
				<h4>エリア<i class="fas fa-chevron-circle-down"></i></h4>
				<ul>
					<?php
					$args = array(
						'parent' => 0,
						'orderby' => 'term_order',
						'order' => 'DISC',
						'post_type' => 'store-list',
						'taxonomy' => 'pref-term',
						'hide_empty' => '0'
					);
					$categories = get_categories($args);
					?>

					<?php foreach ($categories as $category) : ?>
					<li data-img_list="<?php echo $category->slug; ?>"><a
							href="<?php echo home(); ?>store?pref=<?php echo $category->slug; ?>"><?php echo $category->name; ?></a>
					</li>
					<?php endforeach; ?>
					<li class="new_store"><a href="<?php echo home(); ?>store?pref=new_store">新店</a></li>
				</ul>
			</section>
		</aside>
		<main>
			<div class="section-store_detail detail-01">
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
					<div class="right">
						<h3><?php echo get_the_title(); ?></h3>
						<dl>
							<dt>住所</dt>
							<dd><?php echo $address; ?></dd>
						</dl>
						<dl>
							<dt>TEL</dt>
							<dd><?php echo $tel; ?></dd>
						</dl>
						<ul>
							<li>
								<span>営業時間</span><?php echo $b_start; ?>～<?php echo $b_end; ?>
							</li>
							<li><span>駐輪場</span><?php echo $cycle; ?></li>
							<li><span>提携駐車場</span><?php echo $car_space; ?></li>
						</ul>
						<h4>交通アクセス</h4>
						<p><?php echo $access; ?></p>
						<?php if (!empty($mc_array)) : ?>
						<h4>設置台数</h4>
						<?php foreach ($mc_array[0] as $value => $key) : ?>

						<?php $array_val = array_values($key); ?>
						<?php $rate_name = $array_val[0]; ?>
						<?php if ($array_val[1] == 'pachinko') : ?>
						<?php unset($array_val[0]);
									unset($array_val[1]); ?>
						<?php foreach ($array_val as $value => $key) : ?>
						<?php $sum += $key; ?>
						<?php endforeach; ?>
						<dl class="install">
							<dt><span><?php echo $rate_name; ?></span></dt>
							<dd><?php echo $sum; ?>台</dd>
						</dl>
						<?php $sum = 0;; ?>
						<?php endif; ?>
						<?php endforeach; ?>
						<hr>
						<?php foreach ($mc_array[0] as $value => $key) : ?>

						<?php $array_val = array_values($key); ?>
						<?php $rate_name = $array_val[0]; ?>
						<?php if ($array_val[1] == 'slot') : ?>
						<?php unset($array_val[0]);
									unset($array_val[1]); ?>
						<?php foreach ($array_val as $value => $key) : ?>
						<?php $sum += $key; ?>
						<?php endforeach; ?>
						<dl class="install">
							<dt><span><?php echo $rate_name; ?></span></dt>
							<dd><?php echo $sum; ?>台</dd>
						</dl>
						<hr>
						<?php $sum = 0;; ?>
						<?php endif; ?>
						<?php endforeach; ?>
						<?php endif; ?>

						<div class="img-box"> <a href="<?php echo home(); ?>application?store=<?php echo $store_id; ?>">
								<img class="recruit_bnr-02 img-fluid" src="<?php echo img_dir(); ?>page/bnr_recruit_hover.png"
									alt="採用情報">
								<img class="recruit_bnr-01 img-fluid" src="<?php echo img_dir(); ?>page/bnr_recruit.png" alt="採用情報">

							</a></div>
					</div>
				</div>
			</div>
			<div class="section-intall detail-02">

				<ul class="mc_select">
					<li id="mc-01" class="active">パチンコ</li>
					<li id="mc-02">スロット</li>
				</ul>



				<div class="tab-panel">
					<div class="mc-tab active" id="mc-pachinko">
						<?php foreach ($mc_array[0] as $value => $key) : ?>
						<?php $array_val = array_values($key); ?>
						<?php $rate_name = $array_val[0]; ?>
						<?php if ($array_val[1] == 'pachinko') : ?>
						<section>
							<h3><?php echo $rate_name; ?></h3>
							<?php unset($key['レート別']);
									unset($key['遊技台種別']); ?>
							<?php foreach ($key as $value => $key) : ?>
							<dl>
								<dt><?php echo $value; ?></dt>
								<dd>（<?php echo $key; ?>台）</dd>
							</dl>
							<?php endforeach; ?>
						</section>
						<?php endif; ?>
						<?php endforeach; ?>
					</div>



					<div class="mc-tab" id="mc-slot">
						<?php foreach ($mc_array[0] as $value => $key) : ?>
						<?php $array_val = array_values($key); ?>
						<?php $rate_name = $array_val[0]; ?>
						<?php if ($array_val[1] == 'slot') : ?>
						<section>
							<h3><?php echo $rate_name; ?></h3>
							<?php unset($key['レート別']);
									unset($key['遊技台種別']); ?>
							<?php foreach ($key as $value => $key) : ?>
							<dl>
								<dt><?php echo $value; ?></dt>
								<dd>（<?php echo $key; ?>台）</dd>
							</dl>
							<?php endforeach; ?>
						</section>
						<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class="section-sns detail-03">
				<?php if ($tw) : ?>
				<a class="twitter-timeline" href="<?php echo $tw; ?>?ref_src=twsrc%5Etfw">Tweets by
					JANJAN_ryuuga</a>
				<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
				<?php else : ?>
				<p>表示できるSNSの情報がありません</p>
				<?php endif; ?>
			</div>
			<div class="section-map detail-04">
				<?php
				$map = get_post_meta($post->ID, 'map', true);

				if (empty($map)) {
					$map = get_post_meta($post->ID, 'addrss', true);
				}
				?>
				<?php if ($map) : ?>
				<?php
					$addressformap = $map;
					$addressformapencode = urlencode(mb_convert_encoding($addressformap, "UTF-8", "auto"));
					?>
				<div class="gmap">
					<iframe width="500px" height="500px" frameborder="5" scrolling="no" marginheight="0" marginwidth="0"
						src="https://maps.google.co.jp/maps?q=<?php echo $addressformapencode; ?>&z=16&output=embed">
					</iframe>
				</div>
				<div class="btn_area">
					<div class="btn angle"><a href="javascript:;"
							onclick="window.open('http://maps.google.co.jp/maps?q='+encodeURI('<?php echo $addressformap; ?>'));return false;">googleMAPで開く</a>
					</div>
				</div>
				<?php else : ?>
				<p>地図を表示できません。</p>
				<?php endif; ?>
			</div>
		</main>
	</div>
</section>


<?php
get_footer(); ?>