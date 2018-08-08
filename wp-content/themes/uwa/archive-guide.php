<?php get_header(); ?>
<div class="content">
	<main class="main-content cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
		<div class="infographic-archive-list">
			<?php if (have_posts()) {

								$args = array(
									'post_type' => 'guide',
									'posts_per_page' => -1,
									'orderby' => 'date',
									'order'   => 'DESC',
								);

								$guides = new WP_Query($args);

								if ( $guides->have_posts() ) { ?>
									<ul class="guide-list tile-list tile-list">
										<?php while($guides->have_posts()) : $guides->the_post(); ?>
											<li>
												<a class="resource-card" href="<?php the_permalink(); ?>">
													<div>
														<div class="resource-card__image">
															<?php $guide_cover_image = get_field( 'guide_cover_image' );
															if ( $guide_cover_image ) {
																echo wp_get_attachment_image( $guide_cover_image, 'large' );
															} else { ?>
																<img src="<?php echo get_template_directory_uri(); ?>/library/images/guide-placeholder.svg" width="300" height="157">
															<?php } ?>
														</div>
														<div class="resource-card__copy">
															<h2 class="h4 resource-card__title"><?php the_title(); ?></h2>
															<?php $infographic_summary = get_field( 'resource_summary' );
															if ( $infographic_summary ) { ?>
																<p><?php the_field( 'resource_summary' ); ?></p>
															<?php } ?>
														</div>
													</div>
													<span class="resource-card__action">Find Out More →</span>
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
