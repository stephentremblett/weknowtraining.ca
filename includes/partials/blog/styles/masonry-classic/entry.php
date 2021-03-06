<?php
/**
* Default Post Format Template 
*
* Used when "Classic" masonry style is selected.
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
$use_excerpt                 = ( ! empty( $nectar_options['blog_auto_excerpt'] ) && $nectar_options['blog_auto_excerpt'] === '1' ) ? 'true' : 'false';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $nectar_post_class_additions ); ?>>  
  
  <span class="bottom-line"></span>
  
  <div class="inner-wrap animated">
    
    <div class="post-content classic">
      
      <div class="content-inner">
        
        <div class="article-content-wrap">
          
          <div class="post-header">
            
            <?php get_template_part( 'includes/partials/blog/styles/masonry-classic/post-meta-header' );  ?>
            
            <h3 class="title"><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h3>
            
          </div><!--/post-header-->
          
        </div><!--article-content-wrap-->
        
        <?php
        // Featured image.
        get_template_part( 'includes/partials/blog/styles/masonry-classic/post-image' );
        ?>
        
      </div><!--/content-inner-->
      
      <?php get_template_part( 'includes/partials/blog/styles/masonry-classic/post-meta-bottom' ); ?>
      
    </div><!--/post-content-->
    
  </div><!--/inner-wrap-->
  
</article>