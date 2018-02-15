<template>
<div id="degrees-app">
	<div class="controlsWrapper">
		<div class="filters-areas">
			<fieldset class="degreeTypes">
				<h2 class="toolbar-filter__label">Area Of Study
            <img src="/wp-content/themes/uwa/library/images/arrow-down-red.svg" alt="Arrow Down">
          </h2>
				<div class="degreeAreasToolbar toolbar-filter" role="toolbar">
					<button
            key="all"
            class="btn__hollow filter"
            aria-label="List All Degrees Areas"
            @click="updateDegreeAreaToAll">All
          </button>
					<button
            v-for="area in areasOfStudy"
            :key="area.id" class="btn__hollow filter"
            :class="{active: area.id === activeAreaOfStudy}"
            :aria-label="'Filter By ' + area.name"
            @click.prevent="updateDegrees(area)"
            v-html="area.name">
          </button>
				</div>
			</fieldset>
		</div>


		<div class="filters-types">
			<fieldset class="degreeLevels">
				<h2 class="toolbar-filter__label">Degree Types
             <img src="/wp-content/themes/uwa/library/images/arrow-down-red.svg" alt="Arrow Down">
           </h2>
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
            :class="{active: type.id === activeAreaOfStudy}"
            :aria-label="'Filter By ' + type.name"
            @click.prevent="updateDegrees(type)"
            v-html="type.name">
          </button>
				</div>
			</fieldset>
		</div>
	</div>

	<transition-group class="degrees" name="degree-transition" tag="ul">
		<li v-for="(degree, index) in filteredDegrees" :key="index" class="degree-transition degree">
			<h3 class="degree__title" v-html="degree.title.rendered"></h3>
			<a :href="'online-degrees/' + degree.slug">More Info</a>
		</li>
	</transition-group>

</div>
</template>

<script>
import WPAPI from "wpapi";
const apiPromise = WPAPI.discover("https://uwa-gulp.dev");

export default {
	name: "degrees-app",
	data() {
		return {
			degrees: [],
			areasOfStudy: [],
			degreeTypes: [],
			activeAreaOfStudy: null,
			activeDegreeType: null
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
		}
	},

	created() {
		this.getData();
	},

	methods: {
		updateDegrees(area) {
			this.activeAreaOfStudy = area.id;
		},

		updateDegreeAreaToAll() {
			this.activeAreaOfStudy = "all";
		},

		updateDegreeTypeToAll() {
			this.activeDegreeType = "all";
		},

		filterDegrees(activeAreaOfStudy, activeDegreeType) {
			let filteredDegrees = this.degrees.filter(degree => {
				if (this.allFilterSelected) {
					return degree;
				}
				let degreeLevels = degree.levels;
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
