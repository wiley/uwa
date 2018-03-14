<template>
  <div class="optionsWrapper">
    <button
      key="all"
      class="btn__hollow filter all"
      :class="{active: currentlySelectedOption === 'all' }"
      aria-label="Reset This Filter Group"
      @click="$emit('reset-filter')">
      <span class="filter__color"></span>
      <span class="filter__title">All</span>
      <span class="filter__active-indicator">
        <img
          v-if="currentlySelectedOption === 'all'"
          src="/wp-content/themes/uwa/library/images/filtering-module/check.svg"
          alt="Active Filter Icon">
      </span>
    </button>
    <div
      v-for="(option,index) in options"
      :key="option.id">
      <button
        v-if="!option.sub_areas.length"
        class="btn__hollow filter"
        :class="[{ active: option.id === currentlySelectedOption}, option.slug]"
        :aria-label="'Filter By ' + option.name"
        @click.prevent="optionSelected(option)">
        <span class="filter__color"></span>
        <span class="filter__title" v-html="option.name"></span>
        <span class="filter__active-indicator">
          <img
            v-if="option.id === currentlySelectedOption"
            src="/wp-content/themes/uwa/library/images/filtering-module/check.svg"
            alt="Active Filter Icon">
        </span>
      </button>
      <div v-if="option.sub_areas.length > 0">
        <button
          class="btn__hollow filter"
          :class="[{ active: option.id === currentlySelectedOption}, option.slug]"
          :aria-label="'Filter By ' + option.name"
          @click.prevent="optionSelected(option)">
          <span class="filter__color"></span>
          <span class="filter__title" v-html="option.name"></span>
          <span class="filter__active-indicator">
            <img
              v-if="option.id === currentlySelectedOption"
              src="/wp-content/themes/uwa/library/images/filtering-module/check.svg"
              alt="Active Filter Icon">
          </span>
        </button>
    			<div class="sub-filters-wrapper">
            <button
            v-for="subAreaOption in option.sub_areas"
            class="btn__hollow filter"
            :class="[{ active: subAreaOption.id === currentlySelectedOption}, subAreaOption.slug]"
            :aria-label="'Filter By ' + subAreaOption.name"
            @click.prevent="optionSelected(subAreaOption)">
              <span class="filter__color"></span>
              <span class="filter__title" v-html="subAreaOption.name"></span>
              <span class="filter__active-indicator">
                <img
                  v-if="subAreaOption.id === currentlySelectedOption"
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
  props: ['options', 'currentlySelectedOption'],
  methods: {
    optionSelected (option) {
      this.$emit('option-selected', option)
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
.degreeAreasToolbar {
  .filter {
    &__color {
      width: 40px;
      position: absolute;
      height: 40px;
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
