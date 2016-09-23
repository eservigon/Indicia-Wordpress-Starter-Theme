<?php
/**
 * The template for displaying all pages.
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
		<h2><?php the_title(); ?></h2>
		<?php the_content(); ?>
	</div>
</div>

<?php endwhile; ?>

<?php Indicia_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>