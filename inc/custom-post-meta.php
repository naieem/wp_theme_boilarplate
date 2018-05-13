<?php
/**
 * Created by Naieem Mahmud Supto.
 * User: Gamiphy
 * Email: naieem@gamiphy.co
 * Date: 5/13/2018
 * Time: 10:00 PM
 */


function add_embed_tweet_meta_box() {
    add_meta_box(
        'custom_header', // $id
        'Select Settings for the page', // $title
        'show_embed_meta_box', // $callback
        'page', // $page
        'normal', // $context
        'high'); // $priority
}
add_action('add_meta_boxes', 'add_embed_tweet_meta_box');

/**************************************************************************
 * Save the meta fields on save of the post
 **************************************************************************/
function save_embed_tweet_meta($post_id) {
    // verify nonce
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
        return $post_id;

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    $custom_header = $_POST["custom_header"];
    $hide_banner = $_POST['hide_banner_section'];
    $banner_image_url = $_POST['banner_image_url'];
    //if(isset($custom_header)){
        update_post_meta($post_id, "custom_header", $custom_header);
    //}
    //if(isset($hide_banner)){
        update_post_meta($post_id, "hide_banner_section", $hide_banner);
    //}
    //if(isset($banner_image_url)){
        update_post_meta($post_id, "banner_image_url", $banner_image_url);
    //}
}
add_action('save_post', 'save_embed_tweet_meta');

/**
 * Showing meta box in the post page
 */
function show_embed_meta_box() {
    global $post;
    $custom_header = get_post_meta($post->ID, 'custom_header', true);
    $hide_banner = get_post_meta($post->ID, 'hide_banner_section', true);
    $banner_image_url = get_post_meta($post->ID, 'banner_image_url', true);

    // Use nonce for verification
    echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

    echo '<table class="form-table">';
    // begin a table row with
    ?>
    <style>
        .form-table th{
            width:50% !important;
        }
        .form-table input[type='text']{
            width:100%;
        }
    </style>
    <tr>
        <th>
            <label for="">Check if u want custom header menu:</label></th>
        <td>
            <input type="checkbox" value="1" <?php checked($custom_header, true, true); ?> name="custom_header">
<!--		    <span class="description">Use to add custom header.</span>-->
        </td>
    </tr>
    <tr>
        <th>
            <label for="">Check to hide default banner section:</label></th>
        <td>
            <input type="checkbox" value="1" <?php checked($hide_banner, true, true); ?> name="hide_banner_section">
            <!--		    <span class="description">Use to add custom header.</span>-->
        </td>
    </tr>
    <tr>
        <th>
            <label for="">Insert Custom Banner Image url:</label></th>
        <td>
            <input type="text" value="<?php echo $banner_image_url;?>" name="banner_image_url">
            <!--		    <span class="description">Use to add custom header.</span>-->
        </td>
    </tr>
<?php
    echo '</table>';
}