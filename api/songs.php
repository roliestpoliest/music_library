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
    }elseif (isset($_GET['playlist_id'])){
        $result = $model->GetSongsInPlaylist($_GET['playlist_id'], $canGo->account_id);
    }elseif (isset($_GET['search'])){
        $result = $model->searchSong($_GET['search'], $canGo->account_id);
    }else{
        $result = $model->GetAllSongs();
    }
    echo(json_encode($result));
    return;
}
// POST

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/";

    if(isset($canGo->account_id)){
        $allowed = ['mp3']; 
        $model = new songsModel();
        $model->song_id = null;
        $model->artist_id = $_POST["artist_id"];
        $model->title = $_POST["title"];
        $model->duration = 0;
        $model->listens = 0;
        $model->rating = 0;
        $model->genre_id = $_POST["genre_id"];
        $model->audio_path = null;

        $songId = $model->Save();
        if(isset($songId)){
            if(isset($_FILES['files'])){
                $file = $_FILES['files'];
                $file_tmp = $file['tmp_name'][0];
                $timestamp = time();
                $newfileName = $timestamp.$file['name'][0];
                $file_ext = explode('.', $newfileName);
                $file_ext = strtolower(end($file_ext));
                $file_destination = '../uploads/audio'.$newfileName;

                if (!in_array($file_ext, $allowed)) {
                    echo('only files with extension .mp3');
                    return;
                }
                
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    $model = new songsModel();
                    $model->SaveAudioPath($songId, $newfileName);
                    echo 'File uploaded successfully';
                } else {
                    echo('Error moving the file.');
                    return;
                }
            }else{
                $errMsg = new errorMessage('Error', 'Song was saved without a file reference');
                echo(json_encode($errMsg));
                return;
            }
        }
    }
    return;
  }
//PUT
if($_SERVER["REQUEST_METHOD"] == "PUT") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new songsModel();
    $model->song_id = $data->song_id;
    $model->artist_id = $data->artist_id;
    $model->title = $data->title;
    $model->duration = 0;
    $model->listens = 0;
    $model->rating = 0;
    $model->genre_id = $data->genre_id;
    $model->audio_path = $data->audio_path;
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
    $model->audio_path = $data->audio_path;
    $result = $model->Delete();
    echo(json_encode($result));
    return;
}
?>