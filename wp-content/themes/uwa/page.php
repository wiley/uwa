<?php get_header(); ?>
<?php global $post; ?>
			<div class="content">

				<div class="wrap cf">

					<main class="main-content cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						<div class="intro">

						<?php include('includes/subNav.php'); ?>
						<div class="intro__main-wrapper">
							<div class="intro__content">
								<p class="intro_headline">
									<?php if (get_field('intro_headline')): ?>
										<?php the_field('intro_headline') ?>
									<?php endif; ?>
								</p>
								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									<?php the_content(); ?>
								<?php endwhile; endif; ?>
							</div>
							<div class="intro__form">
								<div class="formWrapper">
									<h2 class="h3 form__header">Request Info</h2>
									<div id="tlh-form"></div>
								</div>
							</div>
						</div>


						</div>

					</main>

				</div>
				<?php include('includes/waiting.php'); ?>

			</div>

<?php get_footer(); ?>
