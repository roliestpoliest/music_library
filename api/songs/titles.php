<?php
include '../../model/accountsModel.php';
include '../../model/songsModel.php';

// GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $model = new songsModel();
  $result = $model->GetAllSongTitles();
  echo(json_encode($result));
  return;
}
?>