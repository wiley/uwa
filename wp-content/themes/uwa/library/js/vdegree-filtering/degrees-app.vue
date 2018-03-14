<template>
<div id="degrees-app">

	<div class="controlsWrapper">
		<div class="input-wrapper search-filter">
			<input type="text" class="toolbar-filter__search" placeholder="Click here to search" v-model="searchFilter">
			<div tabindex="0" @click="clearSearch" @keypress.enter="clearSearch" class="searchFilter-icon" :class="{clickable: searchQueryExists}">
				<transition mode="out-in" name="search">
					<img key="search" v-if="!searchQueryExists" src="/wp-content/themes/uwa/library/images/filtering-module/seach.svg" alt="Search Icon">
					<img key="clear" v-else src="/wp-content/themes/uwa/library/images/filtering-module/clear-search.svg" alt="Clear Search">
				</transition>
			</div>
		</div>


		<div class="filter-group filters-types">
			<h2 @click="toggleDegreeTypesFilters" class="toolbar-filter__label" :class="{activeFilter: degreeTypesFilterIsActive}">
					Degree Types
					<transition mode="out-in" name="icon-switch">
						<img key="arrow-down" v-if="mobileMode && !showDegreeTypesToolbar" src="/wp-content/themes/uwa/library/images/filtering-module/arrow-down-red.svg" alt="">
						<img key="arrow-down" v-else-if="mobileMode && showDegreeTypesToolbar" src="/wp-content/themes/uwa/library/images/filtering-module/arrow-up-red.svg" alt="">
					</transition>
					<transition name="icon-switch">
						<span @click="activeDegreeType = 'all'" class="desktop-clear" v-if="!mobileMode && activeDegreeType != 'all'">
							<img key="clear" src="/wp-content/themes/uwa/library/images/filtering-module/clear-search-red.svg" alt="Clear Search">
							Clear
						</span>
					</transition>
				</h2>

			<h3 v-if="mobileMode && activeDegreeType != 'all'" class="toolbar-filter__activeTitle">
					{{activeDegreeTypeTitle}}
					<img class="activeTitle-clear" @click="activeDegreeType = 'all'" src="/wp-content/themes/uwa/library/images/filtering-module/clear-search-red.svg" alt="Clear Search">
				</h3>

			<transition name="slide-down">
				<div v-if="showDegreeTypesToolbar" class="degreeLevelsToolbar toolbar-filter" :class="{activeFilter: degreeTypesFilterIsActive}" role="toolbar">
					<filter-options-list :options="degreeTypes" @option-selected="updateActiveDegreeType" @reset-filter="updateDegreeTypeToAll" :currentlySelectedOption="activeDegreeType">
					</filter-options-list>
				</div>
			</transition>
		</div>

		<div class="filter-group filters-areas">
			<!-- <fieldset class="degreeAreas"> -->
			<h2 @click="toggleDegreeAreasFilters" class="toolbar-filter__label">
					Areas Of Study
					<transition mode="out-in" name="icon-switch">
						<img key="arrow-down" v-if="mobileMode && !showDegreeAreasToolbar" src="/wp-content/themes/uwa/library/images/filtering-module/arrow-down-red.svg" alt="">
						<img key="arrow-down" v-else-if="mobileMode && showDegreeAreasToolbar" src="/wp-content/themes/uwa/library/images/filtering-module/arrow-up-red.svg" alt="">
					</transition>
					<transition name="icon-switch">
						<span @click="activeAreaOfStudy = 'all'" class="desktop-clear" v-if="!mobileMode && activeAreaOfStudy != 'all'">
							<img key="clear" src="/wp-content/themes/uwa/library/images/filtering-module/clear-search-red.svg" alt="Clear Search">
							Clear
						</span>
					</transition>
				</h2>
			<h3 v-if="mobileMode && activeAreaOfStudy != 'all'" class="toolbar-filter__activeTitle">
					{{activeAreaOfStudyTitle}}
					<img class="activeTitle-clear" @click="activeAreaOfStudy = 'all'" src="/wp-content/themes/uwa/library/images/filtering-module/clear-search-red.svg" alt="Clear Search">
				</h3>
			<transition name="slide-down">
				<div v-if="showDegreeAreasToolbar" class="degreeAreasToolbar toolbar-filter" role="toolbar">

					<areas-filter-options-list
						:options="areasOfStudyTest"
						@option-selected="updateActiveDegreeArea"
						@reset-filter="updateDegreeAreaToAll"
						:currentlySelectedOption="activeAreaOfStudy">
					</areas-filter-options-list>
				</div>
			</transition>
<!-- <ul v-if="areasOfStudyFilters.length">
	<li
		v-for="(option, index) in areasOfStudyFilters"
		:key="option.id"
		:class="[{ active: option.id === activeAreaOfStudy}, option.slug]">
		<h4 v-html="option.name"></h4>
		<ul v-if="option.sub_areas">
			<li v-for="subAreaOption in option.sub_areas">
				<h4 v-html="subAreaOption.name"></h4>
			</li>
		</ul>
	</li>
</ul> -->
			<!-- </fieldset> -->
		</div>

	</div>

	<loading-spinner :isVisible="!listForFilteredDegreesAreaAndLevel.length && !degrees.length"></loading-spinner>
	<isotope v-show="listForFilteredDegreesAreaAndLevel.length" ref="cpt" id="root_isotope1" class="degrees" :list="degrees" :options='isotopeOptions'>
		<a v-for="degree, index in listForFilteredDegreesAreaAndLevel" :key="index" :href="'online-degrees/' + degree.slug" class="degree-transition degree" :class="getDegreeClasses(degree)">
			<small class="label" v-if="degree.degree_types[0]" v-html="degree.degree_types[0].name"></small>
			<small class="label undefined" v-else>No Program Type Set</small>
			<h3 class="degree__title" v-html="degree.title.rendered"></h3>
			<span v-if="checkForTeachingCertificate(degree)" class="includes-licensure">
				<img src="/wp-content/themes/uwa/library/images/filtering-module/icon-alabama.svg" alt="Alabama State Icon">
				Includes Licensure
			</span>
			<div class="degree__cta-button">More Info</div>
		</a>
	</isotope>
	<div id="no-results-msg" v-show="!listForFilteredDegreesAreaAndLevel.length && degrees.length">No Results Match This Criteria</div>
</div>
</template>

<script>
import WPAPI from "wpapi";
import isotope from 'vueisotope'
import ToolbarFilter from './components/ToolbarFilter'
import FilterOptionsList from './components/FilterOptionsList'
import AreasFilterOptionsList from './components/AreasFilterOptionsList'
import LoadingSpinner from './components/LoadingSpinner'
const devUrl = 'https://uwa-gulp.dev'
const liveUrl = 'https://onlineuwa.staging.wpengine.com'
const apiPromise = WPAPI.discover(liveUrl);

export default {
	name: "degrees-app",
	components: {
		isotope,
		ToolbarFilter,
		FilterOptionsList,
		AreasFilterOptionsList,
		LoadingSpinner
	},
	data() {
		return {
			searchFilter: '',
			loadingApi: true,
			mobileMode: false,
			showDegreeTypesToolbar: true,
			showDegreeAreasToolbar: true,
			degreeTypesFilterIsActive: false,
			degreeAreasFilterIsActive: false,
			degrees: [],
			areasOfStudy: [],
			areasOfStudyTest: [],
			degreeTypes: [],
			activeAreaOfStudyTitle: '',
			activeDegreeTypeTitle: '',
			activeAreaOfStudy: 'all',
			activeDegreeType: 'all',
			activeFilter: null,
			isotopeOptions: {
				itemSelector: ".degree",
				// layoutMode: 'fitRows',
				masonry: {
					// columnWidth: 200,
					// isFitWidth: true
				},
				getFilterData: {
					"show all": function() {
						return true;
					},
					filterByDegreeAreas: function(el) {
						return this.listForFilteredDegreesAreaAndLevel()
						// return this.listForFilteredDegreesAreaAndLevel
					}
				}
			}
		};
	},
	computed: {
		searchQueryExists() {
			return this.searchFilter !== ''
		},

		allFilterSelected() {
			return this.activeAreaOfStudy === "all" || this.activeDegreeType === "all" ?
				true :
				false;
		},

		filteredDegreesByArea() {
			let activeAreaOfStudy = this.activeAreaOfStudy;
			let activeDegreeType = this.activeDegreeType;

			return activeAreaOfStudy ?
				this.filterDegreesByArea(activeAreaOfStudy) :
				this.degrees;
		},

		filteredDegreesBySearch() {
			return this.degrees.filter(degree => {
				let title = degree.title.rendered
				return title.toLowerCase().includes(this.searchFilter.toLowerCase())
			})
		},

		filteredDegreesByType() {
			let activeDegreeType = this.activeDegreeType;

			return activeDegreeType ?
				this.filterDegreesByType(activeDegreeType) :
				this.degrees;
		},
		areasOfStudyFilters() {
			function returnTeachingFilterIndex(area) {
				return area.id === 7
			}
			let teachingSubAreas = []
			let areasFiltersArray = this.areasOfStudy
			let topLevelFilters = areasFiltersArray.filter(area => {
				return area.parent === 0
			});
			let teachingFilterIndex = topLevelFilters.findIndex(returnTeachingFilterIndex)

			topLevelFilters.forEach((area, index) => {
				area['sub_areas'] = []
			});

			areasFiltersArray.forEach((area, index) => {
				// area[index]['sub_areas'] = []
				if (area.parent === 7) {
					teachingSubAreas.push(area)
				}
			});

			topLevelFilters[teachingFilterIndex]['sub_areas'] = teachingSubAreas
			return topLevelFilters
			// return []
		},

		listForFilteredDegreesAreaAndLevel() {
			let a = new Set(this.filteredDegreesByArea);
			let b = new Set(this.filteredDegreesByType);
			let c = new Set(this.filteredDegreesBySearch);
			let intersection = new Set(
				[...a].filter(x => b.has(x) && c.has(x))
			);

			return [...intersection]
		}
	},

	created() {
		this.getData();
		console.log('After .then: all done');
		this.loadingApi = false
	},

	mounted() {

		if (matchMedia) {
			const mq = window.matchMedia("(min-width: 800px)");
			mq.addListener(this.WidthHandler);
			this.WidthHandler(mq);
			// this.setupFiltersModeOnLoad();
		}

	},

	methods: {
		createAreasOfStudyFilters(arrayOfFilters) {
			function returnTeachingFilterIndex(area) {
				return area.id === 7
			}
			let teachingSubAreas = []
			let areasFiltersArray = this.areasOfStudy
			let topLevelFilters = areasFiltersArray.filter(area => {
				return area.parent === 0
			});
			let teachingFilterIndex = topLevelFilters.findIndex(returnTeachingFilterIndex)

			topLevelFilters.forEach((area, index) => {
				area['sub_areas'] = []
			});

			areasFiltersArray.forEach((area, index) => {
				// area[index]['sub_areas'] = []
				if (area.parent === 7) {
					teachingSubAreas.push(area)
				}
			});
			console.log('sub_areas: ', teachingSubAreas);
			console.log('topLevelFilters: ', topLevelFilters);
			topLevelFilters[teachingFilterIndex]['sub_areas'] = teachingSubAreas
			this.areasOfStudyTest = topLevelFilters
			// return []
		},
		WidthHandler(mq) {
			if (mq.matches) {
				this.mobileMode = false
				this.showDegreeTypesToolbar = true
				this.showDegreeAreasToolbar = true
			} else {
				this.mobileMode = true
				this.showDegreeTypesToolbar = false
				this.showDegreeAreasToolbar = false
			}
		},

		setupFiltersModeOnLoad() {
			if (this.mobileMode === false) {
				this.showDegreeTypesToolbar = true
			} else {
				return false
			}
		},

		toggleDegreeTypesFilters() {
			if (this.mobileMode) {
				if (this.showDegreeAreasToolbar === true) {
					this.showDegreeAreasToolbar = false
				}
				this.showDegreeTypesToolbar = !this.showDegreeTypesToolbar
				this.degreeTypesFilterIsActive = !this.degreeTypesFilterIsActive
				this.activeFilter = this.activeFilter === 'degreeTypes' ? null : 'degreeTypes'

			}
		},

		toggleDegreeAreasFilters() {
			if (this.mobileMode) {
				if (this.showDegreeTypesToolbar === true) {
					this.showDegreeTypesToolbar = false
				}
				this.showDegreeAreasToolbar = !this.showDegreeAreasToolbar
				this.degreeAreasFilterIsActive = !this.degreeAreasFilterIsActive
				this.activeFilter = this.activeFilter === 'degreeAreas' ? null : 'degreeAreas'
			}
		},

		clearSearch() {
			this.searchFilter = ''
		},

		getDegreeClasses(degree) {
			let degreeLevels = degree.degree_levels
			let degreeTypes = degree.degree_types

			let levels = degreeLevels.map(level => {
				return level.slug || ''
			})

			let types = degreeTypes.map(type => {
				if (type.slug) {
					return type.slug
				} else {
					return ''
				}
			})
			// return levels
			return levels.concat(types)
		},

		checkForTeachingCertificate(degree) {
			let degreeLevels = degree.degree_levels
			// return degreeLevels.includes('')
			let levels = degreeLevels.filter(level => {
				return level.slug == "teaching-certificates"
			})
			console.log(levels.length);
			if (levels.length > 0) {
				return true
			} else {
				return false
			}
		},

		updateActiveDegreeType(type) {
			this.activeDegreeType = type.id;
			if (this.mobileMode) {
				this.activeDegreeTypeTitle = type.name;
				this.showDegreeTypesToolbar = false
			}
			this.activeFilter = null
		},

		updateActiveDegreeArea(area) {
			this.activeAreaOfStudy = area.id;
			if (this.mobileMode) {
				this.activeAreaOfStudyTitle = area.name;
				this.showDegreeAreasToolbar = false
			}
			this.activeFilter = null
		},

		updateDegreeTypeToAll() {
			this.activeDegreeType = "all";
			if (this.mobileMode) {
				this.activeDegreeTypeTitle = '';
				this.showDegreeTypesToolbar = false
			}
			this.activeFilter = null
		},

		updateDegreeAreaToAll() {
			this.activeAreaOfStudy = "all";
			if (this.mobileMode) {
				this.activeAreaOfStudyTitle = '';
				this.showDegreeAreasToolbar = false
			}
			this.activeFilter = null
		},
		returnListForFilteredDegreesAreaAndLevel() {
			const combinedArray = [...this.returnListForFilteredDegreesArea, ...this.returnListForFilteredDegreesType];
			return [...new Set(combinedArray)]
		},

		returnListForFilteredDegreesArea() {
			let filteredDegrees = this.degrees.filter(degree => {
				let areasOfStudyForDegree = degree.verticals;
				return areasOfStudyForDegree.includes(this.activeAreaOfStudy);
			});
			return filteredDegrees;
		},

		returnListForFilteredDegreesType() {
			let filteredDegrees = this.degrees.filter(degree => {
				let areasOfStudyForDegree = degree.verticals;
				console.log(areasOfStudyForDegree);

				return areasOfStudyForDegree.includes(this.activeAreaOfStudy);
			});
			return filteredDegrees;

		},

		filterDegreesByType(activeDegreeType) {
			let filteredDegrees = this.degrees.filter(degree => {
				if (this.activeDegreeType === 'all') {
					return degree;
				}
				let degreeTypesForDegree = degree.levels;
				return degreeTypesForDegree.includes(activeDegreeType);
			});
			return filteredDegrees;
		},

		filterDegreesByArea(activeAreaOfStudy, activeDegreeType) {
			let filteredDegrees = this.degrees.filter(degree => {
				if (this.activeAreaOfStudy === 'all') {
					return degree;
				}
				let areasOfStudyForDegree = degree.verticals;
				return areasOfStudyForDegree.includes(activeAreaOfStudy);
			});
			return filteredDegrees;
		},

		getData() {

			apiPromise.then(site => {
				site
					.degrees()
					.perPage(100)
					.then(degrees => {
						this.degrees = degrees;
					})
					.catch(error => {
						console.log(error);
					});

				site
					.verticals()
					.perPage(100)
					.then(areas => {
						this.areasOfStudy = areas;
						this.createAreasOfStudyFilters(areas)
					})
					.catch(error => {
						console.log(error);
					});

				site
					.levels()
					.perPage(100)
					.then(levels => {
						this.degreeTypes = levels;
						// this.loadingApi = false
					})
					.catch(error => {
						console.log(error);
					});
			});
		}
	}
};
</script>

<style lang="scss">
.searchFilter-icon {
    width: 40px;
    background-color: #A81D32;
    background-repeat: no-repeat;
    top: 0;
    bottom: 0;
    right: 0;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;

    &.clickable {
        cursor: pointer;
    }
}

#degrees-app {
    min-height: 600px;
    position: relative;
    .controlsWrapper {
        @media (min-width: 800px) {
            margin-top: 3em;
        }
        .filter-group {

            @media (max-width: 799px) {
                margin-top: 0;
                flex-basis: 48%;
                background: #E9E9EA;
                margin: 0.5em 0;
            }

        }
        .toolbar-filter {
            &__label {
                cursor: pointer;
                position: relative;
                font-size: 14px;
                padding-left: 0.5em;

                @media (min-width: 601px) {
                    font-size: 16px;
                }
                @media (min-width: 901px) {
                    cursor: auto;
                    font-size: 20px;
                    display: flex;
                    justify-content: space-between;
                    align-items: flex-end;
                }

                img {
                    position: absolute;
                    right: 5px;

                    @media (max-width: 900px) {
                        top: -5px;
                        width: 30px;
                    }
                }
            }
            &__activeTitle {
                font-size: 1em;
                position: absolute;
                width: 48%;
                padding: 10px 20px 10px 5px;
                margin-top: 0;
                background: #F4F2E4;
                font-size: 0.8em;
                height: 50px;
            }
            @media (min-width: 800px) {
                .filter:not(.active) {
                    &:focus,
                    &:hover {
                        background: #E9E9EA;
                    }
                }
            }
        }
    }
}
.desktop-clear {
    cursor: pointer !important;
    font-size: 0.7em;
    display: flex;
    align-items: flex-end;
    background: #F4F2E4;
    padding: 3px 5px;
    border-radius: 2px;
    color: #A81D32;

    img {
        width: 17px;
        margin-right: 3px;
        position: relative !important;
    }
}

.activeTitle-clear {
    position: absolute;
    right: 10px;
    width: 20px;
    top: 7px;
    cursor: pointer;
}
#no-results-msg {
    display: flex;
    flex-flow: row wrap;
    align-items: center;
    justify-content: center;
    font-size: 1.5em;
    font-weight: 600;

    @media (min-width: 800px) {
        // position: fixed;
        // right: 50%;
        // top: 65%;
        transform: translate3d(50%, -50%, 0);
        position: absolute;
        width: 400px;
        max-width: 100%;
        flex: 1 1 calc(100% - 400px);
        align-self: flex-start;
        // position: relative;
        // margin-top: 15%;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        font-size: 2.25em;
        background: white;
        border-radius: 3px;
        right: 40%;
        top: 40%;
    }
}
.includes-licensure {
	position: relative;
	font-size: 11px;
	font-style: italic;
	font-weight: 700;
	display: flex;
	align-items: flex-start;
	top: -1.5em;
}
#degrees-app .degrees .degree {
	@media (max-width: 799px) {
		left: 48% !important;
		transform: translateX(-50%) !important;
	}
}

</style>
