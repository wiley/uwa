<?php get_header(); ?>

			<div class="content">

				<!-- <div class="wrap cf"> -->

<?php global $post; ?>
<?php
	$terms = get_the_terms( $post->ID, 'degree_level');
	$termArray = $terms[0];
	$ID = $termArray->term_id;
	$acfTerm = 'term_' . $ID;
	$post_id = $post->ID;
?>

						<main class="main-content cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if ( function_exists('yoast_breadcrumb') ) {
									yoast_breadcrumb('<p class="breadcrumbs">','</p>');
							} ?>
						<div class="wrap cf">
							<div class="program__flexWrapper">

								<div class="program__main">
									<div class="program__top">

										<?php if (get_field('program_badge_selection')): ?>
											<span class="program__badge"><?php the_field('program_badge_selection'); ?></span>
										<?php endif; ?>

										<h1 class="program__title"><?php the_title(); ?></h1>
										<p class="program__subtitle">
											<?php if ( get_field('show_alabama_certification_info') ): ?>
												<?php $certification = get_field('alabama_teaching_certification'); ?>

													<?php if ($certification === 'Yes'): ?>
														<?php echo 'Certification'; ?>
													<?php else: ?>
														<?php echo 'Non-Certification'; ?>
													<?php endif; ?>

											<?php elseif ( get_field('program_subtitle') ): ?>
												<?php the_field('program_subtitle'); ?>
											<?php endif; ?>
										</p>

										<?php include ('includes/singleDegrees/accreditations.php'); ?>
									</div>

									<div class="mobileOnly">
										<?php include ('includes/singleDegrees/programDetails.php'); ?>
									</div>

									<?php if (get_field('overview_info')): ?>
											<?php include ('includes/singleDegrees/degreeOverview.php'); ?>
									<?php endif; ?>

									<?php include ('includes/singleDegrees/who.php'); ?>
								</div>
								<?php include ('includes/singleDegrees/programDetails.php'); ?>

							</div>
						</div>

							<?php include ('includes/singleDegrees/infoTabs.php'); ?>
							<?php include ('includes/singleDegrees/waiting.php'); ?>
							<?php if( is_single(array(1128, 1417)) ): ?>
							<?php include ('includes/singleDegrees/oer.php'); ?>
							<?php endif; ?>
							<?php include ('includes/singleDegrees/relatedDegrees.php'); ?>
						</main>
				<!-- </div> -->

			</div>
			<div class="form__wrapper">
				<div class="form__innerwrapper">
					<div class="focusguard-top" tabindex="0" aria-hidden="true"></div>
					<button class="form__toggle" aria-label="Close Form Window" type="button" name="closeForm"></button>
					<h4 class="form__heading">Request Info</h4>
	        <script src="https://requestforms.learninghouse.com/form/show/university-west-alabama/olc/734/3589/online.uwa.edu:my:thank-you:request_id" type="text/javascript"></script>
				</div>
			</div>
<?php get_footer(); ?>
