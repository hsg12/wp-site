jQuery(function($){

  sunset_get_thumbs() // See function declaration on line 31 (here we invoke it)
  revealPosts(); // See function declaration on line 42 (here we invoke it)
 
  // If navbar links have nested links
  $('.navbar-sunset ul li a').addClass('link-after');
  $('.navbar-sunset ul li.dropdown a').removeClass('link-after').addClass('link-before');
  $('.dropdown-menu a').removeClass('link-before');

  // For slider thumbnails
  function sunset_get_bs_thumbs(carousel) {
    $(carousel).each(function() {

      var nextThumb = $(this).find('.carousel-item.active').find('.next-image-preview').data('image');
      $(this).find('.carousel-control.right').find('.thumbnail-container').css({
        'background-image': 'url(' + nextThumb + ')',
        'transition': 'background-image, 100ms'
      });

      var prevThumb = $(this).find('.carousel-item.active').find('.prev-image-preview').data('image');
      $(this).find('.carousel-control.left').find('.thumbnail-container').css({
        'background-image': 'url(' + prevThumb + ')',
        'transition': 'background-image, 100ms'
      });

    });
  }

  // This wrap function inforce to work carousel
  function sunset_get_thumbs(){
    var carousel = '.sunset-carousel-thumb';
    sunset_get_bs_thumbs(carousel);

    $(carousel).on('slid.bs.carousel', function(){
      sunset_get_bs_thumbs(carousel);
    });
  }

  /* Helper functions */

  function revealPosts() {
    var posts = $('article:not(.reveal)');
    var i = 0;
    var postsLength = posts.length;

    setInterval(function(){
      if (i >= postsLength) return false;

      var el = posts[i];
      $(el).addClass('reveal');
      $(el).find('.sunset-carousel-thumb').carousel();
      sunset_get_thumbs();

      i++;
    }, 200);
  }

  /* Ajax functions */

  $(document).on('click', '.sunset-load-more:not(.loading)', function() {
    
    var that = $(this);
    var page = that.data('page');
    var newPage = page + 1;
    var ajaxUrl = that.data('url');

    that.addClass('loading');
    that.find('.text').slideUp(320);
    that.find('.sunset-icon').addClass('spin');
    
    $.ajax({
      url: ajaxUrl,
      type: 'post',
      data: {
        page: page,
        action: 'sunset_load_more'
      },
      success: function(response) {
  
        setTimeout(function(){
          that.data('page', newPage);
          $('.sunset-posts-container').append(response);

          that.removeClass('loading');
          that.find('.text').slideDown(320);
          that.find('.sunset-icon').removeClass('spin');

          revealPosts();
        }, 1000);

      }
    });
  })

});

