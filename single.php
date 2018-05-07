<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Gamiphy
 */

get_header();
?>
				<?php
					while ( have_posts() ) :
						the_post();
						// echo get_post_type();
						// get_template_part( 'template-parts/content',  get_post_type());
						// ?>

						<section id="blog-content">
					        <div class="container-fluid">
					            <div class="content-card">
					                <div class="row card">
					                    <div class="card-body">
					                        <div class="col-12 brogres-bar-content">
					                            <div class="row">
					                                <div class="col-12 points-number">187 POINT</div>
					                                <div class="col-12 brogres-bar">brogers-here</div>
					                            </div>
					                            <span></span>
					                        </div>
					                        <div class="col-12 blog-title">
					                            	<?php
													if ( is_singular() ) :
														the_title( '<p">', '</p>' );
													else :
														the_title( '<p><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></p>' );
													endif;?>
					                        </div>
					                        <div class="col-12 author-content align-items-center">
					                            <embed src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/author.svg">
					                            <span>BY
					                                <b>
					                                	<?php gamiphy_posted_by();?>
					                                		
					                                	</b> - <?php gamiphy_posted_on();?></span>
					                        </div>
					                        <div class="col-12 blog-content">
					                            <div class="row">
					                                <div class="col-md-1 reaction-content">
					                                    <div class="row">
					                                        <div class="col-md-12 col-sm-2 reaction-div align-items-center">
					                                            <embed src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/chat.svg">
					                                            <span>22</span>
					                                        </div>
					                                        <div class="col-md-12 col-sm-2 reaction-div align-items-center">
					                                            <embed src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/cool.png">
					                                            <span>58</span>
					                                        </div>
					                                        <div class="col-md-12 col-sm-2 reaction-div align-items-center">
					                                            <embed src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/like.png">
					                                            <span>21</span>
					                                        </div>
					                                        <div class="col-md-12 col-sm-2 reaction-div align-items-center">
					                                            <embed src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/lol.png">
					                                            <span>3</span>
					                                        </div>
					                                    </div>
					                                </div>
					                                <div class="col-md-11 blog-details">
					                                    <div class="row">
					                                        <!-- <div class="col-11 first-info">
					                                            Lorem ipsum dolor sit amet, consectadipisicing elit, sed do eiusmod por incidid ut labore et dolore magna aliqua. Ut enim
					                                            ad minim veniam, quis nostrud lorem exercitation ullamco laboris.
					                                        </div>
					                                        <div class="col-12 image-div">
					                                            <img src="./assets/img/head-bg.jpg">
					                                        </div> -->
					                                        <div class="col-12 first-info-details info-details-text">
					                                            <?php
																	the_content( sprintf(
																		wp_kses(
																			/* translators: %s: Name of current post. Only visible to screen readers */
																			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'gamiphy' ),
																			array(
																				'span' => array(
																					'class' => array(),
																				),
																			)
																		),
																		get_the_title()
																	) );

																	wp_link_pages( array(
																		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gamiphy' ),
																		'after'  => '</div>',
																	) );
																	?>
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					            </div>
					        </div>
					    </section>

						<?php

						// the_post_navigation();

						// If comments are open or we have at least one comment, load up the comment template.
						// if ( comments_open() || get_comments_number() ) :
						// 	comments_template();
						// endif;

					endwhile; // End of the loop.
					?>


<?php
// get_sidebar();
get_footer();
