<?php
/*
birdegg functions and definitions.
*/
//////////////////////////////////////////
// Set the content width based on the theme's design and stylesheet.
function birdegg_content_width() {
	global $content_width;
	$content_width = 930;
}
add_action( 'template_redirect', 'birdegg_content_width' );

//////////////////////////////////////////
// Set Widgets
function birdegg_widgets_init() {

	register_sidebar( array (
		'name' => __( 'Widget Area for footer', 'birdegg' ),
		'id' => 'widget-area-footer',
		'description' => __( 'Widget Area for footer', 'birdegg' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );
}
add_action( 'widgets_init', 'birdegg_widgets_init' );

//////////////////////////////////////////
// SinglePage Comment callback
function birdegg_custom_comments( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;

?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

	<?php if( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ):
		$birstips_url    = get_comment_author_url();
		$birstips_author = get_comment_author();
	 ?> 

		<div class="posted"><strong><?php _e( 'Pingback', 'birdegg' ); ?> : </strong><a href="<?php echo $birstips_url; ?>" target="_blank" class="web"><?php echo $birstips_author ?></a><?php edit_comment_link( __('(Edit)', 'birdegg'), ' ' ); ?></div>

	<?php else: ?>

		<div class="comment_meta">
			<?php echo get_avatar( $comment, 40 ); ?>
			<span class="author"><?php comment_author(); ?></span>
			<span class="postdate"><?php echo get_comment_time(get_option('date_format') .' ' .get_option('time_format')); ?></span><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'birdegg' ); ?></em>
		<?php endif; ?>

		<div class="comment_text">
			<?php comment_text(); ?>

			<?php $birdegg_web = get_comment_author_url(); ?>
			<?php if(!empty($birdegg_web)): ?>
				<p class="web"><a href="<?php echo $birdegg_web; ?>" target="_blank"><?php echo $birdegg_web; ?></a></p>
			<?php endif; ?>
		</div>

	<?php endif; ?>
<?php
	// no "</li>" conform WORDPRESS
}

//////////////////////////////////////////////////////
// Header markup
function birdegg_wrapper_class($birdegg_class) {

	if ( 'blank' == get_header_textcolor() ) {
		$birdegg_class .= ' no-title';
	}

	echo 'class="' .$birdegg_class .'"';
}

//////////////////////////////////////////////////////
// Pagenation
function birdegg_the_pagenation() {

	global $wp_rewrite;
	global $wp_query;
	global $paged;

	$birdegg_paginate_base = get_pagenum_link( 1 );
	if ( strpos($birdegg_paginate_base, '?' ) || ! $wp_rewrite->using_permalinks() ) {
		$birdegg_paginate_format = '';
		$birdegg_paginate_base = add_query_arg( 'paged', '%#%' );
	} else {
		$birdegg_paginate_format = ( substr( $birdegg_paginate_base, -1 ,1 ) == '/' ? '' : '/' ) .
		user_trailingslashit( 'page/%#%/', 'paged' );;
		$birdegg_paginate_base .= '%_%';
	}
	echo paginate_links( array(
		'base' => $birdegg_paginate_base,
		'format' => $birdegg_paginate_format,
		'total' => $wp_query->max_num_pages,
		'mid_size' => 3,
		'current' => ( $paged ? $paged : 1 ),
	));
}


//////////////////////////////////////////////////////
// Header Style
function birdegg_header_style() {

	//Theme Option
	$birdegg_accent_color = get_theme_mod( 'birdegg_accent_color', '#ff4a5d' );
	$birdegg_text_color = get_theme_mod( 'birdegg_text_color', '#333' );
	$birdegg_link_color = get_theme_mod( 'birdegg_link_color', '#1c4bbe' );
	$birdegg_widget_color = get_theme_mod( 'birdegg_widget_color', '#E5E5E5' );

?>

<style type="text/css">

	#header #branding #site-title,
	#header #branding #site-title a,
	#header #branding #site-description,
	#menu-wrapper .menu ul#menu-primary-items .current-menu-item > a,
	#menu-wrapper .menu ul#menu-primary-items .current-menu-ancestor > a,
	#menu-wrapper .menu ul#menu-primary-items li a:hover {
		color: #<?php header_textcolor();?>;
		}

	#menu-wrapper .menu #small-menu {
		background-color: #<?php header_textcolor();?>;
	}

	#menu-wrapper .menu ul#menu-primary-items .current-menu-item > a,
	#menu-wrapper .menu ul#menu-primary-items .current-menu-ancestor > a {
		border-color: #<?php header_textcolor();?>;
	}

	#content h1,
	#content h2,
	#content h3,
	#content h4,
	#content h5,
	#content h6,
	#content #comments li.bypostauthor .comment_meta .author,
	#widget-area .widget h3,
	#widget-area .widget #wp-calendar tbody th a,
	#widget-area .widget #wp-calendar tbody td a,
	#footer .site-title,
	#footer .site-title a {
		color: <?php echo $birdegg_accent_color; ?>;
		}

	#widget-area .widget h3 {
		border-color: <?php echo $birdegg_accent_color; ?>;
		}

	#content .hentry a.more-link {
		background-color: <?php echo $birdegg_accent_color; ?>;
		}

	.wrapper,
		.home #content #blog ul.article .hentry .entry-header .entry-title,
		.archive #content ul.list li a .entry-content,
		.search #content ul.list li a .entry-content {
		color:  <?php echo $birdegg_text_color; ?>;
		}

		a,
		.home #content #news ul.article li .entry-header .entry-title,
		.archive #content ul.list li .entry-header .entry-title,
		.search #content ul.list li .entry-header .entry-title {
		color:  <?php echo $birdegg_link_color; ?>;
		}

	#content .tablenav a.page-numbers {
		border-color: <?php echo $birdegg_link_color; ?>;
		color: <?php echo $birdegg_link_color; ?>;
		}

	#content .tablenav .current {
	  	background: <?php echo $birdegg_link_color; ?>;
	  	border-color: <?php echo $birdegg_link_color; ?>;
		}

	#widget-area {
	  	background-color: <?php echo $birdegg_widget_color; ?>;
		}

</style>

<?php 

}

//////////////////////////////////////////////////////
// Admin Header Style
function birdegg_admin_header_style() {
?>

<style type="text/css">

	#birdegg_header {
		font-family: Verdana,Arial,"メイリオ",Meiryo,"ヒラギノ角ゴPro W3","Hiragino Kaku Gothic Pro","ＭＳ Ｐゴシック",sans-serif;
		background: #<?php background_color();?>;
		padding: 1.6em;
		}

	#birdegg_header #site-title {
		margin: 0;
		padding: 0;
		color: #<?php header_textcolor();?>;
		font-size: 2rem;
		}

	#birdegg_header #site-title a {
		color: #<?php header_textcolor();?>;
	    text-decoration: none;
		}

	#birdegg_header #site-description {
		color: #<?php header_textcolor();?>;
		font-size: 1rem;
		}

</style>

<?php

} 

//////////////////////////////////////////////////////
// Admin Header Image
function birdegg_admin_header_image() {

	$style = '';
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) ){
		$style = ' style="display:none;"';
	}
?>
	<?php
		$header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<div id="headerimage">
				<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
			</div>
	<?php endif; ?>

	<div id="birdegg_header">
		<div id="site-title"><a <?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></div>
		<div id="site-description" <?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
	</div>

	<?php
}

//////////////////////////////////////////////////////
// Setup Theme
function birdegg_setup() {

	// Set languages
	load_theme_textdomain( 'birdegg', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Set feed
	add_theme_support( 'automatic-feed-links' );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', array(
		'default-color' => null,
		'default-image' => '',
		'default-color' => 'FFF',
		'wp-head-callback' => 'birdegg_custom_background_cb',
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Navigation Menu', 'birdegg' ),
	) );


	// Add support for custom headers.
	$custom_header_support = array(
		// Text color and image (empty to use none).
		'default-text-color'     => 'ff4a5d',
		'default-image'          => '',

		// Set height and width, with a maximum value for the width.
		'height'                 => 200,
		'width'                  => 1280,
		'max-width'              => 1280,
		'default-image'          => '%s/images/header.jpg',

		// Random image rotation off by default.
		'random-default'         => true,

		// Callbacks for styling the header and the admin preview.
		'wp-head-callback' => 'birdegg_header_style',
		'admin-head-callback' => 'birdegg_admin_header_style',
		'admin-preview-callback' => 'birdegg_admin_header_image'
	);

	add_theme_support( 'custom-header', $custom_header_support );

	register_default_headers( array(
		'birdegg' => array(
			'url' => '%s/images/header.jpg',
			'thumbnail_url' => '%s/images/header-thumbnail.jpg',
			'description' => 'birdegg'
		)
	) );

	// Add support for news content.
	add_theme_support( 'news-content', array(
		'news_content_filter' => 'birdegg_get_news_posts',
		'max_posts' => 5,
	) );
}
add_action( 'after_setup_theme', 'birdegg_setup' );  

//////////////////////////////////////////////////////
// Document Title
function birdegg_title( $title ) {
	global $page, $paged;

	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " | $site_description";

	if ( $paged >= 2 || $page >= 2 )
		$title .= ' | ' . sprintf( __( 'Page %s', 'birdegg' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'birdegg_title' );

//////////////////////////////////////////////////////
// Enqueue Scripts
function birdegg_scripts() {

	if ( is_singular() && comments_open() && get_option('thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'jquery' );  
	wp_enqueue_script( 'jquery-masonry' );
	wp_enqueue_script( 'birdegg', get_template_directory_uri() .'/js/birdegg.js', 'jquery', '1.00' );
	wp_enqueue_style( 'birdegg', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'birdegg_scripts' );

//////////////////////////////////////////////////////
// Enqueue Scripts for admin
function birdegg_admin_scripts( $hook_suffix ) {

	if ( 'appearance_page_custom-header' != $hook_suffix )
		return;

	wp_enqueue_style( 'birdegg-google-font', '//fonts.googleapis.com/css?family=Raleway', false, null, 'all' );
}
add_action( 'admin_enqueue_scripts', 'birdegg_admin_scripts' );

//////////////////////////////////////////////////////
// Theme Customizer
function birdegg_customize($wp_customize) {
 
	$wp_customize->add_section( 'birdegg_customize', array(
		'title'=> __( 'Theme Options', 'birdegg' ),
		'priority' => 99,
	) );

	// Accent Color
	$wp_customize->add_setting( 'birdegg_accent_color', array(
		'default' => '#ff4a5d',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdegg_accent_color', array(
		'label' => __( 'Accent Color', 'birdegg' ),
		'section'=> 'birdegg_customize',
		'settings' => 'birdegg_accent_color',
	) ) );

	// Text Color
	$wp_customize->add_setting( 'birdegg_text_color', array(
		'default' => '#333',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdegg_text_color', array(
		'label' => __( 'Text Color', 'birdegg' ),
		'section'=> 'birdegg_customize',
		'settings' => 'birdegg_text_color',
	) ) );

	// Link Color
	$wp_customize->add_setting( 'birdegg_link_color', array(
		'default' => '#1c4bbe',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdegg_link_color', array(
		'label' => __( 'Link Color', 'birdegg' ),
		'section'=> 'birdegg_customize',
		'settings' => 'birdegg_link_color',
	) ) );

	// Widget Area Background Color
	$wp_customize->add_setting( 'birdegg_widget_color', array(
		'default' => '#E5E5E5',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdegg_widget_color', array(
		'label' => __( 'widget Area BackgroundColor', 'birdegg' ),
		'section'=> 'birdegg_customize',
		'settings' => 'birdegg_widget_color',
	) ) );
}
add_action( 'customize_register', 'birdegg_customize' );

//////////////////////////////////////////////////////
// Custom Background callback
function birdegg_custom_background_cb() {
	// $background is the saved custom image, or the default image.
	$background = set_url_scheme( get_background_image() );

	// $color is the saved custom color.
	// A default has to be specified in style.css. It will not be printed here.
	$color = get_background_color();

	if ( $color === get_theme_support( 'custom-background', 'default-color' ) ) {
		$color = false;
	}

	if ( ! $background && ! $color )
		return;

	$style = $color ? "background-color: #$color;" : '';

	if ( $background ) {
		$image = " background-image: url('$background');";

		$repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );
		if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
			$repeat = 'repeat';
		$repeat = " background-repeat: $repeat;";

		$position = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
		if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
			$position = 'left';
		$position = " background-position: top $position;";

		$attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );
		if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
			$attachment = 'scroll';
		$attachment = " background-attachment: $attachment;";

		$style .= $image . $repeat . $position . $attachment;
	}
?>
<style type="text/css" id="custom-background-css">
body.custom-background .wrapper { <?php echo trim( $style ); ?> }
</style>
<?php
}
