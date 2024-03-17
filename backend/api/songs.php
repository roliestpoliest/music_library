<?php
include '../model/accountsModel.php';
include '../model/songsModel.php';

$val = new validationModel();
$canGo = $val->ValidateToken($_SERVER);
if(!$canGo){
    $errMsg = new errorMessage('Error', 'Please log in before using this application');
    echo(json_encode($errMsg));
    return;
}

// GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new songsModel();
    if(isset($_GET['artist_id'])){
        $result = $model->GetSongsByArtistId($_GET['artist_id']);
    }elseif (isset($_GET['title'])){
        $result = $model->GetSongsByTitle($_GET['title']);
    }elseif (isset($_GET['rating'])){
        $result = $model->GetSongsByRating($_GET['rating']);
    }elseif (isset($_GET['song_id'])){
        $result = $model->GetSongsBySongId($_GET['song_id']);
    }else{
        $result = $model->GetAllSongs();
    }
    echo(json_encode($result));
    return;
}
// POST
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new songsModel();
    $model->song_id = $data->song_id;
    $model->artist_id = $data->artist_id;
    $model->title = $data->title;
    $model->duration = $data->duration;
    $model->listens = $data->listens;
    $model->rating = $data->rating;
    $model->genre_id = $data->genre_id;
    $result = $model->SaveOrUpdate();
    echo(json_encode($result));
    return;
}
// DELETE
if($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new songsModel();
    $model->song_id = $data->song_id;
    $model->artist_id = $data->artist_id;
    $model->title = $data->title;
    $model->duration = $data->duration;
    $model->listens = $data->listens;
    $model->rating = $data->rating;
    $model->genre_id = $data->genre_id;
    $result = $model->Delete();
    echo(json_encode($result));
    return;
}
?>