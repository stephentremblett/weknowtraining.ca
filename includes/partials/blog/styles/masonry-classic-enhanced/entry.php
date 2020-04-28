<?php
/**
 * Default Post Format Template 
 *
 * Used when "Classic Enhanced" masonry style is selected.
 *
 * @version 11.0
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;
global $nectar_options;

$masonry_size_pm             = get_post_meta( $post->ID, '_post_item_masonry_sizing', true );
$masonry_item_sizing         = ( ! empty( $masonry_size_pm ) ) ? $masonry_size_pm : 'regular';
$nectar_post_class_additions = $masonry_item_sizing . ' masonry-blog-item';
$excerpt_length              = ( ! empty( $nectar_options['blog_excerpt_length'] ) ) ? intval( $nectar_options['blog_excerpt_length'] ) : 15;

?>

<article <?php post_class( 'blog-item' ); ?>>
  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"></a>
  <!-- grid item content -->
  <div class="blog-item-content">
    <span class="blog-item-category">
        <?php $parentscategory ="";
        foreach((get_the_category()) as $category) {
        if ($category->category_parent == 0) {
        $parentscategory .= ' <span>' . $category->name . '</span>, ';
        }
        }
        echo substr($parentscategory,0,-2); ?>
    </span>
    <h3><?php the_title(); ?></h3>
  </div>
  <!-- grid item feature image -->
  <?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
  <div class="post-feat-img" style="background-image: url('<?php echo $backgroundImg[0]; ?>');"></div>  
</article>