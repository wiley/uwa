<?php get_header(); ?>
<?php
	global $post;
	// $args = array(
	// 		'post_parent' => $post->ID,
	// 		'post_type' => 'page'
	// );
	// $subpages = new WP_query($args);
	// var_dump($subpages);
// ?>




				<div class="wrap cf">

						<main class="main-content cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<div class="intro">
								<?php include('includes/subNav.php'); ?>


								<?php 

								$title = "Scholarships and Partnerships at the University of West Alabama" ;
								$content = "The University of West Alabama is dedicated to making education as affordable as possible. Each program is competitively priced, and 80 percent of students receive some type of financial aid. Students also use available grants, scholarships, loans and more." ;
								$content_2 = "Here are some exciting scholarship and partnership opportunities at UWA." ;


								$title = get_field('snp_info_title') ? get_field('snp_info_title') : $title ;

								$content = get_field('snp_info_description') ? get_field('snp_info_description') : '<p>' . $content . '</p>' ;

								$content_2 = get_field('snp_info_description') ? null : '<p>' . $content_2 . '</p>' ;


								?>

						        <p class="intro__headline"> <?php echo $title ; ?> </p>
								<?php echo $content ; ?>

								<?php echo $content_2 ; ?>


								<ul class="scholarships-partnerships__list">

								<?php

								if( have_rows('snp_list_item_repeater') ): // If Repeater has content

								    while( have_rows('snp_list_item_repeater') ) : the_row();
								
								        $sub_value = get_sub_field('sub_field');

										$link = get_sub_field('button');

								        ?>

								        <li class="scholarships-partnerships__item">
											<div class="scholarships-partnerships__contentWrapper">
												<h2 class="scholarships-partnerships__heading"> <?php echo get_sub_field('title') ; ?> </h2>
												<span class="scholarships-partnerships__content"> <?php echo get_sub_field('content', false, false) ; ?> </span>
											</div>

											<?php

											if( $link ): 
												$link_url = $link['url'];
												$link_title = $link['title'];
												$link_target = $link['target'] ? $link['target'] : '_self';

												?>

												<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="scholarships-partnerships__btn btn"> <?php echo esc_html( $link_title ); ?> </a>

												<?php 

											endif; 
											
											?>

										</li>

										<?php

								    endwhile;
								
								else :	// If using fallback content
								?>

									<li class="scholarships-partnerships__item">
										<div class="scholarships-partnerships__contentWrapper">
											<h2 class="scholarships-partnerships__heading">Teacher Connect</h2>
											<span class="scholarships-partnerships__content">The <span class="bold">Teacher Connect Scholarship </span>program at UWA partners with school systems to help teachers and aspiring teachers complete education degrees online while qualifying for a tuition scholarship of up to $50 per credit hour. It can be applied to all 35 online education programs for certification (undergraduate and graduate level) at UWA.</span>
										</div>
										<a href="/tuition/scholarships-partnerships/teacher-connect/" class="scholarships-partnerships__btn btn">Learn More</a>
									</li>
									<li class="scholarships-partnerships__item">
										<div class="scholarships-partnerships__contentWrapper">
											<h2 class="scholarships-partnerships__heading">Military Connect</h2>
											<span class="scholarships-partnerships__content">The <span class="bold">Military Connect </span>program at UWA helps <span class="bold">active military members, veterans, spouses and dependents </span>complete their degrees online while qualifying for a <span class="bold">tuition scholarship of up to $100 per credit hour</span>. After the scholarship, tuition equals $329 per credit hour for graduate programs and $275 per credit hour for undergraduate programs. The scholarship is available to students who qualify for the Air University Associate-to-Baccalaureate Cooperative program.</span>
										</div>
										<a href="/tuition/scholarships-partnerships/military-connect/" class="scholarships-partnerships__btn btn">Learn More</a>
									</li>
									<li class="scholarships-partnerships__item">
										<div class="scholarships-partnerships__contentWrapper">
											<h2 class="scholarships-partnerships__heading">Business Connect</h2>
											<span class="scholarships-partnerships__content">The <span class="bold">Business Connect </span>program enables employees at partner companies to receive a scholarship worth<span> $50 per credit hour </span>for graduate or undergraduate degree programs at UWA. This amounts to a $1,500 savings over the course of a typical 30-credit graduate degree or more than $6,000 for a 120-credit undergraduate degree.</span>
											<a href="/tuition/scholarships-partnerships/business-connect/" class="scholarships-partnerships__btn btn">Learn More</a>
										</div>
									</li>
									<li class="scholarships-partnerships__item">
										<div class="scholarships-partnerships__contentWrapper">
											<h2 class="scholarships-partnerships__heading">Community College Connect</h2>
											<span class="scholarships-partnerships__content">The <span class="bold">Community College Connect Scholarship </span>allows students who transfer an associate degree from any partnered community college to earn a scholarship for up to $1,500 at UWA. It will be distributed to your online bachelor’s degree program at $50 per credit hour for the first 30 consecutive credits.</span>
										</div>
										<a href="/tuition/scholarships-partnerships/alabama-transfer/" class="scholarships-partnerships__btn btn">Learn More</a>
									</li>
									<li class="scholarships-partnerships__item">
										<div class="scholarships-partnerships__contentWrapper">
											<h2 class="scholarships-partnerships__heading">Black Belt Teacher Corps Teach for Alabama</h2>
											<span class="scholarships-partnerships__content">The <span class="bold">Black Belt Teacher Corps Teach for Alabama scholarship</span> program helps junior and senior education majors qualify for up to $10,000 in savings while pursuing degree programs that provide initial teacher certification. The BBTC program is designed to supply designated Alabama public school districts with well-qualified teachers for each classroom. Scholarship recipients complete service teaching in Alabama public schools located in the Black Belt region, designated as rural schools or considered high-needs schools.</span>
										</div>
										<a target="_blank" href="/tuition/scholarships-partnerships/bbtc-scholarship/" class="scholarships-partnerships__btn btn">Learn More</a>
									</li> 

								<?php
								endif;

								?>

								</ul>
   

				      </div>

						</main>
				</div>
				<?php include('includes/waiting.php'); ?>
			</div>

<?php get_footer(); ?>
