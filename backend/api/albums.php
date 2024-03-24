<?php
include_once '../model/accountsModel.php';
include_once '../model/albumsModel.php';

$val = new validationModel();
$canGo = $val->ValidateToken($_SERVER);
if(!$canGo){
    $errMsg = new errorMessage('Error', 'Please log in before using this application');
    echo(json_encode($errMsg));
    return;
}

// GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new albumsModel();
    if(isset($_GET['album_id'])){
        $result = $model->GetSongsInAlbum($_GET['album_id']);
    }elseif (isset($_GET['artist_id'])){
        $result = $model->GetAlbumByArtist_id($_GET['artist_id']);
    }elseif (isset($_GET['title'])){
        $result = $model->GetAlbumsByTitle($_GET['title']);
    }else{
        $result = $model->GetAllAlbums();
    }
    echo(json_encode($result));
    return;
}
  // POST
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new albumsModel();
    $model->album_id = $data->album_id;
    $model->record_label = $data->record_label;
    $model->artist_id = $data->artist_id;
    $model->title = $data->title;
    $model->format = $data->format;
    $model->release_date = $data->release_date;
    $model->rating = $data->rating;
    $model->image_path = $data->image_path;
    $result = $model->SaveOrUpdate();
    echo(json_encode($result));
    return;
  }
// DELETE
if($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new albumsModel();
    $model->album_id = $data->album_id;
    $model->record_label = $data->record_label;
    $model->artist_id = $data->artist_id;
    $model->title = $data->title;
    $model->format = $data->format;
    $model->release_date = $data->release_date;
    $model->rating = $data->rating;
    $model->image_path = $data->image_path;
    $result = $model->Delete();
    echo(json_encode($result));
    return;
}
?>