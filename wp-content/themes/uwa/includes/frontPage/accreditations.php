<?php
	// replace data from acf fields if available
	$accreditation_heading = (get_field('accreditation_heading','option'))?get_field('accreditation_heading', 'option'):"Accreditation";
	$accreditation_text = (get_field('accreditation_text','option'))?get_field('accreditation_text', 'option'):"";
	if( have_rows('accreditation_logos','option') ):
		$accreditations = '';
		while( have_rows('accreditation_logos','option') ) : the_row();
			$accreditation_logo = get_sub_field('accreditation_logo');
			$accreditation_link = !empty(get_sub_field('accreditation_logo_link'))?get_sub_field('accreditation_logo_link'):'';
			if (!empty($accreditation_logo)):
				$accreditation = <<<HTML
			<div class="accreditations__logoWrapper"><a href="$accreditation_link" target="_blank" rel="nofollow"><img src="$accreditation_logo" alt="accreditation logo"></a></div>
	HTML;
				//end of template
				$accreditations .= $accreditation;			
			endif;
		endwhile;
	endif;
?>
<div class="accreditations">
  <h3 class="accreditations__title"><?php echo $accreditation_heading?></h3>
	<p class="accreditations__text <?php echo empty($accreditation_text)?'d-none':'';?>"><?php echo $accreditation_text?></p>
	<div class="accreditations__logos">
		<?php
			if( !empty($accreditations ) ):
				echo  $accreditations;
			else:
		?>
    <div class="accreditations__logoWrapper">
      <img src="/wp-content/themes/uwa/library/images/accreditations/1.png" alt="accreditation logo">
    </div>
    <div class="accreditations__logoWrapper">
    <img src="/wp-content/themes/uwa/library/images/accreditations/2.png" alt="accreditation logo">
    </div>
   <!-- <div class="accreditations__logoWrapper">
      <a href="http://www.acbsp.org/?page=search_accredited" target="_blank" rel="nofollow"><img src="/wp-content/themes/uwa/library/images/accreditations/acbsp.png" alt="accreditation logo"></a>
    </div> -->
    <div class="accreditations__logoWrapper">
      <img src="/wp-content/themes/uwa/library/images/accreditations/caep.png" alt="accreditation logo">
    </div>
		<?php endif; ?>
  </div>
</div>
