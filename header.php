<?php
/*
The Header for our theme.
*/
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" >
<meta name="viewport" content="width=device-width" >
<title><?php wp_title('|', true, 'right'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" >
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" >
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php $birdegg_header_image = get_header_image(); ?>
<?php if( ! is_paged() && ! empty( $birdegg_header_image ) ): ?>
	<div id="headerimage">
		<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>">
	</div>
<?php endif; ?>

<div <?php birdegg_wrapper_class('wrapper'); ?>>
	<header id="header">
		<div class="container">
			<div id="branding">
				<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
				<<?php echo $heading_tag; ?> id="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</<?php echo $heading_tag; ?>>
				<p id="site-description"><?php bloginfo( 'description' ); ?></p>
			</div>

			<nav id="menu-wrapper">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'menu', 'menu_class' => '', 'menu_id' => 'menu-primary-items', 'items_wrap' => '<div id="small-menu">' .__( 'Menu', 'birdfield' ) .'</div><ul id="%1$s" class="%2$s">%3$s</ul>', 'fallback_cb' => '' ) ); ?>
			</nav>
		</div>
	</header>
