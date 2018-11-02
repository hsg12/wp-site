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

  /* Scroll functions */

  var lastScroll = 0;

  $(window).scroll( function(){
    var scroll = $(window).scrollTop();
    if (Math.abs(scroll - lastScroll) > $(window).height() * 0.1) { // 10% of window height
      lastScroll = scroll;

      $('.page-limit').each(function(index){
        if (isVisible( $(this) )) {
          window.history.replaceState(null, null, $(this).attr('data-page'));
          return false;
        }
      });
    }
  } );

  /* Helper functions */

  function revealPosts() {

    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();
    
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

  function isVisible(element) {
    var scrollPos = $(window).scrollTop();
    var windowHeight = $(window).height();
    var elementTop = $(element).offset().top;
    var elementHeight = $(element).height();
    var elementBottom = elementTop + elementHeight;

    return ( (elementBottom - elementHeight * 0.25 > scrollPos) && (elementTop < (scrollPos + 0.5 * windowHeight)) );
  }

  /* Ajax functions */

  $(document).on('click', '.sunset-load-more:not(.loading)', function() {
    
    var that = $(this);
    var page = that.data('page');
    var newPage = page + 1;
    var ajaxUrl = that.data('url');
    var prev = that.data('prev');
    var archive = that.data('archive');

    if (typeof prev === 'undefined') {
      prev = 0;
    }

    if (typeof archive === 'undefined') {
      archive = 0;
    }

    that.addClass('loading');
    that.find('.text').slideUp(320);
    that.find('.sunset-icon').addClass('spin');
    
    $.ajax({
      url: ajaxUrl,
      type: 'post',
      data: {
        page: page,
        archive: archive,
        prev: prev,
        action: 'sunset_load_more'
      },
      success: function(response) {

        if (response == 0) {

          $('.sunset-posts-container').append('<div class="text-center"><h3>You reached the end of the line!</h3><p>No more posts to load</p></div>');
          that.slideUp(320);

        } else {

          setTimeout(function(){
            if (prev == 1) {
              $('.sunset-posts-container').prepend(response);
              newPage = page - 1;
            } else {
              $('.sunset-posts-container').append(response);
            }

            if (newPage == 1) {
              that.slideUp(320);
            } else {
              that.data('page', newPage);
            
              that.removeClass('loading');
              that.find('.text').slideDown(320);
              that.find('.sunset-icon').removeClass('spin');
            }

            revealPosts();
          }, 1000);

        }
      }
    });
  })

  /* Sidebar functions */

  $(document).on('click', '.js-toggleSidebar', function() {
    $('.sunset-sidebar').toggleClass('sidebar-closed');
    $('body').toggleClass('no-scroll');
    $('.sidebar-overlay').fadeToggle(320);
    
    return false;
  });

  /* Contact form submission */

  function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
  }

  $('#sunsetContactForm').on('submit', function(e) {
    e.preventDefault();

    var form = $(this);
    var formError = false;
    form.find('.is-invalid').removeClass('is-invalid');
    $('.js-show-feedback').removeClass('js-show-feedback');

    var name = form.find('#name').val();
    var email = form.find('#email').val();
    var message = form.find('#message').val();

    var ajaxUrl = form.data('url');

    if (name === '') {
      form.find('#name').addClass('is-invalid');
      formError = true;
    }

    if (email === '' || !validateEmail(email)) {
      form.find('#email').addClass('is-invalid');
      formError = true;
    }

    if (message === '') {
      form.find('#message').addClass('is-invalid');
      formError = true;
    }

    if (formError) {
      return;
    }

    form.find('input, textarea, button').attr('disabled', 'disabled');
    $('.js-form-submission').addClass('js-show-feedback');

    $.ajax({
      url: ajaxUrl,
      type: 'post',
      data: {
        name: name,
        email: email,
        message: message,
        action: 'sunset_save_user_contact_form'
      },
      error: function(response) {
        $('.js-form-submission').removeClass('js-show-feedback');
        $('.js-form-error').addClass('js-show-feedback');
        form.find('input, textarea, button').removeAttr('disabled');
      },
      success: function(response) {

        if (response == 0) {

          setTimeout(function(){
            $('.js-form-submission').removeClass('js-show-feedback');
            $('.js-form-error').addClass('js-show-feedback');
            form.find('input, textarea, button').removeAttr('disabled');
          }, 2000);
          
        } else {

          setTimeout(function(){
            $('.js-form-submission').removeClass('js-show-feedback');
            $('.js-form-success').addClass('js-show-feedback');
            form.find('input, textarea, button').removeAttr('disabled').val('');
          }, 2000);

        }
      }
    });
  });

});
