<template lang="html">
  <div class="input-wrapper search-filter">
    <label for="degreeGridSearch" class="sr-only">Search For a Degree</label>
    <input name="degreeGridSearch" :value="value" type="text" class="toolbar-filter__search" placeholder="Click here to search" @input="updateSearch($event.target.value)">
    <div role="button" aria-label="Clear Search" tabindex="0" @click="clearSearch" @keypress.enter="clearSearch" class="searchFilter-icon" :class="{clickable: searchQueryExists}">
      <transition mode="out-in" name="search">
        <img role="presentation" key="search" v-if="!searchQueryExists" src="/wp-content/themes/uwa/library/images/filtering-module/seach.svg" alt="Search Icon">
        <img role="presentation" key="clear" v-else src="/wp-content/themes/uwa/library/images/filtering-module/clear-search.svg" alt="Clear Search">
      </transition>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    value: {
      type: String
    }
  },
  computed: {
    searchQueryExists() {
			return this.$store.searchFilter !== ''
		},
  },
  methods: {
    clearSearch() {
			this.$store.searchFilter = ''
		},

    updateSearch(value) {
      this.$emit('input', value)
    }
  },

}
</script>

<style lang="css">
</style>
