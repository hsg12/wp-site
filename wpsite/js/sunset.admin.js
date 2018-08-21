jQuery(function($){

  var mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose a Profile Picture',
      button: {text: 'Choose Picture'},
      multiple: false
    });

  $('#upload-button').on('click', function(e){
    e.preventDefault();
    mediaUploader.open();
  });

  mediaUploader.on('select', function(){
    attachment = mediaUploader.state().get('selection').first().toJSON();
    $('#profile-picture').val(attachment.url);
    $('#profile-picture-preview').css('backgroundImage', 'url(' + attachment.url + ')');
  })

})
