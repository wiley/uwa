<template lang="html">
  <li
    class="degree degree-grid-item"
    :class="degreeClasses">
    <a :href="'online-degrees/' + degree.slug">
      <small class="label" v-if="degree.degree_levels[0]" v-html="singularizedDegreeLevel"></small>
      <small class="label undefined" v-else>No Program Type Set</small>
      <h3 class="degree__title" v-html="degree.title.rendered"></h3>
      <span v-if="hasTeachingCertificate" class="includes-licensure">
        <img class="state-icon" src="/wp-content/themes/uwa/library/images/filtering-module/icon-alabama.svg" alt="Alabama State Icon">
        Includes Licensure
      </span>
      <div class="degree__cta-button">More Info</div>
    </a>
  </li>
</template>

<script>
import pluralize from 'pluralize'

export default {
  props: {
    degree: {
      type: Object,
      required: true
    },
    degreeClasses: {
      type: [Array, Object, String],
    },
    hasTeachingCertificate: {
      type: Boolean
    }
  },
  computed: {
    singularizedDegreeLevel() {
      return pluralize.singular(this.degree.degree_levels[0].name)
    }
  }
}
</script>

<style lang="css">
</style>
