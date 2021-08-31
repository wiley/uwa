<?php
// replace data from acf fields if available
$journey_heading = (get_field('journey_section_title'))?get_field('journey_section_title'):"Start Your Journey";
$journey_text =  (get_field('journey_section_content'))?get_field('journey_section_content'):'Choose from more than 70 degree and certification programs at the University of West Alabama Online.
<a href="/coronavirus-update">Learn how</a> an online program can give you the convenience and flexibility you need.';
$journey_extra_text = (get_field('journey_extra_text'))?get_field('journey_extra_text'):'Other programs include interdisciplinary studies, conservation biology and library media. <a href="/online-degrees">VIEW ALL DEGREES</a>';

if( have_rows('cards') ):
	$cards = '';
	while( have_rows('cards') ) : the_row();
			$card = get_sub_field('card');
			if (!empty($card)):
				$heading = $card['heading'];
				$text = $card['text'];
				if (!empty($heading)):
					$button_url_info = $card['button_url'];
					$button_url = !empty($button_url_info['url'])?$button_url_info['url']:'';
					$button_title = !empty($button_url_info['title'])?$button_url_info['title']:'';
					$button_target = (!empty($button_url_info['target']) && $button_url_info['target']) ? $button_url_info['target'] : '_self';
					//preparing cards html from template
					$card = <<<HTML
				<div class="card"> <h3 class="card__heading">$heading</h3><p class="card__text">$text</p><a class="card__link btn btn-info" href="$button_url" target="$button_target">$button_title</a></div>
	HTML;
					//end of template
					$cards .= $card;
				endif;
			endif;
	endwhile;
endif;
?>

<div class="journey">
  <h2 class="journey__heading section-heading"><?php echo $journey_heading?></h2>
  <p class="journey__text"><?php echo $journey_text?></p>
  <div class="journeyCards">
		<?php
		if( !empty($cards ) ):
			echo  $cards;
		else: ?>
    <div class="card">
      <h3 class="card__heading">Business</h3>
      <p class="card__text">Earn a competitive degree in fields such as accounting, marketing, management and more.</p>
      <a class="card__link btn btn-info" href="/online-degrees/areas-of-study/business"  href="#">Business Degrees</a>
    </div>
    <div class="card">
      <h3 class="card__heading">Teaching</h3>
      <p class="card__text">Progress as an educator in and outside the classroom with a wide range of programs.</p>
      <a class="card__link btn btn-info" href="/online-degrees/areas-of-study/teaching">Teaching Degrees</a>
    </div>
    <div class="card">
      <h3 class="card__heading">Psychology & Counseling</h3>
      <p class="card__text">Pursue an advanced career in clinical mental health counseling, experimental psychology and more.</p>
      <a class="card__link btn btn-info" href="/online-degrees/areas-of-study/psychology-counseling">Psychology Degrees</a>
    </div>
		<?php endif; ?>
  </div>
  <p class="journey__extraText"><?php echo $journey_extra_text?></p>
</div>
