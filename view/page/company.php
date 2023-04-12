<?php get_header(); ?>
<section class="section-breadcrumb">
	<div class="container">
		<?php breadcrumb(); ?>
	</div>
</section>
<main>
	<section class="section-company">
		<div class="container">
			<h3 class="title">会社概要</h3>
			<dl>
				<dt>会社名</dt>
				<dd>株式会社エスエープランニング</dd>
			</dl>
			<dl>
				<dt>代表者</dt>
				<dd>代表取締役社長　金　淳次</dd>
			</dl>
			<dl>
				<dt>創業</dt>
				<dd>2000年11月</dd>
			</dl>
			<dl>
				<dt>資本金</dt>
				<dd>48,000,000円</dd>
			</dl>
			<dl>
				<dt>主な事業</dt>
				<dd>パチンコ事業部門<br>
					新規事業部門<br>
					その他</dd>
			</dl>
			<dl>
				<dt>所在地</dt>
				<dd>〒103-0027　東京都中央区日本橋3丁目5-12日本橋MMビル8階</dd>
			</dl>
			<dl>
				<dt>グループ従業員数</dt>
				<dd>108名</dd>
			</dl>
			<dl>
				<dt>グループ店舗</dt>
				<dd class="btn_dd">
					<div class="btn_area"><a href="<?php echo home(); ?>store" class="btn angle">店舗一覧はこちら</a></div>
				</dd>
			</dl>
			<dl>
				<dt>グループ会員登録数</dt>
				<dd>178,545名</dd>
			</dl>

		</div>
	</section>
	<section class="section-company">
		<div class="container">
			<div class="gmap">
				<iframe
					src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3240.911761218142!2d139.77066141555107!3d35.679174637691624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188be2a9debd35%3A0xa40b214095c5497d!2z44CSMTAzLTAwMjcg5p2x5Lqs6YO95Lit5aSu5Yy65pel5pys5qmL77yT5LiB55uu77yV4oiS77yR77yS!5e0!3m2!1sja!2sjp!4v1613724021515!5m2!1sja!2sjp"
					width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
				<div>
				</div>
	</section>
	<section class="section-company">
		<div class="container">
			<h3 class="title">組織図</h3>
			<div class="chart-box">
				<picture>
					<source media="(max-width: 560px)" srcset="<?php echo img_dir(); ?>page/organization_chart_sp.jpg">
					<img src="<?php echo img_dir(); ?>page/organization_chart.png" class="img-fluid" alt="株式会社エスエープランニング 組織図">
				</picture>
			</div>
		</div>
	</section>
</main>
<?php
get_footer(); ?>