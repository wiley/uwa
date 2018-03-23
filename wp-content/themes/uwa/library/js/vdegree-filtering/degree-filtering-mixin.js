import Stickyfill from 'stickyfilljs'

export const DegreeFilteringMixin = {
	data() {
		return {
      loadingApi: true,
    	mobileMode: false,
    	showDegreeTypesToolbar: true,
    	showDegreeAreasToolbar: true,
    	degreeTypesFilterIsActive: false,
    	degreeAreasFilterIsActive: false,
    	degrees: [],
    	areasOfStudy: [],
    	areasOfStudyTest: [],
    	degreeTypes: [],
    	activeFilter: null,
		}
	},


	computed: {

  },


	mounted() {
		if (matchMedia) {
			const mq = window.matchMedia("(min-width: 800px)");
			mq.addListener(this.WidthHandler);
			this.WidthHandler(mq);
		}
		var elements = document.querySelectorAll('.sticky-grid');
		Stickyfill.add(elements);
	},


	methods: {
		WidthHandler(mq) {
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

    filterDegreesByType(activeDegreeType) {
			let filteredDegrees = this.degrees.filter(degree => {
				if (this.$store.activeDegreeType === 'all') {
					return degree;
				}
				let degreeTypesForDegree = degree.levels;
				return degreeTypesForDegree.includes(activeDegreeType);
			});
			return filteredDegrees;
		},

		filterDegreesByArea(activeDegreeArea, activeDegreeType) {
			let filteredDegrees = this.degrees.filter(degree => {
				if (this.$store.activeDegreeArea === 'all') {
					return degree;
				}
				let areasOfStudyForDegree = degree.verticals;
				return areasOfStudyForDegree.includes(activeDegreeArea);
			});
			return filteredDegrees;
		},
	}
}
