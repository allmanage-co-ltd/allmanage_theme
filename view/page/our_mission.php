<?php get_header(); ?>
<section class="section-breadcrumb">
	<div class="container">
		<?php breadcrumb(); ?>
	</div>
</section>
<main>
	<section class="section-our_mission">
		<div class="container">
			<h3 class="title">会社沿革・ビジョン　<br>1968年創業 ～ 2030年</h3>
			<div class="movie-content-wrap">
				<iframe width="800" height="450" src="https://www.youtube.com/embed/T1a6WcnXDws?enablejsapi=1" frameborder="0"
					allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

			</div>
			<img src="<?php echo img_dir(); ?>common/sp-spacer.gif" alt="" class="sp-spacer">
			<h3 class="title">企業理念・経営理念・ビジョン2030</h3>

		</div>
	</section>
	<section class="section-vision">
		<div class="container">
			<div class="text-box">
				<h4>FOUNDING<span>企業理念</span></h4>
				<hr>
				<p>地域社会に貢献し喜びと感動を与え続ける</p>
				<h4>MANAGEMENT<span>経営理念</span></h4>
				<hr>
				<h5>人と遊びのｒｅ・ｃｒｅａｔｉｏｎ　再創造</h5>
				<p>社員は自他を認め、あらゆる意見や考えを尊重し、個性を発揮して挑戦し続ける仲間である。<br>
					多様化する遊び文化を通じて社員・顧客・自社に関わる全ての人々の社会生活の向上や心の潤い・活力・幸福を創り出す。</p>
				<h4>VISION 2030<span>ビジョン2030</span></h4>
				<hr>
				<p>日本を代表する「ファンタメラボ」となる。<br>
					日常にドラマティックなファンタイム！</p>
			</div>
			<div class="img-box">
				<img src="<?php echo img_dir(); ?>page/our_mission-01.png" class="img-fluid" alt="企業理念・経営理念・ビジョン2030">
			</div>
		</div>
	</section>
	<section class="section-values">
		<div class="container">
			<h3 class="title">Our Values</h3>
			<?php
			require_once(dirname(__FILE__) . '/arry.php'); ?>
			<div class="value-group">
				<?php foreach ($mission_arry as $index => $values) : $index = $index + 1;
					$index = sprintf('%02d', $index);
				?>

				<dl>
					<dt><img src="<?php echo img_dir(); ?>page/our_values-<?php echo $index; ?>.png" class="img-fluid" alt="">
					</dt>
					<dd>
						<h4>
							<div class="num"><span class="num-top">VALUE</span><span class="num-btm"><?php echo $index; ?></span>
							</div>
							<p><strong><?php echo $values['title']; ?></strong><span><?php echo $values['sub']; ?></span></p>
						</h4>
						<hr>
						<p><?php echo $values['text']; ?></p>
					</dd>
				</dl>
				<?php $ct++;; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
</main>
<?php
get_footer(); ?>