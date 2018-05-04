<?php
/**
 * Template Name: Calendly
 * This is the template that displays Calendly calender
 * @package Gamiphy
 */

get_header();
global $options; 
$options = get_option( 'gamiphy_settings' );
?>

	<section id="page-template" class="container-fluid">
		<div class="row">
			<div class="col-md-12 pl-5 pr-5">
				<!-- Calendly inline widget begin -->
				<div class="calendly-inline-widget" data-url="<?php echo $options['calendly_url'];?>" style="min-width:320px;height:580px;"></div>
				<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js">
					
				</script>
				<!-- Calendly inline widget end -->
			<div>
		</div>
	</section><!-- #primary -->

<?php
// get_sidebar();
get_footer();

