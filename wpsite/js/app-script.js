jQuery(function($){

  // If navbar links have nested links
  $('.navbar-sunset ul li a').addClass('link-after');
  $('.navbar-sunset ul li.dropdown a').removeClass('link-after').addClass('link-before');
  $('.dropdown-menu a').removeClass('link-before');

  // For slider thumbnails
  var carousel = '.sunset-carousel-thumb';
  sunset_get_thumbs(carousel);

  $(carousel).on('slid.bs.carousel', function() {
    sunset_get_thumbs(carousel);
  })

  function sunset_get_thumbs(carousel) {
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



});