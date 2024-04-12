<?php
include '../model/accountsModel.php';
include '../model/playlistsModel.php';

$val = new validationModel();
$canGo = $val->ValidateToken($_SERVER);
if(!$canGo){
    $errMsg = new errorMessage('LogInError', 'Please log in before using this application');
    echo(json_encode($errMsg));
    return;
}
// GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new playlistModels();
    if(isset($_GET['title'])){
        $result = $model->GetSongsByTitle($_GET['title']);
    }elseif(isset($_GET['playlis_id'])){
        $result = $model->GetPlaylistByPlaylistId($_GET['playlis_id']);
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
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new playlistModels();

    // print("data");
    // print_r($data);
    // print("files");
    // print_r($_FILES);
    // print("post");
    // print_r($_POST);

    if(isset($_POST["playlist_id"]) && $_POST["playlist_id"] != null){
        $model->playlist_id = $_POST["playlist_id"];
    }
    
    if(isset($data->playlist_id)){
        $model->playlist_id = $data->playlist_id;
    }
    $model->account_id = $canGo->account_id;
    if(isset($_POST["title"])){
        $model->title = $_POST["title"];
    }
    if(isset($data->title)){
        $model->title = $data->title;
    }
    $model->image_path = null;

    if(isset($model->title)){
        $result = $model->SaveOrUpdate();
    }
    if(isset($result)){
        if(isset($_FILES["file"])){
            $file = $_FILES['file'];
            $file_tmp = $file['tmp_name'];
            $timestamp = time();
            $newfileName = $timestamp.$file['name'];
            $file_ext = explode('.', $newfileName);
            $file_ext = strtolower(end($file_ext));
            $file_destination = '../uploads/'.$newfileName;

            if (!in_array($file_ext, $allowed)) {
                echo($file_ext.' not allowed, only files with extension .mp3');
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