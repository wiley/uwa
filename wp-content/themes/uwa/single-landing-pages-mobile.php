<?php
/*
Template Name: LP MobileOptimize
Template Post Type: landing-pages
*/
get_header( 'lp-mobile' ); ?>

		<?php

		// check if the repeater field has rows of data
		if( have_rows('row') ):

						// loop through the rows of data
				while ( have_rows('row') ) : the_row();

				// vars
				$column1 = get_sub_field('column_1_content');
				$column2 = get_sub_field('column_2_content');
		?>

						<section class="<?php the_sub_field('section_class'); ?>">

						<?php if(get_sub_field('columns') == "1") { ?>
						<?php if( ! get_sub_field('full_width') ): ?><div class="wrap"><?php endif; ?>
										<?php echo $column1; ?>
								</div>
						<?php } ?>

						<?php if(get_sub_field('columns') == "2") { ?>
									<div class="wrap">
										<div class="left-col">
											<?php echo $column1; ?>
										</div>
										<div class="right-col">
											<?php echo $column2; ?>
										</div>
									</div>
						<?php } ?>

						</section>

		<?php endwhile;

		endif;

		?>

<?php get_footer( 'lp-mobile' ); ?>
