<?php
/**
 * Template Name: Blog
 * This is the template that displays all posts
 * @package Gamiphy
 */

get_header();
?>

	<section id="page-template" class="container-fluid">
		<div class="row">
			<div class="col-md-12 pl-5 pr-5">
				<article>

					<?php // Display blog posts on any page @ https://m0n.co/l
						$temp = $wp_query; $wp_query= null;
						$wp_query = new WP_Query();
						 $wp_query->query('posts_per_page=5' . '&paged='.$paged);
						while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

						<h2><a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a>
						</h2>
						<?php the_excerpt(); ?>

						<?php endwhile; ?>
						<?php the_posts_pagination( array(
						    'mid_size' => 2,
						    'prev_text' => __( 'Previous', 'textdomain' ),
						    'next_text' => __( 'Next', 'textdomain' ),
						    'before_page_number ' => __( 'sdsd', 'textdomain' )
						) ); ?>

					<?php wp_reset_postdata(); ?>
				</article>
			</div>
		<div>
	</section><!-- #primary -->

<?php
// get_sidebar();
get_footer();
