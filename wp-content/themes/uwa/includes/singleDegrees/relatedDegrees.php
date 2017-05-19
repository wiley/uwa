<?php

$posts = get_field('related_programs_selected');

if( $posts ): ?>
	<div class="relatedDegrees">

  	<div class="wrap cf">
  		<div class="relatedDegrees__infoWrapper">
  			<h2 class="relatedDegrees__heading">Related Degrees</h2>
  			<a href="#" class="btn__hollow">View All Teaching Degrees</a>
  		</div>
  				<div class="relatedDegrees__flexWrapper">
  			    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
  			        <?php setup_postdata($post); ?>

  							<?php $title = $post->post_title; ?>
  						  <?php $degreeID = $post->ID; ?>
  						  <?php $link = get_permalink($degreeID); ?>

  						    <div class="cardLinkWrapper item">
  						      <a href="<?php echo $link; ?>" class="cardLink ">

  						      <img class="cardLink__image" src="<?php the_field('program_image'); ?>" alt="Program Image">

  						      <div class="flexTestWrapper">
  						        <div class="cardLink__text">
  						          <h3 class="cardLink__heading"><?php echo $title; ?></h3>
  						        </div>
  						        <div class="cardLink__info">
  						          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat animi neque corrupti quae numquam recusandae laborum fuga veniam culpa enim.</p>
  						          <div class="cardLink__cta-background"></div>

  						        </div>
  						      </div>
  						      <p class="cardLink__cta">View Program <?php include('arrow.svg'); ?></p>
  						      </a>
  						    </div>
  			    <?php endforeach; ?>
  				</div>
  	</div>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
	</div>
<?php endif; ?>
