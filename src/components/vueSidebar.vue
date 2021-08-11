<template>
    <div class="sidebar">
        <div class="top">

            <div class="sidebar-top">
                <div class="sidebar-user" v-for="data in user" v-bind:key="data">
                    <i class="fas fa-circle" v-bind:class="{status_online: data.status === 'online', status_offline: data.status === 'offline', status_pending: data.status === 'pending'}"></i>
                    <h2>{{data.name}}</h2>
                    <!-- <i class="fas fa-level-down-alt"></i> -->
                </div>

                <div class="sidebar-message">
                    <p>19</p>
                    <i class="fas fa-bell"></i>
                </div>
            </div>

            <input type="text" placeholder="Suchen...">
        </div>

        <hr>

        <ol v-for="sb in sidebar" v-bind:key="sb"> <!-- Für jeden Eintrag in sidebar (6 Durchläufe) -->
            <div class="ol-head">
                <h2>{{ sb.sbName }}</h2>
                <i class="fas fa-folder-minus" v-if="sb.sbStatus" v-on:click="displayList(sb.sbID, $event)"></i>
                <i class="fas fa-folder-plus" v-on:click="displayList(sb.sbID, $event)" v-else></i>
            </div>
            <div v-bind:id="sb.sbID" v-if="sb.sbStatus" style="display: block">
                <a v-for="(sbList, index) in sb.sbList" v-bind:key="index" v-bind:href="sb.sbHref[index]"> {{ sbList }}</a>
            </div>
        </ol>
    </div>
</template>

<script>
export default {
    name: 'Sidebar',
    data() {
        return {
            user: [ {name: 'dlowicki', status: 'online'}, ],
            sidebar: [
                {sbID: 'sb1', sbName: 'Favoriten', sbList: ['Zeiterfassung','Anwesenheit','Stunden'], sbHref: ['zeiterfassung.html','anwesenheit.html','stunden.html'], sbStatus: true},
                {sbID: 'sb2', sbName: 'Benutzer', sbList: ['Zeiterfassung','Anwesenheit', 'Stunden', 'Urlaub', 'Nachrichten'], sbHref: ['zeiterfassung.html'], sbStatus: false},
                {sbID: 'sb3', sbName: 'Verwaltung', sbList: ['Termine'], sbHref: [], sbStatus: false},
                {sbID: 'sb4', sbName: 'Projekte', sbList: ['Übersicht','Pflege'], sbHref: [], sbStatus: false},
                {sbID: 'sb5', sbName: 'Controlling', sbList: ['Kosten','Berechnung'], sbHref: [], sbStatus: false},
                {sbID: 'sb6', sbName: 'Admin', sbList: ['User','Wartung'], sbHref: [], sbStatus: false},
            ],
        }
    },
    methods: {
        displayList(id, event) {
            var list = [];
            this.sidebar.filter((value) => {
                var temp = {};

                temp['sbID'] = value['sbID'];
                temp['sbName'] = value['sbName'];
                temp['sbList'] = value['sbList'];
                temp['sbStatus'] = value['sbStatus'];

                if(value['sbID'] == id){
                    if(value['sbStatus'] == false){
                        document.getElementById(id).style.display = "block";
                        event.target.classList.toggle('fa-folder-plus');
                        event.target.classList.add('fa-folder-minus');
                        temp['sbStatus'] = true;
                    } else {
                        document.getElementById(id).style.display = "none";
                        event.target.classList.toggle('fa-folder-minus');
                        event.target.classList.add('fa-folder-plus');
                        temp['sbStatus'] = false;
                    }
                }
                list.push(temp);
            });
            this.sidebar = list;
        }
    },
  computed: {
    userObject: function() {
      return {
        status: this.user.status
      }
    }
  }
}
</script>
<style scoped>
    .sidebar {
        background-color: #801436;
        width: 12%;
        min-width: 200px;
        min-height: 95vh;
    }
    .top {
        padding: 5% 0% 5% 0%;
        display: flex;
        flex-direction: column;
    }
    .top input {
        width: 80%;
        margin-left: right; margin-left: 10px;
        padding: 3px 5px 3px 5px;
        outline: none;
        background-color: transparent; border: 1px solid white;
        font-size: 1rem; color: white;
    }
    ::placeholder { color: white;opacity: 1; /* Firefox */}
    :-ms-input-placeholder { color: white;}
    ::-ms-input-placeholder { color: white;}


    .sidebar-top {display: flex; flex-direction: row; margin-bottom: 10px;}
    .sidebar-user {width: 70%;display: flex; flex-direction: row;color: white;padding: 7px;}
    .sidebar-user i {margin-top: 6px;padding: 0px 5px 0px 5px;}
    .sidebar-message {padding: 5px;color: white; margin-left: auto;}
    .sidebar-message p {
        float: right;
        margin-top: 3px;
        margin-left: -18px;
        margin-right: 5px;
        z-index: 1;
        position: relative;
        font-size: 0.8rem;
        font-weight: 600;
    }
    .sidebar-message i {
        float: right;
        z-index: 2;
        border-radius: 20px;
        margin: 8px 18px 8px 0px;
        transition: 0.5s;
        cursor: pointer;
    }
    .sidebar-message i:hover {color: red;}


    ol {width: 100%;color: white;margin-top: 2%;}
    ol h2 {width: 95%; padding-left: 5%; padding-bottom: 5%;}
    .ol-head {display: flex; flex-direction: row;}
    .ol-head i {margin-right: 10px;margin-top: 5px;cursor: pointer;}
    ol a  {
        text-align: center;
        padding: 5%;
        font-size: 1.1rem;
        transition: 0.5s;
        cursor: pointer;
        display: block;
        text-decoration: none;
        color: white;
    }
    ol a:hover { background-color: rgba(250,250,250,0.2); }

    .zt-user .fa-level-down-alt:hover { color: crimson; }
    .status_online { color: green; }
    .status_offline { color: red; }
    .status_pending { color: yellow; }


</style>