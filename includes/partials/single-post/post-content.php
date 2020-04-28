<?php
/**
* Single Post Content
*
* @version 10.5
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $nectar_options;

$nectar_post_format            = get_post_format();
$hide_featrued_image           = ( ! empty( $nectar_options['blog_hide_featured_image'] ) ) ? $nectar_options['blog_hide_featured_image'] : '0';
$single_post_header_inherit_fi = ( ! empty( $nectar_options['blog_post_header_inherit_featured_image'] ) ) ? $nectar_options['blog_post_header_inherit_featured_image'] : '0';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <div class="inner-wrap">

		<div class="post-content" data-hide-featured-media="<?php echo esc_attr( $hide_featrued_image ); ?>">
      	
		<h1 class="entry-title"><?php the_title(); ?></h1>
			
			<?php 
								global $nectar_options;
								$theme_skin = (!empty($nectar_options['theme-skin'])) ? $nectar_options['theme-skin'] : 'default';
								
								if( ($post->post_type === 'post' && is_single()) ||
								($post->post_type === 'post' && is_single()) ) {
									
									$categories = get_the_category();
									if ( ! empty( $categories ) ) {
										$output = null;
										foreach( $categories as $category ) {
											$output .= '<a class="'. esc_attr($category->slug) .'" href="' . esc_url( get_category_link( $category->term_id ) ) . '" >' . esc_html( $category->name ) . '</a>';
										}
										echo trim( $output);
									}
								} ?>
								
			<?php if( ($post->post_type === 'post' && is_single()) ) { ?>
			<div class="author-section">
				<div class="avatar-post-info vcard author">
					<span class="fn"><?php the_author_posts_link(); ?></span>

					<?php 
																									$nectar_u_time 					= get_the_time('U'); 
																									$nectar_u_modified_time = get_the_modified_time('U'); 
																									if( $nectar_u_modified_time >= $nectar_u_time + 86400 ) { ?>
					<span class="meta-date date published"><i><?php echo get_the_date(); ?></i></span>
					<span class="meta-date date updated rich-snippet-hidden"><i><?php echo get_the_modified_time(__( 'F jS, Y' , 'salient' )); ?></i></span>
					<?php } else { ?>
					<span class="meta-date date updated"><i><?php echo get_the_date(); ?></i></span>
					<?php }	?>

				</div>
			</div>
			<?php } ?>
			
        <?php
        
        $gallery_attr = null;
                
        if( '1' !== $hide_featrued_image ) {
          
          // Featured Image.
          if( null === $nectar_post_format || false === $nectar_post_format || 'image' === $nectar_post_format) {
            if ( has_post_thumbnail() && '1' !== $single_post_header_inherit_fi ) {
              echo '<span class="post-featured-img">' . get_the_post_thumbnail( $post->ID, 'full', array( 'title' => '' ) ) . '</span>';
            }
          } 
          
          // Video.
          else if( 'video' === $nectar_post_format ) {
            get_template_part( 'includes/partials/blog/media/video-player' );
          }
          // Audio.
          else if( 'audio' === $nectar_post_format ) {
            get_template_part( 'includes/partials/blog/media/audio-player' );
          }
          
        }
        
        // Quote.
        if( 'quote' === $nectar_post_format ) {
          get_template_part( 'includes/partials/blog/media/quote' );
        }
        
        // Link.
        else if( 'link' === $nectar_post_format ) {
          get_template_part( 'includes/partials/blog/media/link' );
        }
        
        // Gallery.
        else if( 'gallery' === $nectar_post_format && '1' !== $hide_featrued_image ) {
          
          $enable_gallery_slider = get_post_meta( get_the_ID(), '_nectar_gallery_slider', true );
          if ( ! empty( $enable_gallery_slider ) && 'on' === $enable_gallery_slider ) {
            
            $gallery_script = 'flickity';
            $blog_type      = ( isset($nectar_options['blog_type']) ) ? $nectar_options['blog_type'] : '';
            
            // Blog Type/Style will determine what gallery script is used.
            if( strpos($blog_type, 'masonry') !== false ) {
              
              // Masonry style.
              $blog_masonry_style = ( ! empty( $nectar_options['blog_masonry_type'] ) ) ? $nectar_options['blog_masonry_type'] : 'classic';
              
              if( 'classic' === $blog_masonry_style ) {
                $gallery_script = 'flexslider'; 
              } 
              
            } else {
              // Standard style.
              $blog_standard_style = ( ! empty( $nectar_options['blog_standard_type'] ) ) ? $nectar_options['blog_standard_type'] : 'classic';
              
              if( 'classic' === $blog_standard_style ) {
                $gallery_script = 'flexslider'; 
              } 
            }
            
            if( 'flickity' === $gallery_script ) {
              echo '<div class="top-featured-media full-width-content wpb_row vc_row-fluid standard_section">';
              get_template_part( 'includes/partials/blog/media/gallery-flickity' );
              echo '</div>';
            } else {
              get_template_part( 'includes/partials/blog/media/gallery-flexslider' );
            }
            
            $gallery_attr = ' data-has-gallery';
          }
        }
          
        
        echo '<div class="content-inner"'. esc_html($gallery_attr).'>';
          
          // Post content.
          if( 'link' !== $nectar_post_format ) {
            the_content( '<span class="continue-reading">' . esc_html__( 'Read More', 'salient' ) . '</span>' );
          }
          
          // Tags.
          if ( '1' === $nectar_options['display_tags'] && has_tag() ) {
            echo '<div class="post-tags"><h4>' . esc_html__( 'Tags:', 'salient' ) . '</h4>';
            the_tags( '', '', '' );
            echo '<div class="clear"></div></div> ';
          }

        echo '</div>';
          

        
        ?>
        
      </div><!--/post-content-->
      
    </div><!--/inner-wrap-->
    
</article>