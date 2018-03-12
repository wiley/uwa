<template lang="html">
  <div class="controlsWrapper">
		<div class="input-wrapper search-filter">
			<input
				type="text"
				class="toolbar-filter__search"
				placeholder="Click here to search"
				v-model="searchFilter">
			<div
				tabindex="0"
				@click="clearSearch"
				@keypress.enter="clearSearch"
				class="searchFilter-icon" :class="{clickable: searchQueryExists}">
				<transition mode="out-in" name="search"
				>
					<img key="search" v-if="!searchQueryExists" src="/wp-content/themes/uwa/library/images/filtering-module/seach.svg" alt="Search Icon">
					<img key="clear" v-else src="/wp-content/themes/uwa/library/images/filtering-module/clear-search.svg" alt="Clear Search">
				</transition>
			</div>
		</div>


		<div class="filter-group filters-types">
			<fieldset class="degreeLevels">
				<h2
					@click="toggleDegreeTypesFilters"
					class="toolbar-filter__label"
					:class="{activeFilter: degreeTypesFilterIsActive}">
					Degree Types
				</h2>
				<h3 v-if="mobileMode" class="toolbar-filter__activeTitle">{{activeDegreeTypeTitle}}</h3>
				<transition name="slide-down">
					<div
						v-if="showDegreeTypesToolbar"
						class="degreeLevelsToolbar toolbar-filter"
						:class="{activeFilter: degreeTypesFilterIsActive}"
						role="toolbar">
	          <button
	            key="all"
	            class="btn__hollow filter"
							:class="{active: activeDegreeType === 'all' }"
	            aria-label="List All Degrees Types"
	            @click="updateDegreeTypeToAll">All
	          </button>
						<button
	            v-for="type in degreeTypes"
	            :key="type.id" class="btn__hollow filter"
	            :class="{active: type.id === activeDegreeType}"
	            :aria-label="'Filter By ' + type.name"
	            @click.prevent="updateActiveDegreeType(type)">
							{{type.name}}
							<span class="active-filter-indicator">
								<img v-if="type.id === activeDegreeType" src="/wp-content/themes/uwa/library/images/filtering-module/check.svg" alt="Active Filter Icon">
							</span>
						</button>
					</div>
				</transition>
			</fieldset>
		</div>

		<div class="filter-group filters-areas">
			<fieldset class="degreeAreas">
				<h2
					@click="toggleDegreeAreasFilters"
					class="toolbar-filter__label">
					Areas Of Study
				</h2>
				<h3 v-if="mobileMode" class="toolbar-filter__activeTitle">{{activeAreaOfStudyTitle}}</h3>
				<transition name="slide-down">
					<div
						v-if="showDegreeAreasToolbar"
						class="degreeAreasToolbar toolbar-filter"
						role="toolbar">
						<button
							key="allAreas"
							class="btn__hollow filter"
							:class="{active: activeAreaOfStudy === 'all' }"
							aria-label="List All Degrees Areas"
							@click="updateDegreeAreaToAll">
							All
						</button>

						<template
						  v-for="(area, key) in areasOfStudy">
							<button
								:key="area.id" class="btn__hollow filter"
								:class="{active: area.id === activeAreaOfStudy}"
								:aria-label="'Filter By ' + area.name"
								@click.prevent="updateActiveDegreeArea(area)">
								{{area.name}}
								<span class="active-filter-indicator">
									<img v-if="area.id === activeAreaOfStudy" src="/wp-content/themes/uwa/library/images/filtering-module/check.svg" alt="Active Filter Icon">
								</span>
							</button>
						</template>
					</div>
				</transition>

			</fieldset>
		</div>

	</div>

</template>

<script>
export default {
}
</script>

<style lang="scss">
</style>
