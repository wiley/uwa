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
									<?php 
									$content = get_post()->post_content;
									if(!empty($content)):
										if (have_posts()) : while (have_posts()) : the_post();
											the_content();										
											endwhile; 
										endif;
									else: ?>
									<ul class="accreditationList">
											<li>
												<div class="accreditationList__text">The University of West Alabama is accredited by the Southern Association of Colleges and Schools Commission on Colleges to award bachelor’s, master’s and education specialist degrees. Contact the Commission on Colleges at 1866 Southern Lane, Decatur, Georgia 30033-4097 or call 404-679-4500 for questions about the accreditation of the University of West Alabama.</div>
												<a class="accreditationList__link" title="SACS Link" href="http://www.sacs.org" target="_blank" rel="nofollow noopener"><img class="alignleft size-full wp-image-696" src="/wp-content/uploads/2017/07/1.png" alt="" width="158" height="160" /></a>
											</li>
											<li>
												<div class="accreditationList__text">All educator certification programs are approved by the Alabama State Department of Education (ALSDE).</div><a class="accreditationList__link" title="SACS Link" href="http://www.sacs.org" target="_blank" rel="nofollow noopener"><img class="alignleft size-full wp-image-697" src="/wp-content/uploads/2017/07/2.png" alt="" width="86" height="80" /></a>
											</li>
											<li>
												<div class="accreditationList__text">All educator certification programs are accredited by the Council for Accreditation of Educator Preparation (CAEP). This accreditation covers initial educator preparation programs and advanced educator preparation programs. CAEP is recognized by the U.S. Department of Education and the Council for Higher Education Accreditation to accredit programs for the preparation of educators and other professional school personnel.</div>
												<a class="accreditationList__link" title="External link to CAEP website" href="http://caepnet.org/about/vision-mission-goals" target="_blank" rel="nofollow noopener"><img class="alignleft wp-image-699 size-full" src="/wp-content/uploads/2017/07/caep.png" alt="" width="512" height="351" /></a>
											</li>
										</ul>
									<?php endif; ?>
								</div>
								<div class="intro__form">
									<div class="formWrapper">
										<h2 class="h3 form__header">Request Info</h2>
										<p>Submit your information to be contacted by phone/email.</p>
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
