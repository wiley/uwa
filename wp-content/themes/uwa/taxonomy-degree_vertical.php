<?php get_header(); ?>
<style media="screen">
  .owl-carousel .owl-dots.disabled, .owl-carousel .owl-nav.disabled {
    /*display: block !important;*/
  }
</style>

  <div class="content">
    <main id="main" class="cf main-content" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

			<?php
			// Current term object
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

			$term_level_descriptions = get_field('degree_level_descriptions', $term);

			if ( $term_level_descriptions ) {
				$degree_level_tabs = array_column($term_level_descriptions, 'degree_level');
				$degree_level_args = array(
					'taxonomy' => 'degree_level',
			    'hide_empty' => true,
					'include' => $degree_level_tabs,
				);
			} else {
				$degree_level_args = array(
					'taxonomy' => 'degree_level',
			    'hide_empty' => true,
				);
			}

			$degree_levels = get_terms( $degree_level_args );

			// Set up array to hold degrees sorted by level
			$term_posts_by_level = array();

			foreach ( $degree_levels as $degree_level ) {
				$args = array(
			    "posts_per_page" => -1,
			    "post_type" => "degrees",
			    "tax_query" => array(
						'relation' => 'AND',
			      array(
			        "taxonomy" => "degree_vertical",
			        "field"    => "slug",
			        "terms"    => $term->slug,
			      ),
						array(
							'taxonomy' => 'degree_level',
							'field'		 => 'slug',
							'terms'		 => $degree_level->slug,
						)
				  ),
				  'orderby' => 'title',
				  'order'   => 'ASC',
				);

				$loop = new WP_Query($args);

				if( $loop->have_posts() ) {
					$term_posts_by_level[$degree_level->slug]['posts'] = $loop->posts;
					$term_posts_by_level[$degree_level->slug]['name'] = $degree_level->name;

					if ( $term_level_descriptions ) {
						$desc_row_index = array_search($degree_level->term_id, array_column($term_level_descriptions, 'degree_level'));
						$term_posts_by_level[$degree_level->slug]['description'] = $term_level_descriptions[$desc_row_index]['description'];
					} else {
						$term_posts_by_level[$degree_level->slug]['description'] = false;
					}
				}
			}  // end foreach loop for $degree_levels ?>

      <div class="intro">
        <div class="intro__breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
          <?php if(function_exists('bcn_display'))
          {
              bcn_display();
          } ?>
        </div>
        <h2 class="intro__headline"><?php the_field('intro_headline', $term); ?></h2>
        <p class="intro__text"><?php the_field('intro_text', $term); ?></p>
        <?php // <div class="intro__link"></div> ?>
      </div>

			<div class="wrap cf">
			  <div class="infoTabs">
			    <div class="infoTabs__buttons" role="tablist">
						<?php $tabs_index = 0;
						foreach ($term_posts_by_level as $slug => $degree_level) { ?>
							<button id="<?php echo $slug; ?>" role="tab"<?php echo $tabs_index === 0 ? ' class="active" aria-selected="true"' : ' aria-selected="false"';?> aria-controls="content-<?php echo $slug; ?>"><?php echo $degree_level['name']; ?></button>
							<?php $tabs_index++ ?>
						<?php } ?>
			    </div>

			    <div class="infoTabs__contentWrapper">

						<?php $tabs_index = 0;
						foreach ($term_posts_by_level as $slug => $degree_level) { ?>
							<div id="content-<?php echo $slug; ?>" class="<?php echo $slug; ?><?php echo $tabs_index === 0 ? ' active' : '';?> infoTabs__content" aria-labelledby="<?php echo $slug; ?>" role="tabpanel">
								<h2 class="mainDegrees__headline"><?php echo $degree_level['name']; ?></h2>
		            <?php if ($degree_level['description']) { ?>
									<p class="mainDegrees__text"><?php echo $degree_level['description']; ?></p>
								<?php } ?>

								<div class="accordion accordion--light accordion--columns">
									<?php foreach ($degree_level['posts'] as $degree) { ?>
										<div class="accord">

								      <h4 class="accord-header">
								        <button aria-controls="content-<?php echo $degree->ID; ?>" aria-expanded="false">
								          <?php echo $degree->post_title; ?>
								          <div class="iconsWrapper iconsWrapper--large">
								            <span class="plus"><?php include ( 'includes/verticals/icon-plus--red.svg'); ?></span>
								            <span class="minus"><?php include ( 'includes/verticals/icon-minus--red.svg'); ?></span>
								          </div>
								        </button>
								      </h4>

								      <div id="content-<?php echo $degree->ID; ?>" class="accord-content" aria-hidden="true">
												<p><?php the_field( 'program_summary', $degree->ID ); ?></p>
												<a class="btn btn--full" href="<? the_permalink( $degree->ID ); ?>">View Info</a>
											</div>
								      <span class="accord-trigger" aria-hidden="true"></span>
								    </div>
									<?php } ?>
								</div>

							</div>
						<?php $tabs_index++ ?>
					<?php } ?>

			    </div>
			  </div>
			</div>

			<?php
			$current_taxonomy = $term->taxonomy;
			$term_children = get_term_children( $term->term_id, $current_taxonomy );
			?>

			<?php if ( $term_children ) { ?>
				<div class="child-terms wrap cf">
					<h2 class="child-terms__heading"><?php echo $term->name; ?> Areas</h2>
					<p><?php the_field('subcategory_overview', $child_term); ?></p>
					<ul class="tile-list tile-list--medium">
						<?php foreach ( $term_children as $child ) { ?>
							<?php $child_term = get_term_by( 'id', $child, $current_taxonomy );
							$child_term_desc = get_field('intro_text', $child_term);
							$child_term_sentences = preg_split("/(?<=[\.\?\!])\s+?(?=[A-Z])/", $child_term_desc); ?>
							<li>
								<div class="resource-card">
									<div class="resource-card__copy">
										<h3 class="resource-card__title"><?php echo $child_term->name; ?></h3>
										<p><?php echo $child_term_sentences[0]; ?></p>
									</div>
									<a class="resource-card__action btn" href="<?php echo get_term_link( $child, $current_taxonomy ); ?>">View Programs</a>
								</div>
							</li>
						<?php } ?>
					</ul>
				</div>
			<?php } ?>

			<?php if ( get_field( 'show_related_resource', $term ) ) { ?>
				<div class="related-resource related-row">
					<div class="wrap cf">
						<div class="related-row__copy">
							<h2><?php the_field( 'related_resource_heading', $term ); ?></h2>
							<p><?php the_field( 'related_resource_description', $term ); ?></p>
							<?php $resource_item = get_field( 'related_resource_item', $term ); ?>
							<p><a class="btn-red" href="<?php the_permalink( $resource_item->ID ); ?>">Read More</a></p>
						</div>
						<div class="related-row__media">
							<?php echo wp_get_attachment_image( get_field( 'related_resource_image', $term ), 'large' ); ?>
						</div>
					</div>
				</div>
			<?php } ?>

			<?php if ( get_field( 'show_related_video', $term ) ) { ?>
				<div class="related-video related-row">
					<div class="wrap cf">
						<div class="related-row__media">
							<div class="video-container">
								<?php the_field( 'related_video_embed', $term ); ?>
							</div>
						</div>
						<div class="related-row__copy">
							<h2><?php the_field( 'related_video_heading', $term ); ?></h2>
							<p><?php the_field( 'related_video_description', $term ); ?></p>
						</div>
					</div>
				</div>
			<?php } ?>

    </main>
		<?php include('includes/waiting.php'); ?>
  </div>

<!-- Add current class to main nav item -->
<script type="text/javascript">
    jQuery(document).ready(function($) {
        var menuItem = $('#menu-item-168')
        $('#menu-main').find(menuItem).addClass('current-menu-item current-page-item');
    });
</script>

<?php get_footer(); ?>
<script type="text/javascript">

</script>
