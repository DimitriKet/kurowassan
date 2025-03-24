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

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="preloader">
	<div class="loader"></div>
</div>
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
					<div class="header-icons d-lg-none">
						<button class="mobile-menu-toggle" type="button" data-bs-toggle="collapse" data-bs-target=".menu__list" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
							<i class="fas fa-bars"></i>
						</button>
						<a href="<?php echo wc_get_cart_url(); ?>">
							<i class="fas fa-shopping-cart"></i>
							<?php if(WC()->cart->get_cart_contents_count() > 0): ?>
								<span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
							<?php endif; ?>
						</a>
					</div>
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
					<div class="cart-icon-wrapper">
						<a href="<?php echo wc_get_cart_url(); ?>" class="cart-icon">
							<i class="fas fa-shopping-cart"></i>
							<span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
						</a>
						<?php get_template_part('template-parts/header/mini-cart'); ?>
					</div>
				</div>
			</div>
		</div>
	</header>

	<?php if (!is_front_page()): ?>
		<?php kurowassan_breadcrumb(); ?>
	<?php endif; ?>
