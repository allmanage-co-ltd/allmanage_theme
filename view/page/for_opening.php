<?php get_header(); ?>
<section class="section-breadcrumb">
	<div class="container">
		<?php breadcrumb(); ?>
	</div>
</section>
<main>
	<section class="section-for_opening-title">
		<div class="container">
			<h3 class="title">土地・物件活用をご検討されているオーナー様へ</h3>
			<h4>(株)エスエープランニングでは新規出店用地を探しています。<br>
				どなた様でもお気軽にご連絡ください。</h4>
			<p>当社は関東を中心に積極的な店舗開発を進めております。<br>
				つきましては物件のご紹介・お問い合わせをいただきますようお願い申し上げます。</p>
		</div>
	</section>

	<section class="section-opening">
		<div class="container">
			<dl>
				<dt><img src="<?php echo img_dir(); ?>page/opening-01.png" alt="" class="img-fluid"></dt>
				<dd>
					<h4 class="title">募集エリア　関東</h4>
					<p>土地・建物・SC及び居抜き物件等がございましたら、「お問い合わせフォーム」よりご紹介下さいませ。</p>
					<p>不動産物件オーナー様や、不動産仲介業者様からのお問い合わせを心よりお待ち申し上げております。</p>
				</dd>
			</dl>
		</div>
	</section>
	<section class="section-opening">
		<div class="container">
			<h3>物件募集のご案内</h3>
			<dl>
				<dt><img src="<?php echo img_dir(); ?>page/opening-store-01.png" alt="" class="img-fluid"></dt>
				<dd>
					<h4 class="title">郊外型（居抜・テナントイン）</h4>
					<ul>
						<li><span>床面積</span>300坪以上</li>
						<li><span>契約形態</span>建物賃貸など</li>
					</ul>
					<div class="btn_area">
						<a href="<?php echo img_dir(); ?>pdf/for_opening_detail.pdf" target="_blank" class="btn angle">詳細はコチラ</a>
					</div>
				</dd>
			</dl>
			<dl>
				<dt><img src="<?php echo img_dir(); ?>page/opening-store-02.png" alt="" class="img-fluid"></dt>
				<dd>
					<h4 class="title">郊外型（土地）</h4>
					<ul>
						<li><span>床面積</span>2,000坪以上</li>
						<li><span>契約形態</span>定期借地、建物賃貸、売買など</li>
					</ul>
					<div class="btn_area">
						<a href="<?php echo img_dir(); ?>pdf/for_opening_detail.pdf" target="_blank" class="btn angle">詳細はコチラ</a>
					</div>
				</dd>
			</dl>
			<dl>
				<dt><img src="<?php echo img_dir(); ?>page/opening-store-03.png" alt="" class="img-fluid"></dt>
				<dd>
					<h4 class="title">駅前型ビルイン</h4>
					<ul>
						<li><span>床面積</span>250坪以上</li>
						<li><span>契約形態</span>建物賃貸など</li>
					</ul>
					<div class="btn_area">
						<a href="<?php echo img_dir(); ?>pdf/for_opening_detail.pdf" target="_blank" class="btn angle">詳細はコチラ</a>
					</div>
				</dd>
			</dl>
		</div>
	</section>
	<section class="section-opening">
		<div class="container">
			<h3>不動産活用の例</h3>
			<div class="item-area">
				<div class="item-box">
					<img src="<?php echo img_dir(); ?>page/opening-store-04.png" alt="" class="img-fluid">
					<span>空き地</span>
				</div>
				<div class="item-box">
					<img src="<?php echo img_dir(); ?>page/opening-store-05.png" alt="" class="img-fluid">
					<span>田・畑・山林</span>
				</div>
				<div class="item-box last-item">
					<img src="<?php echo img_dir(); ?>page/opening-store-06.png" alt="" class="img-fluid">
					<span>大型家電量販店跡地<br>ビル空中階</span>
				</div>
			</div>

		</div>
	</section>
	<section class="section-opening bg_gray contact-box">
		<div class="container">
			<h3>CONTACT</h3>
			<p>店舗・出店用地に関する問い合わせは<br>
				お気軽にお問合せください。</p>
			<div class="btn_area">
				<a href="<?php echo home(); ?>contact" class="btn angle">お問い合わせはこちら</a>
			</div>
		</div>
	</section>
</main>



<?php
get_footer(); ?>