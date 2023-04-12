<?php
// $tw = CFS()->get('tw');
$tw = get_post_meta($post->ID, 'tw', true);
// $address = CFS()->get('address');
$address = get_post_meta($post->ID, 'address', true);
// $b_start = CFS()->get('b_start');
$b_start = get_post_meta($post->ID, 'b_start', true);
// $b_end = CFS()->get('b_end');
$b_end = get_post_meta($post->ID, 'b_end', true);
// $cycle = CFS()->get('cycle');
$cycle = get_post_meta($post->ID, 'cycle', true);
// $car_space = CFS()->get('car_space');
$car_space = get_post_meta($post->ID, 'car_space', true);
// $access = CFS()->get('access');
$access = get_post_meta(
	$post->ID,
	'access',
	true
);
// $tel = CFS()->get('tel');
$tel = get_post_meta($post->ID, 'tel', true);
// $tab_check = $_GET['tab'];
$tab_check = get_post_meta($post->ID, 'tab_check', true);
if (empty($tab_check)) {
	$tab_check = 'tab-01';
}
?>
<?php get_header(); ?>
<section class="section-breadcrumb">
	<div class="container">
		<?php breadcrumb(); ?>
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
					<li>
						<a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a>
					</li>
					<?php endforeach; ?>
					<li class="new_store"><a href="<?php echo home(); ?>store-list/?store=new">新店</a></li>
				</ul>
			</section>
		</aside>
		<main>
			<div class="section-store_detail">
				<div class="container">
					<div class="left">
						<div class="img-box">
							<?php if (has_post_thumbnail()) : ?>
							<?php the_post_thumbnail('full'); ?>
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
						<h4>設置台数</h4>

						<!-- <?php $install_inputs = CFS()->get('install_input'); ?>

						<?php foreach ($install_inputs as $inputs) : ?>
						<?php if (is_null($inputs["p_or_s"]['pachinko'])) : ?>
						<?php $fieldloops = $inputs['install_box']; ?>
						<?php foreach ($fieldloops as $filed) : ?>
						<?php $s_count += (int)$filed["install_count"]; ?>
						<?php endforeach; ?>
						<?php if ($inputs['install_type']) : ?>
						<?php endif; ?>
						<?php endif; ?>
						<?php if (is_null($inputs["p_or_s"]['slot'])) : ?>
						<?php $fieldloops = $inputs['install_box']; ?>
						<?php foreach ($fieldloops as $filed) : ?>
						<?php $p_count += (int)$filed["install_count"]; ?>
						<?php endforeach; ?>
						<?php if ($inputs['install_type']) : ?>
						<?php endif; ?>
						<?php endif; ?>
						<?php endforeach; ?> -->

						<dl class="install">
							<dt><span>パチンコ</span>32台</dt>
							<dd>
								<!-- <?php foreach ($install_inputs as $inputs) : ?>
								<?php if (is_null($inputs["p_or_s"]['slot'])) : ?>
								<?php $fieldloops = $inputs['install_box'];; ?>
								<?php $count = 0; ?>
								<?php foreach ($fieldloops as $filed) : ?>
								<?php $count += (int)$filed["install_count"]; ?>
								<?php endforeach; ?>
								<p><span><?php echo $inputs['install_type']; ?></span><?php echo $count; ?>台</p>
								<?php endif; ?>
								<?php endforeach; ?> -->
							</dd>
						</dl>
						<hr>
						<dl class="install">

							<dt><span>スロット</span>16台</dt>
							<dd>
								<!-- <?php foreach ($install_inputs as $inputs) : ?>
								<?php if (is_null($inputs["p_or_s"]['pachinko'])) : ?>
								<?php $fieldloops = $inputs['install_box']; ?>
								<?php $count = 0; ?>
								<?php foreach ($fieldloops as $filed) : ?>
								<?php $count += (int)$filed["install_count"]; ?>
								<?php endforeach; ?>
								<?php if ($inputs['install_type']) : ?>
								<p><span><?php echo $inputs['install_type']; ?></span><?php echo $count; ?>台</p>
								<?php endif; ?>
								<?php endif; ?>
								<?php endforeach; ?> -->
							</dd>
						</dl>


						<div class="img-box"> <a href="<?php echo home(); ?>recruit">
								<img class="recruit_bnr-02 img-fluid" src="<?php echo img_dir(); ?>page/bnr_recruit_hover.png"
									alt="採用情報">
								<img class="recruit_bnr-01 img-fluid" src="<?php echo img_dir(); ?>page/bnr_recruit.png" alt="採用情報">

							</a></div>
					</div>
				</div>
			</div>
			<div class="section-intall">
				<!-- <?php $install_input = CFS()->get('install_input'); ?>
				<?php foreach ($install_input as $install) : ?>
				<section>
					<h3><?php echo $install['install_type']; ?></h3>
					<?php $install_box = $install['install_box'];; ?>
					<?php foreach ($install_box as $install_list) : ?>
					<dl>
						<dt><?php echo $install_list['install_name']; ?></dt>
						<dd>（<?php echo $install_list['install_count']; ?>台）</dd>
					</dl>
					<?php endforeach; ?>
				</section>
				<?php endforeach; ?> -->
				<section>
					<h3>4円パチンコ</h3>
					<dl>
						<dt>Ｐ元祖大工の源さんＷＣＣ</dt>
						<dd>（1台）</dd>
					</dl>
					<dl>
						<dt>ＣＲぱちんこＡＫＢ４８バラの儀式Ｖ９</dt>
						<dd>（1台）</dd>
					</dl>
					<dl>
						<dt>ＣＲ大海物語４ＭＴＢ</dt>
						<dd>（10台）</dd>
					</dl>
					<dl>
						<dt>ＣＲクイーンズブレイド２ＷＬＢ</dt>
						<dd>（1台）</dd>
					</dl>
				</section>
			</div>
			<div class="section-sns">
				<?php if ($tw) : ?>
				<a class="twitter-timeline" href="<?php echo $tw; ?>?ref_src=twsrc%5Etfw">Tweets by
					JANJAN_ryuuga</a>
				<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
				<?php else : ?>
				<p>表示できるSNSの情報がありません</p>
				<?php endif; ?>
			</div>
			<div class="section-map">
				<?php
				// $map = CFS()->get('map');
				$map = get_post_meta($post->ID, 'map', true);

				if (empty($map)) {
					$map = CFS()->get('address');
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