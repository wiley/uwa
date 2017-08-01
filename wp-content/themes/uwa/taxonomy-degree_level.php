<?php get_header(); ?>


			<div class="content">

				<div class="wrap cf">

						<main class="main-content cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<!-- <?php
							the_archive_title( '<h1 class="archive-title">', '</h1>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
							?> -->
							<div class="degreeLevel__flexWrapper">
								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>




			  						    <div class="cardLinkWrapper item">
													<a class="card" style="background-image: url(<?php the_field('program_image'); ?>);" href="<?php the_permalink(); ?>">
														<div class="card__infoWrapper">

															<h4 class="card__title"><?php the_title(); ?></h4>

															<!-- <div class="card__info">More Information &gt;&gt;</div> -->
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
