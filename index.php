<?php
/*
The main template file.
*/
get_header(); ?>

<div id="content">
	<div class="container">
		<ul class="article">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
		</ul>
		<div class="tablenav"><?php BirdEGG::the_pagenation(); ?></div>
	</div>
</div>

<?php get_footer(); ?>
