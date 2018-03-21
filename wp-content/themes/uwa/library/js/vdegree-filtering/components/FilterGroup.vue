<template lang="html">
  <div class="filter-group filters-types">
    <fieldset class="degreeLevels">
      <h2
        @click="toggleDegreeTypesFilters"
        class="toolbar-filter__label"
        :class="{activeFilter: degreeTypesFilterIsActive}">
        Degree Types
      </h2>
      <h3 v-if="mobileMode" class="toolbar-filter__activeTitle">{{activeDegreeTypeTitle}}</h3>
      <transition name="slide-down">
        <div
          v-if="showDegreeTypesToolbar"
          class="degreeLevelsToolbar toolbar-filter"
          :class="{activeFilter: degreeTypesFilterIsActive}"
          role="toolbar">
          <button
            key="all"
            class="btn__hollow filter"
            :class="{active: activeDegreeType === 'all' }"
            aria-label="List All Degrees Types"
            @click="updateDegreeTypeToAll">All
          </button>
          <button
            v-for="type in degreeTypes"
            :key="type.term_id" class="btn__hollow filter"
            :class="{active: type.term_id === activeDegreeType}"
            :aria-label="'Filter By ' + type.name"
            @click.prevent="updateActiveDegreeType(type)">
            {{type.name}}
            <span class="active-filter-indicator">
              <img v-if="type.term_id === activeDegreeType" src="/wp-content/themes/uwa/library/images/filtering-module/check.svg" alt="Active Filter Icon">
            </span>
          </button>
        </div>
      </transition>
    </fieldset>
  </div>
</template>

<script>
export default {
  name: 'filter-group',
  props: [
    'mobileMode',
  ]
}
</script>

<style lang="scss">
</style>
