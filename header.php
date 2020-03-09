<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<!--
	╭──────────────────────────────────────────╮
	│ ≡ The Fran theme is developed by         │
	╞══════════════════════════════════════════╡
	│ Johan van der Wijk - The Web Works       │
	├──────────────────────────────────────────┤
	│  https://thewebworks.nl                  │
	╰──────────────────────────────────────────╯
-->
<meta charset='<?php bloginfo( 'charset' ); ?>' />
<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0' />
<meta name='application-name' content='<?php bloginfo('name'); ?>' />
<meta name='apple-mobile-web-app-title' content='<?php bloginfo('name'); ?>' />
<meta name='theme-color' content='<?php echo get_theme_mod('primary_color'); ?>' />
<link rel='profile' href='http://gmpg.org/xfn/11' />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header class="header" id="header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
		<div class="wrap">
			<div class="branding" id="branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php $custom_logo_id = get_theme_mod( 'custom_logo' );
					$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
					if ( has_custom_logo() ) { ?>
						<img src="<?php echo esc_url( $logo[0] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="logo" />
					<?php } else if ( is_singular() ) { ?>
						<h2 class="site-title"><?php bloginfo( 'name' ); ?></h2>
					<?php } else { ?>
						<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
					<?php } ?>
				</a>
			</div>
			<div class="navigation">
				<button class="menu-toggle" id="menu-toggle"><?php _e( 'Menu', 'fran' ); ?></button>
				<nav class="nav" id="nav" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
					<?php wp_nav_menu( array( 'theme_location' => 'header', 'container' => false ) ); ?>
				</nav>
				<form class="searchform" id="searchform" method="get" action="<?php echo home_url(); ?>/">
				<div class="searchwrap">
					<input type="text" placeholder="<?php _e('Search', 'fran'); ?>" name="s" />
					<input type="submit" value="&#xf179;" />
					</div>
			</form>
		</div>
	</header>
	<div class="main" id="main" role="main">