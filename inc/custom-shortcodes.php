<?php
/**
 * Created by Naieem Mahmud Supto.
 * User: Gamiphy
 * Email: naieem@gamiphy.co
 * Date: 5/13/2018
 * Time: 11:55 PM
 */

/**
 * shortcode function for demo request form
 * @param  [type] $attributes
 */
function demo_request_func( $atts ) {
    $request = shortcode_atts( array(
        'title' => 'something',
        'subtitle' => 'something else',
        'button_text' => '',
        'business_type' => '',
        'type' => '' // vertical,horizontal
    ), $atts );

    // for vertical form
    // representation
    ob_start();
    ?>
    <div class="col-md-5 request-demo-form-div">
        <div class="row">
            <div class="col-12 title">
                <?php echo $request['title']; ?>
            </div>
            <div class="col-12 description">
                <?php echo $request['subtitle']; ?>
            </div>
            <div id='vertical' class="col-12 description"></div>
            <div class="col-12 request-demo-form">
                <form class="row demo-request-form" data-response-id='vertical'>
                    <div class="col-12">
                        <input type="text" class="form-control" required="required" name="emailOrPhone" placeholder="Email Address or phone number">
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control"  required="required" name="name"  placeholder="Full Name">
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control"  required="required" name="restaurantName"   placeholder="Restaurant name">
                    </div>
                    <div class="col-12">
                        <input type="hidden" value="<?php echo $request['business_type']; ?>" name="business_type">
                        <button type="submit" class="form-control"><?php echo $request['button_text']; ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    $verticalfORM= ob_get_contents();
    ob_end_clean();
    // for Horizontal form
    // representation
    ob_start();
    ?>
    <div class="row">
        <div class="col-12 title">
            <?php echo $request['title']; ?>
        </div>
        <div id='horizontal' class="col-12 description"></div>
        <div class="col-12 request-demo-form">
            <form class="row demo-request-form"  data-response-id='horizontal'>
                <div class="col-md-3">
                    <input type="text" class="form-control"  required="required" name="emailOrPhone"  placeholder="Email Address or phone number">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control"  required="required" name="name" placeholder="Full Name">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control"  required="required" name="restaurantName" placeholder="Restaurant name">
                </div>
                <div class="col-md-3">
                    <input type="hidden" value="<?php echo $request['business_type']; ?>" name="business_type">
                    <button type="submit" class="form-control"><?php echo $request['button_text']; ?></button>
                </div>
            </form>
        </div>
    </div>
    <?php
    $HorizontalFORM = ob_get_contents();
    ob_end_clean();
    if($request['type'] == 'horizontal')
        return $HorizontalFORM;
    if($request['type'] == 'vertical')
        return $verticalfORM;
}
add_shortcode( 'demorequestform', 'demo_request_func' );


/**
 * shortcode function for content slider function
 * @param  [type] $attributes
 */
function content_slider_func( $atts ) {
    $request = shortcode_atts( array(
        'background_image' => '',
        'text_contents' => '',
        'button' => '', // true or false
        'button_text' => '',
        'button_link' =>''
    ), $atts );

    $background_image = $atts['background_image'];
    $isButtonExists = $atts['button'];
    $button_text = $atts['button_text'];
    $button_link = $atts['button_link'];
    $text_contents = explode(',', $atts['text_contents']);
    $counter = 0;
    ?>
    <?php
    ob_start();
    ?>
    <section id="carousel-section">
        <div class="container-fluid">
            <div id="customSlider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <img src="<?php echo $background_image?>">
                    <?php
                        foreach ( $text_contents as $texts ) {
                            $counter++;
                            ?>
                            <div class="carousel-item <?php if($counter == 1) echo 'active';?>">

                                <div class="carousel-caption d-md-block">
                                    <p class="gamiphy-silder-main-title"><?php echo $texts; ?></p>
                                    <div class="breaker"></div>
                                </div>
                            </div>
                    <?php } 
                    if(isset($isButtonExists) && $isButtonExists == 'true'){?>
                    <div class="slider_request_demo">
                        <a  class="btn" href="<?php echo $button_link;?>"><?php echo $button_text;?></a>
                    </div>
                    <?php
                }
                ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    $slider = ob_get_contents();
    ob_end_clean();
    return $slider;
}
add_shortcode( 'contentslider', 'content_slider_func' );