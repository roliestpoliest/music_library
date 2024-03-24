<?php
include '../model/accountsModel.php';
include '../model/genresModel.php';
header("Access-Control-Allow-Origin: *");

$val = new validationModel();
$canGo = $val->ValidateToken($_SERVER);
if(!$canGo){
    $errMsg = new errorMessage('Error', 'Please log in before using this application');
    echo(json_encode($errMsg));
    return;
}
// GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new genresModel();
    if(isset($_GET['title'])){
        $result = $model->GetGeneresByTitle($_GET['title']);
    }else{
        $result = $model->GetAllGeneres();
    }
    echo(json_encode($result));
    return;
}
// POST
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new genresModel();
    $model->genre_id = $data->genre_id;
    $model->title = $data->title;
    $result = $model->SaveOrUpdate();
    echo(json_encode($result));
    return;
}
// DELETE
if($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new genresModel();
    $model->genre_id = $data->genre_id;
    $model->title = $data->title;
    $result = $model->Delete();
    echo(json_encode($result));
    return;
}
?>