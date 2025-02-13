<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kurowassan
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Google Web Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Outfit:wght@100..900&family=Pacifico&display=swap" rel="stylesheet">

	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header id="header">
		<div class="container">
			<div class="row header-inner">
				
				<div class="col-lg-3">
					<div class="site-icon">
						<a href="<?php echo home_url(); ?>">
							<?php if(has_site_icon()): ?>
								<img src="<?php echo esc_url(get_site_icon_url(32)); ?>" alt="<?php bloginfo('name'); ?>">
							<?php endif; ?>
							<?php echo bloginfo('name'); ?>
						</a>
					</div>
				</div>

				<div class="col-lg-7">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'primary-menu',
						'container' => 'nav',
						'container_class'  => 'menu navbar navbar-expand-lg',
						'menu_class'    => 'menu__list collapse navbar-collapse',
						'link_class'        => 'menu__link',
						'list_item_class'   => 'menu__item',
						'fallback_cb' => false
					));
					?>
				</div>

				<div class="col-lg-2">
					<div class="shopping-cart">
						<a href="<?php echo wc_get_cart_url(); ?>" class="cart-icon">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M6 6H21L20 14H7L6 6Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								<circle cx="9" cy="20" r="1" fill="currentColor"/>
								<circle cx="17" cy="20" r="1" fill="currentColor"/>
							</svg>
							<span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
						</a>
					</div>
				</div>

				 
			</div>
		</div>
	</header>
