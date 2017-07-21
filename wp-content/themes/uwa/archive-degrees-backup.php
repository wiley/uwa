<?php get_header(); ?>
<?php
$degreeTypes = get_terms([
    'taxonomy' => 'degree_vertical',
    'hide_empty' => false,
]);

$degreeLevels = get_terms([
    'taxonomy' => 'degree_level',
    'hide_empty' => false,
]);
?>
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

								<div class="degreeTypeToolbar toolbar-filter" role="toolbar">
								  <span class="toolbar-filter__label" style="font-family: 'Oswald', sans-serif; font-size: 0.9em; text-transform: uppercase;">Select Degree Level:</span>
						      <button class="btn__hollow" aria-label="List All Degrees Types" data-filter="all" class="filter">All</button>
										<?php foreach ($degreeTypes as $degreeType): ?>
											<?php
												$Name = $degreeType->name;
												$slug = $degreeType->slug;
											?>

										    <button class="btn__hollow" aria-label="Filter By <?php echo $Name; ?>" data-filter=".<?php echo $slug; ?>" class="filter"><?php echo $Name; ?></button>
										<?php endforeach; ?>
								</div>

								<div class="degreeLevelToolbar toolbar-filter" role="toolbar">
									<span class="toolbar-filter__label" style="font-family: 'Oswald', sans-serif; font-size: 0.9em; text-transform: uppercase;">Select Degree Level:</span>
									<button class="btn__hollow" aria-label="List All Degrees Levels" data-filter="all" class="filter">All</button>
										<?php foreach ($degreeLevels as $degreeLevel): ?>
											<?php
												$Name = $degreeLevel->name;
												$slug = $degreeLevel->slug;
											?>

												<button class="btn__hollow" aria-label="Filter By <?php echo $Name; ?>" data-filter=".<?php echo $slug; ?>" class="filter"><?php echo $Name; ?></button>
										<?php endforeach; ?>
								</div>
						</div>

<?php $terms = get_the_terms( $post->ID, 'degree_vertical'); ?>
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


						</ul>

					</main>

				</div>

			</div>

<?php get_footer(); ?>
