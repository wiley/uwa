<?php get_header(); ?>

			<div class="content">

						<main class="main-content cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">


							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<?php $featuredImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

							<article <?php post_class( 'cf' ); ?> role="article">
								<a href="<?php the_permalink(); ?>" class="article__link">
									<div class="background" style="background-image: url(<?php echo $featuredImage; ?>)"></div>
										<div class="wrap post-header__wrapper cf">
											<h2 class="h2 post-header__title"><?php the_title(); ?></h2>
											<p class="post-meta">
                        <?php printf( __( 'Posted', 'bonestheme' ).' %1$s %2$s',
                        /* the time the post was published */
                        '<time class="post-meta__time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
                        /* the author of the post */
                        '<span class="post-meta__by">'.__( 'by', 'bonestheme').'</span> <span class="post-meta__author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
                        ); ?>
											</p>
										</div>
									</a>




							</article>

							<?php endwhile; ?>

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

<?php get_footer(); ?>
