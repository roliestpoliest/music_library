<?php
include '../../model/genresModel.php';


//GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new genresModel();
    $result = $model->GetAllGeneres();
    echo(json_encode($result));
    return;
}


?>