<?php /* Template Name: Scholarship/Partnership Template */?>

<?php get_header(); ?>
<style media="screen">
.accreditations img {
	height: 80px;
	margin: .5em;
}
.page-template-scholarship-partnership-single-template .benefits {
	margin-bottom: 0;
}

.page-template-scholarship-partnership-single-template .accordion .accord-content {
	padding: 1em;
}

form {
	padding: 1em;
}
.legal-text {
	color: white !important;
}
</style>
			<div class="content">
				<main class="main-content cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

					<?php if ( function_exists('yoast_breadcrumb') ) {
							yoast_breadcrumb('<p class="breadcrumbs">','</p>');
					} ?>
				<div class="wrap cf">
					<div class="page__flexWrapper">

						<div class="page__main">
							<div class="page__top">
								<p class="page__subtitle">
									<?php if (get_field('content_heading')): ?>
										<h2 class="page__title"><?php the_field('content_heading'); ?></h2>
									<?php endif; ?>
								</p>
								<div class="accreditations">
									<img src="/wp-content/themes/uwa/library/images/accreditations/1.png" alt="">
									<img src="/wp-content/themes/uwa/library/images/accreditations/2.png" alt="">
									<img src="/wp-content/themes/uwa/library/images/accreditations/ncate.png" alt="">
								</div>
							</div>
							<div class="mobileOnly">
								<div class="decorativeForm formWrapper">
									<div class="decorativeForm__header">
										<div class="arrow-right"></div>
										<div class="arrow-left"></div>
										<h3 class="decorativeForm__heading decorative decorative_red">Request Info</h3>
										<p class="decorativeForm__prompt">What degree are you interested in?</p>
									</div>
									<div id="tlh-form-mobile"></div>
								</div>
							</div>
							<?php if (get_field('content_text')): ?>
								<?php the_field('content_text'); ?>
							<?php endif; ?>
							<div class="scholarshipDetails">
								<h3>Scholarship Details</h3>
								<div class="accordion">
									<?php if( have_rows('scholarship_details_accordion') ): $i = 0;?>

		              <?php while ( have_rows('scholarship_details_accordion') ) : the_row(); $i++; ?>

		                <div class="accord">

		                  <h4 class="accord-header">
		                    <button aria-controls="content-<?php echo $i; ?>" aria-expanded="false">
		                      <?php the_sub_field('accordion_header'); ?>
		                      <div class="iconsWrapper">
		                        <span class="plus"><?php include ( 'library/images/icon-plus.svg'); ?></span>
		                        <span class="minus"><?php include ( 'library/images/icon-minus.svg'); ?></span>
		                      </div>
		                    </button>
		                  </h4>
		                  <div id="content-<?php echo $i; ?>" class="accord-content" aria-hidden="true"><?php the_sub_field('accordion_content'); ?></div>
		                  <span class="accord-trigger" aria-hidden="true"></span>
		                </div>

		              <?php endwhile; ?>
									<?php endif; ?>

		            </div>
							</div>

							<section class="benefits cf">
								<div class="wrap">
									<h2 class="decorative decorative_red_dark">Benefits of Attending UWA Online:</h2>
									<ul>
										<li>
											<h3>CONVENIENCE</h3>
											<p>Earn an online degree on your schedule with personal support from application to graduation</p>
										</li>
										<li>
											<h3>COMPETITIVE TUITION</h3>
											<p>Join the 80 percent of UWA students who receive some type of financial aid</p>
										</li>
										<li>
											<h3>EASY CREDIT TRANSFER</h3>
											<p>Benefit from UWA’s generous credit transfer policy</p>
										</li>
										<li>
											<h3>EXPERT FACULTY</h3>
											<p>Study from scholars and practitioners to build the skills and knowledge you need to succeed</p>
										</li>
									</ul>
								</div>


							</section>
						</div>

						<div class="page__side">
							<div class="decorativeForm formWrapper">
								<div class="decorativeForm__header">
									<div class="arrow-right"></div>
									<div class="arrow-left"></div>
									<h3 class="decorativeForm__heading decorative decorative_red">Request Info</h3>
									<p class="decorativeForm__prompt">What degree are you interested in?</p>
								</div>

								<div id="tlh-form"></div>
							</div>

	<!-- <?php if (is_page('Teacher Connect')): ?>
<div class="scholarship-banner"><img class="aligncenter wp-image-1367 size-full" src="/wp-content/uploads/2019/04/TC-scholarship-graphic-UWA.png" alt="" width="600" height="200" srcset="/wp-content/uploads/2019/04/TC-scholarship-graphic-UWA.png 600w, /wp-content/uploads/2019/04/TC-scholarship-graphic-UWA-300x100.png 300w" sizes="(max-width: 600px) 100vw, 600px"></div>
	<?php endif; ?> -->

						</div>

					</div>
				</div>

				</main>

				</div>
							<?php include ('includes/singleDegrees/waiting.php'); ?>

			</div>

<?php get_footer(); ?>
<script>
	tlhFormLoader('tlh-form-mobile')
</script>
