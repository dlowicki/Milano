<template>
  <div id="container">
    <vueHeader></vueHeader>
    <div class="main">
      <vueSidebar></vueSidebar>
      <vueZeiterfassung></vueZeiterfassung>
    </div>
  </div>
</template>

<script>
import vueHeader from './components/vueHeader'
import vueSidebar from './components/vueSidebar'
import vueZeiterfassung from './components/vueZeiterfassung'

export default {
  name: 'container',
  components: {
    vueHeader,
    vueSidebar,
    vueZeiterfassung
  }
}
</script>

<style>
  *{ margin: 0; padding: 0; }
  #container { font-family: 'Avenir', Helvetica, Arial, sans-serif;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale; }
  .main { display: flex; flex-direction: row; }
</style>
