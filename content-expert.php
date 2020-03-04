<?php if ( is_archive() || is_home() || is_search() ) { // Archive ?>

	<div class="col one-third">
		<div <?php post_class( 'block' ); ?>>

			<?php if ( has_post_thumbnail ( $post ->ID ) ) { ?>
				<div class="thumbnail">
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post ->ID ), 'single' ); ?>
						<img src="<?php echo $image[0]; ?>" alt="<?php the_title_attribute(); ?>" />
					</a>
				</div>
			<?php }; ?>

			<div class="entry-meta">
				<span class="date updated"><?php the_modified_date( get_option( 'date_format' ) ); ?></span>
				<span class="vcard author">
					<?php _e( 'by', 'fran' ); ?>
					<span class="fn"><?php the_author(); ?></span>
				</span>
			</div>

			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h2>

			<div class="entry-content">
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php the_excerpt(); ?>
				</a>
			</div>

			<?php if ( !is_tax() && !is_category() ) { // Archive ?>
				<div class="entry-footer">
					<?php get_template_part( 'module-categories', get_post_format() ); ?>
				</div>
			<?php } ?>

		</div>
	</div>

<?php } else { // Single ?>

			<div class="col">
				<div <?php post_class( 'block' ); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-meta">
						<span class="date updated"><?php the_time( get_option( 'date_format' ) ); ?></span>
						<span class="vcard author">
							<?php _e( 'by', 'fran' ); ?>
							<span class="fn"><?php the_author(); ?></span>
						</span>
					</div>

					<div class="entry-content clearfix">

						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail();
						} ?>

						<?php the_content(); ?>

						<?php 
						$linkedin = get_field( 'linkedin' );
						$email = get_field( 'email' );
						if ( $email || $linkedin ) {
							echo '<ul class="expert-info">';
							if ( $linkedin ) {
								echo '<li class="linkedin"><a href="' . $linkedin . '" target="_blank">' . $linkedin . '</a></li>';
							}
							if ( $email ) {
								echo '<li class="envelope"><a href="mailto:' . $email . '">' . $email . '</a></li>';
							}
							echo '</ul>';
						} ?>

						<?php get_template_part( 'module-page-links', get_post_format() ); ?>

					</div>

					<div class="entry-footer clearfix">
<?php // get_template_part( 'module-categories', get_post_format() ); ?>
<?php // get_template_part( 'module-sharing', get_post_format() ); ?>
					</div>

				</div>
			</div>

			<?php 
			$related_posts = get_posts( array(
						'post_type' => 'post',
						'posts_per_page' => -1,
						'meta_query' => array(
							array(
								'key' => 'expert',
								'value' => $post ->ID,
								'compare' => 'LIKE'
							)
					) ) );
					if ( $related_posts ) { ?>

			<div class="col">
				<div class="block related">
					<h3>Gerelateerde artikelen</h3>
					<ul>
						<?php
							foreach ( $related_posts as $related_post ) { ?>
								<li><a href="<?php echo get_permalink( $related_post->ID ); ?>"><?php echo $related_post->post_title; ?></a></li>
							<?php
							}
						?>
					</ul>
				</div>
			</div>

			<?php wp_reset_postdata();
			} ?>

<?php } ?>