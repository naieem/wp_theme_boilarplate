<?php
/**
 * Template Name: Contact form
 * This is the template that displays contact us form
 * @package Gamiphy
 */

get_header();
global $options;
$options = get_option('gamiphy_settings');
?>
    <?php
while (have_posts()):
	the_post();
	the_content();

endwhile; // End of the loop.
?>
    <section id="contact-us-form-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 section-title">
                    <p>send us a message</p>
                    <div class="one"></div>
                    <div class="two"></div>
                </div>
            </div>
            <div class="action_result_container"></div>
            <form class="contact-us-form">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" placeholder="Your name" name="name" required="required">
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="email" required="required" class="form-control" placeholder="Your Email" name="email">
                    </div>
                    <div class="col-md-12 mb-3">
                        <textarea type="textarea"required="required" class="form-control" placeholder="Subject" name="subject"></textarea>
                    </div>
                    <div class="col-md-12">
                        <button class="form-control" type="submit">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section id="schedule-meeting-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 section-title">
                    <p>Schedule a meeting</p>
                    <div class="one"></div>
                    <div class="two"></div>
                </div>
                <div class="col-md-12 pl-5 pr-5">
                <!-- Calendly inline widget begin -->
                        <div class="calendly-inline-widget" data-url="<?php echo $options['calendly_url']; ?>" style="min-width:320px;height:580px;"></div>
                            <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js">

                            </script>
                        <!-- Calendly inline widget end -->
                <div>
            </div>
        </div>
    </section>
<?php
get_footer();
