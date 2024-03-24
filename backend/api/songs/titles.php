<?php
include '../../model/accountsModel.php';
include '../../model/songsModel.php';
header("Access-Control-Allow-Origin: *");

// GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $model = new songsModel();
  $result = $model->GetAllSongTitles();
  echo(json_encode($result));
  return;
}
?>