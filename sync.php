<?php

if(isset($_POST['savePlan'])){
  $ini = fopen('data/data.ini','w');
  fwrite($ini, "[table]\r\n" . $_POST['savePlan']);
  fclose($ini);
  echo true;
}

?>
