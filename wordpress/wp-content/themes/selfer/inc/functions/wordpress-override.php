<?php
/*
* This template for override wordpress some function to match the theme
*/ 
 
if ( ! function_exists( 'selfer_custom_post_excerpt' ) ) :
// custom post excerpt with charecter
function selfer_custom_post_excerpt($string, $length, $dots = "&hellip;") {
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
}
endif;

if ( ! function_exists( 'selfer_custom_string_limit_words' ) ) :
// custom post excerpt with words
function selfer_custom_string_limit_words($string, $word_limit) {
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}
endif;

/**
 * Estimates the reading time for a given piece of $content.
 *
 * @param string $content Content to calculate read time for.
 * @param int $wpm Estimated words per minute of reader.
 *
 * @returns int $time Esimated reading time.
 */
if ( ! function_exists( 'selfer_estimated_reading_time' ) ) :
function selfer_estimated_reading_time( $content = '', $wpm = 300 ) {
  $clean_content = strip_shortcodes( $content );
  $clean_content = strip_tags( $clean_content );
  $word_count = str_word_count( $clean_content );
  $time = ceil( $word_count / $wpm );
  return $time;
}
endif;