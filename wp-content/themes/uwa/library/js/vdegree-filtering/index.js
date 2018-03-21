import Vue from 'vue'
const VueAffix = require('vue-affix');
Vue.use(VueAffix);
import DegreesApp from './degrees-app'
const DegreeFiltersApp = document.getElementById('app');

import VueStash from 'vue-stash'
Vue.use(VueStash)


const StoreObject = {
	searchFilter: '',
	loadingApi: true,
	mobileMode: false,
	showDegreeTypesToolbar: true,
	showDegreeAreasToolbar: true,
	degreeTypesFilterIsActive: false,
	degreeAreasFilterIsActive: false,
	degrees: wpData.degrees,
	areasOfStudy: [],
	areasOfStudyTest: [],
	degreeTypes: [],
	activeDegreeAreaTitle: '',
	activeDegreeTypeTitle: '',
	activeDegreeArea: 'all',
	activeDegreeType: 'all',
	activeFilter: null,
}

if (DegreeFiltersApp) {
	var vueApp = new Vue({
		el: '#app',
		data: {
			store: StoreObject
		},
    components: {
      DegreesApp
    }
	})
}
