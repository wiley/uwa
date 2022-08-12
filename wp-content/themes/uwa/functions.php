<?php

// LOAD BONES CORE (if you remove this, the theme will break)
require_once('library/bones.php');
require_once('aria-walker.php');

/*********************
LAUNCH BONES
Let's get everything up and running.
 *********************/

/**
 * tell WP Migrate DB Pro to preserve some options,
 * so that we can stay in dev / test mode
 * @param string $preserved_options
 * @return string
 */





// Async load
function async_scripts($url)
{
  if (strpos($url, '#asyncload') === false)
    return $url;
  else if (is_admin())
    return str_replace('#asyncload', '', $url);
  else
    return str_replace('#asyncload', '', $url) . "' async='async";
}
// add_filter( 'clean_url', 'async_scripts', 11, 1 );

add_filter('rest_post_collection_params', 'my_prefix_change_post_per_page', 10, 1);

function my_prefix_change_post_per_page($params)
{
  if (isset($params['per_page'])) {
    $params['per_page']['maximum'] = 100;
  }

  return $params;
};

function prepare_rest($data, $post, $request)
{
  $_data = $data->data;
  $array = array();

  $degreeVerticals = get_the_terms($post->ID, 'degree_vertical') ? get_the_terms($post->ID, 'degree_vertical') : $array;
  $degreeLevels = get_the_terms($post->ID, 'degree_level') ? get_the_terms($post->ID, 'degree_level') : $array;

  $_data['degree_types'] = $degreeVerticals;
  $_data['degree_levels'] = $degreeLevels;
  $data->data = $_data;

  return $data;
}
add_filter('rest_prepare_degrees', 'prepare_rest', 10, 3);


add_action('send_headers', function () {
  if (!did_action('rest_api_init') && $_SERVER['REQUEST_METHOD'] == 'HEAD') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Expose-Headers: Link');
    header('Access-Control-Allow-Methods: HEAD');
  }
});

remove_action('wp_head', 'rest_output_link_wp_head', 10);

add_filter('get_the_archive_title', function ($title) {

  if (is_category()) {

    $title = single_cat_title('', false);
  } elseif (is_tag()) {

    $title = single_tag_title('', false);
  } elseif (is_author()) {

    $title = '<span class="vcard">' . get_the_author() . '</span>';
  }

  return $title;
});

add_filter('wpmdb_preserved_options', function ($preserved_options) {

  $preserved_options = array_merge($preserved_options, array(
    'wppusher_token', // don't overwrite wppusher_token
  ));

  return array_unique($preserved_options);
});


function bones_ahoy()
{

  // Programs Custom Post Type
  require_once('library/custom-post-types.php');
  // launching operation cleanup
  add_action('init', 'bones_head_cleanup');
  // A better title
  add_filter('wp_title', 'rw_title', 10, 3);
  // remove WP version from RSS
  add_filter('the_generator', 'bones_rss_version');
  // remove pesky injected css for recent comments widget
  add_filter('wp_head', 'bones_remove_wp_widget_recent_comments_style', 1);
  // clean up comment styles in the head
  add_action('wp_head', 'bones_remove_recent_comments_style', 1);
  // clean up gallery output in wp
  add_filter('gallery_style', 'bones_gallery_style');
  // enqueue base scripts and styles
  add_action('wp_enqueue_scripts', 'bones_scripts_and_styles', 999);

  // launching this stuff after theme setup
  bones_theme_support();
  // adding sidebars to Wordpress (these are created in functions.php)
  add_action('widgets_init', 'bones_register_sidebars');
  // cleaning up random code around images
  add_filter('the_content', 'bones_filter_ptags_on_images');
  // cleaning up excerpt
  add_filter('excerpt_more', 'bones_excerpt_more');
} /* end bones ahoy */

// let's get this party started
add_action('after_setup_theme', 'bones_ahoy');


/************* REMOVE WP EMBED *************/

function my_deregister_scripts()
{
  wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'my_deregister_scripts');


/************* OEMBED SIZE OPTIONS *************/

if (!isset($content_width)) {
  $content_width = 680;
}

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars()
{
  register_sidebar(array(
    'id' => 'sidebar1',
    'name' => __('Sidebar 1'),
    'description' => __('The first (primary) sidebar.'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));
  register_sidebar(array(
    'id' => 'sidebar_blog',
    'name' => __('Sidebar Blog'),
    'description' => __('The first (primary) sidebar.'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments($comment, $args, $depth)
{
  $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article class="cf">
      <header class="comment-author vcard">
        <?php // custom gravatar call 
          ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
          ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call 
          ?>
        <?php printf(__('<cite class="fn">%1$s</cite> %2$s'), get_comment_author_link(), edit_comment_link(__('(Edit)'), '  ', '')) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>"><?php comment_time(__('F jS, Y')); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e('Your comment is awaiting moderation.') ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
    <?php // </li> is added by WordPress automatically 
      ?>
  <?php
  } // don't remove this bracket!


  /************* REMOVE P TAGS FROM IMAGES *********************/

  function filter_ptags_on_images($content)
  {
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
  }
  add_filter('the_content', 'filter_ptags_on_images');

  /************* SOCIAL SHARING *********************/

  // Dynamic share buttons for post
  function tlh_build_social_sharing_buttons($label = 'Share on')
  {

    // Get current post info
    $socialURL = urlencode(get_permalink());
    $socialTitle = str_replace(' ', '%20', get_the_title());

    // Construct sharing URL without using any script
    $twitterURL = 'https://twitter.com/intent/tweet?text=' . $socialTitle . '&amp;url=' . $socialURL . '&amp;via=univwestalabama';
    $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' . $socialURL;
    $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $socialURL . '&amp;title=' . $socialTitle;

    // Build sharing buttons
    $socialContent .= '<div class="social-sharing">';
    $socialContent .= '<span class="social-sharing__label">' . $label . '</span>';
    $socialContent .= '<div><a class="social-link social-link_twitter" title="Share this page on Twitter" href="' . $twitterURL . '" target="_blank"><span class="social-link__icon"><svg viewBox="0 0 512 512" preserveAspectRatio="xMidYMid meet" width="18" height="18"><path d="M419.6 168.6c-11.7 5.2-24.2 8.7-37.4 10.2 13.4-8.1 23.8-20.8 28.6-36 -12.6 7.5-26.5 12.9-41.3 15.8 -11.9-12.6-28.8-20.6-47.5-20.6 -42 0-72.9 39.2-63.4 79.9 -54.1-2.7-102.1-28.6-134.2-68 -17 29.2-8.8 67.5 20.1 86.9 -10.7-0.3-20.7-3.3-29.5-8.1 -0.7 30.2 20.9 58.4 52.2 64.6 -9.2 2.5-19.2 3.1-29.4 1.1 8.3 25.9 32.3 44.7 60.8 45.2 -27.4 21.4-61.8 31-96.4 27 28.8 18.5 63 29.2 99.8 29.2 120.8 0 189.1-102.1 185-193.6C399.9 193.1 410.9 181.7 419.6 168.6z"></path></svg></span><span class="social-link__label">Twitter</span></a>';
    $socialContent .= '<a class="social-link social-link_facebook" title="Share this page on Facebook" href="' . $facebookURL . '" target="_blank"><span class="social-link__icon"><svg viewBox="0 0 512 512" preserveAspectRatio="xMidYMid meet" width="18" height="18"><path d="M211.9 197.4h-36.7v59.9h36.7V433.1h70.5V256.5h49.2l5.2-59.1h-54.4c0 0 0-22.1 0-33.7 0-13.9 2.8-19.5 16.3-19.5 10.9 0 38.2 0 38.2 0V82.9c0 0-40.2 0-48.8 0 -52.5 0-76.1 23.1-76.1 67.3C211.9 188.8 211.9 197.4 211.9 197.4z"></path></svg></span><span class="social-link__label">Facebook</span></a>';
    $socialContent .= '<a class="social-link social-link_linkedin" title="Share this page on LinkedIn" href="' . $linkedInURL . '" target="_blank"><span class="social-link__icon"><svg viewBox="0 0 512 512" preserveAspectRatio="xMidYMid meet" width="18" height="18"><path d="M186.4 142.4c0 19-15.3 34.5-34.2 34.5 -18.9 0-34.2-15.4-34.2-34.5 0-19 15.3-34.5 34.2-34.5C171.1 107.9 186.4 123.4 186.4 142.4zM181.4 201.3h-57.8V388.1h57.8V201.3zM273.8 201.3h-55.4V388.1h55.4c0 0 0-69.3 0-98 0-26.3 12.1-41.9 35.2-41.9 21.3 0 31.5 15 31.5 41.9 0 26.9 0 98 0 98h57.5c0 0 0-68.2 0-118.3 0-50-28.3-74.2-68-74.2 -39.6 0-56.3 30.9-56.3 30.9v-25.2H273.8z"></path></svg></span><span class="social-link__label">LinkedIn</span></a>';
    $socialContent .= '</div></div>';

    return $socialContent;
  };

  function tlh_social_sharing_buttons($label = 'Share on')
  {
    echo tlh_build_social_sharing_buttons($label);
  }

  function social_sharing_buttons($content)
  {
    if (is_singular('post')) {

      $socialContent = tlh_build_social_sharing_buttons($label = 'Share on');

      return $socialContent . $content;
    } else {
      // if not a post/page then don't include sharing button
      return $content;
    }
  };
  add_filter('the_content', 'social_sharing_buttons');

  /************* JQUERY CONFLICT FIX *********************/

  function enqueue_scripts()
  {
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, false, false);
    wp_enqueue_script('jquery');

    wp_enqueue_script('validate-js', get_stylesheet_directory_uri(__FILE__) . '/library/js/libs/jquery.validate.min.js');
    wp_enqueue_script('gravity-form-js', get_stylesheet_directory_uri(__FILE__) . '/library/js/libs/gravity-form.js');
  }
  add_action('wp_enqueue_scripts', 'enqueue_scripts');

  // 
  // Get user IP address
  // 
  wp_register_script( 'gravity-form-js', get_stylesheet_directory_uri(__FILE__) . '/library/js/libs/gravity-form.js');

  function get_the_user_ip() {

      if ( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
          if ( strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') > 0 ) {
              $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
              $ip = trim($addr[0]);
          } else {
              $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
          }
      } else {
          $ip = $_SERVER['REMOTE_ADDR'];
      }

      return $ip;
  }
  $ip = get_the_user_ip(); 

  wp_localize_script( 'gravity-form-js', 'user_ip', $ip );


  function custom_taxonomies_terms_slugs()
  {
    // get post by post id
    $post = get_post();

    // get post type by post
    $post_type = $post->post_type;

    // get post type taxonomies
    $taxonomies = get_object_taxonomies($post_type, 'objects');

    $out = array();
    foreach ($taxonomies as $taxonomy_slug => $taxonomy) {

      // get the terms related to post
      $terms = get_the_terms($post->ID, $taxonomy_slug);

      if (!empty($terms)) {
        foreach ($terms as $term) {
          $out[] = $term->slug . ' ';
        }
      }
    }

    return implode('', $out);
  }
  // require_once( 'filters.php' );

  // function attributes_shortcode( $attr, $content = null ) {
  //     return $content . 'aria-label="My test"';
  // }
  // add_shortcode('attr', 'attributes_shortcode');

  require_once('library/resources_admin_page.php');

// Fix for Better Search and Replace Plugin on Pantheon: https://pantheon.io/docs/plugins-known-issues#better-search-and-replace

function better_search_replace_cap_override() {
    return 'manage_options';
}
add_filter( 'bsr_capability', 'better_search_replace_cap_override' );

  /* DON'T DELETE THIS CLOSING TAG */ ?>