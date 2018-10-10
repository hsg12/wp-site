<?php

/* 
  =======================
     Shortcode Options 
  =======================
*/

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
