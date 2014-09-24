<?php
/*
The template for displaying Search Results pages.
*/
get_header(); ?>

<div id="content">
	<div class="container">

		<header class="content-header">
		<h1 class="content-title"><?php printf(__('Search Results: %s', 'birdegg'), esc_html($s) ); ?></h1>
		</header>

		<?php if (have_posts()) : ?>

			<ul class="article">
			<?php while (have_posts()) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
			</ul>
			<div class="tablenav"><?php BirdEGG::the_pagenation(); ?></div>

		<?php else: ?>
			<p><?php printf(__('Sorry, no posts matched &#8216;%s&#8217;', 'birdegg'), esc_html($s) ); ?>
		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>
