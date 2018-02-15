import Vue from 'vue'
import DegreesApp from './degrees-app'
const DegreeFiltersApp = document.getElementById('app');



if (DegreeFiltersApp) {
	var vueApp = new Vue({
		el: '#app',
    components: {
      DegreesApp
    }
	})
}
