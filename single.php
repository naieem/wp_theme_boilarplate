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
						$parent_posts_comment_count = $post->comment_count;
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
					                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/head-bg.jpg">
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
					     <!-- related post block -->
					    <section id="related-articles-section">
					        <div class="container-fluid">
					            <div class="row">
					                <div class="col-12 section-title">
					                    <p>Related Articles</p>
					                    <div class="one"></div>
					                    <div class="two"></div>
					                </div>
					            </div>
					            <div class="row">
					            	<?php
										//for use in the loop, list 5 post titles related to first tag on current post
										$tags = wp_get_post_tags($post->ID);
										// var_dump($tags);
										if ($tags) {
										$first_tag = $tags[0]->term_id;
										$args=array(
										'tag__in' => array($first_tag),
										'post__not_in' => array($post->ID),
										'posts_per_page'=>5,
										'caller_get_posts'=>1
										);
										$my_query = new WP_Query($args);
										if( $my_query->have_posts() ) {
										while ($my_query->have_posts()) : $my_query->the_post(); 
											$post = get_post( get_the_ID() );
											// storing commnet count
											$comment_count = $post->comment_count;
										?>
										<!-- <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?>
										</a> -->
										<div class="blog-card col-md-6 col-lg-4">
						                    <div class="related-articles-card row">
						                        <div class="col-md-12 col-sm-4 related-articles-card-header">
						                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>">
						                        </div>
						                        <div class="col-md-12 col-sm-8 related-articles-card-body">
						                            <div class="row">
						                                <div class="col-md-12">
						                                    <span class="read-and-earn">Read and earn</span>
						                                    <span class="points-number">200POINTS</span>
						                                </div>
						                                <div class="col-md-12">
						                                    <p class="body-title">
						                                    	<a href="<?php the_permalink(); ?>">
		                                							<?php the_title(); ?>
		                                						</a>
		                                					</p>
						                                </div>
						                                <div class="col-md-12">
						                                    <span class="body-text"><?php the_excerpt(); ?>
						                                    </span>
						                                </div>
						                            </div>
						                        </div>
						                        <div class="col-lg-12 related-articles-card-footer">
						                            <div class="row">
						                                <div class="col-8 align-items-center">
						                                    <embed class="like-chat-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/lol.png">
						                                    <embed class="like-chat-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/like.png">
						                                    <embed class="like-chat-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/cool.png">
						                                    <span class="like-chat-number">82</span>
						                                </div>
						                                <div class="col-4 align-items-center justify-content-flex-end">
						                                    <embed class="like-chat-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/chat.svg">
						                                    <span class="like-chat-number">
						                                    	<a href="<?php echo get_comments_link( $post->ID ); ?>">
								                                    <span class="like-chat-number">
								                                    	<?php echo $comment_count;?>
								                                    </span>
						                                		</a>
						                                	</span>
						                                </div>
						                            </div>
						                    	</div>
						                	</div>
					                	</div>
										<?php
										endwhile;
										}
										wp_reset_query();
										}
										?>

					            </div>
					        </div>
					    </section>

					    <!-- comments section -->
					    <section id="comments-section">
					        <div class="container-fluid">
					            <div class="row">
					                <div class="col-12 section-title">
					                    <p>Comments (<?php echo $parent_posts_comment_count;?>)</p>
					                    <div class="one"></div>
					                    <div class="two"></div>
					                </div>
					            </div>
					            <div class="col-12 invite-to-comment ">
					                Write a comments, get reactions and get points!
					                <embed src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Asset14.svg" width="30px">
					            </div>
					            <!-- all the comments list -->
					            <div class="row comments">
					                <?php
					                if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;
					                ?>
					            </div>
					        </div>
					    </section>

					    <!-- comment form section -->
					    <section id="write-comment-section">
					        <div class="container-fluid">
					            <div class="row">
					                <div class="col-12 section-title">
					                    <p>Write a Comment</p>
					                    <div class="one"></div>
					                    <div class="two"></div>
					                </div>
					            </div>
					            

								<?php if ( comments_open() ) : ?>
								<div id="respond" class="comment-respond">
									<h3 id="reply-title" class="comment-reply-title"> <small>
										<?php echo get_cancel_comment_reply_link('Cancel');?>
									</small></h3>
						            <form class="comment-form" id="commentform" action="<?php echo site_url('/wp-comments-post.php') ?>" method="post">
						                <div class="row">
						                	<?php if ( is_user_logged_in() ) : ?>
											<div>
												<span class="field-hint">Logged in as <?php echo get_user_option('user_nicename') ?></span>
											</div>
											<?php else : ?>
						                    <div class="col-md-6 mb-3">
						                        <input type="text" name="author" id="comment-author" class="form-control" placeholder="Your name">
						                    </div>
						                    <div class="col-md-6 mb-3">
						                        <input type="text" class="form-control" name="email" id="comment-email" placeholder="Your Email">
						                    </div>
						                    <?php endif ?>
						                    <div class="col-md-12 mb-3">
						                        <textarea  name="comment" id="comment-body" class="form-control" placeholder="Your comment"></textarea>
						                    </div>
						                    <div class="col-md-12">
						                        <button class="form-control" type="submit">Post your Comment</button>
						                        <?php comment_form_hidden_fields() ?>
						                    </div>
						                </div>
						            </form>
						        </div>
					            	<?php else : ?>

									<hr />

									<p class="nocomments">
										Comments are closed for this article.
									</p>

								<?php endif ?>
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
