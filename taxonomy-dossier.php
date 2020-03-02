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

<div class="row content">
	<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_type() );
			endwhile;
		else :
			get_template_part( 'content', 'none' );
		endif;
	?>
</div>

<?php get_template_part( 'module-pagination', get_post_format() ); ?>

<?php get_footer();