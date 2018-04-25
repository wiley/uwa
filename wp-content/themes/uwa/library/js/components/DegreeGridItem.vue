<template lang="html">
  <li class="degree degree-grid-item" :class="getDegreeClasses(degree)" :key="degree.id">
    <a :href="'online-degrees/' + degree.slug">
      <small class="label" v-if="degree.degree_levels[0]" v-html="degree.degree_levels[0].name"></small>
      <small class="label undefined" v-else>No Program Type Set</small>
      <h3 class="degree__title" v-html="degree.title.rendered"></h3>
      <span v-if="checkForTeachingCertificate(degree)" class="includes-licensure">
        <!-- <img class="state-icon" src="/wp-content/themes/uwa/library/images/filtering-module/icon-alabama.svg" alt="Alabama State Icon"> -->
        Includes Licensure
      </span>
      <div class="degree__cta-button">More Info</div>
    </a>
  </li>
</template>

<script>
export default {
  props: {
    degree: {
      type: Object
    }
  }
}
</script>

<style lang="css">
</style>
