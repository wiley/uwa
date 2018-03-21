<template lang="html">
  <isotope v-show="listForFilteredDegreesAreaAndLevel.length" ref="cpt" id="root_isotope1" class="degrees sticky" :list="degrees" :options='isotopeOptions'>
    <a v-for="(degree, index) in listForFilteredDegreesAreaAndLevel" :key="index" :href="'online-degrees/' + degree.post_name" class="degree-transition degree" :class="getDegreeClassesNew(degree)">
      <small class="label" v-if="degree.degree_levels[0]" v-html="degree.degree_levels[0].name"></small>
      <small class="label undefined" v-else>No Program Type Set</small>
      <h3 class="degree__title" v-html="degree.post_title"></h3>
      <span v-if="checkForTeachingCertificate(degree)" class="includes-licensure">
        <img class="state-icon" src="/wp-content/themes/uwa/library/images/filtering-module/icon-alabama.svg" alt="Alabama State Icon">
        Includes Licensure
      </span>
      <div class="degree__cta-button">More Info</div>
    </a>
  </isotope>

</template>

<script>
export default {
}
</script>

<style lang="css">
</style>
