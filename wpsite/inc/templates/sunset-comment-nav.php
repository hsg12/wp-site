<nav class="comment-navigation" role="navigation"> 
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
