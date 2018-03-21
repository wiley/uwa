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
