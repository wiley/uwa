<?php

/*********************
WP_HEAD GOODNESS
 *********************/
function setFilterOrder($term1, $term2)
{
	if ($term1->display_order == $term2->display_order) {
		return 0;
	} elseif ($term1->display_order < $term2->display_order) {
		return -1;
	} else {
		return 1;
	}
}

function buildDegreeAreas($filterArray)
{
	$degreeFilterArray = array();

	foreach ($filterArray as $filter) {
		if (!$filter->parent) {
			$degreeFilterArray[] = $filter;
		}
	}

	foreach ($degreeFilterArray as $term) {
		$term_id = $term->term_id;
		$taxonomy_name = $term->taxonomy;
		$term_children = get_terms($term_id, $taxonomy_name);
		$term_children = get_terms([
			'parent' => $term_id,
			'taxonomy' => $taxonomy_name,
			'hide_empty' => false,
		]);
		$sub_areas = $term_children ? $term_children : array();
		$term->sub_areas = $sub_areas;
	}
	return $degreeFilterArray;
}

// get all direct decendants of the $parent
function buildDegressArray($degrees)
{
	foreach ($degrees as $post) {
		$array = array();
		$degreeAreas = get_the_terms($post->ID, 'degree_vertical') ? get_the_terms($post->ID, 'degree_vertical') : $array;
		$degreeLevels = get_the_terms($post->ID, 'degree_level') ? get_the_terms($post->ID, 'degree_level') : $array;

		$post->degree_areas = $degreeAreas;
		$post->degree_levels = $degreeLevels;
	}
	return $degrees;
}

function buildDegreeLevels($degreeLevels)
{
	foreach ($degreeLevels as $term) {
		$array = array();
		$term_id = $term->term_id;
		$id = 'term_' . $term_id;
		$displayOrder = get_field('menu_order', $id) ?  get_field('menu_order', $id) : '0';
		$term->display_order = $displayOrder;
	}
	return $degreeLevels;
}



function bones_head_cleanup()
{
	// category feeds
	remove_action('wp_head', 'feed_links_extra', 3);
	// post and comment feeds
	remove_action('wp_head', 'feed_links', 2);
	// EditURI link
	remove_action('wp_head', 'rsd_link');
	// windows live writer
	remove_action('wp_head', 'wlwmanifest_link');
	// previous link
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	// start link
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	// links for adjacent posts
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	// WP version
	remove_action('wp_head', 'wp_generator');

	// NOTE: VERSION REMOVING HAPPENING HERE:

	// remove WP version from css
	add_filter('style_loader_src', 'bones_remove_wp_ver_css_js', 9999);
	// remove Wp version from scripts
	add_filter('script_loader_src', 'bones_remove_wp_ver_css_js', 9999);


	// remove wpemoji nonsense
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
} /* end bones head cleanup */

/*****************
A better title
 *****************/

// http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html
function rw_title($title, $sep, $seplocation)
{
	global $page, $paged;

	// Don't affect in feeds.
	if (is_feed()) return $title;

	// Add the blog's name
	if ('right' == $seplocation) {
		$title .= get_bloginfo('name');
	} else {
		$title = get_bloginfo('name') . $title;
	}

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo('description', 'display');

	if ($site_description && (is_home() || is_front_page())) {
		$title .= " {$sep} {$site_description}";
	}

	// Add a page number if necessary:
	if ($paged >= 2 || $page >= 2) {
		$title .= " {$sep} " . sprintf(__('Page %s', 'dbt'), max($paged, $page));
	}

	return $title;
} // end better title

// remove WP version from RSS
function bones_rss_version()
{
	return '';
}

// remove WP version from scripts
function bones_remove_wp_ver_css_js($src)
{
	if (strpos($src, 'ver='))
		$src = remove_query_arg('ver', $src);
	return $src;
}

// remove injected CSS for recent comments widget
function bones_remove_wp_widget_recent_comments_style()
{
	if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
		remove_filter('wp_head', 'wp_widget_recent_comments_style');
	}
}

// remove injected CSS from recent comments widget
function bones_remove_recent_comments_style()
{
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
	}
}

// remove injected CSS from gallery
function bones_gallery_style($css)
{
	return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

/*********************
SCRIPTS & ENQUEUEING
 *********************/

// loading modernizr and jquery, and reply script
function bones_scripts_and_styles()
{

	global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

	if (!is_admin()) {

		// modernizr (without media query polyfill)
		// wp_register_script( 'bones-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );

		// ie-only style sheet
		wp_register_style('bones-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '');

		// comment reply script for threaded comments
		if (is_singular() and comments_open() and (get_option('thread_comments') == 1)) {
			wp_enqueue_script('comment-reply');
		}

		//adding scripts file in the footer
		// wp_register_script( 'bones-js', get_stylesheet_directory_uri() . '/library/js/build/production.min.js', array( 'jquery' ), microtime(), true );
		//

		function handle_adding_main_js()
		{
			wp_register_script('bones-js', get_stylesheet_directory_uri() . '/library/js/build/production.min.js', array('jquery'), '', true);

			$allDegreesArgs = array(
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order'   => 'ASC',
				'post_type' => 'degrees',
				'post_status' => 'publish',
			);

			$allDegrees = get_posts($allDegreesArgs);
			$degree_areas = get_field('degree_area_filters', 'option') ? get_field('degree_area_filters', 'option') : array();
			$degree_levels = get_field('degree_level_filters', 'option') ? get_field('degree_level_filters', 'option') : array();
			// print($degree_levels);

			$data = array(
				'degrees' => buildDegressArray($allDegrees),
				'degreeAreas' => buildDegreeAreas($degree_areas),
				'degreeLevels' => buildDegreeLevels($degree_levels)
			);

			wp_localize_script('bones-js', 'wpData', $data);
		}
		handle_adding_main_js();


		// enqueue styles and scripts
		wp_enqueue_script('bones-modernizr');

		if (!is_singular('landing-pages')) {
			wp_enqueue_style('bones-ie-only');
		}

		$wp_styles->add_data('bones-ie-only', 'conditional', 'lte IE 9'); // add conditional wrapper around ie stylesheet
		// wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
		wp_enqueue_script('jquery');
		wp_enqueue_script('bones-js');
	}
}

/*********************
THEME SUPPORT
 *********************/

// Adding WP 3+ Functions & Theme Support
function bones_theme_support()
{

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support('post-thumbnails');

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// wp menus
	add_theme_support('menus');

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __('The Main Menu'),   // main nav in header
			'footer-links' => __('Footer Links'), // secondary nav in footer
			'secondary' => __('Secondary Menu'), // secondary nav in footer
			'secondary-left' => __('Secondary Left Menu'), // secondary nav in footer
			'secondary-right' => __('Secondary Right Menu') // secondary nav in footer
		)
	);

	// Enable support for HTML5 markup.
	add_theme_support('html5', array(
		'comment-list',
		'search-form',
		'comment-form'
	));
} /* end bones theme support */


/*********************
RELATED POSTS FUNCTION
 *********************/

// Related Posts Function (call using bones_related_posts(); )
function bones_related_posts()
{
	echo '<ul id="bones-related-posts">';
	global $post;
	$tags = wp_get_post_tags($post->ID);
	if ($tags) {
		foreach ($tags as $tag) {
			$tag_arr .= $tag->slug . ',';
		}
		$args = array(
			'tag' => $tag_arr,
			'numberposts' => 5, /* you can change this to show more */
			'post__not_in' => array($post->ID)
		);
		$related_posts = get_posts($args);
		if ($related_posts) {
			foreach ($related_posts as $post) : setup_postdata($post); ?>
				<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach;
					} else { ?>
			<?php echo '<li class="no_related_post">' . __('No Related Posts Yet!') . '</li>'; ?>
	<?php }
		}
		wp_reset_postdata();
		echo '</ul>';
	} /* end bones related posts function */


	/*********************
PAGE NAVI
	 *********************/

	// Numeric Page Navi (built into the theme by default)
	function bones_page_navi()
	{
		global $wp_query;
		$bignum = 999999999;
		if ($wp_query->max_num_pages <= 1)
			return;
		echo '<nav class="pagination">';
		echo paginate_links(array(
			'base'         => str_replace($bignum, '%#%', esc_url(get_pagenum_link($bignum))),
			'format'       => '',
			'current'      => max(1, get_query_var('paged')),
			'total'        => $wp_query->max_num_pages,
			'prev_text'    => '&larr;',
			'next_text'    => '&rarr;',
			'type'         => 'list',
			'end_size'     => 3,
			'mid_size'     => 3
		));
		echo '</nav>';
	} /* end page navi */


	/*********************
RANDOM CLEANUP ITEMS
	 *********************/

	// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
	function bones_filter_ptags_on_images($content)
	{
		return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	}

	// This removes the annoying […] to a Read More link
	function bones_excerpt_more($more)
	{
		global $post;
		// edit here if you like
		return '...  <a class="excerpt-read-more" href="' . get_permalink($post->ID) . '" title="' . __('Read ') . esc_attr(get_the_title($post->ID)) . '">' . __('Read more &raquo;') . '</a>';
	}


	/**********************
RANDOM HELPER FUNCTIONS
	 **********************/

	// Pull Quote Shortcode
	function pullquote_func($atts, $content = null)
	{
		return '<span class="pullquote">' . do_shortcode($content) . '</span>';
	}
	add_shortcode('pullquote', 'pullquote_func');


	/*************
CTA Shortcode
	 *************/

	// Add Shortcode for blog call to action box
	// Shortcode for Call to Action box in blog posts: [cta]
	function blog_post_cta($atts)
	{
		$cta_title = get_field('blog_cta_title');
		$cta_message = get_field('blog_cta_message');
		$cta_button_label = get_field('blog_cta_button_label') ? get_field('blog_cta_button_label') : 'Learn More';
		$cta_button_link = get_field('blog_cta_button_link');

		$output = '';

		if (!empty($cta_button_link)) {
			$output .= '<div class="cta-blog">';
			if (!empty($cta_title)) {
				$output .= '<h3 class="cta-blog__title">' . $cta_title . '</h3>';
			}
			if (!empty($cta_message)) {
				$output .= '<p class="cta-blog__message">' . $cta_message . '</p>';
			}
			$output .= '<a class="button cta-blog__button" href="' . $cta_button_link . '">' . $cta_button_label . '</a>';
			$output .= '</div>';
		}

		return $output;
	}
	add_shortcode('cta', 'blog_post_cta');


	/*************************
Add Theme Options for ACF
	 *********************** */

	if (function_exists('acf_add_options_page')) {

		acf_add_options_page(array(
			'page_title'    => 'Theme General Settings',
			'menu_title'    => 'Theme Settings',
			'menu_slug'     => 'theme-general-settings',
			'capability'    => 'edit_posts',
			'redirect'      => false
		));

		acf_add_options_sub_page(array(
			'page_title'    => 'Theme Header Settings',
			'menu_title'    => 'Header',
			'parent_slug'   => 'theme-general-settings',
		));

		acf_add_options_sub_page(array(
			'page_title'    => 'Theme Footer Settings',
			'menu_title'    => 'Footer',
			'parent_slug'   => 'theme-general-settings',
		));
	}

	/******************
Allow SVG uploads
	 ******************/

	function cc_mime_types($mimes)
	{
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	add_filter('upload_mimes', 'cc_mime_types');

	// Privacy Policy Shortcode
	function privacy_policy()
	{
		$file = "http://www.learninghouse.com/privacy/privacy.txt";
		$data = file_get_contents($file);
		return $data;
	}
	add_shortcode('privacy', 'privacy_policy');

	/****************************************************************************
This is where we include the custom theme setting for Maintenance Alerts
	 *****************************************************************************/

	// Add Settins Page
	add_action('admin_menu', 'mnt_add_admin_menu');

	// Add Admin Settings
	add_action('admin_init', 'mnt_settings_init');

	// Add Link to Menu
	function mnt_add_admin_menu()
	{
		add_theme_page('Maintenance', 'Maintenance', 'manage_options', 'maintenance', 'mnt_options_page');
	}

	// Content of the Setting Page
	function mnt_options_page()
	{ ?>

	<form action='options.php' method='post'>
		<?php
			settings_fields('pluginPage');
			do_settings_sections('pluginPage');
			submit_button();
			?>
	</form>

<?php }

function mnt_settings_init()
{
	register_setting('pluginPage', 'mnt_settings');

	// Add Section
	add_settings_section(
		'mnt_pluginPage_section',
		__('Maintenance Alert', 'wordpress'),
		'mnt_settings_section_callback',
		'pluginPage'
	);


	// Add Checkbox
	add_settings_field(
		'mnt_checkbox_field_0',
		__('Turn Maintenance Message On', 'wordpress'),
		'mnt_checkbox_field_0_render',
		'pluginPage',
		'mnt_pluginPage_section'
	);
}

// Section text
function mnt_settings_section_callback()
{
	echo '<p>This will turn on a maintenance option for all wordpress users on the dashboard and login page.</p>';
}

// The Checkbox Field
function mnt_checkbox_field_0_render()
{

	$options = get_option('mnt_settings');
	?>
	<input type='checkbox' name='mnt_settings[mnt_checkbox_field_0]' <?php checked((is_array($options) && $options['mnt_checkbox_field_0'] == '1'), 1); ?> value='1'>
<?php

}

// Turn on Notification when the box is checked and saved
$options = get_option('mnt_settings');
if (is_array($options) && $options['mnt_checkbox_field_0'] == '1') {
	// Add custom message to WordPress dashboard
	add_action('admin_notices', 'wps_wp_admin_area_notice');
	function wps_wp_admin_area_notice()
	{
		echo ' <div class="error" style="background:red; color:white; padding:10px 5px; margin-left:0; margin-top: 20px;">This website is currently under development. Please DO NOT make any content changes unless approved by web development.</div>';
	}

	// Add custom message to WordPress login page
	add_filter('login_message', 'smallenvelop_login_message');
	function smallenvelop_login_message()
	{
		if (empty($message)) {
			return "<p class='login-error' style='background:red; color:white; padding:10px 5px;'><strong>This website is currently under development. Please DO NOT make any content changes unless approved by web development.</strong></p>";
		} else {
			return $message;
		}
	}
}

function enqueue_optimizely()
{
	$account = 'UWA_Main';

	wp_register_script('optimizely-js', 'https://cdn.optimizely.com/public/523170811/s/' . $account . '.js', array(), null, false);
	wp_enqueue_script('optimizely-js');
}
add_action('wp_enqueue_scripts', 'enqueue_optimizely', 1);

?>
