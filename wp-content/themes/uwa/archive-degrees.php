<?php get_header(); ?>
<!-- TESTING!!!  -->
	<style media="screen">
		.sticky-grid {
			max-width: 74%;
		}
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
	<script>
        /*this is to support filter buttons of home page*/
		var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
		function waitForElement(elementClass, callBack) {
    		window.setTimeout(
        		function () {
            		var element = document.getElementsByClassName(elementClass);
            		if(element) {
                		callBack(elementClass, element);
            		} else {
                		waitForElement(elementClass, callBack);
            		}
        		}, 100
    		)
		}
        jQuery(document).ready(
            function () {
                waitForElement(
                    '.filter-group', function () {
                        var id = $(location).attr('hash').slice(1);
                        // to make sure it will for future but you need to make sure degree level slug and hash is equal
						if (isMobile) {
							jQuery('.filter-group.filters-types h2').one("click", function () {
								waitForElement('.degreeLevelsToolbar',function(){
									jQuery('button.btn__hollow.filter.'+id).click();
								});                                
    						});
							jQuery('.filter-group.filters-types h2').trigger("click");								
						}
                        jQuery('.degreeLevelsToolbar button.'+id).click();
                    }
                );
            }
        );
    </script>

	<div class="degree-app-wrapper" role="main">
		<div id="app">
			<degrees-app></degrees-app>
		</div>
	</div>
<?php get_footer(); ?>
