<template>
  <transition-group tag="ul" class="degree-grid degrees" name="list">
    <slot v-for="degree in listForFilteredDegreesAreaAndLevel"></slot>
  </transition-group>  
</template>

<script>
export default {
  props: {
    degrees: {
      type: Array
    }
  }
}
</script>

<style lang="css">
</style>
