jQuery(document).ready(function($) {
	/**
	 * On nav item click function
	 */
	$(".nav-item").on("click", function () {
        $(".navbar-nav").find(".active").removeClass("active");
        $(this).addClass("active");
    });
	/**
	 * Function to fire on clicking to requesting demo form
	 */
	$(document).on( 'submit', 'form.demo-request-form', function(event) {
		event.preventDefault();
		
		var data = $(this).serialize();
		var resultContainerid = $(this).attr('data-response-id');
		var resultContainer = $('#'+resultContainerid);
		var currentForm = $(this);
		resultContainer.html('<img class="alignnone" src="https://cdnjs.cloudflare.com/ajax/libs/galleriffic/2.0.1/css/loader.gif" alt="" width="48" height="48">');
		$.ajax({
			url : site.ajax_url,
			type : 'post',
			data : data + "&action=add_demo_request",
			success : function( response ) {
				response = JSON.parse(response);
				debugger;
				if(response.status){
					currentForm.trigger("reset");
					resultContainer.html(response.message);
					setTimeout(function(){
						resultContainer.html('')
					}, 3000);
				}else{
					resultContainer.html(response.message);
					setTimeout(function(){
						resultContainer.html('')
					}, 3000);
				}
			}
		});
	});
});