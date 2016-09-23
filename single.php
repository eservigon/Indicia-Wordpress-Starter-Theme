<?php
/**
 * The Template for displaying all single posts
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Indicia Starter
 */
?>
<?php Indicia_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="container">
	<div class="twelve columns">
		<article>
		
			<h2><?php the_title(); ?></h2>
			<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time>
			<?php the_content(); ?>			

				
		</article>
	</div>
</div>

<?php endwhile; ?>

<?php Indicia_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>