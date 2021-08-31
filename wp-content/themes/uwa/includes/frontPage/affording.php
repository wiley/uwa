<?php
	// replace data from acf fields if available
	$affording_heading = (get_field('education_section_title'))?get_field('education_section_title'):"Affording Your Education";
	$affording_text = (get_field('education_section_content'))?get_field('education_section_content'):"The University of West Alabama Online is dedicated to making your education as affordable as possible. Discover what it will cost — and how much you’ll save.";
  if( have_rows('fast_facts_sections') ):
    $fast_facts = '';
    while( have_rows('fast_facts_sections') ) : the_row();
        $fast_fact = get_sub_field('fast_fact');
        $facts_lgtn_img = file_get_contents( get_template_directory() . '/includes/frontPage/lighting.svg' );
        if (!empty($fast_fact)):
          $fast_fact_info = $fast_fact['fast_fact_info'];
          $heading = $fast_fact['heading'];
          $text = $fast_fact['text'];
          $image = $fast_fact['image'];
          $button_url_info = $fast_fact['button_url'];
					$button_url = !empty($button_url_info['url'])?$button_url_info['url']:'';
					$button_title = !empty($button_url_info['title'])?$button_url_info['title']:'';
					$button_target = (!empty($button_url_info['target']) && $button_url_info['target']) ? $button_url_info['target'] : '_self';
          $img_src = '';
				  $img_alt = '';
          if( !empty( $image ) ):
            $img_src = esc_url($image['url']);
            $img_alt = esc_attr($image['alt']);
          endif;

          if (!empty($heading)):
            //preparing cards html from template
            $fast_fact = <<<HTML
          <div class="section">
            <div class="card">
              <div class="card__imageWrapper"><img src="$img_src" alt="$img_alt"></div>
              <div class="card__info">
                <h2>$heading</h2>
                <p> $text</p>
                <a href="$button_url" class="btn__hollow">$button_title</a>
              </div>
            </div>
            <div class="fastFact">
              <h6 class="fastFact__heading">$facts_lgtn_img Fast Fact</h6>
              <p class="fastFact__info">$fast_fact_info</p>
            </div>
          </div>
HTML;
            //end of template
            $fast_facts .= $fast_fact;
          endif;
        endif;
    endwhile;
  endif;
?>
<div class="affording">
  <div class="wrap cf">
    <h2 class="affording__heading"><?php echo $affording_heading?></h2>
    <p><?php echo $affording_text?></p>
    <?php if( !empty($fast_facts ) ):
				echo  $fast_facts;
    else: ?>
    <div class="section">
      <div class="card">
        <div class="card__imageWrapper">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/library/images/frontPage/tuition.jpg" alt="">
        </div>
        <div class="card__info">
          <h2>Tuition</h2>
          <p>View current tuition rates for all programs.</p>
          <a href="/tuition" class="btn__hollow">Tuition Info</a>
        </div>
      </div>
      <div class="fastFact">
        <h6 class="fastFact__heading"><?php include('lighting.svg'); ?>Fast Fact</h6>
        <p class="fastFact__info">The University of West Alabama was founded in 1835</p>
      </div>
    </div>

    <div class="section">
      <div class="card">
        <div class="card__imageWrapper">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/library/images/frontPage/financial-aid.jpg" alt="">
        </div>
        <div class="card__info">
          <h2>Financial Aid</h2>
          <p>Learn more about financial aid and how you can maximize these opportunities to cut the cost of your education.</p>
          <a href="/tuition/financial-aid/" class="btn__hollow">Financial Aid Info</a>
        </div>
      </div>
      <div class="fastFact">
        <h6 class="fastFact__heading"><?php include('lighting.svg'); ?>Fast Fact</h6>
        <p class="fastFact__info">We have served more than 20,000 students</p>
      </div>
    </div>

    <div class="section">
      <div class="card">
        <div class="card__imageWrapper">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/library/images/frontPage/scholarships.jpg" alt="">
        </div>
        <div class="card__info">
          <h2>Scholarships</h2>
          <p>Save thousands of dollars with UWA-specific scholarships: Military Connect, Teacher Connect and Business Connect.</p>
          <a href="/my/teacherconnect/" class="btn__hollow">Scholarship Info</a>
        </div>
      </div>
      <div class="fastFact">
        <h6 class="fastFact__heading">Fast Fact</h6>
        <p class="fastFact__info">We have more than 50 online degrees available</p>
      </div>
    </div>
    <?php endif; ?>
  </div>
</div>
