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

							<?php
								$hasSiblingPages = get_pages(array(
										'child_of' => $post->post_parent,
										'title_li' => ''
										// 'exclude' => $post->ID
								));
							?>

							<?php if ($hasSiblingPages && $post->post_parent != 0): ?>
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
							<?php else: ?>
								<div class="intro__breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
									<?php if(function_exists('bcn_display'))
									{
											bcn_display();
									}?>
								</div>
							<?php endif; ?>



						<p class="intro_headline">
							<?php if (get_field('intro_headline')): ?>
								<?php the_field('intro_headline') ?>
							<?php endif; ?>
						</p>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; endif; ?>
							<div class="formWrapper">
								<h2 class="h3 form__header">Request Info</h2>
								<script src="http://requestforms.learninghouse.com/form/show/university-west-alabama/olc/734/3589/online.uwa.edu:thank-you:request_id" type="text/javascript"></script>
							</div>
						</div>

					</main>




				</div>
				<?php include('includes/waiting.php'); ?>

			</div>

<?php get_footer(); ?>
