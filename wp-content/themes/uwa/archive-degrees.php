<?php get_header(); ?>

			<div class="content">

				<div class="wrap cf">

					<main class="main-content cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						<?php
							$allDegreesArgs = array(
								 'posts_per_page' => -1,
								 'orderby' => 'title',
								 'order'   => 'ASC',
								 'post_type' => 'degrees',
								 'post_status' => 'publish',
							);
							$allDegrees = get_posts( $allDegreesArgs );
						?>

						<?php
							$businessArgs = array(
								 'posts_per_page' => -1,
								 'orderby' => 'title',
								 'order'   => 'ASC',
								 'post_type' => 'degrees',
								 'degree_vertical' => 'business',
								 'post_status' => 'publish'
							);
							$businessDegrees = get_posts( $businessArgs );
						?>

						<?php
							$teachingArgs = array(
								 'posts_per_page' => -1,
								 'orderby' => 'title',
								 'order'   => 'ASC',
								 'post_type' => 'degrees',
								 'degree_vertical' => 'teaching',
								 'post_status' => 'publish'
							);
							$teachingDegrees = get_posts( $teachingArgs );
						?>
						<?php
							$psychologyCounselingArgs = array(
								 'posts_per_page' => -1,
								 'orderby' => 'title',
								 'order'   => 'ASC',
								 'post_type' => 'degrees',
								 'degree_vertical' => 'psychology-counseling',
								 'post_status' => 'publish'
							);
							$psychologyCounselingDegrees = get_posts( $psychologyCounselingArgs );
						?>

						<div class="controls">

						    <div class="toolbar-filter" role="toolbar">
						      <span class="toolbar-filter__label" style="font-family: 'Oswald', sans-serif; font-size: 0.9em; text-transform: uppercase;">Select Degree Type:</span>
						      <button class="btn__hollow" aria-label="List business degrees" data-filter=".business" class="filter">Business</button>

						      <button class="btn__hollow" aria-label="List education degrees" data-filter=".teaching" class="filter">Teaching</button>

						      <button class="btn__hollow" aria-label="List psychology and human-services degrees" data-filter=".psychology-counseling" class="filter">Psychology</button>
						      <button class="btn__hollow" aria-label="List All Degrees" data-filter="all" class="filter">All</button>
						    </div>

						</div>


						<ul id="mix-container" class="noList cf">
						  <?php foreach ($allDegrees as $post): ?>
						    <?php setup_postdata($post); ?>
									<?php $terms = get_the_terms( $post->ID, 'degree_vertical'); ?>
									<a class="mix card <?php echo custom_taxonomies_terms_slugs(); ?>" href="<?php the_permalink(); ?>">
									  <div>
									    <?php if (!empty( $terms )): ?>
									    <?php endif; ?>
									    <h4><?php the_title(); ?></h4>
									    <div class="card__info">More Information &gt;&gt;</div>
									  </div>
									</a>
						  <?php endforeach;?>

						  <?php foreach ($teachingDegrees as $post): ?>
						    <?php setup_postdata($post); ?>
									<?php $terms = get_the_terms( $post->ID, 'degree_vertical'); ?>
									<a class="mix card <?php echo custom_taxonomies_terms_slugs(); ?>" href="<?php the_permalink(); ?>">
									  <div>
									    <?php if (!empty( $terms )): ?>
									      <div class="program__icons">
									        <?php foreach ($terms as $term): ?>


									        <?php endforeach; ?>
									      </div>
									    <?php endif; ?>
									    <h4><?php the_title(); ?></h4>
									    <div class="card__info">More Information &gt;&gt;</div>
									  </div>
									</a>
						  <?php endforeach; ?>

							<?php foreach ($psychologyCounselingDegrees as $post): ?>
								<?php setup_postdata($post); ?>
									<?php $terms = get_the_terms( $post->ID, 'degree_vertical'); ?>
									<a class="mix card <?php echo custom_taxonomies_terms_slugs(); ?>" href="<?php the_permalink(); ?>">
										<div>
											<?php if (!empty( $terms )): ?>
												<div class="program__icons">
													<?php foreach ($terms as $term): ?>


													<?php endforeach; ?>
												</div>
											<?php endif; ?>
											<h4><?php the_title(); ?></h4>
											<div class="card__info">More Information &gt;&gt;</div>
										</div>
									</a>
							<?php endforeach; ?>
						</ul>

					</main>

				</div>

			</div>

<?php get_footer(); ?>
