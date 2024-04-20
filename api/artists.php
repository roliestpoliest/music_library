<?php
include '../model/accountsModel.php';
include '../model/artistsModel.php';

$val = new validationModel();
$canGo = $val->ValidateToken($_SERVER);
if(!$canGo){
    $errMsg = new errorMessage('LogInError', 'Please log in before using this application');
    echo(json_encode($errMsg));
    return;
}

// GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new artistsModel();
    if(isset($_GET['account_id'])){
        $result = $model->GetArtistByAcountId($_GET['account_id']);
    }elseif (isset($_GET['artist_id'])){
        $result = $model->GetArtistByArtistId($_GET['artist_id']);
    }elseif (isset($_GET['getArtistId'])){
        $result = $model->GetArtistId($canGo->account_id);
    }elseif (isset($_GET['artistReport'])){
        $result = $model->GetArtistReport();
    }else{
        $result = $model->GetAllArtist();
    }
    echo(json_encode($result));
    return;
}
// POST
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new artistsModel();
    $model->account_id = $data->account_id;
    $result = $model->Save();
    echo(json_encode($result));
    return;
  }
  // DELETE
if($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new artistsModel();
    $model->artist_id = $data->artist_id;
    $result = $model->Delete();
    echo(json_encode($result));
    return;
}
?>