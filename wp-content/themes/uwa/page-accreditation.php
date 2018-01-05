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

				<div class="wrap cf">

<?php
// $menuLocations = get_nav_menu_locations();
//
// $menuID = $menuLocations['main-nav'];
//
// $primaryNav = wp_get_nav_menu_items($menuID);

// foreach ( $primaryNav as $navItem ) {
// 	if ($navItem->post_parent == $post->ID) {
// 		// print("<pre>".print_r($navItem,true)."</pre>");
// 		echo '<li><a href="'.$navItem->url.'" title="'.$navItem->title.'">'.$navItem->title.'</a></li>';
// 	} else {
// 		echo 'NO SIBLINGS';
// 	}
// }
?>

					<main class="main-content cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						<div class="intro">

						<?php include('includes/subNav.php'); ?>

						<p class="intro_headline">
							<?php if (get_field('intro_headline')): ?>
								<?php the_field('intro_headline') ?>
							<?php endif; ?>
						</p>
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
								<ul class="accreditationList">
								 	<li>
										<div class="accreditationList__text">The University of West Alabama is accredited by the Southern Association of Colleges and Schools Commission on Colleges to award bachelor’s, master’s and education specialist degrees. Contact the Commission on Colleges at 1866 Southern Lane, Decatur, Georgia 30033-4097 or call 404-679-4500 for questions about the accreditation of the University of West Alabama.</div>
										<a class="accreditationList__link" title="SACS Link" href="http://www.sacs.org" target="_blank" rel="nofollow noopener"><img class="alignleft size-full wp-image-696" src="http://onlineuwa.staging.wpengine.com/wp-content/uploads/2017/07/1.png" alt="" width="158" height="160" /></a>
									</li>
								 	<li>
										<div class="accreditationList__text">All educator certification programs are approved by the Alabama State Department of Education (ALSDE).</div><a class="accreditationList__link" title="SACS Link" href="http://www.sacs.org" target="_blank" rel="nofollow noopener"><img class="alignleft size-full wp-image-697" src="http://onlineuwa.staging.wpengine.com/wp-content/uploads/2017/07/2.png" alt="" width="86" height="80" /></a>
									</li>
								 	<li>
										<div class="accreditationList__text">All educator certification programs are accredited by the National Council for Accreditation of Teacher Education (NCATE). This accreditation covers initial educator preparation programs and advanced educator preparation programs. NCATE is recognized by the U.S. Department of Education and the Council for Higher Education Accreditation to accredit programs for the preparation of educators and other professional school personnel.</div><a class="accreditationList__link" href="http://www.ncate.org" target="_blank" rel="nofollow noopener"><img class="alignleft wp-image-698 size-full" src="http://onlineuwa.staging.wpengine.com/wp-content/uploads/2017/07/ncate.png" alt="Accreditation Logo" width="156" height="130" /></a>
									</li>
								 	<li>
										<div class="accreditationList__text">The University of West Alabama education department is accredited by the Council for Accreditation of Educator Preparation (CAEP).</div>
										<a class="accreditationList__link" title="External link to CAEP website" href="http://caepnet.org/about/vision-mission-goals" target="_blank" rel="nofollow noopener"><img class="alignleft wp-image-699 size-full" src="http://onlineuwa.staging.wpengine.com/wp-content/uploads/2017/07/caep.png" alt="" width="512" height="351" /></a>
									</li>
								 	<li>
										<div class="accreditationList__text">The University’s College of Business and Technology is nationally accredited by the Accreditation Council for Business Schools and Programs (ACBSP) to offer the following degrees: the Master of Business Administration and the Bachelor of Business Administration degree in Accounting, Business Administration, Management and Marketing. The following College of Business and Technology degree is not accredited by ACBSP: the Bachelor of Science in Technology.</div>
										<a class="accreditationList__link" href="https://www.acbsp.org/" target="_blank" rel="nofollow noopener"><img class="alignleft wp-image-700 size-full" src="http://onlineuwa.staging.wpengine.com/wp-content/uploads/2017/07/acbsp.png" alt="Accreditation Logo" width="440" height="499" /></a>
									</li>
								</ul>
							<?php endwhile; endif; ?>
						</div>

					</main>

				</div>
				<?php include('includes/waiting.php'); ?>

			</div>

<?php get_footer(); ?>
