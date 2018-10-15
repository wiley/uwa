<?php get_header(); ?>
<?php global $post; ?>

			<div class="content">

				<div class="wrap cf">

						<main class="main-content cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<div class="intro">
				        <div class="intro__subNav" typeof="BreadcrumbList" vocab="https://schema.org/">
									<ul class="subpagesNav">
										<?php
										$subpageNav = wp_list_pages(array(
										    'child_of' => $post->post_parent,
												'title_li' => ''
										    // 'exclude' => $post->ID
										))
										?>
									</ul>
				        </div>
								<div class="intro__main-wrapper">
									<div class="intro__content">
										<p class="intro__headline">Applying to an online program at the University of West Alabama is simple.</p>
										<a target="_blank" href="https://www.gowest-alabama.org/freshman/get-started.htm" class="btn">Start your online application today</a>
										<p>You will be asked to create a username and password during this process. If you don’t complete your application immediately, the application system will be able to locate your application when you’re ready to complete it.</p>
										<p>Once your application has been received, you will be contacted by an enrollment counselor, who will help you with application documents and transfer credits.</p>
										<p>Due to state authorization requirements, we are unable to accept applications from persons who reside in CA, MA, and PR for our online programs.</p>
									</div>
									<div class="intro__form">
										<div class="formWrapper">
											<h2 class="h3 form__header">Request Info</h2>
											<script src="https://requestforms.learninghouse.com/form/show/university-west-alabama/olc/734/3589/online.uwa.edu:thank-you:request_id" type="text/javascript"></script>
										</div>
									</div>
								</div>
				      </div>

						</main>
				</div>
				<?php include('includes/waiting.php'); ?>
			</div>

<?php get_footer(); ?>
