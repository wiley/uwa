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

function buildDegressArray($degrees) {
  foreach ( $degrees as $post ) {
    $array = array();
    $degreeAreas = get_the_terms( $post->ID, 'degree_vertical') ? get_the_terms( $post->ID, 'degree_vertical') : $array;
    $degreeLevels = get_the_terms( $post->ID, 'degree_level') ? get_the_terms( $post->ID, 'degree_level') : $array;

    $post->degree_areas = $degreeAreas;
    $post->degree_levels = $degreeLevels;
  }
  return $degrees;
}

function buildDegreeLevels($degreeLevels) {
  foreach ( $degreeLevels as $term ) {
    $array = array();
    $term_id = $term->term_id;
    $id = 'term_' . $term_id;
    $displayOrder = get_field('menu_order', $id) ?  get_field('menu_order', $id) : '0';
    $term->display_order = $displayOrder;
  }
  return $degreeLevels;
}

add_action( 'wp_enqueue_scripts', 'add_localized_js_data' );
function add_localized_js_data() {
  wp_enqueue_script( 'degree-filtering', 'data for vue degree filtering', array() );

  $degreeAreas = get_terms([
	    'taxonomy' => 'degree_vertical',
	    'hide_empty' => false,

	]);

	$degreeLevels = get_terms([
	    'taxonomy'     => 'degree_level',
	    'hide_empty'   => false,
      'meta_key'		 => 'menu_order',
    	'orderby'			 => 'meta_value',
    	'order'				 => 'ASC'
	]);

  $allDegreesArgs = array(
		 'posts_per_page' => -1,
		 'orderby' => 'title',
		 'order'   => 'ASC',
		 'post_type' => 'degrees',
		 'post_status' => 'publish',
	);

	$allDegrees = get_posts( $allDegreesArgs );
  // $degree_areas = get_field('degree_vertical_filters_test', 201);

  $data = array(
    'degrees' => buildDegressArray($allDegrees),
    'degreeAreas' => $degreeAreas,
    'degreeLevels' => $degreeLevels
    );

  wp_localize_script( 'degree-filtering', 'wpData', $data );

}

?>
