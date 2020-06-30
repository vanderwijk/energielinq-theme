<?php if ( is_archive() || is_home() || is_search() ) { // Archive ?>

			<div class="col one-third">
				<div <?php post_class( 'block' ); ?>>

					<?php if ( has_post_thumbnail () ) { ?>
						<div class="thumbnail">
							<a href="<?php the_permalink(); ?>" rel="bookmark">
								<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post ->ID ), 'single' ); ?>
								<img src="<?php echo $image[0]; ?>" alt="<?php echo the_title_attribute(); ?>" />
							</a>
						</div>
					<?php } ?>

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
						} else { ?>
							<a href="mailto:redactie@stroomversnelling.nl">
								<img class="attachment-post-thumbnail" src="/wp-content/themes/energielinq-theme/img/placeholder-project.png">
							</a>
						<?php } ?>

						<div class="flex">

							<div class="projectbeschrijving">
								<?php if ( !empty( get_the_content() ) ) {
									the_content();
								} else {
									echo '<p>Ontbreekt uw projectbeschrijving hier of ziet u incorrecte informatie? E-mail dan naar <a href="mailto:redactie@stroomversnelling.nl">redactie@stroomversnelling.nl</a></p>';
								} ?>
							</div>

							<div class="projectdata">
								<table>

									<?php if ($project_meta['provincie'][0]) { ?>
									<tr>
										<td>Provincie</td>
										<td><?php echo $project_meta['provincie'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['plaats'][0]) { ?>
									<tr>
										<td>Plaats</td>
										<td><?php echo $project_meta['plaats'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['wijk_straat'][0]) { ?>
									<tr>
										<td>Wijk, Straat</td>
										<td><?php echo $project_meta['wijk_straat'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['eigendom'][0]) { ?>
									<tr>
										<td>Eigendom</td>
										<td><?php echo $project_meta['eigendom'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['bouw'][0]) { ?>
									<tr>
										<td>Bouw</td>
										<td><?php echo $project_meta['bouw'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['bouwlagen'][0]) { ?>
									<tr>
										<td>Bouwlagen</td>
										<td><?php echo $project_meta['bouwlagen'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['ambitieniveau'][0]) { ?>
									<tr style="display: none;">
										<td>Ambitieniveau</td>
										<td><?php echo $project_meta['ambitieniveau'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['energiebron_verwarming'][0]) { ?>
									<tr>
										<td>Energiebron voor verwarming</td>
										<td><?php echo $project_meta['energiebron_verwarming'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['prestatiegarantie'][0]) { ?>
									<tr style="display: none;">
										<td>Prestatiegarantie</td>
										<td><?php echo $project_meta['prestatiegarantie'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['epv'][0]) { ?>
									<tr style="display: none;">
										<td>EPV</td>
										<td><?php echo $project_meta['epv'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['aantal_woningen'][0]) { ?>
									<tr>
										<td>Aantal woningen</td>
										<td><?php echo $project_meta['aantal_woningen'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['opleverjaar'][0]) { ?>
									<tr>
										<td>Opleverjaar</td>
										<td><?php echo $project_meta['opleverjaar'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['bouwjaar'][0]) { ?>
									<tr style="display: none;">
										<td>Bouwjaar</td>
										<td><?php echo $project_meta['bouwjaar'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['bouwbedrijf'][0]) { ?>
									<tr>
										<td>Bouwbedrijf</td>
										<td><?php echo $project_meta['bouwbedrijf'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['opdrachtgever'][0]) { ?>
									<tr>
										<td>Opdrachtgever</td>
										<td><?php echo $project_meta['opdrachtgever'][0]; ?></td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['link1'][0]) { ?>
									<tr>
										<td>Gerelateerde link</td>
										<td>
											<a href="<?php echo $project_meta['link1'][0]; ?>" rel="external">
												<?php if ($project_meta['link_1_beschrijving'][0]) {
													echo $project_meta['link_1_beschrijving'][0];
												} else {
													echo 'Externe link';
												}; ?>
											</a>
										</td>
									</tr>
									<?php } ?>

									<?php if ($project_meta['link2'][0]) { ?>
									<tr>
										<td>Gerelateerde link</td>
										<td>
											<a href="<?php echo $project_meta['link2'][0]; ?>" rel="external">
												<?php if ($project_meta['link_2_beschrijving'][0]) {
													echo $project_meta['link_2_beschrijving'][0];
												} else {
													echo 'Externe link';
												}; ?>
											</a>
										</td>
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

						<p><a class="action" href="/nom-projecten/">Projectoverzicht</a></p>

						<?php get_template_part( 'module-page-links', get_post_format() ); ?>

					</div>

					<div class="entry-footer clearfix">
<?php // get_template_part( 'module-categories', get_post_format() ); ?>
<?php // get_template_part( 'module-sharing', get_post_format() ); ?>
					</div>

				</div>
			</div>

<?php } ?>