<template>
  <div class="optionsWrapper degreeLevelsToolbar toolbar-filter" role="toolbar">
    <button
      key="all"
      class="btn__hollow filter all"
      :class="{active: selectedFilter === 'all' }"
      :aria-pressed="selectedFilter === 'all' ? 'true' : 'false'"
      aria-label="Reset This Filter Group"
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
    <button
      v-for="option in options"
      :key="option.term_id"
      class="btn__hollow filter"
      :class="[{ active: option.term_id === selectedFilter.term_id}, option.slug]"
      :aria-label="'Filter By ' + option.name"
      :aria-pressed="option.term_id === selectedFilter.term_id ? 'true' : 'false'"
      @click="updateFilter(option)">
      <span class="filter__color"></span>
      <span class="filter__title" v-html="option.name"></span>
      <span class="filter__active-indicator">
        <img
          v-if="option.term_id === selectedFilter.term_id"
          src="/wp-content/themes/uwa/library/images/filtering-module/check.svg"
          alt="Active Filter Icon">
      </span>

    </button>
  </div>
</template>

<script>
export default {
  name: 'filter-options-list',
  props: ['options', 'selectedFilter'],
  methods: {
    updateFilter (selectedOption) {
      this.$emit('update:selectedFilter', selectedOption)
      this.$emit('filterSelected')
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
  padding: 1em .25em;
  width: 100%;
}
.degreeAreasToolbar {
  .filter {
    &__color {
      width: 25px;
      position: absolute;
      height: 25px;
    }
    &__title {
      left: 50px;
      position: relative;
    }
  }
}
.degreeLevelsToolbar {
  .filter__color {
    display: none;
  }
}

</style>
