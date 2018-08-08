<?php get_header(); ?>
	<style media="screen">
		.filter.active {
			background: #A81D32;
	    color: white;
	    font-weight: 900;
		}

		.search-filter {
			position: relative;
		}
		.searchFilter-icon {
			height: 45px;
		}

		@media (min-width: 800px) {
			#degrees-app {
				margin-left: 4em;
			}
			.controlsWrapper {
				max-width: 340px;
			}
			.degree-app-wrapper {
				min-height: 400px;
			}
		}
	</style>

	<div class="degree-app-wrapper" role="main">
		<div id="app">
			<degrees-app></degrees-app>
		</div>
	</div>
<?php get_footer(); ?>
