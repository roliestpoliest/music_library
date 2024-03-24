<?php
include '../../model/accountsModel.php';
include '../../model/artistsModel.php';
header("Access-Control-Allow-Origin: *");

// GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new artistsModel();
    $result = $model->GetAllArtistNames();
    echo(json_encode($result));
    return;
}
?>