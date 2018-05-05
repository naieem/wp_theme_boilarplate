<?php
/**
* Theme Options
* Created by Naieem Mahmud Supto
* naieem@gamiphy.co
*/

$gamiphyset = 'gamiphy_settings';

$gameOptions = array(
	array(
		'type' => 'text',
		'label' => 'Youtube Video url',
		'model' => 'youtube_video_url',
		'description' => 'Enter youtube video url'
	),
	array(
		'type' => 'text',
		'label' => 'Enter number of post to display in blog page',
		'model' => 'post_per_page',
		'description' => 'Enter number of post to display in blog page'
	),
	array(
		'type' => 'text',
		'label' => 'Insert Getting started Link',
		'model' => 'getting_started_url',
		'description' => 'Insert Getting started Link'
	),
	// array(
	// 	'type' => 'textarea',
	// 	'label' => 'Insert site Configuration',
	// 	'model' => 'site_configuration',
	// 	'description' => 'Insert site configuration'
	// ),
	array(
		'type' => 'media',
		'label' => 'Select or insert site logo',
		'model' => 'site_logo',
		'description' => 'Select or insert site logo',
		'button_text' => 'select logo',
		'input_field_id' => 'site_logo',
		'popWindowTitle' => 'Select Logo',
		'previewId' => 'preview'
	),
	array(
		'type' => 'text',
		'label' => 'Insert calendly url',
		'model' => 'calendly_url',
		'description' => 'Insert calendly url'
	)
);


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
			var inputFieldId=''; // needed for setting value to the input field
			var previewId = ''; // needed to put preview image link in that previewcontainer
			// uploading  media query action
		    $('.select_media_button').click(function() {
		    	inputFieldId = this.attributes['data-input-id'].value;
		    	popupWindowTitle = this.attributes['data-pop-title'].value;
		    	previewId = this.attributes['data-preview-id'].value;
		        tb_show(popupWindowTitle, 'media-upload.php?referer=gamiphy-settings&type=image&TB_iframe=true&post_id=0', false);
		        return false;
		    });
		    $(".gamiphy-container .hndle").click(function(){
				$(this).next().toggle();
				$(this).parent().toggleClass("open");
			});
			//  callback function after selecting media files
			window.send_to_editor = function(html) {
			    var image_url = $(html).attr('src');
			    $('#'+ inputFieldId).val(image_url);
			    $('#'+previewId+' img').attr('src',image_url);
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
						<?php
						foreach ($GLOBALS["gameOptions"] as $key => $option) {
							switch ($option['type']) {
								case 'text':
								 echo returnTextOptionConfiguration($option,$options);
									break;
								case 'textarea':
								 echo returnTextareaOptionConfiguration($option,$options);
									break;
								case 'media':
								 echo returnMediaSelectionConfiguration($option,$options);
									break;
								
								default:
									# code...
									break;
							}
						}
						?>
					</tbody>
				</table>
			</div>		
		</div>

		<p><input name="submit" id="submit" class="button button-primary" value="Save Changes" type="submit"></p>

	</form>

</div><!-- END wrap -->

<?php
}

/**
 * returning html for input type text
 * @param  [type] $options     [inputs configuration]
 * @param  [type] $storedValue [setting value that is registered and saved]
 * @return [type]              [text]
 */
function returnTextOptionConfiguration($options,$storedValue){
	$saved_value = $storedValue[$options["model"]];
	$labelAndName = $GLOBALS["gamiphyset"].'['.$options["model"].']';
	$label = $GLOBALS[$gamiphyset].$options["label"];
	$description = $options["description"];
	return '<tr valign="top">
			<th scope="row">
				<label for="'.$labelAndName.'">'.$label.'</label>
			</th>
			<td>
				<p>
					<input type="text" class="full-width" name="'.$labelAndName.'" value="'.$saved_value.'"></p>
				<p><span class="description">'.$description.'</span></p>
			</td>
		</tr>';
}
/**
 * returning html for input type textarea
 * @param  [type] $options     [inputs configuration]
 * @param  [type] $storedValue [setting value that is registered and saved]
 * @return [type]              [textarea]
 */
function returnTextareaOptionConfiguration($options,$storedValue){
	$saved_value = $storedValue[$options["model"]];
	$labelAndName = $GLOBALS["gamiphyset"].'['.$options["model"].']';
	$label = $GLOBALS[$gamiphyset].$options["label"];
	$description = $options["description"];
	return '<tr valign="top">
			<th scope="row">
				<label for="'.$labelAndName.'">'.$label.'</label>
			</th>
			<td>
				<p>
				<textarea name="'.$labelAndName.'" class="large-text" cols="78" rows="8">'.$saved_value.'</textarea></p>
				<p><span class="description">'.$description.'</span></p>
			</td>
		</tr>';
}

/**
 * returning html for input type file selection
 * @param  [type] $options     [inputs configuration]
 * @param  [type] $storedValue [setting value that is registered and saved]
 * @return [type]              [media]
 */

function returnMediaSelectionConfiguration($options,$storedValue){
	$saved_value = $storedValue[$options["model"]];
	$labelAndName = $GLOBALS["gamiphyset"].'['.$options["model"].']';
	$label = $GLOBALS[$gamiphyset].$options["label"];
	$description = $options["description"];
	$buttonText = $options["button_text"];
	$inputFieldId = $options["input_field_id"];
	$popWindowTitle = $options['popWindowTitle']; 
	$previewId = $options['previewId'];
	return '<tr valign="top">
				<th scope="row">
					<label for="'.$labelAndName.'">'.$label.'</label>
				</th>
				<td>
					<p>
					<input class="full-width" type="text" id="'.$inputFieldId.'" name="'.$labelAndName.'" value="'.$saved_value.'">
					<input type="button" class="select_media_button button" data-pop-title="'.$popWindowTitle.'" data-input-id="'.$inputFieldId.'" data-preview-id="'.$previewId.'" value="'.$buttonText.'" />
					</p>
					<p id="'.$previewId.'">
						<img src="'.$saved_value.'">
					</p>
					<p><span class="description">'.$description.'</span></p>
				</td>
			</tr>';
}