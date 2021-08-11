<template>
  <div class="zt">
    <div class="zt-woche">
        <div class="zt-woche-top">
            <h3>{{ title }}</h3>
            <h4> {{ arbeitsstunden }}h</h4>
            <input type="week">
        </div>
        <div class="zt-woche-days">
            <div v-for="w in week" v-bind:key="w" style="width: 20%;">
                <div class="days-day">
                    <h3>{{ w.date }}</h3>
                    <p>{{ weekHours(w.hours) }}h</p>
                </div>
                <div class="days-activities">
                    <ul style="list-style: none;">
                       <li v-for="(item, index) in w.activities" v-bind:key="index">
                          {{ item }}
                          <p>{{ w.hours[index] }}h</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="zt-bottom">
      <div class="zt-buchhungen">
        	<div class="buchungen-top">
            <h3>Letzte Buchungen</h3>
            <select id="buchungen-days">
              <option>Letzten 7 Tage</option>
              <option>Letzten 14 Tage</option>
              <option>Letzten 30 Tage</option>
              <option>Letzten 90 Tage</option>
            </select>
          </div>
      </div>
      <ol class="buchungen-bottom">
        <li>
          <h3 class="buchung-table-title">Titel</h3>
          <h3 class="buchung-table-aufwand">Aufwand</h3>
          <h3 class="buchung-table-datum">Datum</h3>
          <h3 class="buchung-table-projekt">Projekt</h3>
          <h3 class="buchung-table-paket">Paket</h3>
          <h3 class="buchung-table-beschreibung">Beschreibung</h3>
        </li>
        <li v-for="d in data" v-bind:key="d">
          <p class="buchung-table-title">{{ d[1] }}</p>
          <p class="buchung-table-aufwand">{{ d[2] }}h</p>
          <p class="buchung-table-datum">{{ d[3] }}</p>
          <p class="buchung-table-projekt">{{ d[4] }}</p>
          <p class="buchung-table-paket">{{ d[5] }}</p>
          <p class="buchung-table-beschreibung">{{ d[6] }}</p>
          </li>
      </ol>
    </div>

  </div>
</template>

<script>
export default {
  name: 'vueZeiterfassung',
  data () {
    return {
      title: 'Wochenüberblick',
      arbeitsstunden: 30,
      week: {
          day1: {date: 'Mo., 13.7', activities: ['Insta Seite erstellen', 'Facebook Seite erstellen', 'Twitter Seite erstellen'], hours: [2.5,3.5,7.2]},
          day2: {date: 'Di., 14.7', activities: ['Facebook Seite erstellen'], hours: [6.2]},
          day3: {date: 'Mi., 15.7', activities: ['Reddit Seite erstellen'], hours: [1.5]},
          day4: {date: 'Do., 16.7', activities: ['IBS Seite erstellen', 'Facebook Seite erstellen'], hours: [5.5,4.2]},
          day5: {date: 'Fr., 17.7', activities: ['Kara Seite erstellen', 'Facebook Seite erstellen'], hours: [6.5,3.2]},
      },
      data: [
        [0, 'Insta Seite erstellen', 2.5, '22.08.2021','KK28838','Entwickler','Insta Seite wurde erstellt und bla bla bla'],
        [1, 'Facebook Seite erstellen', 5.5, '22.08.2021','KK28838','Entwickler','Facebook Seite wurde erstellt und bla bla bla'],
        [2, 'Twitter Seite erstellen', 1.5, '22.08.2021','KK28838','Entwickler','Twitter Seite wurde erstellt und bla bla bla'],
      ]
    }
  },
  methods: {
      weekHours(list){
          var temp = 0;
          list.forEach(element => {
              temp = temp + element;
          });
          return temp;
      }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .zt {width: 100%; height: 95vh;}
  .zt-woche {display: flex; flex-direction: column; width: 95%; margin-left: auto; margin-right: auto; margin-top: 30px;
  -webkit-box-shadow: 1px 1px 2px 0px rgba(0,0,0,0.75);-moz-box-shadow: 1px 1px 2px 0px rgba(0,0,0,0.75);box-shadow: 1px 1px 2px 0px rgba(0,0,0,0.75);
  }
  .zt-woche-top {width: 98%; background-color: #f7f7f8; border-top-left-radius: 10px; border-top-right-radius: 10px; display: flex; flex-direction: row; padding: 0.5% 1% 1.5% 1%;}
  .zt-woche-top h3 {width: 70%; font-size: 1rem; color: #4f5050; font-weight: 500; margin-top: 5px;}
  .zt-woche-top h4 {color: #801436; font-size: 1.2rem; margin-left: auto; width: 100px; text-align: right;}
  .zt-woche-top input {margin-left: auto; background-color: transparent; min-width: 100px; padding: 0px 2px 2px 2px; outline: none; border: none; color: #801436; font-size: 1rem;}

  .zt-woche-days {width: 100%;  display: flex; flex-direction: row; height: 300px; }
  .days-day {width: 95%; padding: 2.5%; background-color: #f7f7f8;  display: flex; flex-direction: row;}
  .days-day h3 {width: 80%; font-size: 1rem; color: #4f5050; font-weight: 100;}
  .days-day p {font-size: 1.2rem; margin-left: auto; color: #801436; font-weight: 600;}
  .days-activities {margin-top: 10px;}
  .days-activities li {margin-top: 10px; width: 90%;margin-left: auto; margin-right:auto; background-color: #801436; color: white; 
                          padding: 7.5% 4% 7.5% 4%; border-radius: 10px; display: flex; flex-direction: row;
  -webkit-box-shadow: 1px 1px 2px 0px rgba(0,0,0,0.75);-moz-box-shadow: 1px 1px 2px 0px rgba(0,0,0,0.75);box-shadow: 1px 1px 2px 0px rgba(0,0,0,0.75);                        
  }
  .days-activities p {margin-left: auto;}

  .zt-bottom { display: flex; flex-direction: column; width: 95%; margin-left: auto; margin-right: auto; margin-top: 20px;
  -webkit-box-shadow: 1px 1px 2px 0px rgba(0,0,0,0.75);-moz-box-shadow: 1px 1px 2px 0px rgba(0,0,0,0.75);box-shadow: 1px 1px 2px 0px rgba(0,0,0,0.75);
  }
  .buchungen-top { width: 98%; padding: 0.5% 1% 1% 1%; background-color: #f7f7f8; display: flex; flex-direction: row; }
  .buchungen-top h3 { font-size: 1rem; color: #4f5050; font-weight: 500; margin-top: 5px; }
  #buchungen-days { margin-left: auto; outline: none; border: none; background-color: transparent; color: #4f5050; padding: 5px; font-size: 1rem; }
  .buchungen-bottom { width: 100%; background-color: white; }
  .buchungen-bottom li {display: flex; flex-direction: row; padding: 5px; color: #4f5050; border: 1px solid #f7f7f8;}
  .buchungen-bottom li:first-of-type { background-color: #f7f7f8; }
  .buchungen-bottom li:first-of-type h3 { max-height: 5vh; overflow: hidden; text-align: left; display: block; padding: 2px; font-size: 1rem; font-weight: 100;}
  .buchungen-bottom p { max-height: 5vh; overflow: hidden; text-align: left; display: block; padding: 2px; font-size: 0.9rem; font-weight: bold;}
  .buchung-table-title { width: 15%;min-width: 150px; }
  .buchung-table-aufwand { width: 80px;}
  .buchung-table-datum {width: 120px;}
  .buchung-table-projekt {width: 15%; min-width: 150px;}
  .buchung-table-paket {width: 15%; min-width: 150px;}
  .buchung-table-beschreibung {width: 35%; min-width: 150px;}

</style>
