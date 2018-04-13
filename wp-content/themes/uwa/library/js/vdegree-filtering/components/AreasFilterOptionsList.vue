<template>
  <div class="optionsWrapper toolbar-filter degreeAreasToolbar" role="toolbar">
    <button
      key="all"
      class="btn__hollow filter all"
      :class="{active: selectedFilter === 'all' }"
      aria-label="Reset This Filter Group"
      :aria-pressed="selectedFilter === 'all'"
      @click="updateFilter('all')">
      <span class="filter__color"></span>
      <span class="filter__title">All</span>
      <span class="filter__active-indicator">
        <img
          v-if="selectedFilter === 'all'"
          src="/wp-content/themes/uwa/library/images/filtering-module/check.svg"
          alt="Active Filter Icon">
      </span>
    </button>
    <div
      v-for="(option,index) in options"
      :key="option.term_id">
      <button
        v-if="option.sub_areas && !option.sub_areas.length"
        class="btn__hollow filter"
        :class="[{ active: option.term_id === selectedFilter.term_id}, option.slug]"
        :aria-label="'Filter By ' + option.name"
        @click.prevent="updateFilter(option)">
        <span class="filter__color"></span>
        <span class="filter__title" v-html="option.name"></span>
        <span class="filter__active-indicator">

          <img
            v-if="option.term_id === selectedFilter.term_id"
            src="/wp-content/themes/uwa/library/images/filtering-module/check.svg"
            alt="Active Filter Icon">
        </span>
      </button>
      <div v-if="option.sub_areas && option.sub_areas.length > 0">

        <button
          class="btn__hollow filter"
          :class="[{ active: option.term_id === selectedFilter.term_id || option.term_id === selectedFilter.parent }, option.slug, { 'remove-hover-styles': removeHoverStyles === true }]"
          :aria-label="'Filter By ' + option.name"
          :aria-pressed="option.term_id === selectedFilter.term_id"
          @click.prevent="updateFilter(option)">
          <span class="filter__color"></span>
          <span class="filter__title" v-html="option.name"></span>
          <span class="filter__active-indicator">
            <img
              v-if="option.term_id === selectedFilter.term_id"
              src="/wp-content/themes/uwa/library/images/filtering-module/check.svg"
              alt="Active Filter Icon">
              <img
                v-if="option.term_id === selectedFilter.parent"
                src="/wp-content/themes/uwa/library/images/filtering-module/hide-white.svg"
                alt="Active Filter Icon">
          </span>

          <div class="toggle-subfilter"
            @mouseover="removeHoverStyles = true"
            @mouseout="removeHoverStyles = false"
            tabindex="0"
            @click.stop="showSubFilters = !showSubFilters">
            <img class="subfilter-toggle-icon" key="hide" v-if="showSubFilters" src="/wp-content/themes/uwa/library/images/filtering-module/hide-sub-filters.svg" alt="">
            <img class="subfilter-toggle-icon "key="show" v-else src="/wp-content/themes/uwa/library/images/filtering-module/show-sub-filters.svg" alt="">

          </div>
        </button>
    			<div class="sub-filters-wrapper" v-if="showSubFilters">
            <button
            v-for="subAreaOption in option.sub_areas"
            class="btn__hollow filter"
            :class="[{ active: subAreaOption.term_id === selectedFilter.term_id}, subAreaOption.slug]"
            :aria-label="'Filter By ' + subAreaOption.name"
            :aria-pressed="option.term_id === subAreaOption.term_id"
            @click.prevent="updateFilter(subAreaOption)">

              <img src="/wp-content/themes/uwa/library/images/filtering-module/subdirectory.svg" alt="Subdirectory Icon">
              <span class="filter__title" v-html="subAreaOption.name"></span>
              <span class="filter__active-indicator">
                <img
                  v-if="subAreaOption.term_id === selectedFilter.term_id"
                  src="/wp-content/themes/uwa/library/images/filtering-module/check.svg"
                  alt="Active Filter Icon">
              </span>
            </button>
    			</div>
  		</div>

    </div>

  </div>
</template>

<script>
export default {
  name: 'filter-options-list',
  props: ['options', 'selectedFilter'],
  data() {
    return {
      showSubFilters: false,
      removeHoverStyles: false
    }
  },
  computed: {
    parentOfSelectedSubfilter() {
      return this.selectedFilter.parent
    }
  },
  methods: {
    updateFilter (selectedOption) {
      if (selectedOption.parent === 0 && selectedOption.term_id !== this.selectedFilter.parent) this.showSubFilters = false
      // if (selectedOption.term_id === this.selectedFilter.term_id) {
      //
      // }
      this.$emit('update:selectedFilter', selectedOption)
      this.$emit('filterSelected')
    },
    updateFilterAndSubFilters (selectedOption) {
      this.updateFilter(selectedOption)
      this.showSubFilters = !this.showSubFilters
    }
  }
}
</script>

<style lang="scss">
.filter {
  width: 100%;
  text-transform: capitalize !important;
  @media (max-width: 799px) {
    border-bottom: 2px solid #6D6D6D !important;
    font-size: 14px;
  }
}
.optionsWrapper {
  padding: 1em .5em;
  width: 100%;
}

.toggle-subfilter {
  position: absolute;
  right: 10px;
  vertical-align: bottom;
  height: 2.5em;
  width: 2.5em;
  .subfilter-toggle-icon {
    width: 2.25em;
    height: 2.25em;
    // background: #9E9E9E;
    // box-shadow: 0 2px 3px rgba(0, 0, 0, 0.19), 0 2px 3px rgba(0, 0, 0, 0.12);
  }
}


.sub-filters-wrapper {

  .filter {
    margin-left: 6px !important;
    justify-content: flex-start !important;
    &__color {
      width: 40px;
      position: absolute;
      height: 40px;
    }
    &__title {
      left: 20px;
      position: relative;
    }

    &__active-indicator {
      right: 15px !important;
      left: initial !important;
    }
  }
}
.degreeLevelsToolbar {
  .filter__color {
    display: none;
  }
}
.degreeAreasToolbar > div {
  flex-basis: 100%;
}
</style>
