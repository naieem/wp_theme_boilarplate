<?php
/**
 * Template Name: Blog
 * This is the template that displays all posts
 * @package Gamiphy
 */

get_header();
global $options; 
    $options = get_option( 'gamiphy_settings' );
?>

	 <section id="blogs-section" class="page-blog">
        <div class="container-fluid">
            <div class="row">
            	<!-- single blog listing  -->
            	<?php 
						$temp = $wp_query; $wp_query= null;
						$wp_query = new WP_Query();
						$number_of_posts = isset($options['post_per_page']) ? $options['post_per_page'] : 10;
						$wp_query->query('posts_per_page=' .$number_of_posts. '&paged='.$paged);
						while ($wp_query->have_posts()) : $wp_query->the_post(); 
							$post = get_post( get_the_ID() );
							$comment_count = $post->comment_count;
				?>
						<div class="blog-card col-md-6 col-lg-4">
		                    <div class="card">
		                        <div class="card-header">
		                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/head-bg.jpg">
		                        </div>
		                        <div class="card-body row">
		                            <div class="col-md-12">
		                                <span class="read-and-earn">Read and earn</span>
		                                <span class="points-number">200POINTS</span>
		                            </div>
		                            <div class="col-md-12">
		                                <p class="body-title"><?php the_title(); ?></p>
		                            </div>
		                            <div class="col-md-12">
		                                <?php the_excerpt(); ?>
		                            </div>
		                        </div>
		                        <div class="card-footer">
		                            <div class="row">
		                                <div class="col-8 align-items-center">
		                                    <embed class="like-chat-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/lol.png">
		                                    <embed class="like-chat-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/like.png">
		                                    <embed class="like-chat-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/cool.png">
		                                    <span class="like-chat-number">82</span>
		                                </div>
		                                <div class="col-4 align-items-center justify-content-flex-end">
		                                    <embed class="like-chat-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/chat.svg">
		                                    
		                                    <a href="<?php echo get_comments_link( $post->ID ); ?>">
			                                    <span class="like-chat-number">
			                                    	<?php echo $comment_count;?>
			                                    </span>
		                                	</a>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
                		</div>

						<?php endwhile; ?>
						
						<?php 
							// the_posts_pagination( array(
							//     'mid_size' => 2,
							//     'prev_text' => __( 'Previous', 'textdomain' ),
							//     'next_text' => __( 'Next', 'textdomain' ),
							//     'before_page_number ' => __( 'sdsd', 'textdomain' )
							// ));
						 ?>
						
					<?php wp_reset_postdata(); ?>
            </div>
            <div class="row pagination-sub-section">
                <div class="col-md-12 align-items-center justify-content-center">
                	<?php 
				        echo paginate_links( array(
				            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
				            'total'        => $wp_query->max_num_pages,
				            'current'      => max( 1, get_query_var( 'paged' ) ),
				            'format'       => '?paged=%#%',
				            'show_all'     => false,
				            'type'         => 'list',
				            'end_size'     => 2,
				            'mid_size'     => 1,
				            'prev_next'    => true,
				            'prev_text'    => sprintf( '%1$s', __( 'Previous', 'gamiphy' ) ),
				            'next_text'    => sprintf( '%1$s', __( 'Next', 'gamiphy' ) ),
				            'add_args'     => false,
				            'add_fragment' => '',
				        ) );
					?>
                    <!-- <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#">Previous</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul> -->
                </div>
            </div>
        </div>

    </section>

<?php
// get_sidebar();
get_footer();
