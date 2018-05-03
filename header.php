<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gamiphy
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <!-- <link rel="icon" href="assets/img/favicon.ico"> -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
        crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/main.css">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header id="gamiphy-header">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg bg-faded">
                <a class="navbar-brand" href="#">
                    <embed class="gamiphy-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.svg" width="100%" height="100%">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Industries</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Affiliates</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Careers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link gamiphy-get-started" href="#">Get Started</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <section id="carousel-section">
        <div class="container-fluid">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/intro.jpg" alt="...">
                        <div class="carousel-caption d-md-block">
                            <p class="gamiphy-silder-main-title">Take your customer epxeriece to the next level with incentives and rewards </p>
                            <p class="gamiphy-silder-sub-title">Improve your gamified customer journey</p>
                            <div class="breaker"></div>
                            <a class="watch-video" href="#">
                                <embed class="gamiphy-play" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/video.svg" width="40px" height="40px">
                                <span> watch the video </span>
                            </a>
                        </div>
                    </div>
                    <!-- <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/intro.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/intro.jpg" alt="Third slide">
                    </div> -->
                </div>
            </div>
        </div>
    </section>
