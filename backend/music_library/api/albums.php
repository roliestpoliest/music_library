<?php
include '../model/accountsModel.php';
include '../model/albumsModel.php';

// GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $val = new validationModel();
    $canGo = $val->ValidateToken($_SERVER);
    if(!$canGo){
        $errMsg = new errorMessage('Error', 'Please log in before using this application');
        echo(json_encode($errMsg));
    }else{
        $model = new albumsModel();
        if(isset($_GET['album_id'])){
        $result = $model->GetAlbumById($_GET['album_id']);
        }elseif (isset($_GET['artist_id'])){
            $result = $model->GetAlbumByArtist_id($_GET['artist_id']);
        }elseif (isset($_GET['title'])){
            $result = $model->GetAlbumsByTitle($_GET['title']);
        }else{
        $result = $model->GetAllAlbums();
        }
        echo(json_encode($result));
    }
  }
?>