<form method="get" id="searchform" action="<?php echo home(); ?>">
	<i class="fas fa-search"></i>
	<input type="text" value="" name="s" class="s" id="s" placeholder="サイト内投稿記事検索" />
	<input type="hidden" name="post_type" value="news-list">
	<button type="submit" class="s-btn-area">
		<div class="s-btn">検索</div>
	</button>
</form>