<?php
/*
The template for displaying the footer.
*/
?>
	<footer id="footer">
		<section id="widget-area">
			<div class="container">
				<?php dynamic_sidebar( 'widget-area-footer' ); ?>
			</div>
		</section>

		<div class="container">
			<div class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ) ; ?>"><strong><?php bloginfo(); ?></strong></a>

				<?php if( get_theme_mod( 'copyright', 'true' ) ): ?>
					<?php printf(__( 'Copyright &copy; %s All Rights Reserved.', 'birdegg' ), BirdEGG::get_copyright_year() ); ?>
				<?php endif; ?>

				<?php if( get_theme_mod( 'credit', 'true' ) ): ?>
					<br>
					<span class="generator"><a href="<?php echo esc_url('http://wordpress.org/'); ?>" target="_blank"><?php _e( 'Proudly powered by WordPress', 'birdegg' ); ?></a></span>
				<?php printf(__( 'BirdEGG theme by %sSysbird%s', 'birdegg' ), '<a href="' .esc_url('https://profiles.wordpress.org/sysbird/') .'" target="_blank">', '</a>' ); ?>
				<?php endif; ?>
			</div>
		</div>
		<p id="back-top"><a href="#top"><span><?php _e( 'Go Top', 'birdegg'); ?></span></a></p>
	</footer>

</div><!-- wrapper -->

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js" type="text/javascript"></script>
<![endif]-->
<?php wp_footer(); ?>

</body>
</html>