<?php get_header(); ?>

<?php $termID = 'term_' . get_queried_object()->term_id; ?>


			<div class="content">

				<div class="wrap cf">

						<main class="main-content cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
							<?php if (get_field('degree_level_description', $termID)): ?>
								<p><?php the_field('degree_level_description', $termID); ?></p>
							<?php endif; ?>

							<!-- <?php
							the_archive_title( '<h1 class="archive-title">', '</h1>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
							?> -->
							<div class="degreeLevel__flexWrapper">
								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						    <div class="cardLinkWrapper item">
									<a style="background-image: url(<?php the_field('program_image'); ?>);" class="mix card <?php echo custom_taxonomies_terms_slugs(); ?>" href="<?php the_permalink(); ?>">
									  <div class="card__infoWrapper">
									    <?php if (!empty( $terms )): ?>
									    <?php endif; ?>
									    <h3 class="card__title"><?php the_title(); ?></h3>

									    <div class="card__info">More Information <?php include('library/images/arrow.svg'); ?></div>
									    <div class="cardLink__cta-background"></div>
									  </div>
									</a>
						    </div>

								<?php endwhile; ?>
							</div>
									<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="post-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="post-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="post-footer">
												<p><?php _e( 'This is the error message in the archive.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</main>



				</div>

			</div>

<?php get_footer(); ?>
