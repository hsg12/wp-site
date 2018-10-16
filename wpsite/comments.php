<?php 

if ( post_password_required() ) {
  return;
}

?>

<div id="comments" class="comments-area">
  <?php if ( have_comments() ) : ?>

    <!-- Comments title and count -->

    <h4 class="comment-title mt-5">
      <?php
        printf(
          esc_html( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'wp-site' ) ),
          number_format_i18n( get_comments_number() ),
          '<span>' . get_the_title() . '</span>'
        );
      ?>
    </h4>

    <!-- Comments pagination -->

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
      <nav id="comment-nav-top" class="comment-navigation" role="navigation"> 
        <div class="row">

          <div class="col-12 col-sm-6">
            <div class="post-link-nav">
              <span class="mr-1">&laquo;</span>
              <?php previous_comments_link( esc_html__( 'Older Comments', 'wp-site' ) ) ?>
            </div>
          </div>

           <div class="col-12 col-sm-6 text-right">
            <div class="post-link-nav">
              <?php next_comments_link( esc_html__( 'Newer Comments', 'wp-site' ) ) ?>
              <span class="mr-1">&raquo;</span>
            </div>
          </div>

        </div>
      </nav>
    <?php endif; ?>

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

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
      <nav id="comment-nav-bottom" class="comment-navigation" role="navigation">
        <div class="row">

          <div class="col-12 col-sm-6">
            <div class="post-link-nav">
              <span class="mr-1">&laquo;</span>
              <?php previous_comments_link( esc_html__( 'Older Comments', 'wp-site' ) ) ?>
            </div>
          </div>

           <div class="col-12 col-sm-6 text-right">
            <div class="post-link-nav">
              <?php next_comments_link( esc_html__( 'Newer Comments', 'wp-site' ) ) ?>
              <span class="mr-1">&raquo;</span>
            </div>
          </div>

        </div>
      </nav>
    <?php endif; ?>

    <?php if ( !comments_open() && get_comments_number() ) : ?>
      <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'wp-site' ); ?></p>
    <?php endif; ?>

  <?php endif; ?>

  <?php comment_form(); ?>
</div><!-- .comments-area -->
