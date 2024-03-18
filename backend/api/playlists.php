<?php
include '../model/accountsModel.php';
include '../model/playlistsModel.php';

$val = new validationModel();
$canGo = $val->ValidateToken($_SERVER);
if(!$canGo){
    $errMsg = new errorMessage('Error', 'Please log in before using this application');
    echo(json_encode($errMsg));
    return;
}
// GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new playlistModels();
    if(isset($_GET['title'])){
        $result = $model->GetSongsByTitle($_GET['title']);
    }elseif(isset($_GET['song_id'])){
        $result = $model->GetPlaylistByPlaylistId($_GET['song_id']);
    }elseif(isset($_GET['account_id'])){
        $result = $model->GetAllPlaylistsByAccountId($_GET['account_id']);
    }else{
        $result = $model->GetAllPlaylists();
    }
    echo(json_encode($result));
    return;
}
// POST
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new playlistModels();
    $model->playlist_id = $data->playlist_id;
    $model->account_id = $data->account_id;
    $model->title = $data->title;
    $model->image_path = $data->image_path;
    $result = $model->SaveOrUpdate();
    echo(json_encode($result));
    return;
}
// DELETE
if($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new playlistModels();
    $model->playlist_id = $data->playlist_id;
    $model->account_id = $data->account_id;
    $model->title = $data->title;
    $model->image_path = $data->image_path;
    $result = $model->Delete();
    echo(json_encode($result));
    return;
}
?>