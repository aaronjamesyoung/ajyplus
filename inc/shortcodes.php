<?php
/**
 * Custom shortcodes and shortcode-related functions.
 *
 * @package ajy
 * 
 * TOC this file:
 * 1. Enable shortcodes in widgets.
 * 2. [gallery] - replacement for Wordpress gallery using Foundation Clearing
 * 3. [ajy-button] - turn a link into a button
 */

//enable shortcodes in widgets
if (!is_admin()) {
  add_filter('widget_text', 'do_shortcode', 11);
}

//redefine [gallery]
//using Foundation Clearing. This requires a different HTML syntax.
//remember to uncomment clearing script in enqueue, and write necessary javascript
//insert as normal gallery.
remove_shortcode('gallery');
add_shortcode('gallery', 'ajy_gallery_shortcode');
function ajy_gallery_shortcode($attr) {
  $post = get_post();

  static $instance = 0;
  $instance++;

  if ( ! empty( $attr['ids'] ) ) {
    // 'ids' is explicitly ordered, unless you specify otherwise.
    if ( empty( $attr['orderby'] ) )
      $attr['orderby'] = 'post__in';
    $attr['include'] = $attr['ids'];
  }

  // Allow plugins/themes to override the default gallery template.
  $output = apply_filters('post_gallery', '', $attr);
  if ( $output != '' )
    return $output;

  // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
  if ( isset( $attr['orderby'] ) ) {
    $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
    if ( !$attr['orderby'] )
      unset( $attr['orderby'] );
  }

  extract(shortcode_atts(array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'itemtag'    => 'li',
    'icontag'    => '',
    'captiontag' => 'p',
    'columns'    => 3,
    'size'       => 'thumbnail',
    'include'    => '',
    'exclude'    => ''
  ), $attr));

  $id = intval($id);
  if ( 'RAND' == $order )
    $orderby = 'none';

  if ( !empty($include) ) {
      $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

      $attachments = array();
      foreach ( $_attachments as $key => $val ) {
        $attachments[$val->ID] = $_attachments[$key];
      }
  } elseif ( !empty($exclude) ) {
    $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
  } else {
    $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
  }

  if ( empty($attachments) )
    return '';

  if ( is_feed() ) {
    $output = "\n";
    foreach ( $attachments as $att_id => $attachment )
      $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
    return $output;
  }

  $itemtag = tag_escape($itemtag);
  $captiontag = tag_escape($captiontag);
  $icontag = tag_escape($icontag);
  $valid_tags = wp_kses_allowed_html( 'post' );
  if ( ! isset( $valid_tags[ $itemtag ] ) )
    $itemtag = 'dl';
  if ( ! isset( $valid_tags[ $captiontag ] ) )
    $captiontag = 'dd';
  if ( ! isset( $valid_tags[ $icontag ] ) )
    $icontag = 'dt';

  $columns = intval($columns);
  $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
  $float = is_rtl() ? 'right' : 'left';

  $selector = "gallery-{$instance}";

  $gallery_style = $gallery_div = '';
  
  $size_class = sanitize_html_class( $size );
  $gallery_div = "<ul data-clearing id='$selector' class='clearing-thumbs gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
  $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

  $i = 0;
  foreach ( $attachments as $id => $attachment ) {
    //this part is mod aaron
    $thumblink = wp_get_attachment_image_src( $id, 'thumbnail', false );
    $biglink = wp_get_attachment_image_src( $id, 'large', false );
    
    //show a caption
    $captionlink = '';
    if(trim($attachment->post_excerpt)) {
      $captionlink = ' data-caption="'.wptexturize($attachment->post_excerpt).'"';
    }
    
    $link = '<a href="'.$biglink[0].'" class="ajy-thumb"><img'.$captionlink.' src="'.$thumblink[0].'" /></a>';
    $output .= "<{$itemtag} class='gallery-item'>";
    $output .="$link";
    $output .= "</{$itemtag}>";
  }

  $output .= "</ul>\n";

  return $output;
}

//[ajy-button link="http://google.com" text="Button Text"] - create buttons
add_shortcode('ajy-button', 'ajy_button');
function ajy_button($atts) {
  extract(shortcode_atts(array(
    'text' => '',
    'link' => '',
  ), $atts));
  $hrer = "<a href=\"".$link."\" class=\"button ajy-button\">".$text." <i class=\"icon-caret-right\"></i></a>";
  return $hrer;
}
