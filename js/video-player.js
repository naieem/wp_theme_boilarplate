/**
 * Created by Naieem Mahmud Supto on 5/15/2018.
 */
jQuery(document).ready(function () {

// Gets the video src from the data-src on each button

    var $videoSrc;
    jQuery('.video-btn').click(function (ev) {
        ev.preventDefault();
        $videoSrc = $(this).data("src");
    });

    jQuery(document).on('hide.bs.modal','#videoModal', function (ev) {
        jQuery("#video").attr('src', '');
        console.log('modal closed');
    });
    jQuery(document).on('show.bs.modal','#videoModal', function () {
        console.log('modal opened');
        $("#video").attr('src', $videoSrc);
    });


// document ready
});


