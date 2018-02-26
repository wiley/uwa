<template>
  <div class="optionsWrapper">
    <button
      key="all"
      class="btn__hollow filter"
      :class="{active: currentlySelectedOption === 'all' }"
      aria-label="List All Degrees Types"
      @click="$emit('reset-filter')">
      All
    </button>
    <button
      v-for="option in options"
      :key="option.id"
      class="btn__hollow filter"
      :class="{active: option.id === currentlySelectedOption}"
      :aria-label="'Filter By ' + option.name"
      @click.prevent="optionSelected(option)">
      {{option.name}}
      <span class="active-filter-indicator">
        <img v-if="option.id === currentlySelectedOption" src="/wp-content/themes/uwa/library/images/filtering-module/check.svg" alt="Active Filter Icon">
      </span>
    </button>
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
}
</style>
