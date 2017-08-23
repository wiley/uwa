<script id="degrees-menu-template" type="text/template">
  <?php

    $featuredProgram = get_field('featured_program');
  ?>
  <?php
    $verticalsTaxonomy = 'degree_vertical';
    $degreeTypes = get_terms( $verticalsTaxonomy, $args = array(
      'hide_empty' => true, // do not hide empty terms
    ));
  ?>

  <?php
  // your taxonomy name
    $levelsTaxonomy = 'degree_level';
    // get the terms of taxonomy
    $degreeLevels = get_terms( $levelsTaxonomy, $args = array(
      'hide_empty' => true, // do not hide empty terms
    ));
  ?>
  <?php
  	function setDisplayOrder($term1, $term2) {
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

    <!-- <div class="megamenuWrapper"> -->
      <ul id="megamenu" class="degrees-menu sub-menu">
        <ul class="degrees-menu__submenu">
          <li class="label">By Program Type</li>
          <?php foreach ($degreeLevels as $level ): ?>
            <?php
              $url = get_term_link( $level );
              $name = $level->name;
              $slug = $level->slug;
              $termID = 'term_' . $level->term_id;
              $menuOrderValue = get_field('menu_order', $termID);
            ?>

            <?php if ($menuOrderValue): ?>
                <li><a href="<?php echo esc_url( $url ); ?>"><?php echo $name; ?></a></li>
            <?php endif; ?>

          <?php endforeach; ?>
        </ul>

        <ul class="degrees-menu__submenu">
          <li class="label">By Area of Study</li>
          <?php foreach ($degreeTypes as $type ): ?>
            <?php
              $url = get_term_link( $type );
              $name = $type->name;

            ?>
            <li><a href="<?php echo esc_url( $url ); ?>"><?php echo $name; ?></a></li>
          <?php endforeach; ?>
            <li id="allLink__item"><a id="allLink" class="allLink" href="/online-degrees">View All Degrees</a></li>
        </ul>

<?php if ($featuredProgram): ?>
  <?php
	setup_postdata( $featuredProgram );
  ?>
  <h3 class="card__title"><?php the_title(); ?></h3>


  <?php wp_reset_postdata(); ?>
<?php endif; ?>

        <div id="megamenuCard" class="card">

          <a class="card__link" href="#" style="background-image: url('/wp-content/uploads/2017/06/MAT.jpg');">
            <div class="title">
              <span class="label">Featured Program</span>
              <h3 class="card__title">M.A. in Teaching</h3>
            </div>
            <div class="card__info">View Program </div>
            <div class="cardLink__cta-background"></div>
          </a>
        </div>
        <!-- <a class="allLink" href="/online-degrees">View All Degrees</a> -->
      </ul>


    <!-- </div> -->
</script>
