<template lang="html">
  <transition name="slide-down">
    <div id="no-results-msg" class="sticky" v-show="isVisible">No Results Match This Criteria</div>
  </transition>
</template>

<script>
export default {
  props: {
    isVisible: {
      type: Boolean
    }
  }
}
</script>

<style lang="css">
</style>
