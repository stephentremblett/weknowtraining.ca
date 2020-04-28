<?php
/**
 * The template for displaying single posts.
 *
 * @package Salient WordPress Theme
 * @version 10.5
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$nectar_options    = get_nectar_theme_options();
$fullscreen_header = ( ! empty( $nectar_options['blog_header_type'] ) && 'fullscreen' === $nectar_options['blog_header_type'] && is_singular( 'post' ) ) ? true : false;
$blog_header_type  = ( ! empty( $nectar_options['blog_header_type'] ) ) ? $nectar_options['blog_header_type'] : 'default';
$theme_skin        = ( ! empty( $nectar_options['theme-skin'] ) ) ? $nectar_options['theme-skin'] : 'original';
$header_format     = ( ! empty( $nectar_options['header_format'] ) ) ? $nectar_options['header_format'] : 'default';
if ( 'centered-menu-bottom-bar' === $header_format ) {
	$theme_skin = 'material';
}

$hide_sidebar                      = ( ! empty( $nectar_options['blog_hide_sidebar'] ) ) ? $nectar_options['blog_hide_sidebar'] : '0';
$blog_type                         = $nectar_options['blog_type'];
$blog_social_style                 = ( get_option( 'salient_social_button_style' ) ) ? get_option( 'salient_social_button_style' ) : 'fixed';
$enable_ss                         = ( ! empty( $nectar_options['blog_enable_ss'] ) ) ? $nectar_options['blog_enable_ss'] : 'false';
$remove_single_post_date           = ( ! empty( $nectar_options['blog_remove_single_date'] ) ) ? $nectar_options['blog_remove_single_date'] : '0';
$remove_single_post_author         = ( ! empty( $nectar_options['blog_remove_single_author'] ) ) ? $nectar_options['blog_remove_single_author'] : '0';
$remove_single_post_comment_number = ( ! empty( $nectar_options['blog_remove_single_comment_number'] ) ) ? $nectar_options['blog_remove_single_comment_number'] : '0';
$remove_single_post_nectar_love    = ( ! empty( $nectar_options['blog_remove_single_nectar_love'] ) ) ? $nectar_options['blog_remove_single_nectar_love'] : '0';
$container_wrap_class              = ( true === $fullscreen_header ) ? 'container-wrap fullscreen-blog-header' : 'container-wrap';

// Post header.
if ( have_posts() ) :
	while ( have_posts() ) :
		
		the_post();

endwhile;
endif;


// Post header fullscreen style when no image is supplied.
if ( true === $fullscreen_header ) {
	get_template_part( 'includes/partials/single-post/post-header-no-img-fullscreen' );
} ?>


<div class="<?php echo esc_attr( $container_wrap_class ); if ( $blog_type === 'std-blog-fullwidth' || $hide_sidebar === '1' ) { echo ' no-sidebar'; } ?>" data-midnight="dark" data-remove-post-date="<?php echo esc_attr( $remove_single_post_date ); ?>" data-remove-post-author="<?php echo esc_attr( $remove_single_post_author ); ?>" data-remove-post-comment-number="<?php echo esc_attr( $remove_single_post_comment_number ); ?>">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
			<div class="single-post-feat-img" style="background-image: url('<?php echo $backgroundImg[0]; ?>');"></div>  
	<div class="container main-content">

		<div class="col span_12 dark left">
			<div class="vc_column-inner">
				<div class="wpb_wrapper">
					<div class="wpb_row vc_row-fluid vc_row inner_row standard_section">
						<div class="col span_12 dark left">
							<div class="vc_col-sm-2 wpb_column column_container vc_column_container col">

								<?php if ( 'post' === get_post_type() ) { ?>
									<div class="meta-section">
										<ul>
											<li class="meta-date">
												<?php echo get_the_date(); ?>
											</li>
											<li class="meta-author">
												<span class="meta-author"><?php echo esc_html__( 'By', 'salient' ); ?> <?php the_author_posts_link(); ?></span>
											</li>
											<li class="meta-category">
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
											</li>
										</ul>
									</div>
								<?php } ?>

							</div>
							<div class="vc_col-sm-8 wpb_column column_container vc_column_container col">
								<h1 class="entry-title"><?php the_title(); ?></h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col span_12 dark left">
			<div class="vc_column-inner">
				<div class="wpb_wrapper">
					<div class="wpb_row vc_row-fluid vc_row inner_row standard_section">
						<div class="col span_12 dark left">
							<div class="vc_col-sm-2 wpb_column column_container vc_column_container col">
								<?php
									
								?>
							</div>
							<div class="vc_col-sm-8 wpb_column column_container vc_column_container col">
								<div class="blog-content">
									<?php
				
									nectar_hook_before_content(); 
									
									if ( have_posts() ) :
										while ( have_posts() ) :
											
											the_post();
											the_content();
												
										endwhile;
									endif;
									
									nectar_hook_after_content();
									
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">

			<?php 
				
				// Pagination/Related Posts.
				nectar_next_post_display();
				nectar_related_post_display();
				
				// Ascend Theme Skin Author Bio.
				if ( ! empty( $nectar_options['author_bio'] ) && 
					'1' === $nectar_options['author_bio'] && 
					'ascend' === $theme_skin && 
					'post' == get_post_type() ) {
					get_template_part( 'includes/partials/single-post/author-bio-ascend-skin' );
				}
			
			?>

		</div>

	</div><!--/container-->

</div><!--/container-wrap-->

<?php if ( 'fixed' === $blog_social_style ) {
	  // Social sharing buttons.
		if( function_exists('nectar_social_sharing_output') ) {
			nectar_social_sharing_output('fixed');
		}
}

get_footer(); ?>