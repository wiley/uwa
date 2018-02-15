import Vue from 'vue'
import WPAPI from 'wpapi'
import axios from 'axios'
// const wp = new WPAPI({ endpoint: 'https://uwa-gulp.dev/wp-json' });
const DegreeFiltersApp = document.getElementById('app');

// export const HTTP = axios.create({
//   baseURL: `http://jsonplaceholder.typicode.com/`,
//   headers: {
//     Authorization: 'Bearer {token}'
//   }
// })

var apiPromise = WPAPI.discover('https://uwa-gulp.dev');
const $wpApi = axios.create({
	baseURL: `https://uwa-gulp.dev/wp-json/wp/v2`
})

let Params = {
	per_page: 1
}


if (DegreeFiltersApp) {
	var vueApp = new Vue({
		el: '#app',
		data: {
			msg: 'HELLO',
			degrees: [],
			areasOfStudy: [],
			degreeTypes: []
		},

		created() {
      this.getData()
			// this.getDegrees()
			// this.getAreasOfStudy()
			// this.getDegreeTypes()
		},

		methods: {

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
        });
      },

			getDegrees() {
				$wpApi.get('degrees', {
						per_page: 100
					})
					.then(response => {
						this.degrees = response.data
					})
					.catch(e => {
						this.errors.push(e)
					})
			},

			getAreasOfStudy() {
				$wpApi.get('verticals', Params)
					.then(response => {
						this.areasOfStudy = response.data
					})
					.catch(e => {
						this.errors.push(e)
					})
			},

			getDegreeTypes() {
				$wpApi.get('levels', Params)
					.then(response => {
						this.degreeTypes = response.data
					})
					.catch(e => {
						this.errors.push(e)
					})
			}
		}
	})
}
