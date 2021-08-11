<template>
  <div class="header">
    <h1>{{ title }}</h1>
    <div class="header-fav">
      <h2>{{ page }}</h2>
      <i class="fas fa-star" v-if="favorite"></i>
      <i class="far fa-star" v-else></i>
      <button v-if="favorite" class="b-remove">Als Favorit entfernen</button>
      <button v-else class="b-add">Als Favorit speichern</button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'vueHeader',
  data () {
    return {
      title: 'Zeiterfassung',
      page: 'Zeiterfassung',
      favorite: true,
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.header {
  display: flex; flex-direction: row;
  background-color: #801436;
  color: white;
  width: 100%; 
  padding: 0.5vh 0vh 0.5vh 0vh;
  height: 4vh;
}
h1 {padding-left: 0.5%;  width: 30%;}

.header-fav {margin-left: auto; width: 20%; min-width: 400px; display: flex; flex-direction: row;}
.header-fav h2 { font-size: 1.2rem; width: 40%; min-width: 150px; padding: 5px;}
.header-fav i { padding: 8px; }
.header-fav button { font-size: 1rem;display: block; background-color: transparent; min-width: 150px; border: none; color: white; cursor: pointer; transition: 0.2s; }
.b-remove:hover { color: crimson; }
.b-add:hover { color: greenyellow; }
.fa-star { color: yellow; }
</style>
