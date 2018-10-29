<?php

/* 
  =======================
     Shortcode Options 
  =======================
*/

/* Tooltip */

function sunset_tooltip( $atts, $content = null ) {
  // [tooltip placement="top" title="Some description here"]Hover for tooltip[/tooltip]

  $res = '';
  $dataArray = array(
    'placement' => 'top',
    'title'     => '',
  );

  extract( shortcode_atts( $dataArray, $atts, 'tooltip' ) );

  $title = $title ? $title : $content;

  $res .= '<span class="sunset-tooltip" data-toggle="tooltip" data-placement="' . $placement . '" title="' . $title . '">';
  $res .= $content;
  $res .= '</span>';

  return $res;
}

add_shortcode( 'tooltip', 'sunset_tooltip' );

/* Popover */

function sunset_popover( $atts, $betweenTags = null ) {
  // [popover placement="right" title="Popover title here" content="Content for popover"]Click for popover[/popover]

  $res = '';
  $dataArray = array(
    'placement' => 'top',
    'title'     => '',
    'trigger'   => 'click',
    'content'   => '',
  );

  extract( shortcode_atts( $dataArray, $atts, 'popover' ) );

  $res .= '<span class="sunset-popover" data-toggle="popover" data-placement="' . $placement . '" title="' . $title . '" data-trigger="' . $trigger . '" data-content="' . $content . '">';
  $res .= $betweenTags;
  $res .= '</span>';

  return $res;
}

add_shortcode( 'popover', 'sunset_popover' );

/* Contact Form */

function sunset_contact_form( $atts, $content = null ) {

  // [contact_form]

  shortcode_atts( array(), $atts, 'contact_form' );

  ob_start();
  include 'templates/contact-form.php';
  return ob_get_clean();
}

add_shortcode( 'contact_form', 'sunset_contact_form' );
