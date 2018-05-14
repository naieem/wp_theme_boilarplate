<?php
/**
 * The header for our theme
 * @package Gamiphy
 */

?>
    <!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <?php
        if (!is_home()) { ?>
            <meta name="title" content="Gamiphy | Complete Gamification Solutions for Customer Journeys">
            <meta name="desciption"
                  content="Gamiphy is a user engagement and retention platform that equips brands in different industries with tools proven to increase customers reach and loyalty.">
            <?php
        }
        ?>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <!-- <link rel="icon" href="assets/img/favicon.ico"> -->
        <link rel="stylesheet"
              href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/font-awesome/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
              integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
              crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/main.css">
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
            function openGamiphyQuiz() {
                Gamiphy.openInPopup("https://static-test.gamiphy.co/gamiphy-quiz/index.html", 900, 900);
            }
        </script>
    </head>

<body <?php body_class(); ?>>
    <?php
    global $post;
    $custom_header = get_post_meta($post->ID, 'custom_header', true);
    $hide_banner_section = get_post_meta($post->ID, 'hide_banner_section', true);
    $banner_image_url = get_post_meta($post->ID, 'banner_image_url', true);
    $logo_url = get_post_meta($post->ID, 'logo_url', true);
    ?>
    <header <?php if ($custom_header) echo 'id="landing-page-header"'; else 'id="gamiphy-header"'; ?> >
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg bg-faded">
                <a class="navbar-brand" href="<?php echo home_url('/'); ?>">
                    <?php
                    // checking page logo url first
                    // then checking theme options logo
                    // at last embed default logo
                    if(isset($logo_url) && $logo_url !=''){
                        echo "<img src='" . $logo_url . "' class='gamiphy-logo'>";
                    }elseif(isset($options['site_logo']) && $options['site_logo'] != '') {
                        echo "<img src='" . $options['site_logo'] . "' class='gamiphy-logo'>";
                    } else {
                        echo '<embed class="gamiphy-logo" src="' . get_stylesheet_directory_uri() . '/assets/img/logo.svg" width="100%" height="100%">';
                    }
                    ?>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                    'menu_id' => 'primary-menu',
                    'menu_class' => 'navbar-nav ml-auto',
                    'container' => 'div',
                    'container_class' => 'collapse navbar-collapse',
                    'container_id' => 'navbarSupportedContent'
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
                     <?php if ($banner_image_url != ''){ ?>style="background-image: url('<?php echo $banner_image_url;
                     } ?>')">
                    <div class="col-md-12">
                        <div class="row top-section-title">
                            <div class="col-md-12">
                                <p class="title">
                                    <?php the_title(); ?>
                                </p>
                            </div>
                            <div class="col-md-12">
                            <span class="route">
                                <!-- Home
                                <embed class="arrow-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow.svg" width="5px"> blog -->
                                <?php breadcrumbs(); ?>
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
                    <?php
                    $slider_query = new WP_Query(array('post_type' => 'slider'));
                    $slider_count = 0;
                    if ($slider_query->have_posts()) :
                        while ($slider_query->have_posts()) : $slider_query->the_post();
                            $slider_count++;
                            ?>
                            <div class="carousel-item <?php if ($slider_count == 1) echo 'active'; ?>">
                                <?php //the_post_thumbnail( 'full' );?>
                                <div class="carousel-caption d-md-block">
                                    <p class="gamiphy-silder-main-title"><?php the_title(); ?></p>
                                    <p class="gamiphy-silder-sub-title"><?php echo get_the_excerpt(get_the_ID()); ?>
                                    </p>
                                    <div class="breaker"></div>
                                    <a class="watch-video" href="<?php echo $options['youtube_video_url']; ?>"
                                       target="_blank">
                                        <embed class="gamiphy-play"
                                               src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/video.svg"
                                               width="40px" height="40px">
                                            <span> watch the video </span>
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}
