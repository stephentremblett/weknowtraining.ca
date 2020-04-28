<?php
/*template name: Blog */
get_header();

$nectar_options = get_nectar_theme_options();

?>
	
<div class="container main-content">
	
	<div class="row">

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				
				the_post();
				the_content(); 

		endwhile;
		endif;
		?>

		<div class="blog-filter">
			<span>View categories:</span>
			<ul>
				<?php wp_list_categories( array(
					'orderby'    => 'name',
					'depth'	     => '1',
					'title_li'   => 0,
					'hide_empty' => 1,
					'exclude'    => '1',
					'show_count' => 1,
				) ); ?> 
			</ul>
		</div>

		<div class="blog-grid">
			<?php
				$args = array( 'numberposts' => 25 );
				$postslist = get_posts( $args );
				foreach ($postslist as $post) :  setup_postdata($post); ?>
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
			<?php endforeach; ?>
		</div><!--/blog-grid-->

	</div><!--/row-->

</div><!--/container-->

<?php get_footer(); ?>
<script type="text/javascript">
	jQuery(document).ready(function($) {

		$('.blog-filter-section').find('a + span').each(function () {
		$(this)
			.prev()
			.andSelf()
			.wrapAll('<div class="blog-filter-cat"></div>')
			.attr('class', '');
		});

		$('.blog-filter').find('.blog-filter-title').click(function(){

			var self = $(this);

			//Expand or collapse this panel
			self.next().slideToggle('fast');

			//Remove class for all element, except the current selected item
			$('.blog-filter-title').not(self).removeClass('open');

			//Toggle active class for the current element
			self.toggleClass('open');

			//Hide the other panels
			$(".blog-filter-categories").not(self.next()).slideUp('fast');

		});

	});
</script>