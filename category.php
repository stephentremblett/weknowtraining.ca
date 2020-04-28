<?php
/*template name: Category */
get_header();

$nectar_options = get_nectar_theme_options();

?>
	
<div class="container main-content">

    <div id="page-intro">
        <p><a href="http://phpstack-392486-1235152.cloudwaysapps.com//blog/">Blog</a></p>
        <h1><?php single_cat_title(); ?></h1>
    </div>
	
	<div class="row">

		<div class="blog-grid">
        <?php
 
 // The Loop
 while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'blog-item' ); ?>>
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"></a>
					<!-- grid item content -->
					<div class="blog-item-content">
						<span class="blog-item-category">
							<?php
							$postcat = get_the_category( $post->ID );
							foreach ($postcat as $cat) {
								if ($cat->parent != 0) {
									echo $cat->name;
								}
							}
							?>
						</span>
						<h3><?php the_title(); ?></h3>
					</div>
					<!-- grid item feature image -->
					<?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
					<div class="post-feat-img" style="background-image: url('<?php echo $backgroundImg[0]; ?>');"></div>  
				</article>
                        <?php endwhile; ?>
		</div><!--/blog-grid-->

	</div><!--/row-->

</div><!--/container-->

<?php get_footer(); ?>
<script type="text/javascript">
	jQuery(document).ready(function($) {

		$('.blog-item.category-podcast .blog-item-content').append('<span class="arr">→</span>');
		$('.blog-item.category-podcast').prepend('<div class="wktshow-logo"><img src="http://localhost:8888/weknowtraining.ca/wp-content/uploads/2020/03/logo-wktShow.svg"/></div>')
		
		var bigbrother = -1;

		$('.blog-item-content').each(function() {
		bigbrother = bigbrother > $('.blog-item-content').height() ? bigbrother : $('.blog-item-content').height();
		});

		$('.blog-item-content').each(function() {
		$('.blog-item-content').height(bigbrother);
		});

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