<template>
<div id="degrees-app">

	<div class="controlsWrapper">
		<search-filter v-model="$store.searchFilter"></search-filter>

		<div class="filter-group filters-types">
			<h2 @click="toggleDegreeTypesFilters" class="toolbar-filter__label" :class="{activeFilter: degreeTypesFilterIsActive}">
					Degree Types
					<transition mode="out-in" name="icon-switch">
						<img key="arrow-down" v-if="mobileMode && !showDegreeTypesToolbar" src="/wp-content/themes/uwa/library/images/filtering-module/arrow-down-red.svg" alt="">
						<img key="arrow-down" v-else-if="mobileMode && showDegreeTypesToolbar" src="/wp-content/themes/uwa/library/images/filtering-module/arrow-up-red.svg" alt="">
					</transition>
					<transition name="icon-switch">
						<span @click="$store.activeDegreeType = 'all'" class="desktop-clear" v-if="!mobileMode && $store.activeDegreeType != 'all'">
							<img key="clear" src="/wp-content/themes/uwa/library/images/filtering-module/clear-search-red.svg" alt="Clear Search">
							Clear
						</span>
					</transition>
				</h2>
			<filter-active-title
				:filter.sync="$store.activeDegreeType"
				:visible="mobileMode && $store.activeDegreeType !== 'all'">
			</filter-active-title>
			<transition name="slide-down">
				<filter-options-list
					v-if="showDegreeTypesToolbar"
					@filterSelected="closeMenuOnMobile"
					:options="degreeTypes"
					:selectedFilter.sync="$store.activeDegreeType">
				</filter-options-list>
			</transition>
		</div>

		<div class="filter-group filters-areas">

			<h2 @click="toggleDegreeAreasFilters" class="toolbar-filter__label">
					Areas Of Study
					<transition mode="out-in" name="icon-switch">
						<img key="arrow-down" v-if="mobileMode && !showDegreeAreasToolbar" src="/wp-content/themes/uwa/library/images/filtering-module/arrow-down-red.svg" alt="">
						<img key="arrow-down" v-else-if="mobileMode && showDegreeAreasToolbar" src="/wp-content/themes/uwa/library/images/filtering-module/arrow-up-red.svg" alt="">
					</transition>
					<transition name="icon-switch">
						<span @click="$store.activeDegreeArea = 'all'" class="desktop-clear" v-if="!mobileMode && $store.activeDegreeArea != 'all'">
							<img key="clear" src="/wp-content/themes/uwa/library/images/filtering-module/clear-search-red.svg" alt="Clear Search">
							Clear
						</span>
					</transition>
				</h2>
				<filter-active-title
					:filter.sync="$store.activeDegreeArea"
					:visible="mobileMode && $store.activeDegreeArea !== 'all'">
				</filter-active-title>

			<transition name="slide-down">
				<areas-filter-options-list
					v-if="showDegreeAreasToolbar"
					@filterSelected="closeMenuOnMobile"
					:options="areasOfStudyTest"
					:selectedFilter.sync="$store.activeDegreeArea">
				</areas-filter-options-list>
			</transition>
		</div>
	</div>

	<loading-spinner :isVisible="!listForFilteredDegreesAreaAndLevel.length && !degrees.length"></loading-spinner>

	<div class="sticky-grid">
		<transition-group tag="ul" class="sticky degree-grid degrees" name="list">
			<degree-item
				v-for="degree in listForFilteredDegreesAreaAndLevel"
				:degree="degree"
				:degreeClasses="getDegreeClasses(degree)"
				:hasTeachingCertificate="checkForTeachingCertificate(degree)"
				:key="degree.id">
			</degree-item>
	  </transition-group>
		<no-results :isVisible="noResults"></no-results>
	</div>

</div>
</template>

<script>
import {DegreeFilteringMixin} from './degree-filtering-mixin'
import WPAPI from "wpapi"
import ToolbarFilter from './components/ToolbarFilter'
import FilterOptionsList from './components/FilterOptionsList'
import AreasFilterOptionsList from './components/AreasFilterOptionsList'
import FilterActiveTitle from './components/FilterActiveTitle'
import DegreeItem from './components/DegreeItem'
import SearchFilter from './components/SearchFilter'
import NoResults from './components/NoResults'
import LoadingSpinner from './components/LoadingSpinner'
const devUrl = 'https://uwa-gulp.dev'
const liveUrl = 'https://onlineuwa.staging.wpengine.com'
const apiPromise = WPAPI.discover(liveUrl);

export default {
	name: "degrees-app",
	mixins: [DegreeFilteringMixin],
	components: {
		ToolbarFilter,
		FilterOptionsList,
		AreasFilterOptionsList,
		LoadingSpinner,
		SearchFilter,
		NoResults,
		FilterActiveTitle,
		DegreeItem
	},
 	// store: ['activeFilter1', 'activeFilter2'],
	data() {
		return {
		};
	},
	computed: {
		noResults() {
			return !this.listForFilteredDegreesAreaAndLevel.length && this.degrees.length ? true : false
		},

		currentDegreesByArea() {
			let activeDegreeArea = this.$store.activeDegreeArea;
			let activeDegreeType = this.$store.activeDegreeType;

			return activeDegreeArea ?
				this.filterDegreesByArea(activeDegreeArea) :
				this.degrees;
		},

		currentDegreesBySearch() {
			return this.degrees.filter(degree => {
				let title = degree.title.rendered
				return title.toLowerCase().includes(this.$store.searchFilter.toLowerCase())
			})
		},

		currentDegreesByType() {
			let activeDegreeType = this.$store.activeDegreeType;

			return activeDegreeType ?
				this.filterDegreesByType(activeDegreeType) :
				this.degrees;
		},
		areasOfStudyFilters() {
			function returnTeachingFilterIndex(area) {
				return area.term_id === 7
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
			if ( !this.degrees ) return []
			let a = new Set(this.currentDegreesByArea);
			let b = new Set(this.currentDegreesByType);
			let c = new Set(this.currentDegreesBySearch);
			let intersection = new Set(
				[...a].filter(x => b.has(x) && c.has(x))
			);

			return [...intersection]
		}
	},

	created() {
		this.getData();
		this.loadingApi = false
	},

	mounted() {
		this.degreeTypes = this.orderByDisplayOrder(wpData.degreeLevels);
		this.createAreasOfStudyFilters()
	},

	methods: {
		closeMenuOnMobile() {
			if ( this.mobileMode ) {
				this.showDegreeTypesToolbar = false
				this.showDegreeAreasToolbar = false
			}
		},

		createAreasOfStudyFilters(arrayOfFilters) {
			function returnTeachingFilterIndex(area) {
				return area.term_id === 7
			}
			let teachingSubAreas = []
			let areasFiltersArray = wpData.degreeAreas
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

			this.areasOfStudyTest = topLevelFilters
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

			if (levels.length > 0) {
				return true
			} else {
				return false
			}
		},

		updateActiveDegreeType(type) {
			this.$store.activeDegreeType = type.term_id;
			if (this.mobileMode) {
				this.$store.activeDegreeTypeTitle = type.name;
				this.showDegreeTypesToolbar = false
			}
			this.activeFilter = null
		},

		updateActiveDegreeArea(area) {
			this.$store.activeDegreeArea = area.term_id;
			if (this.mobileMode) {
				this.$store.activeDegreeAreaTitle = area.name;
				this.showDegreeAreasToolbar = false
			}
			this.activeFilter = null
		},

		updateDegreeTypeToAll() {
			this.$store.activeDegreeType = "all";
			if (this.mobileMode) {
				this.$store.activeDegreeTypeTitle = '';
				this.showDegreeTypesToolbar = false
			}
			this.activeFilter = null
		},

		updateDegreeAreaToAll() {
			this.$store.activeDegreeArea = "all";
			if (this.mobileMode) {
				this.$store.activeDegreeAreaTitle = '';
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
				return areasOfStudyForDegree.includes(this.$store.activeDegreeArea);
			});
			return filteredDegrees;
		},

		returnListForFilteredDegreesType() {
			let filteredDegrees = this.degrees.filter(degree => {
				let areasOfStudyForDegree = degree.verticals;
				// console.log(areasOfStudyForDegree);

				return areasOfStudyForDegree.includes(this.$store.activeDegreeArea);
			});
			return filteredDegrees;

		},

		getData() {

			apiPromise.then(site => {
				site
					.degrees()
					.perPage(100)
					.then(degrees => {
						// this.degrees = this.shuffle(degrees)
						this.degrees = degrees.sort(this.sortByCompareTitles);
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
                // flex-basis: 48%;

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
                // padding: 10px 20px 10px 5px;
								padding: 10px 20px 15px 10px;
                margin-top: 0;
                background: #F4F2E4;
                font-size: 0.85em;
                // height: 50px;
            }
            @media (min-width: 800px) {
                .filter:not(.active):not(.remove-hover-styles) {
                    &:focus,
                    &:hover {
                        background: #E9E9EA;
                    }
                }
								// .filter.remove-hover-styles {
								// 		&:focus,
								// 		&:hover {
								// 				background: initial;
								// 		}
								// }
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

.includes-licensure {
	position: relative;
	font-size: 11px;
	font-style: italic;
	font-weight: 700;
	display: flex;
	align-items: flex-start;
	top: -1.5em;

	.state-icon {
		margin-right: 5px;
	}
}
#degrees-app {
	.degrees {
		position: sticky !important;
		top: 0 !important;

		.degree {
			@media (max-width: 799px) {
				// left: 48% !important;
				// transform: translateX(-50%) !important;
				margin: 1em auto;
			}

			@media (min-width: 800px) {
				margin: 1em !important;
			}
		}
	}
}


</style>
<!-- <style src="./list-transition.scss" lang="scss"></style> -->
