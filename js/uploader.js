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
	console.log(window);
	//  callback function after selecting media files
	window.send_to_editor = function(html) {
			var image_url = $(html).attr('src');
		    $('#'+ inputFieldId).val(image_url);
		    $('#'+previewId+' img').attr('src',image_url);
		    clickFromOption = false;
		    tb_remove();
	}
});