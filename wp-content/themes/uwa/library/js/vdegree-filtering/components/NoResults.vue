<template>
  <transition name="slide-down">
    <div id="no-results-msg" class="sticky" v-if="isVisible">No Results Match This Criteria</div>
  </transition>
</template>

<script>
export default {
  name: 'NoResults',
  props: {
    isVisible: {
      type: Boolean
    }
  },

  watch: {
    isVisible: function(newStatus, oldStatus) {
      if (newStatus === true) {
        // this.removeMessageAfterDelay()
      }
    }
  },
  methods: {
    removeMessageAfterDelay() {
      setTimeout(() => {
        this.isVisible = false
      }, 2500);
    }
  }
}
</script>

<style lang="scss">
#no-results-msg {
    display: flex;
    flex-flow: row wrap;
    align-items: center;
    justify-content: center;
    font-size: 1.5em;
    font-weight: 600;

    @media (min-width: 800px) {
				bottom: 60%;
				margin-top: 1.5em;
		    margin-bottom: 1em;
				width: 500px;
				padding: .5em 1.5em;//
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        font-size: 2.25em;
        background: #F4F2E4;
        border-radius: 3px;
    }
}
/*  */
</style>
