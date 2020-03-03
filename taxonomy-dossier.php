<?php get_header(); ?>

<div class="row intro">
	<div class="col">
		<div class="block">
			<h2><?php single_term_title( 'Dossier ' ); ?></h2>
			<?php $description = term_description(); ?>
			<p><?php echo $description; ?></p>
			<h3><?php single_term_title( 'Artikelen over ' ); ?></h3>
		</div>
	</div>
</div>

<div class="row">
	<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();

					echo '<div class="wide flex"><div class="thumbnail"><a href="' . get_the_permalink() . '">';
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post ->ID ), 'single' );
					echo '<img src="' . $image[0] . '" alt="">';
					echo '</a></div><div class="description"><a href="' . get_the_permalink() . '"><h3>' . get_the_title() . '</h3>';
					the_excerpt();
					echo '</a>';
					echo '<p><a href="' . get_the_permalink() . '" class="read-more">';
					$post_type = get_post_type( get_the_ID() );
					if ( $post_type == 'post' ) {
						echo 'lees artikel';
					} else if ( $post_type == 'project' ) {
						echo 'bekijk project';
					} else {
						echo 'lees meer';
					}
					echo '</a></p>';
					
					echo '</div></div>';

			endwhile;
		else :
			get_template_part( 'content', 'none' );
		endif;
	?>
</div>

<?php get_template_part( 'module-pagination', get_post_format() ); ?>

<?php get_footer();