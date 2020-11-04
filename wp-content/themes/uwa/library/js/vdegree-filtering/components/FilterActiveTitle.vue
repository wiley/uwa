<template>
  <h3 v-if="visible"
    class="toolbar-filter__activeTitle">
    <span v-html="filter.name"></span>
    <img class="activeTitle-clear" @click="$emit('update:filter', 'all')" src="/wp-content/themes/uwa/library/images/filtering-module/clear-search-red.svg" alt="Clear Search">
  </h3>
</template>

<script>
export default {
  name: 'FilterActivetitle',
  props: {
    filter: {
      type: [String, Object],
    },
    title: {
      type: String,
    },
    visible: {
      type: Boolean,
    }
  }
}
</script>

<style lang="scss">
</style>
