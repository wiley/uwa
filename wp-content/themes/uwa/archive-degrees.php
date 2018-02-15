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
	function setFilterOrder($term1, $term2) {
	        if ($term1->display_order == $term2->display_order) {
	            return 0;
	        } elseif ($term1->display_order < $term2->display_order) {
	            return -1;
	        } else {
	            return 1;
	        }
	    }

	if ($degreeLevels) {
	    foreach ($degreeLevels as $index => $term) {
				$termID = 'term_' . $term->term_id;
				$menuOrderValue = get_field('menu_order', $termID);
				$degreeLevels[$index]->display_order = $menuOrderValue;
	    }
	    usort($degreeLevels, 'setDisplayOrder');
	}
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

	<div id="app">
		<degrees-app></degrees-app>
		<!-- <div class="controlsWrapper">
			<fieldset class="degreeTypes">
				<h2 class="toolbar-filter__label">Area Of Study
					<?php include('library/images/arrow-down-red.svg'); ?>
				</h2>
				<div class="degreeTypesToolbar toolbar-filter" role="toolbar">
					<button class="btn__hollow filter" aria-label="List All Degrees Types" data-filter="">All</button>
					<button
						v-for="area in areasOfStudy"
						:key="area.id"
						class="btn__hollow filter"
						:data-filter="area.slug"
						:aria-label="'Filter By ' + area.name"
						@click.prevent="updateDegrees(area)">
						{{area.name}} : {{area.id}}
					</button>
				</div>
			</fieldset>

			<h3>Acive Area: {{this.activeAreaOfStudy}}</h3>
		</div>
		<div class="degrees">
			<template
				v-for="degree in filteredDegrees">
				<div
					:key="degree.id"
					class="degree">
					<h3 v-html="degree.title.rendered"></h3>
					<a :href="'online-degrees/' + degree.slug">More Info</a>
				</div>
			</template>
		</div> -->
	</div>
	<main>

		<div class="controlsWrapper">
			<form class="controls" id="Filters">
			  <!-- We can add an unlimited number of "filter groups" using the following format: -->

			  <fieldset class="degreeTypes">
			    <h2 class="toolbar-filter__label">Area Of Study
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
									$termID = 'term_' . $degreeLevel->term_id;
									$menuOrderValue = get_field('menu_order', $termID);
								?>

									<?php if ($menuOrderValue): ?>
										<button  class="btn__hollow filter" aria-label="Filter By <?php echo $Name; ?>" data-filter=".<?php echo $slug; ?>"><?php echo $Name; ?></button>
									<?php endif; ?>

							<?php endforeach; ?>
					</div>
			  </fieldset>
				<div id="holder">
					<div id="activeFiltersHolder"></div>
					<button id="Reset" class="btn-red">Clear</button>
				</div>

			</form>
		</div>

			<div class="mix-containerWrapper">

				<ul id="mix-container" class="container noList cf">
					<?php foreach ($allDegrees as $post): ?>
						<?php setup_postdata($post); ?>
							<?php $terms = get_the_terms( $post->ID, 'degree_vertical'); ?>

							<?php if (get_field('program_subtitle', $post->ID)): ?>
						    <?php $text = get_field('program_subtitle', $post->ID); ?>
						  <?php endif; ?>

							<a style="background-image: url(<?php the_field('program_image'); ?>);" class="mix card <?php echo custom_taxonomies_terms_slugs(); ?>" href="<?php the_permalink(); ?>">
								<div class="card__infoWrapper">
									<?php if (!empty( $terms )): ?>
									<?php endif; ?>
									<h3 class="card__title"><?php the_title(); ?></h3>

									<div class="card__info">More Information <?php include('library/images/arrow.svg'); ?></div>
									<div class="cardLink__cta-background"></div>
								</div>
							</a>
					<?php endforeach;?>


				</ul>
<!-- </div> -->
			</div>

	</main>

<?php get_footer(); ?>
