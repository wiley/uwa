<?php get_header(); ?>

			<div class="content">

				<!-- <div class="wrap cf"> -->
<?php global $post; ?>
<?php

$terms = get_the_terms( $post->ID, 'degree_level');
$termArray = $terms[0];

$ID = $termArray->term_id;

$acfTerm = 'term_' . $ID;
// if (is_array($terms)):
// 	foreach($terms as $term):
// 		// print_r($term->slug);
// 	endforeach;
// endif;
?>
<?php the_field('main_image', $acfTerm); ?>
						<main class="main-content cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if ( function_exists('yoast_breadcrumb') ) {
									yoast_breadcrumb('<p class="breadcrumbs">','</p>');
							} ?>
						<div class="wrap cf">
							<div class="program__flexWrapper">

								<div class="program__main">
									<span class="program__badge">Online Master of Education Degree</span>
									<h1 class="program__title"><?php the_title(); ?></h1>
									<p class="program__subtitle">Make a Difference in the Lives of Young Children</p>
									<?php include ('includes/singleDegrees/accreditations.php'); ?>

									<?php include ('includes/singleDegrees/degreeOverview.php'); ?>
									<?php include ('includes/singleDegrees/who.php'); ?>
								</div>
								<?php include ('includes/singleDegrees/programDetails.php'); ?>
							</div>
						</div>

							<?php include ('includes/singleDegrees/infoTabs.php'); ?>
							<?php include ('includes/singleDegrees/waiting.php'); ?>
							<?php include ('includes/singleDegrees/relatedDegrees.php'); ?>
						</main>
				<!-- </div> -->

			</div>

			<div class="form__wrapper">
				<div class="form__innerwrapper">
					<div class="focusguard-top" tabindex="0" aria-hidden="true"></div>
					<button class="form__toggle" aria-label="Close Form Window" type="button" name="closeForm"><?php include ('library/images/close-form-button.svg'); ?></button>
					<h4 class="form__heading">Request Info</h4>
	        <script src="http://requestforms.learninghouse.com/form/show/university-west-alabama/olc/734/3589/online.uwa.edu:my:thank-you:request_id" type="text/javascript"></script>
				</div>
			</div>
<?php get_footer(); ?>
