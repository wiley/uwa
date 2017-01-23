<?php get_header( 'lp' ); ?>

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
										<div class="left-col">
												<div class="wrap">
														<?php echo $column1; ?>
												</div>
										</div>
										<div class="right-col">
												<div class="wrap">
														<?php echo $column2; ?>
												</div>
										</div>
						<?php } ?>

						</section>

		<?php endwhile;

		endif;

		?>

		<?php
		if( have_rows('modal') ):

				while ( have_rows('modal') ) : the_row();

				$modalId = get_sub_field('modal_id');
				$modalContent = get_sub_field('modal_content'); ?>

					<div id="<?php echo $modalId; ?>" class="modal">
						<a href="#" class="js-modal__close js-modal__close_overlay">Close</a>
						<div class="modal__content">
							<a href="#" class="js-modal__close">&times; Close</a>
							<?php echo $modalContent; ?>
						</div>
					</div>
				<?php endwhile; ?>
		<?php endif; ?>

<?php get_footer( 'lp' ); ?>
