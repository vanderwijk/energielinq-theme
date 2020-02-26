<?php get_header(); ?>

<div class="row intro">
	<div class="col">
		<div class="block">
			<h2>Projecten</h2>
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
				
				echo '<div class="result flex"><div class="search-thumbnail"><a href="' . get_the_permalink() . '">';
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post ->ID ), 'single' );
				echo '<img src="' . $image[0] . '" alt="">';
				echo '</a></div><div class="search-description"><a href="' . get_the_permalink() . '"><h3>' . get_the_title() . '</h3>';
				the_excerpt();
				echo '</a></div></div>';

			endwhile;
		else : ?>
			
			<div class="col">
				<div class="block">
					<h1 class="page-title"><?php _e( 'Not Found', 'fran' ); ?></h1>
					<div class="page-content">
						<p>Er kunnen geen projecten worden gevonden met deze zoekcriteria.</p>
					</div>
				</div>
			</div>

		<?php endif;
	?>
	</div>
</div>

<?php get_template_part( 'module-pagination', get_post_format() ); ?>

<?php get_footer();