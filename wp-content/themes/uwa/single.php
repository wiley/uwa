<?php get_header(); ?>

			<div class="content">

				<div class="wrap cf">

					<div class="content__innerWrapper">
						<main class="main-content cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<article <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

								  <section class="post-content cf" itemprop="articleBody">
								    <?php the_content(); ?>
								  </section> <?php // end article section ?>

								</article> <?php // end article ?>

							<?php endwhile; ?>

							<?php else : ?>

								<article class="post-not-found hentry cf">
										<header class="post-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="post-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="post-footer">
												<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
										</footer>
								</article>

							<?php endif; ?>
						</main>
						<aside>
							<div class="sidebar--singlePost cf" role="complementary">

								<div class="formWrapper">
									<h2 class="h3 formWrapper__heading">Request Your Info Packet</h2>
									<div id="tlh-form"></div>
								</div>

						<?php dynamic_sidebar( 'Sidebar Blog' ); ?>
								<?php
									if ( is_active_sidebar( 'sidebar1' ) ) :
										dynamic_sidebar( 'sidebar1' );
									endif;
								?>

							</div>

						</aside>
						</div>
				</div>

			</div>

            <script>
					 // Progess Indicator for Blog Posts
           // Load document before calculating window height
            $(document).on('ready', function() {
              var winHeight = $(window).height(),
                  docHeight = $(document).height(),
                  progressBar = $('progress'),
                  max, value;

              /* Set the max scrollable area */
              max = docHeight - winHeight;
              progressBar.attr('max', max);

              console.log(docHeight);
              console.log(winHeight);

              $(document).on('scroll', function(){
                 value = $(window).scrollTop();
                 progressBar.attr('value', value);
              });
            });
            </script>

<?php get_footer(); ?>
