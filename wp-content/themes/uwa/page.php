<?php get_header(); ?>
<?php
	global $post;
	// $args = array(
	// 		'post_parent' => $post->ID,
	// 		'post_type' => 'page'
	// );
	// $subpages = new WP_query($args);
	// var_dump($subpages);
?>
			<div class="content">

				<div class="wrap cf">


<?php

$menuLocations = get_nav_menu_locations(); // Get our nav locations (set in our theme, usually functions.php)
                                           // This returns an array of menu locations ([LOCATION_NAME] = MENU_ID);

$menuID = $menuLocations['main-nav']; // Get the *primary* menu ID

$primaryNav = wp_get_nav_menu_items($menuID);

foreach ( $primaryNav as $navItem ) {
	if ($navItem->post_parent == 215) {
		# code...
		// print_r($navItem);
		echo '<li><a href="'.$navItem->url.'" title="'.$navItem->title.'">'.$navItem->title.'</a></li>';

	}


}
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
						</div>

					</main>



				</div>
				<?php include('includes/waiting.php'); ?>

			</div>

<?php get_footer(); ?>
