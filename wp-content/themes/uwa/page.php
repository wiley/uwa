<?php get_header(); ?>
<?php
	global $post;
	// $args = array(
	// 		'post_parent' => $post->ID,
	// 		'post_type' => 'page'
	// );
	// $subpages = new WP_query($args);
	// var_dump($subpages);
?>
			<div class="content">

				<div class="wrap cf">

					<main class="main-content cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<div class="intro">
							<div class="intro__breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
			          <?php if(function_exists('bcn_display'))
			          {
			              bcn_display();
			          }?>
			        </div>

						<p class="intro_headline">
							<?php if (get_field('intro_headline')): ?>
								<?php the_field('intro_headline') ?>
							<?php endif; ?>
						</p>
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; endif; ?>
						</div>

					</main>



				</div>
				<?php include('includes/waiting.php'); ?>

			</div>

<?php get_footer(); ?>
