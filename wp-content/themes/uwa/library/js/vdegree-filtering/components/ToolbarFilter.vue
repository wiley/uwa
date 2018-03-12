<template lang="html">
  <div
    v-if="isShowing"
    class="toolbar-filter"
    :class="{activeFilter: activeFilterClass}"
    role="toolbar">
    <h2>Toolbar Filter Component</h2>
  </div>
</template>

<script>
export default {
  name: 'toolbar-filter',
  props: [
    'isShowing',
    'activeFilterClass'
  ]
}
</script>

<style lang="css">
</style>
