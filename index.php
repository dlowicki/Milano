<!DOCTYPE html>
<html lang="ger" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Startseite | Milano</title>
    <link rel="icon" href="http://localhost/html/milano/img/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/script.create.js"></script>

    <style media="screen">
      * { margin: 0; padding: 0; font-family: arial; }
      body,html { width: 100%; height: 100%; }
      .container { width: 100%; height: 100%; background-color: #1d3557; display: flex; flex-wrap: nowrap; }
      .sidebar-container { width: 10%; min-width: 150px; background-color: #03071e; color: white; }
      h1 { text-align: center; }
      .sidebar-box { text-align: center; width: 96%; height: auto; padding: 2%; }
      .sidebar-box ul li { padding: 2%; margin: 2%; cursor: pointer; transition: 0.5s; font-size: 1.2rem; }
      .sidebar-box ul li:hover { color: darkgray; }
      .sidebar-box ul li i { float: right; }

      .sidebar-box ol { display: none; list-style: none; padding: 0% 0% 10% 0%; }
      .sidebar-box ol li { font-size: 1rem; }
      .sidebar-box ol li input { width: 50%; float: right; outline: none; }

      #bt-delete { background-color: #03071e; border: 1px solid white; color: white; margin-top: 5%; padding: 3% 0% 3% 0%; width: 70%; transition: 0.5s; cursor: pointer; }
      #bt-delete:hover { background-color: #d00000; }
      #bt-save { background-color: #03071e; border: 2px solid white; color: white; margin-top: 5%; padding: 3% 0% 3% 0%; width: 70%; cursor: pointer; }

      .main-container { width: 90%; height: 100%; }
      #main-info { width: 80%; height: 30px; margin: 1% 10% 0% 10%; text-align: right; color: white; }
      #main-window { width: 80%; height: 80%; background-color: #ffe5d9; margin: 1% 10% 0% 10%; }
      .draggable { background-color: #29e; color: #fff; font-size: 1.2em; touch-action: none; position: absolute; border: 2px solid white; z-index: 0; }
      .table-vertical { width: 40px; height: 100px; }
      .table-horizontal { width: 100px; height: 40px; }
      .table-cube { width: 40px; height: 40px; }
    </style>

  </head>
  <body>
    <div class="container">
      <div class="sidebar-container">
        <h1>Milano</h1>
        <div class="sidebar-box">
          <hr>
          <ul>
            <li>Pläne <i class="fas fa-arrow-down" id="dp-1"></i></li>
            <ol class="dp-1">
              <li>Etage 1</li>
              <li>Etage 2</li>
              <li>Außenbereich</li>
            </ol>
            <li>Hinzufügen <i class="fas fa-arrow-down" id="dp-2"></i></li>
            <ol class="dp-2">
              <li onClick="create('table-vertical')">Tisch</li>
              <li onClick="create('table-cube')">Quadrat</li>
            </ol>
            <li>Objekt <i class="fas fa-arrow-down" id="dp-3"></i></li>
            <ol class="dp-3">
              <li>ID:     <input type="text" id="input-id" readonly></li>
              <li>X:      <input type="number" id="input-x">       </li>
              <li>Y:      <input type="number" id="input-y">       </li>
              <li>Farbe:  <input type="text" id="input-farbe">     </li>
              <li>Text:   <input type="text" id="input-text">      </li>
              <button id="bt-delete">Löschen</button>
            </ol>
          </ul>
          <hr>
          <button id="bt-save" onClick="savePlan()">Speichern</button>
        </div>
      </div>
      <div class="main-container">
        <div id="main-info"></div>
        <div id="main-window">
          <?php
          $ini = parse_ini_file("data/data.ini", true);
          foreach ($ini['table'] as $key => $value) {
            $exp = explode(',',$value);
            echo '<div class="draggable '.$exp["0"].'" id="'.$key.'" data-x="'.$exp["1"].'" data-y="'.$exp["2"].'" style="transform: translate('.$exp["1"].'px,'.$exp["2"].'px);"><p></p></div>';
          }
          ?>
        </div>
      </div>
    </div>
    <script type="module">
    import interact from 'https://cdn.interactjs.io/v1.10.11/interactjs/index.js'
    var element = document.querySelector('.draggable').id; var x = 0; var y = 0;
    interact('.draggable')
    .draggable({
      modifiers: [
        interact.modifiers.snap({
          targets: [ interact.snappers.grid({ x: 1, y: 1 }) ]
        }),
        interact.modifiers.restrictRect({
          restriction: 'parent', endOnly: true
        })
      ],
      listeners: {
        move: dragMoveListener,
        end (event){
          event.target.style.zIndex = 1;
          event.target.style.borderColor = 'white';
        }
      },
      inertia: false,
      autoScroll: true
    })

    function dragMoveListener (event) {
      var target = event.target;
      target.style.zIndex = 2; target.style.borderColor = 'green';
      var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
      var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

      target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
      target.setAttribute('data-x', x); target.setAttribute('data-y', y);
      $('#input-x').val(x); $('#input-y').val(y);
    }


    </script>
    <script type="text/javascript">
    function savePlan() {
      var elements = document.getElementsByClassName('draggable');
      var dataset = "";
      for(let item of elements){
        var x = item.dataset['x'];
        var y = item.dataset['y'];
        var id = item.id;
        var type = item.className.split(" ")[1];
        dataset = dataset + id + "=" + type + "," + x + "," + y + "\r\n";
      }

      $.ajax({
          url: "sync.php", method: "POST", data: {savePlan: dataset},
          success: function(result) {
            if(result != false){
              if($('#main-info h2').length <= 0){
                $('#main-info').append('<h2>Plan wurde gespeichert!</h2>');
                setTimeout(function(){ $('#main-info').empty(); }, 5000);
              }
            }
          }
        });
    }
    $(document).on('click','.fa-arrow-up', function(){
      var id = $(this).attr('id');
      $('.'+id).css('display','none');
      $(this).attr('class','fas fa-arrow-down');
    });
    $(document).on('click','.fa-arrow-down', function(){
      var id = $(this).attr('id');
      $('.'+id).css('display','block');
      $(this).attr('class','fas fa-arrow-up');
    });

    </script>
  </body>
</html>
