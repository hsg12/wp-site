<?php

/* 
  =======================
     Shortcode Options 
  =======================
*/

/* Tooltip */

function sunset_tooltip( $atts, $content = null ) {
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