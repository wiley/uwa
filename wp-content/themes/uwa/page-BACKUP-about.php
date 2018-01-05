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
								<?php the_content(); ?>
							<?php endwhile; endif; ?>
						</div>

					</main>



				</div>
				<?php include('includes/waiting.php'); ?>

			</div>

<?php get_footer(); ?>
