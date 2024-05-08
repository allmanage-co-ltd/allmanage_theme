<ul>
	<li><a href="<?php echo home(); ?>">ホーム</a></li>
	<li><a href="<?php echo home(); ?>recruit">採用情報</a></li>
	<li><a href="<?php echo home(); ?>company">会社概要</a>
		<ul>
			<li><a href="<?php echo home(); ?>our_mission"><i class="fas fa-angle-right"></i>経営者の想い・企業としての使命</a></li>
			<li><a href="<?php echo home(); ?>feature"><i class="fas fa-angle-right"></i>事業の特徴と強み</a></li>
			<li><a href="<?php echo home(); ?>mission"><i class="fas fa-angle-right"></i>ミッション</a></li>
			<li><a href="<?php echo home(); ?>csr"><i class="fas fa-angle-right"></i>CSR活動</a></li>
		</ul>
	</li>
	<li><a href="<?php echo home(); ?>for_opening">出店用地募集</a></li>
	<li><a href="<?php echo home(); ?>store">店舗情報</a></li>
	<li><a href="<?php echo home(); ?>contact">お問合わせ</a></li>
</ul>
<form method="get" id="searchform-dw" action="<?php echo home(); ?>">
	<i class="fas fa-search"></i>
	<input type="text" value="" name="s" class="s" placeholder="サイト内投稿記事検索" />
	<input type="hidden" name="post_type" value="news-list">
	<button type="submit" class="s-btn-area">
		<div class="s-btn">検索</div>
	</button>
</form>