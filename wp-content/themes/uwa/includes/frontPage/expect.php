<?php
// replace data from acf fields if available
$expects_heading = (get_field('expects_section_title'))?get_field('expects_section_title'):"What you can expect";

if( have_rows('expect_section_cards') ):
	$cards = '';
	while( have_rows('expect_section_cards') ) : the_row();
			$card = get_sub_field('expect_section_card');
			if (!empty($card)):
				$heading = $card['heading'];
				$text = $card['text'];
				$image = $card['image'];
				$img_src = '';
				$img_alt = '';
				if( !empty( $image ) ):
					$img_src = esc_url($image['url']);
					$img_alt = esc_attr($image['alt']);
				endif;
				if (!empty($heading)):
					//preparing cards html from template
					$card = <<<HTML
				<div class="card"><img class="card__icon" src="$img_src" alt="$img_alt"><h4 class="card__heading">$heading</h4><p class="card__text">$text</p></div>
	HTML;
					//end of template
					$cards .= $card;
				endif;
			endif;
	endwhile;
endif;
?>

<div class="expect">
  <h2 class="expect__heading section-heading"><?php echo $expects_heading?></h2>
  <div class="expectCards">
	<?php
		if( !empty($cards ) ):
			echo  $cards;
		else: ?>
    <div class="card">
      <img class="card__icon" src="/wp-content/themes/uwa/library/images/icons/learning.svg" alt="Image icon for versatile learning environment">
      <h4 class="card__heading">A Versatile Learning Environment</h4>
      <p class="card__text">Study in a convenient setting that allows you to maintain your professional and personal schedule.</p>
    </div>
    <div class="card">
      <img class="card__icon" src="/wp-content/themes/uwa/library/images/icons/instruction.svg"  alt="Image icon for expert instruction">
      <h4 class="card__heading">Expert Instruction</h4>
      <p class="card__text">Learn from faculty who have real-world experience and hold the highest degrees in their field.</p>
    </div>
    <div class="card">
      <img class="card__icon" src="/wp-content/themes/uwa/library/images/icons/affordability.svg"  alt="Image icon for affordability">
      <h4 class="card__heading">Affordability</h4>
      <p class="card__text">Each program is competitively priced and 80 percent of students receive some type of financial aid. Scholarships are also available.</p>
    </div>
		<?php endif; ?>
  </div>
</div>
