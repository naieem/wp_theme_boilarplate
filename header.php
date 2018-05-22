<?php
/**
 * The header for our theme
 * @package Gamiphy
 */

?>
<!doctype html>
<html <?php language_attributes();?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?php
if (!is_home()) {?>
        <meta name="title" content="Gamiphy | Complete Gamification Solutions for Customer Journeys">
        <meta name="desciption"
              content="Gamiphy is a user engagement and retention platform that equips brands in different industries with tools proven to increase customers reach and loyalty.">
        <?php
}
?>
    <meta charset="<?php bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <!-- <link rel="icon" href="assets/img/favicon.ico"> -->
    <link rel="stylesheet"
          href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
          crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/main.min.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.min.css">
    <?php wp_head();
global $options;
$options = get_option('gamiphy_settings');
?>
    <title>
        <?php if (isset($options['site_title'])) {
	echo $options['site_title'];
} else {
	echo "Gamiphy";
}
?></title>
    <script src="https://static.gamiphy.co/js/api.min.js"></script>
    <script>
        var w = window.innerWidth;
        var h = window.innerHeight;
        w = w * 90 / 100;
        h = h * 70 / 100;
        function openGamiphyQuiz() {
            Gamiphy.openInPopup("https://static-test.gamiphy.co/gamiphy-quiz/index.html", w, h);
        }
    </script>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '455669301537003');
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=455669301537003&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->

</head>

<body <?php body_class();?>>
<?php
global $post;
$custom_header = get_post_meta($post->ID, 'custom_header', true);
$hide_banner_section = get_post_meta($post->ID, 'hide_banner_section', true);
$banner_image_url = get_post_meta($post->ID, 'banner_image_url', true);
$logo_url = get_post_meta($post->ID, 'logo_url', true);
$hide_page_title = get_post_meta($post->ID, 'hide_title', true);
?>
<header <?php if ($custom_header) {
	echo 'id="landing-page-header"';
} else {
	'id="gamiphy-header"';
}
?> >
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-faded">
            <a class="navbar-brand" href="<?php echo home_url('/'); ?>">
                <?php
// checking page logo url first
// then checking theme options logo
// at last embed default logo
if (isset($logo_url) && $logo_url != '') {
	echo "<img src='" . $logo_url . "' class='gamiphy-logo'>";
} elseif (isset($options['site_logo']) && $options['site_logo'] != '') {
	echo "<img src='" . $options['site_logo'] . "' class='gamiphy-logo'>";
} else {
	echo '<embed class="gamiphy-logo" src="' . get_stylesheet_directory_uri() . '/assets/img/logo.svg" width="100%" height="100%">';
}
?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <!-- <span class="navbar-toggler-icon"></span> -->
                <?php
if ($custom_header) {
	echo '<img class="navbar-toggler-custom-button" src="' . get_stylesheet_directory_uri() . '/assets/img/burger-black.png" width="35px">';

} else {
	echo '<img class="navbar-toggler-custom-button" src="' . get_stylesheet_directory_uri() . '/assets/img/burger.svg" width="35px">';

}
?>

            </button>
            <?php
wp_nav_menu(array(
	'theme_location' => 'menu-1',
	'depth' => 2,
	'menu_id' => 'primary-menu',
	'menu_class' => 'navbar-nav ml-auto',
	'container' => 'div',
	'container_class' => 'collapse navbar-collapse',
	'container_id' => 'navbarSupportedContent',
	'walker' => new WP_Bootstrap_Navwalker(),
));
?>
            <?php
if (!$custom_header) {
	?>
                <a class="nav-link gamiphy-get-started" href="<?php echo $options['getting_started_url']; ?>">Get
                    Started</a>
                <?php
}
?>
        </nav>
    </div>
</header>
<?php
if (!is_home()) {
	if (!$hide_banner_section) {
		?>
        <section id="top-section">
            <div class="container-fluid">
                <div class="row top-section-container"
                     <?php if ($banner_image_url != '') {
			?>style="background-image: url('<?php echo $banner_image_url;
		} ?>')">
                    <div class="col-md-12">
                        <div class="row top-section-title">
                            <div class="col-md-12">
                                <?php
if (!$hide_page_title) {
			?>
                                    <p class="title">
                                        <?php the_title();?>
                                    </p>
                                    <?php
}
		?>
                            </div>
                            <div class="col-md-12">
                            <span class="route">
                                <!-- Home
                                <embed class="arrow-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow.svg" width="5px"> blog -->
                                <?php breadcrumbs();?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
}
}
if (is_home()) {
	?>
    <section id="carousel-section">
        <div class="container-fluid">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <img src="<?php echo $options['slider_bg']; ?>">
                    <span class="slider_custom_title gamiphy-silder-main-title"><?php echo $options['home_slider_title']; ?></span>
                    <?php
$slider_query = new WP_Query(array('post_type' => 'slider'));
	$slider_count = 0;
	if ($slider_query->have_posts()):
		while ($slider_query->have_posts()): $slider_query->the_post();
			$slider_count++;
			?>
								                            <div class="carousel-item <?php if ($slider_count == 1) {
				echo 'active';
			}
			?>">
								                                <?php //the_post_thumbnail( 'full' );?>
								                                <div class="carousel-caption d-md-block">
								                                    <!-- <p class="gamiphy-silder-main-title"><?php //echo get_the_excerpt(get_the_ID()); ?></p> -->
								                                    <p class="gamiphy-silder-sub-title"><?php echo get_the_excerpt(get_the_ID()); ?>
								                                    </p>
								                                    <div class="breaker"></div>
								                                    <a class="watch-video video-btn"  data-toggle="modal" data-src="<?php echo $options['youtube_video_url']; ?>" data-target="#videoModal" href="#">
								                                        <embed class="gamiphy-play"
								                                               src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/video.svg"
								                                               width="40px" height="40px">
								                                            <span> watch the video </span>
								                                    </a>
								                                    <a class="nav-link gamiphy-get-started-mobile" href="<?php echo $options['getting_started_url']; ?>">Get Started</a>
								                                </div>
								                            </div>
								                        <?php endwhile;?>
				                    <?php else: ?>
                        <p><?php _e('Sorry, no posts matched your criteria.');?></p>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>

<!-- Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="video showing url" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- 16:9 aspect ratio -->
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always"></iframe>
                </div>


            </div>

        </div>
    </div>
</div>