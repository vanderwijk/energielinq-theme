<?php get_header(); ?>

<div class="row intro">
	<div class="col">
		<div class="block">
			<h2><?php _e('Projects','energielinq'); ?></h2>
		</div>
	</div>
</div>

<div class="row flex">

	<div class="narrow-column">
		<?php echo facetwp_display( 'facet', 'search' ); ?>
		<?php echo facetwp_display( 'facet', 'provincie' ); ?>
		<?php echo facetwp_display( 'facet', 'plaats' ); ?>
		<?php echo facetwp_display( 'facet', 'eigendom' ); ?>
		<?php echo facetwp_display( 'facet', 'bouw' ); ?>
		<?php echo facetwp_display( 'facet', 'bouwlagen' ); ?>
		<?php echo facetwp_display( 'facet', 'ambitieniveau' ); ?>
		<?php echo facetwp_display( 'facet', 'energiebron' ); ?>
		<?php echo facetwp_display( 'facet', 'epv' ); ?>
		<p>Aantal Woningen</p>
		<?php echo facetwp_display( 'facet', 'aantal_woningen' ); ?>
		<?php echo facetwp_display( 'facet', 'bouwjaar' ); ?>
		<?php echo facetwp_display( 'facet', 'corporatie' ); ?>
		<?php echo facetwp_display( 'facet', 'projectstatus' ); ?>

		<p class="reset"><a href="#" onclick="FWP.reset()">Reset</a></p>
	</div>

	<div class="wide-column">
	<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				if ( has_post_thumbnail() ) {
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post ->ID ), 'single' );
					$image = $image[0];
				} else {
					$image = '/wp-content/themes/energielinq-theme/img/link-project.svg';
				} ?>

				<div class="result flex">
					<div class="search-thumbnail">
						<a href="<?php echo get_the_permalink(); ?>">
							<img src="<?php echo $image; ?>" alt="<?php the_title_attribute(); ?>">
						</a>
					</div>
					<div class="search-description">
						<a href="<?php echo get_the_permalink(); ?>">
							<h3><?php echo get_the_title(); ?></h3>
							<?php the_excerpt(); ?>
						</a>
					</div>
				</div>

			<?php endwhile;
		else : ?>
			
		<div class="col">
			<div class="block">
				<h1 class="page-title"><?php _e( 'Not Found', 'fran' ); ?></h1>
				<div class="page-content">
					<p>Er kunnen geen projecten worden gevonden met deze zoekcriteria.</p>
				</div>
			</div>
		</div>

		<?php endif; ?>
	</div>
</div>

<?php get_template_part( 'module-pagination', get_post_format() ); ?>

<?php get_footer();