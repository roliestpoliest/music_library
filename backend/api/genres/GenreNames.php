<?php
include '../../model/genresModel.php';
header("Access-Control-Allow-Origin: *");

//GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new genresModel();
    $result = $model->GetAllGeneres();
    echo(json_encode($result));
    return;
}


?>