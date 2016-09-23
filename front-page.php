<?php
/**
 * Template Name: Front Page
 * The homepage template file
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
	<div class="six columns">
		<h2><?php the_title(); ?></h2>
	</div>
	<div class="six columns">
		<?php the_content(); ?>
		<a href="#" class="button">Button</a>
		<a href="#" class="button button-primary">Button</a>

	</div>
</div>

<?php endwhile; ?>


<?php Indicia_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>