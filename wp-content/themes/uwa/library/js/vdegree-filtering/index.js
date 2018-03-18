import Vue from 'vue'
const VueAffix = require('vue-affix');
Vue.use(VueAffix);
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
