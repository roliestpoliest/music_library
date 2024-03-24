<?php
include '../model/accountsModel.php';
include '../model/songs_in_albumModel.php';
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
    $model = new songs_in_albumModel();
    if(isset($_GET['song_id'])){
        $result = $model->GetSongsInAlbumBySongId($_GET['song_id']);
    }else if(isset($_GET['album_id'])){
        $result = $model->GetSongsInAlbumByAlbumId($_GET['album_id']);
    }else{
        $result = $model->GetAllSongsInAlbum();
    }
    echo(json_encode($result));
    return;
}

// POST
if($_SERVER["REQUEST_METHOD"] == "POST") {
    echo("save Song");
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new songs_in_albumModel();
    $model->song_id = $data->song_id;
    $model->album_id = $data->album_id;
    $result = $model->Save();
    echo(json_encode($result));
    return;
}

// DELETE
if($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new songs_in_albumModel();
    $model->song_id = $data->song_id;
    $model->album_id = $data->album_id;
    $result = $model->Delete();
    echo(json_encode($result));
    return;
}
?>