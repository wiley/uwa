<template>
  <div class="optionsWrapper">
    <button
      key="all"
      class="btn__hollow filter all"
      :class="{active: selectedFilter === 'all' }"
      aria-label="Reset This Filter Group"
      @click="$emit('reset-filter')">
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
        :class="[{ active: option.term_id === selectedFilter}, option.slug]"
        :aria-label="'Filter By ' + option.name"

        @click.prevent="$emit('update:selectedFilter', option.term_id)">
        <span class="filter__color"></span>
        <span class="filter__title" v-html="option.name"></span>
        <span class="filter__active-indicator">
          <img
            v-if="option.term_id === selectedFilter"
            src="/wp-content/themes/uwa/library/images/filtering-module/check.svg"
            alt="Active Filter Icon">
        </span>
      </button>
      <div v-if="option.sub_areas && option.sub_areas.length > 0">
        <button
          class="btn__hollow filter"
          :class="[{ active: option.term_id === selectedFilter }, option.slug]"
          :aria-label="'Filter By ' + option.name"
          @click.prevent="showSubFilters = !showSubFilters">
          <span class="filter__color"></span>
          <span class="filter__title" v-html="option.name"></span>
          <!-- <transition mode="out-in" name="icon-switch"> -->
						<img key="hide" v-if="showSubFilters" src="/wp-content/themes/uwa/library/images/filtering-module/hide-sub-filters.svg" alt="">
            <img key="show" v-else src="/wp-content/themes/uwa/library/images/filtering-module/show-sub-filters.svg" alt="">
					<!-- </transition> -->
        </button>
    			<!-- <div class="sub-filters-wrapper" v-if="showSubFilters">
            <button
            v-for="subAreaOption in option.sub_areas"
            class="btn__hollow filter"
            :class="[{ active: subAreaOption.term_id === currentlySelectedOption}, subAreaOption.slug]"
            :aria-label="'Filter By ' + subAreaOption.name"
            @click.prevent="optionSelected(subAreaOption)">

              <img src="/wp-content/themes/uwa/library/images/filtering-module/subdirectory.svg" alt="Subdirectory Icon">
              <span class="filter__title" v-html="subAreaOption.name"></span>
              <span class="filter__active-indicator">
                <img
                  v-if="subAreaOption.term_id === currentlySelectedOption"
                  src="/wp-content/themes/uwa/library/images/filtering-module/check.svg"
                  alt="Active Filter Icon">
              </span>
            </button>
    			</div> -->
  		</div>

    </div>

  </div>
</template>

<script>
export default {
  name: 'filter-options-list',
  props: ['options', 'currentlySelectedOption', 'selectedFilter'],
  data() {
    return {
      showSubFilters: false
    }
  },
  methods: {
    optionSelected (option) {
      this.$emit('updated:currentlySelectedOption', option.term_id)
      // this.$emit('option-selected', option)
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
  padding: 1em;
  width: 100%;
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

</style>
