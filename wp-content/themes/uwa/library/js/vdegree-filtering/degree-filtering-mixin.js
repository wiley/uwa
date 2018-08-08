import Stickyfill from "stickyfilljs";

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
			degreeAreas: [],
			degreeTypes: [],
			activeFilter: null
		};
	},

	computed: {},

	mounted() {
		if (matchMedia) {
			const mq = window.matchMedia("(min-width: 800px)");
			mq.addListener(this.WidthHandler);
			this.WidthHandler(mq);
		}
		var elements = document.querySelectorAll(".sticky-grid");
		Stickyfill.add(elements);
	},

	methods: {
		sortByCompareTitles(a, b) {
			if (a.title.rendered < b.title.rendered) return -1;
			if (a.title.rendered > b.title.rendered) return 1;
			return 0;
		},

		orderByDisplayOrder(filtersArray) {
			return filtersArray.sort(function(a, b) {
				return a.display_order - b.display_order;
			});
		},

		random(max) {
			return Math.floor(Math.random() * (max + 1));
		},
		shuffle(arrayToShuffle) {
			console.log(arrayToShuffle);
			let shuffledArray = [];
			while (arrayToShuffle.length > 0) {
				console.log();
				const index = this.random(arrayToShuffle.length - 1);
				shuffledArray.push(arrayToShuffle[index]);
				arrayToShuffle.splice(index, 1);
			}
			console.log(shuffledArray);
			return shuffledArray;
		},

		WidthHandler(mq) {
			if (mq.matches) {
				this.mobileMode = false;
				this.showDegreeTypesToolbar = true;
				this.showDegreeAreasToolbar = true;
			} else {
				this.mobileMode = true;
				this.showDegreeTypesToolbar = false;
				this.showDegreeAreasToolbar = false;
			}
		},

		filterDegreesByType(activeDegreeTypeFilter) {
			let filteredDegrees = this.degrees.filter(degree => {
				if (activeDegreeTypeFilter === "all") {
					return degree;
				}
				let degreeTypesForDegree = degree.levels;
				return degreeTypesForDegree.includes(activeDegreeTypeFilter.term_id);
			});
			return filteredDegrees;
		},

		filterDegreesByArea(activeDegreeAreaFilter) {
			let filteredDegrees = this.degrees.filter(degree => {
				if (activeDegreeAreaFilter === "all") {
					return degree;
				}
				let areasOfStudyForDegree = degree.areas;
				return areasOfStudyForDegree.includes(activeDegreeAreaFilter.term_id);
			});
			return filteredDegrees;
		}
	}
};
