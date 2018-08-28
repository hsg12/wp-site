// ace code editor from https://github.com/ajaxorg/ace-builds ( src-min folder )

var editor = ace.edit("customCss");
editor.setTheme("ace/theme/monokai");
editor.session.setMode("ace/mode/css");

jQuery(function($){

  var updateCSS = function() {
     $('#sunset_css').val( editor.session.getValue() );
  }

  $('#save-custom-css-form').on('submit', updateCSS);

});
