<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments and the comment
 * form. The actual display of comments is handled by a callback to
 * outspoken_comment() which is located in the functions.php file.
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if (post_password_required())
	return;
?>

<div id="comments" class="commentsBox">

<?php if (have_comments()): ?>
	<h2 class="comments-title">
		<?php
		printf(_nx('There is one comment', 'There are %1$s comments', get_comments_number(), 'comments title', 'coworking'),
			number_format_i18n(get_comments_number()));
		?>
	</h2>

	<ol class="comment-list commentList">
		<?php
		wp_list_comments(array(
			'style' => 'ol',
			'format' => 'html5',
			'short_ping' => true,
			'avatar_size' => 56,
			'callback' => 'uni_coworking_theme_comment'
		));
		?>
	</ol><!-- .comment-list -->

	<?php
	// Are there comments to navigate through?
	if (get_comment_pages_count() > 1 && get_option('page_comments')):
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text section-heading"><?php esc_html_e('Comment navigation', 'coworking'); ?></h1>

		<div class="nav-previous"><?php previous_comments_link(esc_html__('&larr; Older Comments', 'coworking')); ?></div>
		<div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments &rarr;', 'coworking')); ?></div>
	</nav><!-- .comment-navigation -->
	<?php endif; // Check for comment navigation ?>

	<?php if (!comments_open() && get_comments_number()): ?>
	<p class="no-comments"><?php esc_html_e('Comments are closed.', 'coworking'); ?></p>
	<?php endif; ?>

<?php endif; // have_comments() ?>

	<?php
    $bReq               = get_option( 'require_name_email' );
	$sAuthorPlaceholder = esc_attr__('Your name', 'coworking');
	$sEmailPlaceholder  = esc_attr__('Your email', 'coworking');
	comment_form(array(
		'format' => 'html5',
		'label_submit' => esc_html__('Submit Comment', 'coworking'),
		'title_reply' => esc_html__('Post Your Thoughts', 'coworking'),
		'cancel_reply_link' => esc_html__('Cancel', 'coworking'),
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="'.esc_html__('Your message', 'coworking').'"></textarea></p>',
		'fields' => apply_filters('comment_form_default_fields', array(
			'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" value="'.esc_attr($commenter['comment_author']).'" size="30"'.($bReq ? ' aria-required="true" placeholder="'.$sAuthorPlaceholder.'"' : ' placeholder="'.$sAuthorPlaceholder.'"').' /></p>',
			'email' => '<p class="comment-form-email"><input id="email" name="email" type="text" value="'.esc_attr($commenter['comment_author_email']).'" size="30"'.($bReq ? ' aria-required="true" placeholder="'.$sEmailPlaceholder.'"' : ' placeholder="'.$sEmailPlaceholder.'"').' /></p>',
			'url' => '<p class="comment-form-url"><input id="url" name="url" type="text" value="'.esc_attr($commenter['comment_author_url']).'" size="30" placeholder="'.esc_attr__('Your website', 'coworking').'" /></p>'
		))
	));
	?>

</div><!-- #comments -->
