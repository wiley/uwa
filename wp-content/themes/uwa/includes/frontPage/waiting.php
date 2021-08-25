<?php
// replace data from acf fields if available
$waiting_heading = (get_field('waiting_section_title'))?get_field('waiting_section_title'):"What are you waiting for?";
$waiting_text =  (get_field('waiting_section_content'))?get_field('waiting_section_content'):'';

if( have_rows('waiting_section_buttons') ):
	$buttons = '';
	while( have_rows('waiting_section_buttons') ) : the_row();
			$button = get_sub_field('waiting_section_button_details');
			$button_no_follow = get_sub_field('waiting_section_button_no_follow');
      $button_no_follow = ($button_no_follow==true)?'nofollow':'';
			if (!empty($button)):
					$button_url = !empty($button['url'])?$button['url']:'';
					$button_title = mb_strimwidth(!empty($button['title'])?$button['title']:'', 0, 12, '..');
					$button_target = (!empty($button['target']) && $button['target']) ? $button['target'] : '_self';
					//preparing buttons html from template
				$button = <<<HTML
          <a href="$button_url" target="$button_target" rel="$button_no_follow" class="btn-red">$button_title</a>
        HTML;
					//end of template
					$buttons .= $button;
			endif;
	endwhile;
endif;
?>
<div class="waiting">
  <div class="wrap cf">
    <h2 class="waiting__heading section-heading"><?php echo $waiting_heading?></h2>
    <p class="waiting__text <?php echo empty($waiting_text)?'d-none':'';?>"><?php echo $waiting_text?></p>
    <?php
			if( !empty($buttons ) ):
				echo  $buttons;
			else:
		?>
    <a href="/request-info" class="btn-red">Request Info</a>
    <a href="http://www.uwa.edu/apply/" target="_blank" rel="nofollow" class="btn-red">Apply Now</a>
    <?php endif; ?>
  </div>
</div>
