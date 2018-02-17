<template>
<div id="degrees-app">
	<div class="controlsWrapper">

		<div class="filters-areas">
			<fieldset class="degreeTypes">
				<h2 class="toolbar-filter__label">Area Of Study</h2>
				<div class="degreeAreasToolbar toolbar-filter" role="toolbar">
					<button
            key="allAreas"
            class="btn__hollow filter"
						:class="{active: activeAreaOfStudy === 'all' }"
            aria-label="List All Degrees Areas"
            @click="updateDegreeAreaToAll">All
          </button>
					<button
            v-for="area in areasOfStudy"
            :key="area.id" class="btn__hollow filter"
            :class="{active: area.id === activeAreaOfStudy}"
            :aria-label="'Filter By ' + area.name"
            @click.prevent="updateActiveDegreeArea(area)"
            v-html="area.name">
          </button>
				</div>
			</fieldset>
		</div>

		<div class="filters-types">
			<fieldset class="degreeLevels">
				<h2 class="toolbar-filter__label">Degree Types</h2>
				<div class="degreeLevelsToolbar toolbar-filter" role="toolbar">
          <button
            key="all"
            class="btn__hollow filter"
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

	</div>

	<isotope ref="cpt" id="root_isotope1" class="degrees" :list="degrees" :options='isotopeOptions'>
    <!-- <div v-for="element,index in list" :class='[element.category]'  :key="index">
      <h3 class="name">{{element.name}}</h3>
      <p class="symbol">{{element.symbol}}</p>
      <p class="number">{{element.number}}</p>
      <p class="weight">{{element.weight}}</p>
    </div> -->
		<div v-for="degree, index in listForFilteredDegreesAreaAndLevel" :key="index" class="degree-transition degree">
			<h3 class="degree__title" v-html="degree.title.rendered"></h3>
			<a :href="'online-degrees/' + degree.slug">More Info</a>
		</div>
  </isotope>

	<!-- <transition-group class="degrees" name="degree-transition" tag="ul">
		<li v-for="(degree, index) in filteredDegrees" :key="index" class="degree-transition degree">
			<h3 class="degree__title" v-html="degree.title.rendered"></h3>
			<a :href="'online-degrees/' + degree.slug">More Info</a>
		</li>
	</transition-group> -->

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

	computed: {
		allFilterSelected() {
			return this.activeAreaOfStudy === "all" || this.activeDegreeType === "all"
				? true
				: false;
		},

		filteredDegrees() {
			let activeAreaOfStudy = this.activeAreaOfStudy;
			let activeDegreeType = this.activeDegreeType;

			return activeAreaOfStudy || activeDegreeType
				? this.filterDegrees(activeAreaOfStudy, activeDegreeType)
				: this.degrees;
		},

		filteredDegreesByType() {
			let activeDegreeType = this.activeDegreeType;

			return activeDegreeType
				? this.filterDegreesByType(activeDegreeType)
				: this.degrees;
		},

		listForFilteredDegreesAreaAndLevel () {
			let a = new Set(this.filteredDegrees);
			let b = new Set(this.filteredDegreesByType);
			let intersection = new Set(
			    [...a].filter(x => b.has(x)));

			return [...intersection]
		}
	},

	created() {
		this.getData();
	},

	methods: {
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

			// let filteredDegrees = this.degrees.filter(degree => {
			// 	let degreeTypesForDegree = degree.levels;
			// 	return degreeTypesForDegree.includes(this.activeDegreeType);
			// });
			// return filteredDegrees;
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

		filterDegrees(activeAreaOfStudy, activeDegreeType) {
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

</style>
