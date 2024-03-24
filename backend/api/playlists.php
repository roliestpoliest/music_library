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
    }elseif(isset($_GET['playlist_id'])){
        $result = $model->GetSongsInPlaylist($_GET['playlist_id']);
    }elseif(isset($_GET['song_id'])){
        $result = $model->GetPlaylistByPlaylistId($_GET['song_id']);
    }elseif(isset($_GET['account_id'])){
        $result = $model->GetAllPlaylistsByAccountId($canGo->account_id);
    }else{
        $result = $model->GetAllPlaylists();
    }
    echo(json_encode($result));
    return;
}
// POST
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $model = new playlistModels();
    if(isset($_POST["playlist_id"])){
        $model->playlist_id = $_POST["playlist_id"];
    }
    $model->account_id = $canGo->account_id;
    $model->title = $_POST["title"];
    $model->image_path = null;
    $result = $model->SaveOrUpdate();
    if(isset($result)){
        if(isset($_FILES['files'])){
            $file = $_FILES['files'];
            $file_tmp = $file['tmp_name'][0];
            $timestamp = time();
            $newfileName = $timestamp.$file['name'][0];
            $file_ext = explode('.', $newfileName);
            $file_ext = strtolower(end($file_ext));
            $file_destination = '../uploads/'.$newfileName;

            if (!in_array($file_ext, $allowed)) {
                echo('only files with extension .mp3');
                return;
            }
            
            if (move_uploaded_file($file_tmp, $file_destination)) {
                // $model = new songsModel();
                $model->SavePlaylistImage($newfileName, $result);
                // echo 'File uploaded successfully';
            }
        }
        echo(json_encode($result));
    }
    return;
}
// DELETE
if($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new playlistModels();
    $model->playlist_id = $data->playlist_id;
    $model->account_id = $canGo->account_id;
    $model->title = $data->title;
    $model->image_path = $data->image_path;
    $result = $model->Delete();
    echo(json_encode($result));
    return;
}
?>