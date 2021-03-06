<?php
/*
The template for displaying Comments.
*/
?>
<div id="comments">
<?php if ( post_password_required() ) : ?>
	<div class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'birdegg' ); ?></div>
</div>
<?php return;
	endif;
?>

<?php if ( have_comments() ) : ?>
	<h2 id="comments-title">
		<?php
		printf( _n( 'One Comment', '%1$s Comments', get_comments_number(), 'birdegg' ),
		number_format_i18n( get_comments_number() ));
		?>
	</h2>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div class="navigation top">
			<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'birdegg' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'birdegg' ) ); ?></div>
		</div>
	<?php endif;  ?>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'BirdEGG::the_comments' ) ); ?>
		</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div class="navigation bottom">
			<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'birdegg' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'birdegg' ) ); ?></div>
		</div>
	<?php endif; ?>

<?php endif; ?>

<?php $myfields =  array(
'author' => '<label for="author"><em>' . __( 'Name', 'birdegg' ) . ($req ? ' ' .__( '(*required)', 'birdegg' ) : '') .'</em><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="22"' .($req ? ' aria-required="true"' : '') . ' ></label>',
'email'  => '<label for="email"><em>' . __('Email (will not be published)', 'birdegg') . ($req ? ' ' .__( '(*required)', 'birdegg' ) : '') .'</em><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' .($req ? ' aria-required="true"' : '') . ' ></label>',
'url' => '<label for="url"><em>' . __( 'Website', 'birdegg' ) .'</em><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" ></label>',
); ?>

<?php $myform = array(
'fields' => apply_filters( 'comment_form_default_fields', $myfields ),
'comment_field' => '<label for="comment"><em>' . __( 'Comment', 'birdegg' ) . ($req ? ' ' .__( '(*required)', 'birdegg' ) : '') .'</em>' . '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></label>',
'comment_notes_before' => '',
); ?>

<?php comment_form($myform); ?>

</div>