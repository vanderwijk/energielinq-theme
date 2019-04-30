<?php
/**
* Template Name: Landingpage
*/
get_header(); ?>

<style>
header,
footer {
	display: none;
}
.page-template-page-landing article {
	background: rgb(255,255,255);
	background: -moz-linear-gradient(0deg, rgba(255,255,255,1) 0%, rgba(232,221,176,1) 100%);
	background: -webkit-linear-gradient(0deg, rgba(255,255,255,1) 0%, rgba(232,221,176,1) 100%);
	background: linear-gradient(0deg, rgba(255,255,255,1) 0%, rgba(232,221,176,1) 100%);
}
.page-template-page-landing a[rel=home] {
	flex: 1 100%;
	margin-bottom: 50px;
}
.page-template-page-landing section {
	color: #3e3e3e;
	margin: 0 auto;
	max-width: 1200px;
	padding: 50px 30px;
	width: 100%;
	display: flex;
	flex-flow: row wrap;
}
.page-template-page-landing .main {
	background-color: #fff;
}
.page-template-page-landing .logo {
	height: initial;
	width: initial;
	max-height: initial;
}
.page-template-page-landing .wp-post-image {
	width: 100%;
	height: auto;
}
.page-template-page-landing .copy {
	flex: 3;
	margin-right: 30px;
	order: 1;
}
.page-template-page-landing .hero {
	flex: 2;
	order: 2;
}
.page-template-page-landing h1 {
	color: #3e3e3e;
	font-size: 48px;
	text-transform: uppercase;
	margin: 0 0 32px 0;
}
.page-template-page-landing .wp-block-button__link {
	font-size: 24px;
	font-weight: 600;
	border-radius: 5px;
	border: 1px solid rgba(53, 82, 74, .2);
	padding: 18px 24px;
	margin: 32px 0 0 0;
}
@media screen and (max-width: 480px),
screen and (device-width: 360px) and (device-height: 640px) and (-webkit-device-pixel-ratio: 3) {
	.page-template-page-landing a[rel=home] {
		margin-bottom: 24px;
	}
	.page-template-page-landing section {
		padding: 30px;
	}
	.page-template-page-landing .logo {
		float: right;
		width: 100px;
	}
	.page-template-page-landing .copy {
		flex: 1 100%;
		margin-right: 0;
		order: 2;
	}
	.page-template-page-landing .hero {
		flex: 1 100%;
		order: 1;
	}
	.page-template-page-landing h1 {
		font-size: 24px;
		margin: 24px 0 32px 0;
	}
	.page-template-page-landing .wp-block-button__link {
		width: 100%;
	}
}
</style>

<article>
	<section>

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<?php $custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			if ( has_custom_logo() ) { ?>
				<img src="<?php echo esc_url( $logo[0] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="logo" />
			<?php } ?>
		</a>

		<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post();

		echo '<div class="hero">';

		the_post_thumbnail( 'large' );

		echo '</div>';

		echo '<div class="copy">';

		the_title( '<h1>', '</h1>' );

		the_content();

		echo '</div>';

		endwhile;
	
		else :
			get_template_part( 'content', 'none' );
		endif; ?>
	</section>

</article>

<?php get_footer();