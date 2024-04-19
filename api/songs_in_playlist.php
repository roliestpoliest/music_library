<?php
include '../model/accountsModel.php';
include '../model/songs_in_playlistModel.php';

$val = new validationModel();
$canGo = $val->ValidateToken($_SERVER);
if(!$canGo){
    $errMsg = new errorMessage('LogInError', 'Please log in before using this application');
    echo(json_encode($errMsg));
    return;
}
// GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new songs_in_playlistModel();
    if(isset($_GET['song_id'])){
        $result = $model->GetSongsInPlaylistBySongId($_GET['song_id']);
    }else if(isset($_GET['playlist_id'])){
        $result = $model->GetSongsInPlaylistByPlaylistId($_GET['playlist_id']);
    }else{
        $result = $model->GetAllSongsInPlaylist();
    }
    echo(json_encode($result));
    return;
}

// POST
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new songs_in_playlistModel();
    $model->song_id = $data->song_id;
    $model->playlist_id = $data->playlist_id;
    $result = $model->Save();
    echo(json_encode($result));
    return;
}

// DELETE
if($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new songs_in_playlistModel();
    $model->song_id = $data->song_id;
    $model->playlist_id = $data->playlist_id;
    $result = $model->Delete();
    echo(json_encode($result));
    return;
}
?>