<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js">
<head>
	
		<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-P76PJBK');</script>
	<!-- End Google Tag Manager -->
	<!-- Hotjar Tracking Code for https://weknowtraining.ca -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1772266,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	
	<link rel="icon" href="https://weknowtraining.ca/favicon.png" sizes="16x16 32x32" type="image/png">
	<link rel="stylesheet" href="https://weknowtraining.ca/wp-content/themes/salient/css/fonts/gotham/stylesheet.css" />
	<link rel="stylesheet" href="https://weknowtraining.ca/wp-content/themes/salient/css/fonts/rogthem/stylesheet.css" />
	
	<?php
	
	$nectar_options = get_nectar_theme_options();
	
	if ( ! empty( $nectar_options['responsive'] ) && '1' === $nectar_options['responsive'] ) { 
		echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />';
	} else { 
		echo '<meta name="viewport" content="width=1200" />';
	} 
	
	// Shortcut icon fallback.
	if ( ! empty( $nectar_options['favicon'] ) && ! empty( $nectar_options['favicon']['url'] ) ) {
		echo '<link rel="shortcut icon" href="'. esc_url( nectar_options_img( $nectar_options['favicon'] ) ) .'" />';
	}
	
	wp_head();
	
	?>
	
</head>

<?php

$nectar_header_options = nectar_get_header_variables();

?>

<body <?php body_class(); ?> <?php nectar_body_attributes(); ?>>
	
		<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P76PJBK"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	
	<?php
	
	nectar_hook_after_body_open();
	
	nectar_hook_before_header_nav();
	
	// Boxed theme option opening div.
	if ( $nectar_header_options['n_boxed_style'] ) {
		echo '<div id="boxed">';
	}
	
	get_template_part( 'includes/partials/header/header-space' );
	
	?>
	
	<div id="header-outer" <?php nectar_header_nav_attributes(); ?>>
		
		<?php
		
		get_template_part( 'includes/partials/header/secondary-navigation' );
		
		if ('ascend' !== $nectar_header_options['theme_skin'] && 
			'left-header' !== $nectar_header_options['header_format']) {
			get_template_part( 'includes/header-search' );
		}
		
		get_template_part( 'includes/partials/header/header-menu' );
		
		
		?>
		
	</div>
	
	<?php
	
	if ( ! empty( $nectar_options['enable-cart'] ) && '1' === $nectar_options['enable-cart'] ) {
		get_template_part( 'includes/partials/header/woo-slide-in-cart' );
	}
	
	if ( 'ascend' === $nectar_header_options['theme_skin'] || 
		'left-header' === $nectar_header_options['header_format'] && 
		'false' !== $nectar_header_options['header_search'] ) {
		get_template_part( 'includes/header-search' ); 
	}
	
	?>
	
	<div id="ajax-content-wrap">
		
		<?php
		
		nectar_hook_after_outer_wrap_open();
