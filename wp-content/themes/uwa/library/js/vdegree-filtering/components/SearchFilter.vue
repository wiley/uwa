<template lang="html">
  <div class="input-wrapper search-filter">
    <input :value="value" type="text" class="toolbar-filter__search" placeholder="Click here to search" @input="updateSearch($event.target.value)">
    <div tabindex="0" @click="clearSearch" @keypress.enter="clearSearch" class="searchFilter-icon" :class="{clickable: searchQueryExists}">
      <transition mode="out-in" name="search">
        <img key="search" v-if="!searchQueryExists" src="/wp-content/themes/uwa/library/images/filtering-module/seach.svg" alt="Search Icon">
        <img key="clear" v-else src="/wp-content/themes/uwa/library/images/filtering-module/clear-search.svg" alt="Clear Search">
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
