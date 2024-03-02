<?php
/*
Plugin Name: SEO Auto Meta Tags Plugin
Description: Automatically generates meta tags for SEO and social sharing
Version: .09.1
Author: contrastruction
*/

function seo_meta_tags() {

  global $post;

  // Default title if none is set
  if ( !$post->post_title ) {
    $title = get_bloginfo('name');
  } else {
    $title = $post->post_title;
  }

  // Generate description from post content if none is set
  if ( !$post->post_excerpt ) {
    $description = wp_trim_words( strip_tags( $post->post_content ), 55, '...' );
  } else {
    $description = $post->post_excerpt;
  }

  // Get the featured image URL
  if ( has_post_thumbnail($post->ID) ) {
    $image_id = get_post_thumbnail_id( $post->ID );
    $image = wp_get_attachment_image_src( $image_id, 'full' )[0];
  } else {
    // Use a default image if no featured image is set
    $image = 'https://www.contrastruction.com/artgallery/wp-content/uploads/contra_icon-150x150-1.jpg';
  }

  // Default Twitter username
  $twitter_username = 'contrastruction';

  // Current date
  $current_date = get_the_date('c');

?>

<meta name="description" content="<?php echo $description; ?>">

<meta property="og:title" content="<?php echo $title; ?>">
<meta property="og:description" content="<?php echo $description; ?>">
<meta property="og:image" content="<?php echo $image; ?>">
<meta property="og:type" content="article">
<meta property="og:url" content="<?php echo get_permalink(); ?>">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo $title; ?>">
<meta name="twitter:description" content="<?php echo $description; ?>">
<meta name="twitter:image" content="<?php echo $image; ?>">
<meta name="twitter:creator" content="<?php echo $twitter_username; ?>">

<meta itemprop="name" content="<?php echo $title; ?>">
<meta itemprop="description" content="<?php echo $description; ?>">
<meta itemprop="image" content="<?php echo $image; ?>">

<meta property="article:published_time" content="<?php echo $current_date; ?>">
<meta property="article:modified_time" content="<?php echo $current_date; ?>">

<?php
}

add_action('wp_head', 'seo_meta_tags')
?>
