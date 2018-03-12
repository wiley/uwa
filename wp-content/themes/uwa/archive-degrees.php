<?php get_header(); ?>
<style media="screen">
	.filter.active {
		background: #A81D32;
    color: white;
    font-weight: 900;
	}
</style>

<?php
	$degreeTypes = get_terms([
	    'taxonomy' => 'degree_vertical',
	    'hide_empty' => false,
	]);

	$degreeLevels = get_terms([
	    'taxonomy' => 'degree_level',
	    'hide_empty' => false,
	]);
?>

<?php
	function setFilterOrder($term1, $term2) {
	        if ($term1->display_order == $term2->display_order) {
	            return 0;
	        } elseif ($term1->display_order < $term2->display_order) {
	            return -1;
	        } else {
	            return 1;
	        }
	    }

	if ($degreeLevels) {
	    foreach ($degreeLevels as $index => $term) {
				$termID = 'term_' . $term->term_id;
				$menuOrderValue = get_field('menu_order', $termID);
				$degreeLevels[$index]->display_order = $menuOrderValue;
	    }
	    usort($degreeLevels, 'setDisplayOrder');
	}
?>

<?php
	$allDegreesArgs = array(
		 'posts_per_page' => -1,
		 'orderby' => 'title',
		 'order'   => 'ASC',
		 'post_type' => 'degrees',
		 'post_status' => 'publish',
	);
	$allDegrees = get_posts( $allDegreesArgs );
?>


	<!-- <main> -->

		<div id="app">
			<degrees-app></degrees-app>
		</div>

	<!-- </main> -->

<?php get_footer(); ?>
