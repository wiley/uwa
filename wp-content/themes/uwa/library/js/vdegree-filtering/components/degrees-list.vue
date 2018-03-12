<template>
  <isotope ref="cpt" id="root_isotope1" class="degrees" :list="degrees" :options='isotopeOptions'>
    <a
      v-for="degree, index in listForFilteredDegreesAreaAndLevel"
      :key="index"
      :href="'online-degrees/' + degree.slug"
      class="degree-transition degree"
      :class="getDegreeClasses(degree)">
      <small class="label" v-if="degree.degree_types[0]" v-text="degree.degree_types[0].name"></small>
      <small class="label undefined" v-else>No Program Type Set</small>
      <h3 class="degree__title" v-html="degree.title.rendered"></h3>
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
