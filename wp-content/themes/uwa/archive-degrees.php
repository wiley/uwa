<?php get_header(); ?>
<style media="screen">
	.filter.active {
		background: #A81D32;
    color: white;
    font-weight: 900;
	}
</style>
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
	<main>
		<div class="controlsWrapper">
			<form class="controls" id="Filters">
			  <!-- We can add an unlimited number of "filter groups" using the following format: -->

			  <fieldset class="degreeTypes">
			    <h2 class="toolbar-filter__label">Areas Of Study
						<?php include('library/images/arrow-down-red.svg'); ?>
					</h2>
					<div class="degreeTypesToolbar toolbar-filter" role="toolbar">
						<button class="btn__hollow filter" aria-label="List All Degrees Types" data-filter="">All</button>
							<?php foreach ($degreeTypes as $degreeType): ?>
								<?php
									$Name = $degreeType->name;
									$slug = $degreeType->slug;
								?>

									<button class="btn__hollow filter" aria-label="Filter By <?php echo $Name; ?>" data-filter=".<?php echo $slug; ?>"><?php echo $Name; ?>

									</button>
							<?php endforeach; ?>
					</div>
			  </fieldset>

			  <fieldset class="degreeLevels">
			    <h2 class="toolbar-filter__label">Degree Types
						<?php include('library/images/arrow-down-red.svg'); ?>
					</h2>
					<div class="degreeLevelsToolbar toolbar-filter" role="toolbar">
						<!-- <span class="toolbar-filter__label" style="font-family: 'Oswald', sans-serif; font-size: 0.9em; text-transform: uppercase;">Select Degree Level:</span> -->
						<button  class="btn__hollow filter" aria-label="List All Degrees Levels" data-filter="">All</button>
							<?php foreach ($degreeLevels as $degreeLevel): ?>
								<?php
									$Name = $degreeLevel->name;
									$slug = $degreeLevel->slug;
								?>

									<button  class="btn__hollow filter" aria-label="Filter By <?php echo $Name; ?>" data-filter=".<?php echo $slug; ?>"><?php echo $Name; ?></button>
							<?php endforeach; ?>
					</div>
			  </fieldset>

			  <button id="Reset" class="btn-red">Clear Filters</button>
			</form>
		</div>

			<div class="mix-containerWrapper">
<!-- <div class="wrap cf"> -->
				<ul id="mix-container" class="container noList cf">
					<?php foreach ($allDegrees as $post): ?>
						<?php setup_postdata($post); ?>
							<?php $terms = get_the_terms( $post->ID, 'degree_vertical'); ?>

							<a style="background-image: url(<?php the_field('program_image'); ?>);" class="mix card <?php echo custom_taxonomies_terms_slugs(); ?>" href="<?php the_permalink(); ?>">
								<div class="card__infoWrapper">
									<?php if (!empty( $terms )): ?>
									<?php endif; ?>
									<h4 class="card__title"><?php the_title(); ?></h4>

									<div class="card__info">More Information &gt;&gt;</div>
								</div>
							</a>
					<?php endforeach;?>


				</ul>
<!-- </div> -->
			</div>

	</main>

<?php get_footer(); ?>
