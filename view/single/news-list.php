 <section class="section-breadcrumb">
 	<div class="container">
 		<?php breadcrumb(); ?>
 	</div>
 </section>
 <main>
 	<?php
		if (have_posts()) :
			while (have_posts()) : the_post();
		?>
 	<section class="section-news-list">
 		<div class="container">
 			<?php the_content(); ?>
 		</div>
 	</section>
 	<?php endwhile;
		endif;
			?>