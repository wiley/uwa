<template>
  <div id="degrees-app">
    <h1>App here</h1>
    <div class="controlsWrapper">
			<fieldset class="degreeTypes">
				<h2 class="toolbar-filter__label">Area Of Study
					<img src="/wp-content/themes/uwa/library/images/arrow-down-red.svg" alt="Arrow Down">
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

    <transition-group class="degrees" name="degree-transition" tag="ul">
      <li
        v-for="(degree, index) in filteredDegrees"
				:key="index"
				class="degree-transition degree">
				<h3 class="degree__title" v-html="degree.title.rendered"></h3>
				<a :href="'online-degrees/' + degree.slug">More Info</a>
			</li>
    </transition-group>

	</div>
</template>

<script>
import WPAPI from 'wpapi'
const apiPromise = WPAPI.discover('https://uwa-gulp.dev');

export default {
  name: 'degrees-app',
  data() {
    return {
      degrees: [],
      areasOfStudy: [],
      degreeTypes: [],
      activeAreaOfStudy: null,
      activeDegreeType: null
    }
  },

  computed: {
    filteredDegrees () {
      let activeAreaOfStudy = this.activeAreaOfStudy
      let activeDegreeType = this.activeDegreeType

      if ( activeAreaOfStudy || activeDegreeType ) {
        return this.filterDegrees(activeAreaOfStudy, activeDegreeType)
      } else {
        return this.degrees
      }

    }

  },

  created() {
    this.getData()
  },

  methods: {
    updateDegrees (area) {
      this.activeAreaOfStudy = area.id
    },

    filterDegrees (activeAreaOfStudy, activeDegreeType) {
      let filteredDegrees =  this.degrees.filter(degree => {
        let degreeLevels = degree.levels
        let areasOfStudyForDegree = degree.verticals
        return areasOfStudyForDegree.includes(activeAreaOfStudy)
      })
      return filteredDegrees
    },

    getData () {
      apiPromise.then(site => {

        site.degrees().perPage(100)
          .then(degrees => {
            this.degrees = degrees
          })
          .catch(error => {
            console.log(error);
          })

        site.verticals().perPage(100)
          .then(areas => {
            this.areasOfStudy = areas
          })
          .catch(error => {
            console.log(error);
          })

        site.levels().perPage(100)
          .then(levels => {
            this.degreeTypes = levels
          })
          .catch(error => {
            console.log(error);
          })
      })
    }
  }
}
</script>

<style lang="scss">

</style>
