<?php
/**
* Theme Options
* Created by Naieem Mahmud Supto
* naieem@gamiphy.co
*/

$gamiphyset = 'gamiphy_settings';
// ===========================================
// adding admin script query =================
// ===========================================
function gamiphy_options_enqueue_scripts() {
 
        wp_enqueue_script('jquery');
 
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
 
        wp_enqueue_script('media-upload');
        wp_enqueue_script('wptuts-upload');
 
}
add_action('admin_enqueue_scripts', 'gamiphy_options_enqueue_scripts');

//Internal css and js
add_action('admin_head', 'gamiphy_styles_scripts');

function gamiphy_styles_scripts() { ?>
	<style type="text/css">
		form{
			margin-left: 15px;
			margin-right: 15px;
		}
		div.updated{
			margin: 0px;
			margin-bottom: 10px;
		}
  		.gamiphy-container h2{
			margin: 0;
		    padding: 12px 15px 15px;
		    position: relative;
  		}
  		.js .postbox .hndle{
  			cursor: pointer;
  		}
  		h2.hndle{
  			font-size: 14px;
		    padding: 8px 12px;
		    margin: 0;
		    line-height: 1.4;
  		}
  		.toggle-indicator:before{
  			content: "\f142";
		    display: inline-block;
		    font: 400 20px/1 dashicons;
		    speak: none;
		    -webkit-font-smoothing: antialiased;
		    -moz-osx-font-smoothing: grayscale;
		    text-decoration: none!important;
  		}
  		.open .toggle-indicator:before{
  			content: "\f140";
  		}
  		.full-width{
  			width: 100%;
  		}
	</style>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			// uploading logo media query action
		    $('#upload_logo_button').click(function() {
		        tb_show('Upload a logo', 'media-upload.php?referer=gamiphy-settings&type=image&TB_iframe=true&post_id=0', false);
		        return false;
		    });
		    $(".gamiphy-container .hndle").click(function(){
				$(this).next().toggle();
				$(this).parent().toggleClass("open");
			});
			//  callback function after selecting media files
			window.send_to_editor = function(html) {
			    var image_url = $(html).attr('src');
			    $('#site_logo').val(image_url);
			    $('#logo_preview img').attr('src',image_url);
			    tb_remove();
			}
		});
	</script>
<?php }

//register settings
function theme_settings_init(){
	global $gamiphyset;
    register_setting( $gamiphyset, $gamiphyset );
}


//add settings page to menu
function add_settings_page() {
	add_menu_page( __( 'Theme Options' ), __( 'Theme Options' ), 'manage_options', 'settings', 'theme_settings_page');
}


//add actions
add_action( 'admin_init', 'theme_settings_init' );
add_action( 'admin_menu', 'add_settings_page' );


//start settings page
function theme_settings_page() {
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	global $gamiphyset;
?>

<div class="wrap">

	<form method="post" action="options.php">

		<?php settings_fields( $gamiphyset ); ?>

		<?php $options = get_option( $gamiphyset ); ?>

		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>

		<h2><?php printf( __( '%s Theme Options', 'gamiphy' ), ucfirst($theme_name) ); ?></h2>
		<?php

		//show saved options message
		if ( false !== $_REQUEST['settings-updated'] ) : ?>
			<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
				<p><strong>Options saved.</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
			</div>

		<?php endif; ?>
		<div class="postbox gamiphy-container">
			<button type="button" class="handlediv button-link" aria-expanded="false"><span class="screen-reader-text">Toggle panel: Information</span><span class="toggle-indicator" aria-hidden="true"></span></button>
			<h2 class="hndle"><span>Gamiphy Theme Options Panel</span></h2>
			<div class="inside">
				<table class="form-table">
					<tbody>
						<!-- site title-->
						<tr valign="top">
							<th scope="row">
								<label for="<?php echo $gamiphyset."[site_title]"; ?>">Site Title
								</label>
							</th>
							<td>
								<p>
									<input type="text" class="full-width" name="<?php echo $gamiphyset."[site_title]"; ?>" value="<?php echo $options['site_title']; ?>"></p>
								<p><span class="description">Enter website title.</span></p>
							</td>
						</tr>

						<!-- <tr valign="top">
							<th scope="row">
								<label for="<?php echo $gamiphyset."[footer_scripts]"; ?>">Footer Scripts
								</label>
							</th>
							<td>
								<p><textarea name="<?php echo $gamiphyset."[footer_scripts]"; ?>" class="large-text" id="<?php echo $gamiphyset."[footer_scripts]"; ?>" cols="78" rows="8"><?php echo $options['footer_scripts']; ?></textarea></p>
								<p><span class="description">Add Description here.</span></p>
							</td>
						</tr> -->

						<!-- site logo-->
						<tr valign="top">
							<th scope="row">
								<label for="<?php echo $gamiphyset."[site_logo]"; ?>">Select website logo
								</label>
							</th>
							<td>
								<p><input class="full-width" type="text" id="site_logo" name="<?php echo $gamiphyset."[site_logo]"; ?>" value="<?php echo $options['site_logo']; ?>">
									<input id="upload_logo_button" type="button" class="button" value="<?php _e( 'Select Logo', 'gamiphy' ); ?>" />
								</p>
								<p id="logo_preview">
									<img src="<?php echo $options['site_logo']; ?>">
								</p>
								<p><span class="description">Select Website Logo.</span></p>
							</td>
						</tr>

						<!-- Youtube Video url-->
						<tr valign="top">
							<th scope="row">
								<label for="<?php echo $gamiphyset."[youtube_video_url]"; ?>">Insert Youtube Video Url
								</label>
							</th>
							<td>
								<p><input class="full-width" type="text" name="<?php echo $gamiphyset."[youtube_video_url]"; ?>" value="<?php echo $options['youtube_video_url']; ?>">
								</p>
								<p><span class="description">Insert youtube video url</span></p>
							</td>
						</tr>
						<!-- getting started input -->
						<tr valign="top">
							<th scope="row">
								<label for="<?php echo $gamiphyset."[getting_started_url]"; ?>">Insert getting started Url
								</label>
							</th>
							<td>
								<p><input class="full-width" type="text"  name="<?php echo $gamiphyset."[getting_started_url]"; ?>" value="<?php echo $options['getting_started_url']; ?>">
								</p>
								<p><span class="description">Insert Getting started Link</span></p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>		
		</div>

		<p><input name="submit" id="submit" class="button button-primary" value="Save Changes" type="submit"></p>

	</form>

</div><!-- END wrap -->

<?php

}