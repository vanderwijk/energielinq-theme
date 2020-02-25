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

			<?php $project_id = get_the_id();
			$project_meta = get_post_meta( $project_id ); ?>

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

						<div class="flex">

							<div class="projectbeschrijving">
								<?php the_content(); ?>
							</div>

							<div class="projectdata">
								<table>
									<tr>
										<td>Gemeente</td><td><?php echo $project_meta['gemeente'][0]; ?></td>
									</tr>

									<?php if ($project_meta['aantal_woningen'][0]) { ?>
									<tr>
										<td>Aantal woningen</td><td><?php echo $project_meta['aantal_woningen'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['renovatie_of_nieuwbouw'][0]) { ?>
									<tr>
										<td>Projecttype</td><td><?php echo $project_meta['renovatie_of_nieuwbouw'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['bouwer'][0]) { ?>
									<tr>
										<td>Bouwer</td><td><?php echo $project_meta['bouwer'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['corporatie'][0]) { ?>
									<tr>
										<td>Corporatie</td><td><?php echo $project_meta['corporatie'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['toeleverancier'][0]) { ?>
									<tr>
										<td>Toeleverancier</td><td><?php echo $project_meta['toeleverancier'][0]; ?></td>
									</tr>
									<?php } ?>
								</table>
							</div>

						</div>

						<?php if ($project_meta['overige_opmerkingen']) { ?>
							<?php echo wpautop($project_meta['overige_opmerkingen'][0]); ?>
						<?php } ?>

						<?php if ($project_meta['links']) {
							$links = $project_meta['links']; ?>
							<h2><?php _e('Links', 'cha'); ?></h2>
							<ul>
							<?php foreach( $links as $link ) { ?>
								<li><a href="<?php echo $link; ?>" rel="external"><?php echo $link; ?></a></li>
							<?php } ?>
							</ul>
						<?php } ?>
			
						<?php echo do_shortcode('[gallery size="medium"]'); ?>

						<?php get_template_part( 'module-page-links', get_post_format() ); ?>

					</div>

					<div class="entry-footer clearfix">
<?php // get_template_part( 'module-categories', get_post_format() ); ?>
<?php // get_template_part( 'module-sharing', get_post_format() ); ?>
					</div>

				</div>
			</div>

			<?php 
			$searchwp_related = new SearchWP_Related();

			// Use the keywords as defined in the SearchWP Related meta box
			$keywords = get_post_meta( get_the_ID(), $searchwp_related->meta_key, true );

			$args = array(
			's'              => $keywords,  // The stored keywords to use
			'engine'         => 'default',  // the SearchWP engine to use
			'posts_per_page' => 3,          // how many entries to find
			);

			// Retrieve Related content for the current post
			$related_content = $searchwp_related->get( $args );

			if ( $related_content ) { ?>

			<div class="col">
				<div class="block related">
					<h3>Gerelateerde artikelen</h3>
					<ul>
						<?php
							foreach ( $related_content as $related ) { ?>
								<li><a href="<?php echo get_permalink( $related); ?>"><?php echo get_the_title( $related ); ?></a></li>
							<?php
							}
						?>
					</ul>
				</div>
			</div>

			<?php wp_reset_postdata();
			} ?>

<?php } ?>