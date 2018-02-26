<template>
<div id="degrees-app">
	<div class="controlsWrapper">
		<div class="input-wrapper search-filter">
			<input
				type="text"
				class="toolbar-filter__search"
				placeholder="Click here to search"
				v-model="searchFilter">
			<div
				tabindex="0"
				@click="clearSearch"
				@keypress.enter="clearSearch"
				class="searchFilter-icon" :class="{clickable: searchQueryExists}">
				<transition mode="out-in" name="search">
					<img key="search" v-if="!searchQueryExists" src="/wp-content/themes/uwa/library/images/filtering-module/seach.svg" alt="Search Icon">
					<img key="clear" v-else src="/wp-content/themes/uwa/library/images/filtering-module/clear-search.svg" alt="Clear Search">
				</transition>
			</div>
		</div>


		<div class="filter-group filters-types">
			<fieldset class="degreeLevels">
				<h2
					@click="toggleDegreeTypesFilters"
					class="toolbar-filter__label"
					:class="{activeFilter: degreeTypesFilterIsActive}">
					Degree Types
					<transition mode="out-in" name="search">
						<img key="arrow-down" v-if="mobileMode && !showDegreeTypesToolbar" src="/wp-content/themes/uwa/library/images/filtering-module/arrow-down.svg" alt="">
						<img key="arrow-down" v-else-if="mobileMode && showDegreeTypesToolbar" src="/wp-content/themes/uwa/library/images/filtering-module/arrow-up.svg" alt="">
						<!-- <img key="clear" v-else src="/wp-content/themes/uwa/library/images/filtering-module/clear-search.svg" alt="Clear Search"> -->
					</transition>

				</h2>
				<h3 v-if="mobileMode" class="toolbar-filter__activeTitle">{{activeDegreeTypeTitle}}</h3>

				<toolbar-filter
					class="degreeLevelsToolbar"
					:activeFilterClass="degreeTypesFilterIsActive"
					:isShowing="showDegreeTypesToolbar">
				</toolbar-filter>


				<transition name="slide-down">
					<div
						v-if="showDegreeTypesToolbar"
						class="degreeLevelsToolbar toolbar-filter"
						:class="{activeFilter: degreeTypesFilterIsActive}"
						role="toolbar">
	          <button
	            key="all"
	            class="btn__hollow filter"
							:class="{active: activeDegreeType === 'all' }"
	            aria-label="List All Degrees Types"
	            @click="updateDegreeTypeToAll">All
	          </button>
						<filter-options-list
							:options="degreeTypes"
							@option-selected="updateActiveDegreeType"
							@reset-filter="updateDegreeTypeToAll"
							:currentlySelectedOption="activeDegreeType">
						</filter-options-list>
						<!-- <button
	            v-for="type in degreeTypes"
	            :key="type.id" class="btn__hollow filter"
	            :class="{active: type.id === activeDegreeType}"
	            :aria-label="'Filter By ' + type.name"
	            @click.prevent="updateActiveDegreeType(type)">
							{{type.name}}
							<span class="active-filter-indicator">
								<img v-if="type.id === activeDegreeType" src="/wp-content/themes/uwa/library/images/filtering-module/check.svg" alt="Active Filter Icon">
							</span>
						</button> -->
					</div>
				</transition>
			</fieldset>
		</div>

		<div class="filter-group filters-areas">
			<fieldset class="degreeAreas">
				<h2
					@click="toggleDegreeAreasFilters"
					class="toolbar-filter__label">
					Areas Of Study
				</h2>
				<h3 v-if="mobileMode" class="toolbar-filter__activeTitle">{{activeAreaOfStudyTitle}}</h3>
				<transition name="slide-down">
					<div
						v-if="showDegreeAreasToolbar"
						class="degreeAreasToolbar toolbar-filter"
						role="toolbar">
						<button
							key="allAreas"
							class="btn__hollow filter"
							:class="{active: activeAreaOfStudy === 'all' }"
							aria-label="List All Degrees Areas"
							@click="updateDegreeAreaToAll">
							All
						</button>

						<template
						  v-for="(area, key) in areasOfStudy">
							<button
								:key="area.id" class="btn__hollow filter"
								:class="{active: area.id === activeAreaOfStudy}"
								:aria-label="'Filter By ' + area.name"
								@click.prevent="updateActiveDegreeArea(area)">
								{{area.name}}
								<span class="active-filter-indicator">
									<img v-if="area.id === activeAreaOfStudy" src="/wp-content/themes/uwa/library/images/filtering-module/check.svg" alt="Active Filter Icon">
								</span>
							</button>
						</template>
					</div>
				</transition>

			</fieldset>
		</div>

	</div>

	<isotope ref="cpt" id="root_isotope1" class="degrees" :list="degrees" :options='isotopeOptions'>
		<a
			v-for="degree, index in listForFilteredDegreesAreaAndLevel"
			:key="index"
			:href="'online-degrees/' + degree.slug"
			class="degree-transition degree"
			:class="getDegreeClasses(degree)">
			<small class="label" v-if="degree.degree_types[0]" v-text="degree.degree_types[0].name"></small>
			<small class="label undefined" v-else>No Program Type Set</small>
			<h3 class="degree__title" v-html="degree.title.rendered"></h3>
			<div class="degree__cta-button">More Info</div>
		</a>
  </isotope>

</div>
</template>

<script>
import WPAPI from "wpapi";
import isotope from 'vueisotope'
import ToolbarFilter from './components/ToolbarFilter'
import FilterOptionsList from './components/FilterOptionsList'
const apiPromise = WPAPI.discover("https://uwa-gulp.dev");

export default {
	name: "degrees-app",
	components: {
		isotope,
		ToolbarFilter,
		FilterOptionsList
	},
	data() {
		return {
			searchFilter: '',
			// searchIsActive: false,
			mobileMode: false,
			showDegreeTypesToolbar: true,
			showDegreeAreasToolbar: true,
			degreeTypesFilterIsActive: false,
			degreeAreasFilterIsActive: false,
			degrees: [],
			areasOfStudy: [],
			degreeTypes: [],
			activeAreaOfStudyTitle: '',
			activeDegreeTypeTitle: '',
			activeAreaOfStudy: 'all',
			activeDegreeType: 'all',
			activeFilter: null,
			isotopeOptions: {
	      itemSelector: ".degree",
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
			return this.activeAreaOfStudy === "all" || this.activeDegreeType === "all"
				? true
				: false;
		},

		filteredDegreesByArea() {
			let activeAreaOfStudy = this.activeAreaOfStudy;
			let activeDegreeType = this.activeDegreeType;

			return activeAreaOfStudy || activeDegreeType
				? this.filterDegreesByArea(activeAreaOfStudy, activeDegreeType)
				: this.degrees;
		},

		filteredDegreesBySearch() {
      return this.degrees.filter(degree => {
				let title = degree.title.rendered
        return title.toLowerCase().includes(this.searchFilter.toLowerCase())
      })
    },

		filteredDegreesByType() {
			let activeDegreeType = this.activeDegreeType;

			return activeDegreeType
				? this.filterDegreesByType(activeDegreeType)
				: this.degrees;
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

			areasFiltersArray.forEach(function (area, index) {
					// area[index]['sub_areas'] = []
					if (area.parent === 7) {
						teachingSubAreas.push(area)
					}
			});
			return []
		},

		listForFilteredDegreesAreaAndLevel () {
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
	},

	mounted () {
		if (matchMedia) {
			const mq = window.matchMedia("(min-width: 800px)");
			mq.addListener(this.WidthHandler);
			this.WidthHandler(mq);
			// this.setupFiltersModeOnLoad();
		}

	},

	methods: {
		WidthHandler (mq) {
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
			if ( this.mobileMode === false ){
				this.showDegreeTypesToolbar = true
			} else {
				return false
			}
		},

		toggleDegreeTypesFilters () {
			if (this.mobileMode) {
				if ( this.showDegreeAreasToolbar === true ) {
					 this.showDegreeAreasToolbar = false
				}
				this.showDegreeTypesToolbar = !this.showDegreeTypesToolbar
				this.degreeTypesFilterIsActive = !this.degreeTypesFilterIsActive
				this.activeFilter = this.activeFilter === 'degreeTypes' ? null : 'degreeTypes'

			}
		},

		toggleDegreeAreasFilters () {
			if (this.mobileMode) {
				if ( this.showDegreeTypesToolbar === true ) {
					 this.showDegreeTypesToolbar = false
				}
				this.showDegreeAreasToolbar = ! this.showDegreeAreasToolbar
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
					})
					.catch(error => {
						console.log(error);
					});

				site
					.levels()
					.perPage(100)
					.then(levels => {
						this.degreeTypes = levels;
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

.toolbar-filter {
	&__label {
		cursor: pointer;
		position: relative;
		@media (min-width: 901px) {
			cursor: auto;
		}

		img {
			position: absolute;
			right: 1em;
		}
	}
	&__activeTitle {
		font-size: 1em;
		position: absolute;
	}
}


</style>
