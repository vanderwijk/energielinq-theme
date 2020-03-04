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
		<?php echo facetwp_display( 'facet', 'gemeente' ); ?>
		<?php echo facetwp_display( 'facet', 'renovatie_of_nieuwbouw' ); ?>
	</div>

	<div class="wide-column">
	<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); 
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post ->ID ), 'single' ); ?>
				
				<div class="result flex">
					<div class="search-thumbnail">
						<a href="<?php echo get_the_permalink(); ?>">
							<img src="<?php echo $image[0]; ?>" alt="">
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