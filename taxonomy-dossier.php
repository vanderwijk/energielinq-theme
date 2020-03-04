<?php get_header(); ?>

<div class="row intro">
	<div class="col">
		<div class="block">
			<h2><?php single_term_title(__('Dossier','energielinq') . ' ', 'energielinq'); ?></h2>
			<?php $description = term_description(); ?>
			<p><?php echo $description; ?></p>
			<h3><?php single_term_title(__('Articles about','energielinq') . ' ', 'energielinq'); ?></h3>
		</div>
	</div>
</div>

<div class="row">
	<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();

				$post_id = get_the_id();
				$post_meta = get_post_meta($post_id);
				$post_type = get_post_type($post_id);

				if ( $post_type == 'post' ) {
					$readmore = 'lees artikel';
				} else if ( $post_type == 'project' ) {
					$readmore = 'bekijk project';
				} else if ( $post_type == 'link' ) {
					$readmore = 'open link';
				} else {
					$readmore = 'lees meer';
				}

				if ( $post_type == 'link' ) {
					$link = $post_meta['url'][0];
					$link_rel = 'rel="external"';
				} else {
					$link = get_the_permalink();
					$link_rel = '';
				}

				$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post ->ID ), 'single' ); ?>

				<div class="wide flex">
					<div class="thumbnail">
						<a href="<?php echo $link; ?>" <?php echo $link_rel; ?>>
							<img src="<?php if ($featured_image[0]) { echo $featured_image[0]; } else { echo '/wp-content/themes/energielinq-theme/img/link-thumbnail.svg'; } ?>" alt="">
						</a>
					</div>
					<div class="description">
						<a href="<?php echo $link; ?>" <?php echo $link_rel; ?>>
							<h3><?php echo get_the_title(); ?></h3>
							<?php the_excerpt(); ?>
						</a>
						<a href="<?php echo $link; ?>" <?php echo $link_rel; ?> class="read-more"><?php echo $readmore; ?></a>
					</div>
				</div>

			<?php endwhile;
		else :
			get_template_part( 'content', 'none' );
		endif;
	?>
</div>

<?php get_template_part( 'module-pagination', get_post_format() ); ?>

<?php get_footer();