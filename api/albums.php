<?php
include_once '../model/accountsModel.php';
include_once '../model/albumsModel.php';

$val = new validationModel();
$canGo = $val->ValidateToken($_SERVER);
if(!$canGo){
    $errMsg = new errorMessage('LogInError', 'Please log in before using this application');
    echo(json_encode($errMsg));
    return;
}

// GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new albumsModel();
    if(isset($_GET['album_id'])){
        $result = $model->GetAlbumById($_GET['album_id']);
    }elseif (isset($_GET['artist_id'])){
        $result = $model->GetAlbumByArtist_id($_GET['artist_id']);
    }elseif (isset($_GET['title'])){
        $result = $model->GetAlbumsByTitle($_GET['title']);
    }elseif (isset($_GET['myAlbums'])){
        $result = $model->GetMyAlbums($canGo->account_id);
    }else{
        $result = $model->GetAllAlbums();
    }
    echo(json_encode($result));
    return;
}
  // POST
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new albumsModel();
    if(isset($_POST["album_id"])){
        $model->album_id = $_POST["album_id"];
    }
    // $model->record_label = $_POST["record_label"];
    $model->artist_id = $_POST["artist_id"];
    $model->title = $_POST["title"];
    $model->format = $_POST["format"];
    $model->release_date = $_POST["release_date"];
    $model->rating = null;
    $model->image_path = null;
    $result = $model->SaveOrUpdate();

    if(isset($result)){
        if(isset($_FILES['files'])){
            $file = $_FILES['files'];
            $file_tmp = $file['tmp_name'];
            $timestamp = time();
            $newfileName = $timestamp.$file['name'];
            $file_ext = explode('.', $newfileName);
            $file_ext = strtolower(end($file_ext));
            $file_destination = '../uploads/'.$newfileName;

            if (in_array($file_ext, $allowed)) {
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    $model->SaveAlbumCoverImage($result, $newfileName);
                }
            }
        }
    }
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