<?php get_header(); ?>
<section class="section-breadcrumb">
	<div class="container">
		<?php breadcrumb(); ?>
	</div>
</section>
<main>
	<section class="section-contact">
		<div class="container">
			<h3 class="title">お問い合わせフォーム</h3>
			<?php echo do_shortcode('[contact-form-7 id="135" title="お問い合わせフォーム"]'); ?>

		</div>
	</section>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
	crossorigin="anonymous"></script>
<script>
var site_url = "<?php echo home(); ?>privacy-policy"
jQuery('.policy').attr('href', site_url)
</script>
<?php
get_footer(); ?>