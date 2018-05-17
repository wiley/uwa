<?php get_header(); ?>
<?php
	global $post;
	// $args = array(
	// 		'post_parent' => $post->ID,
	// 		'post_type' => 'page'
	// );
	// $subpages = new WP_query($args);
	// var_dump($subpages);
	// print("<pre>".print_r($post,true)."</pre>");
?>
			<div class="content">
				<main class="main-content cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
					<div class="wrap cf">
						<div class="resources-wrapper">
							<div class="resources-overview">
								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									<?php the_content(); ?>
								<?php endwhile; endif; ?>
							</div>
							<div class="resources-list">
								<ul class="tile-list tile-list--large">
									<li>
										<div class="card">
											<div class="card__copy">
												<h2 class="card__title">Career Outcomes</h2>
												<p>Explore potential career paths. Whether you’re just starting out or looking to change careers, discover your options.</p>
											</div>
											<a class="card__action btn" href="/career-outcomes">View Career Outcomes</a>
										</div>
									</li>
									<li>
										<div class="card">
											<div class="card__copy">
												<h2 class="card__title">Program Resources</h2>
												<p>Here’s what you need to know about the program that you have chosen.</p>
											</div>
											<a class="card__action btn" href="/program-resources">View Program Resources</a>
										</div>
									</li>
									<li>
										<div class="card">
											<div class="card__copy">
												<h2 class="card__title">News</h2>
												<p>Make sure you’re keeping current with your major. Read the latest news about your program and career path.</p>
											</div>
											<a class="card__action btn" href="/news">View News Posts</a>
										</div>
									</li>
									<li>
										<div class="card">
											<div class="card__copy">
												<h2 class="card__title">Counseling Career Paths</h2>
												<p>This multimedia guide will dive into counseling career paths including school counselors, family and marriage counselors, and mental health counselors. It will cover the types of populations helped by each (age/demographic/challenges), where they practice, skills and motivations, and specific responsibilities and nuances for each role.</p>
											</div>
											<a class="card__action btn" href="/guides/rn-specialization/">View Guide</a>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</main>
				<?php include('includes/waiting.php'); ?>
			</div>

<?php get_footer(); ?>
