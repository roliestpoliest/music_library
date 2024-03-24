<?php
header("Access-Control-Allow-Origin: *");
include '../model/accountsModel.php';
include '../model/eventsModel.php';

$val = new validationModel();
$canGo = $val->ValidateToken($_SERVER);
if(!$canGo){
    $errMsg = new errorMessage('Error', 'Please log in before using this application');
    echo(json_encode($errMsg));
    return;
}
// GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new eventsModel();
    if(isset($_GET['event_id'])){
        $result = $model->GetEventsByEventId($_GET['event_id']);
    }elseif (isset($_GET['artist_id'])){
        $result = $model->GetEventsByArtistId($_GET['artist_id']);
    }elseif (isset($_GET['date'])){
        $result = $model->GetAllEventsByDate($_GET['date']);
    }elseif (isset($_GET['title'])){
        $result = $model->GetAllEventsByTitle($_GET['title']);
    }elseif (isset($_GET['region'])){
        $result = $model->GetAllEventsByRegion($_GET['region']);
    }else{
        $result = $model->GetAllEvents();
    }
    echo(json_encode($result));
    return;
}
// POST
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new eventsModel();
    $model->event_id = $data->event_id;
    $model->title = $data->title;
    $model->description = $data->description;
    $model->date = $data->date;
    $model->start_time = $data->start_time;
    $model->end_time = $data->end_time;
    $model->region = $data->region;
    $model->artist_id = $data->artist_id;
    $result = $model->SaveOrUpdate();
    echo(json_encode($result));
    return;
  }
// DELETE
if($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new eventsModel();
    $model->event_id = $data->event_id;
    $model->title = $data->title;
    $model->description = $data->description;
    $model->date = $data->date;
    $model->start_time = $data->start_time;
    $model->end_time = $data->end_time;
    $model->region = $data->region;
    $model->artist_id = $data->artist_id;
    $result = $model->Delete();
    echo(json_encode($result));
    return;
}
?>