<div id="comment-wrapper" class="comments">
  <?php if ( post_password_required() ) : ?>
  <p class="nopassword">
    <?php _e( 'This post is password protected. Enter the password to view any comments.','colabsthemes' ); ?>
  </p>
</div>
<!-- #comments -->
<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>
<?php // You can start editing here -- including this comment! ?>
<?php if ( have_comments() ) : ?>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
<nav id="comment-nav-above">
  <h1 class="assistive-text">
    <?php _e( 'Comment navigation' ); ?>
  </h1>
  <div class="nav-previous">
    <?php previous_comments_link( __( '&larr; Older Comments','colabsthemes' ) ); ?>
  </div>
  <div class="nav-next">
    <?php next_comments_link( __( 'Newer Comments &rarr;' ,'colabsthemes') ); ?>
  </div>
</nav>
<?php endif; // check for comment navigation ?>
<div class="post-meta col2">
  <h3 class="meta-com">
      <?php comments_number( '', '1', '%' ); ?>
      <?php comments_number( __('Add Comment','colabsthemes'), __('Comment','colabsthemes'), __('Comments','colabsthemes') ); ?>
  </h3>
</div>
<div class="post-item col6">
  <ol class="commentlist">
<?php wp_list_comments('type=comment&callback=custom_comments'); ?>
  </ol>
<?php // contact form layout

$fields =  array(
	'author' => '<div class="comment-right"><p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="'.__( 'Name' ).'&nbsp;('.__( 'required' ).')" /><label for="author">' . __( 'Your name' ) . '</label> ' . ( $req ? '' : '' ) .
	            '</p>',
	'email'  => '<p class="comment-form-email"><input id="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="'.__( 'Email' ).'&nbsp;('.__( 'required, hidden' ).')" /><label for="email">'. __( 'Your email, won&rsquo;t be published, promise!' ) .'</label> ' . ( $req ? '' : '' ) .
	            '</p>',
	'url'    => '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="'.__( 'URL' ).'&nbsp;('.__( 'optional' ).')" /><label for="url">' . __( 'Website' ) . '</label></p></div>',
);

comment_form(array(
	'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="'.__( 'Insert your comment here' ).'"></textarea></p>',
	'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'title_reply'          => __( 'Respond','colabsthemes' ),
	'title_reply_to'       => __( 'Leave a Reply to %s','colabsthemes' ),
	'label_submit'         => __( 'Submit Comment','colabsthemes' ),
	'cancel_reply_link'    => __( 'Cancel','colabsthemes' ),
)); ?>
</div>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
<nav id="comment-nav-below">
  <h1 class="assistive-text">
    <?php _e( 'Comment navigation' ); ?>
  </h1>
  <div class="nav-previous">
    <?php previous_comments_link( __( '&larr; Older Comments','colabsthemes' ) ); ?>
  </div>
  <div class="nav-next">
    <?php next_comments_link( __( 'Newer Comments &rarr;','colabsthemes' ) ); ?>
  </div>
</nav>
<?php endif; // check for comment navigation ?>
<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>

<?php endif; ?>

		<?php if ( !have_comments() ) : ?>

		<div class="post-item col6">

		<?php // contact form layout

		$fields =  array(
			'author' => '<div class="comment-right"><p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="'.__( 'Name' ).'&nbsp;('.__( 'required' ).')" /><label for="author">' . __( 'Your name' ) . '</label> ' . ( $req ? '' : '' ) .
						'</p>',
			'email'  => '<p class="comment-form-email"><input id="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="'.__( 'Email' ).'&nbsp;('.__( 'required, hidden' ).')" /><label for="email">'. __( 'Your email, won&rsquo;t be published, promise!' ) .'</label> ' . ( $req ? '' : '' ) .
						'</p>',
			'url'    => '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="'.__( 'URL' ).'&nbsp;('.__( 'optional' ).')" /><label for="url">' . __( 'Website' ) . '</label></p></div>',
		);

		comment_form(array(
			'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="'.__( 'Insert your comment here' ).'"></textarea></p>',
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'title_reply'          => __( 'Respond','colabsthemes' ),
			'title_reply_to'       => __( 'Leave a Reply to %s','colabsthemes' ),
			'label_submit'         => __( 'Submit Comment','colabsthemes' ),
			'cancel_reply_link'    => __( 'Cancel','colabsthemes' ),
		)); ?>
		</div>
		<?php endif; ?>
</div>
<!-- #comments --> 
