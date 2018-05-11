<?php get_header(); ?>
	<style media="screen">
		.filter.active {
			background: #A81D32;
	    color: white;
	    font-weight: 900;
		}
		.degree-app-wrapper {
			min-height: 400px;
		}
		.controlsWrapper {
			max-width: 340px;
		}

		@media (min-width: 800px) {
			#degrees-app {
				margin-left: 4em;
			}
		}
		.search-filter {
			position: relative;
		}
		.searchFilter-icon {
			height: 40px;
		}
	</style>

	<div class="degree-app-wrapper" role="main">
		<div id="app">
			<degrees-app></degrees-app>
		</div>
	</div>
<?php get_footer(); ?>
