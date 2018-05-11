<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gamiphy
 */

?>

<footer id="footer">
        <div class="container-fluid">
            <div class="row footer-container">
                <div class="col-md-7 left-section">
                    <div class="row ">
                        <div class="col-sm-12">
                            <span>© Copyright 2018 Gamiphy.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 right-section">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="social-icon-container">
                                <a href="">
                                    <embed class="social-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/fb.svg" width="7" height="15">
                                </a>
                            </div>
                            <div class="social-icon-container">
                                <a href="">
                                    <embed class="social-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/twitter.svg" width="16" height="13">
                                </a>
                            </div>
                            <div class="social-icon-container">
                                <a href="">
                                    <embed class="social-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/linkedin.svg" width="15" height="16">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</footer>

    <div></div>

<?php wp_footer(); ?>
<!-- Bootstrap core javascript-->
    <!-- <script src="<?php echo get_stylesheet_directory_uri(); ?>///ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery-3.3.1.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
</body>
</html>
