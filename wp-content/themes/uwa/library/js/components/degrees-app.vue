<template>
<div id="degrees-app">
	<div class="controlsWrapper">
		<input type="text" class="toolbar-filter__search" placeholder="Click here to search" v-model="searchFilter">
		<div class="filters-types">
			<fieldset class="degreeLevels">
				<h2 class="toolbar-filter__label">Degree Types</h2>
				<div class="degreeLevelsToolbar toolbar-filter" role="toolbar">
          <button
            key="all"
            class="btn__hollow filter"
						:class="{active: activeDegreeType === 'all' }"
            aria-label="List All Degrees Types"
            @click="updateDegreeTypeToAll">All
          </button>
					<button
            v-for="type in degreeTypes"
            :key="type.id" class="btn__hollow filter"
            :class="{active: type.id === activeDegreeType}"
            :aria-label="'Filter By ' + type.name"
            @click.prevent="updateActiveDegreeType(type)"
            v-html="type.name">
          </button>
				</div>
			</fieldset>
		</div>

		<div class="filters-areas">
			<fieldset class="degreeTypes">
				<h2 class="toolbar-filter__label">Areas Of Study</h2>
				<div class="degreeAreasToolbar toolbar-filter" role="toolbar">
					<button
            key="allAreas"
            class="btn__hollow filter"
						:class="{active: activeAreaOfStudy === 'all' }"
            aria-label="List All Degrees Areas"
            @click="updateDegreeAreaToAll">All
          </button>

					<template
					  v-for="(area, key) in areasOfStudy">
						<button
							:key="area.id" class="btn__hollow filter"
							:class="{active: area.id === activeAreaOfStudy}"
							:aria-label="'Filter By ' + area.name"
							@click.prevent="updateActiveDegreeArea(area)"
							v-html="area.name">

							<!-- <template v-if="area.sub_areas">
								<pre>{{area.sub_areas}}</pre>
							</template> -->
						</button>
					</template>

				</div>
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
const apiPromise = WPAPI.discover("https://uwa-gulp.dev");

export default {
	name: "degrees-app",
	components: {
		isotope
	},
	data() {
		return {
			searchFilter: '',
			degrees: [],
			areasOfStudy: [],
			degreeTypes: [],
			activeAreaOfStudy: 'all',
			activeDegreeType: 'all',
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

	// watch:{
	// 	filterDegreesBySearch(val) {
	// 		setTimeout(() => {
	// 			this.listForFilteredDegreesAreaAndLevel = val
  //      }, 500);
	// 	}
	// },

	computed: {
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
			// if (topLevelFilters) {
			// 	topLevelFilters[teachingFilterIndex]['sub_areas'] = teachingSubAreas
			// }
			//
			// return topLevelFilters
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

	methods: {
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

		updateActiveDegreeArea(area) {
			this.activeAreaOfStudy = area.id;
		},

		updateActiveDegreeType(type) {
			this.activeDegreeType = type.id;
		},

		updateDegreeAreaToAll() {
			this.activeAreaOfStudy = "all";
		},

		updateDegreeTypeToAll() {
			this.activeDegreeType = "all";
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
	input.toolbar-filter__search {
		border: 2.33px solid #A81D32;
		margin: 1em;
		max-width: 315px;
		width: 100%;
		font-style: italic;
	}
</style>
