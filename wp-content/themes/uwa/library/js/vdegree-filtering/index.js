import Vue from 'vue'
import VueStash from 'vue-stash'
import DegreesApp from './degrees-app'
const DegreeFiltersApp = document.getElementById('app');

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
	wpData: wpData,
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
