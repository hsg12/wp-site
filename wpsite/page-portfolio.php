<?php

$portfolio = [
  (object) [
      'title' => 'simplesite',
      'url'   => 'http://simplesite.96.lt/',
  ],
  (object) [
      'title' => 'jokeshop',
      'url'   => 'http://jokeshop.96.lt/',
  ],
  (object) [
      'title' => 'socnetwork',
      'url'   => 'http://socnetwork.96.lt/',
  ],
  (object) [
      'title' => 'minisite',
      'url'   => 'http://minisite.rf.gd/',
  ],
  (object) [
      'title' => 'university',
      'url'   => 'http://tutorial.rf.gd/',
  ],
  (object) [
      'title' => 'forum',
      'url'   => 'http://php-user.site/app',
  ],
  (object) [
      'title' => 'blog',
      'url'   => 'http://php-user.site/blog',
  ],
  (object) [
      'title' => 'arkada',
      'url'   => 'http://arkada.rf.gd/',
  ],
  (object) [
      'title' => 'recipes',
      'url'   => 'http://sample.rf.gd/',
  ],
  (object) [
      'title' => 'meetup',
      'url'   => 'https://meetup-project-78f3d.firebaseapp.com/',
  ],
  (object) [
      'title' => 'real-estate',
      'url'   => 'https://ads-project-f8454.firebaseapp.com/',
  ],
  (object) [
      'title' => 'laravel-shop',
      'url'   => 'http://php-user.site/shop',
  ],
];

?>

<?php get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
  
    <div class="container">
      <?php if ( have_posts() ) : ?>
        
          <?php while ( have_posts() ) : the_post(); ?>

            <?php
              $images = get_children( array (
                'post_parent' => $post->ID,
                'post_type' => 'attachment',
                'post_mime_type' => 'image'
              ));
            ?>

            <div class="row mt-5">
              <?php
                foreach ($portfolio as $item) :
                  foreach ( $images as $attachment_id => $attachment ) :
                    if (strpos($attachment->guid, $item->title) !== false) {
                      $imageUrl = $attachment->guid;
                    }
                  endforeach;
              ?>
                
              <div class="col-md-4 mb-5 text-center" data-toggle="tooltip" title="<?php echo $item->title; ?>" data-placement="bottom">
                <a href="<?php echo $item->url; ?>" target="_blank">
                  <img src="<?php echo $imageUrl; ?>" alt="site - <?php echo $item->title; ?>" width="300" class="img-fluid portfolio-img">
                </a>
              </div>
                
              <?php endforeach; ?>

            </div>
            
          <?php endwhile; ?>

      <?php endif; ?>
    </div><!-- .container -->

  </main>
</div><!-- #primary -->

<?php get_footer(); ?>
