<footer class="footer">


	<div class="contents">
		<div class="footer-logo">
			<a href="<?php echo home(); ?>"><img src="<?php echo img_dir(); ?>common/logo-w.png" class="img-fluid" alt=""></a>


		</div>
		<div class="footer-link">
			<ul>
				<li><a href="<?php echo home(); ?>">ホーム</a></li>
				<li><a href="<?php echo home(); ?>company">会社概要</a>
					<ul>
						<li><a href="<?php echo home(); ?>our_mission"><i class="fas fa-caret-right"></i>経営者の想い・企業としての使命</a></li>
						<li><a href="<?php echo home(); ?>feature"><i class="fas fa-caret-right"></i>事業の特徴と強み</a></li>
						<li><a href="<?php echo home(); ?>mission"><i class="fas fa-caret-right"></i>ミッション</a></li>
						<li><a href="<?php echo home(); ?>csr"><i class="fas fa-caret-right"></i>CSR活動</a></li>
					</ul>
				</li>
				<li><a href="<?php echo home(); ?>for_opening">出店用地募集</a></li>
			</ul>
			<ul>
				<li><a href="<?php echo home(); ?>store">店舗情報</a></li>



				<!-- <li><a href="<?php echo home(); ?>store?pref=new_store"></i>オープン情報</a></li> -->



				<li><a href="<?php echo home(); ?>recruit">採用情報</a>
				</li>
				<li><a href="<?php echo home(); ?>contact">お問い合わせ</a>
				</li>
				<li><a href="<?php echo home(); ?>privacy-policy">プライバシーポリシー</a>
				</li>
			</ul>



		</div>
	</div>
	<address>© 2020 SA-PLANNING</address>

</footer>
<div class="topto out"><a href="#top"><i class="fas fa-angle-up"></i>TOP</a></div>
<?php wp_footer(); ?>
<script>
let mySwiper = new Swiper('.swiper-container', {
	// 以下にオプションを設定
	loop: true, //最後に達したら先頭に戻る

	//ページネーション表示の設定
	pagination: {
		el: '.swiper-pagination', //ページネーションの要素
		type: 'bullets', //ページネーションの種類
		clickable: true, //クリックに反応させる
	},

	//ナビゲーションボタン（矢印）表示の設定
	navigation: {
		nextEl: '.swiper-button-next', //「次へボタン」要素の指定
		prevEl: '.swiper-button-prev', //「前へボタン」要素の指定
	},

	//スクロールバー表示の設定
	scrollbar: {
		el: '.swiper-scrollbar', //要素の指定
	},
})
</script>
</body>

</html>