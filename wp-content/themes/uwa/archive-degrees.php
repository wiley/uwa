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
		<form class="controls" id="Filters">
  <!-- We can add an unlimited number of "filter groups" using the following format: -->

  <fieldset>
    <h4>Degree Types</h4>
		<div class="degreeTypesToolbar toolbar-filter" role="toolbar">
			<span class="toolbar-filter__label" style="font-family: 'Oswald', sans-serif; font-size: 0.9em; text-transform: uppercase;">Select Degree Level:</span>
			<button class="btn__hollow filter" aria-label="List All Degrees Types" data-filter="all">All</button>
				<?php foreach ($degreeTypes as $degreeType): ?>
					<?php
						$Name = $degreeType->name;
						$slug = $degreeType->slug;
					?>

						<button class="btn__hollow filter" aria-label="Filter By <?php echo $Name; ?>" data-filter=".<?php echo $slug; ?>"><?php echo $Name; ?></button>
				<?php endforeach; ?>
		</div>
  </fieldset>

  <fieldset>
    <h4>Degree Levels</h4>
		<div class="degreeLevelsToolbar toolbar-filter" role="toolbar">
			<span class="toolbar-filter__label" style="font-family: 'Oswald', sans-serif; font-size: 0.9em; text-transform: uppercase;">Select Degree Level:</span>
			<button  class="btn__hollow filter" aria-label="List All Degrees Levels" data-filter="all">All</button>
				<?php foreach ($degreeLevels as $degreeLevel): ?>
					<?php
						$Name = $degreeLevel->name;
						$slug = $degreeLevel->slug;
					?>

						<button  class="btn__hollow filter" aria-label="Filter By <?php echo $Name; ?>" data-filter=".<?php echo $slug; ?>"><?php echo $Name; ?></button>
				<?php endforeach; ?>
		</div>
  </fieldset>

  <button id="Reset">Clear Filters</button>
</form>

			<ul id="mix-container" class="container noList cf">
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

		<!-- <div id="Container" class="container">
		  <div class="mix triangle white"></div>
		  <div class="mix square white"></div>
		  <div class="mix circle green"></div>
		  <div class="mix triangle blue"></div>
		  <div class="mix square white"></div>
		  <div class="mix circle blue"></div>
		  <div class="mix triangle green"></div>
		  <div class="mix square blue"></div>
		  <div class="mix circle white"></div>

		  <div class="gap"></div>
		  <div class="gap"></div>
		  <div class="gap"></div>
		  <div class="gap"></div>
		</div> -->

	</main>

<?php get_footer(); ?>
