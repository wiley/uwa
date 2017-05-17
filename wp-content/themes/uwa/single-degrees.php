<?php get_header(); ?>

			<div class="content">

				<!-- <div class="wrap cf"> -->

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
									<div class="accreditations">
										<img src="/wp-content/themes/uwa/library/images/accreditations/1.png" alt="accreditation logo">
										<img src="/wp-content/themes/uwa/library/images/accreditations/2.png" alt="accreditation logo">
										<img src="/wp-content/themes/uwa/library/images/accreditations/3.png" alt="accreditation logo">
									</div>
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
