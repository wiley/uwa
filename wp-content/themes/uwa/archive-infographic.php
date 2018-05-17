<?php get_header(); ?>
<div class="content">
	<main class="main-content cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
		<div class="resource-archive-list">
			<?php if (have_posts()) {

								$args = array(
									'post_type' => 'infographic',
									'posts_per_page' => -1,
									'orderby' => 'date',
									'order'   => 'DESC',
								);

								$guides = new WP_Query($args);

								if ( $guides->have_posts() ) { ?>
									<ul class="infographic-list tile-list tile-list">
										<?php while($guides->have_posts()) : $guides->the_post(); ?>
											<li>
												<a class="card" href="<?php the_permalink(); ?>" title="View infographic: <?php the_title(); ?>, including a transcript.">
													<div>
														<div class="card__image">
															<?php $guide_cover_image = get_field( 'infographic_cover_image' );
															if ( $guide_cover_image ) {
																echo wp_get_attachment_image( $guide_cover_image, 'large' );
															} else { ?>
																<img src="<?php echo get_template_directory_uri(); ?>/library/images/infographic.svg" width="400" height="300">
															<?php } ?>
														</div>
														<div class="card__copy">
															<h2 class="h3 card__title"><?php the_title(); ?></h2>
															<?php $infographic_summary = get_field( 'infographic_summary' );
															if ( $infographic_summary ) { ?>
																<p><?php the_field( 'infographic_summary' ); ?></p>
															<?php } ?>
														</div>
													</div>
													<span class="card__action">View Infographic</span>
												</a>
											</li>
										<?php endwhile; ?>
									</ul>
								<?php } ?>

							<?php } else { ?>

									<p><em>There are currently no resources listed in this section.</em></p>

							<?php } ?>
		</div>
	</main>
	<?php include('includes/waiting.php'); ?>
</div>
<?php get_footer(); ?>
