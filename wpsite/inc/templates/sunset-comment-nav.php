<nav class="comment-navigation my-4" role="navigation"> 
  <div class="row">

    <div class="col-12 col-sm-6">
      <div class="post-link-nav">
        <?php previous_comments_link( '<span class="mr-1">&laquo;</span>' . esc_html__( 'Older Comments', 'wp-site' ) ) ?>
      </div>
    </div>

     <div class="col-12 col-sm-6">
      <div class="post-link-nav justify-content-end">
        <?php next_comments_link( esc_html__( 'Newer Comments', 'wp-site' ) . '<span class="ml-1">&raquo;</span>' ) ?>
      </div>
    </div>

  </div>
</nav>
