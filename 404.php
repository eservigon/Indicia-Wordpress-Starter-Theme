<?php
/**
 * Note - The template for displaying 404 pages (Not Found)
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Indicia Starter
 */
?>
<?php Indicia_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<div class="container">
	<div class="twelve columns">
		<h2>Page not found</h2>
	</div>
</div>

<?php Indicia_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>