<?php 

if ( post_password_required() ) {
  return;
}

?>

<div id="comments" class="comments-area">
  <?php if ( have_comments() ) : ?>

    <!-- Comments title and count -->

    <h4 class="comment-title mt-2">
      <?php
        printf(
          esc_html( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'wp-site' ) ),
          number_format_i18n( get_comments_number() ),
          '<span>' . get_the_title() . '</span>'
        );
      ?>
    </h4>

    <!-- Comments pagination -->

    <?php echo sunset_get_post_navigation (); ?>

    <!-- Comments list -->

    <ol class="comment-list">
      <?php
        $args = array(
          'walker'            => null,
          'max_depth'         => '',
          'style'             => 'ol',
          'callback'          => null,
          'end-callback'      => null,
          'type'              => 'all',
          'reply_text'        => 'Reply',
          'page'              => '',
          'per_page'          => '',
          'avatar_size'       => 64,
          'reverse_top_level' => null,
          'reverse_children'  => '',
          'format'            => 'html5',
          'short_ping'        => false,
          'echo'              => true,
        );

        wp_list_comments( $args );
      ?>
    </ol>

    <!-- Comments pagination -->

    <?php echo sunset_get_post_navigation (); ?>

    <?php if ( !comments_open() && get_comments_number() ) : ?>
      <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'wp-site' ); ?></p>
    <?php endif; ?>

  <?php endif; ?>

  <?php 
    $fields = array(
      'author' =>
        '<div class="form-group">
          <label for="author">' . __( 'Name', 'wp-site' ) . '<span class="required">*</span></label>
          <input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" required="required" />
        </div>',
      'email' =>
        '<div class="form-group">
          <label for="email">' . __( 'Email', 'wp-site' ) . '<span class="required">*</span></label>
          <input id="email" name="email" class="form-control" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" required="required" />
        </div>',
      'url' =>
        '<div class="form-group">
          <label for="url">' . __( 'Website', 'wp-site' ) . '</label>
          <input id="url" name="url" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" />
        </div>',
    );

    $args = array(
      'class_form'    => 'app-comment-form',
      'class_submit'  => 'btn btn-block btn-secondary btn-lg mt-4',
      'label_submit'  => __( 'Submit Comment' ),
      'comment_field' => '<div class="form-group"><label for="comment">' . _x( 'Comment', 'wp-site' ) . '<span class="required">*</span></label><textarea id="comment" name="comment" class="form-control" required="required" ></textarea></div>',
      'fields'        => apply_filters( 'comment_form_default_fields', $fields ),
    );

    comment_form( $args ); 
  ?>
</div><!-- .comments-area -->
