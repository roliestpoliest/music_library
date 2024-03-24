<?php
include '../model/accountsModel.php';
include '../model/followed_artistsModel.php';
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
    $model = new followed_artistsModels();
    if(isset($_GET['account_id'])){
        $result = $model->GetArtistFollowedByAccountId($_GET['account_id']);
    }elseif (isset($_GET['artist_id'])){
        $result = $model->GetAccountstFollowingArtistId($_GET['artist_id']);
    }else{
        $result = $model->GetAllFollowed();
    }
    echo(json_encode($result));
    return;
}
// POST
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new followed_artistsModels();
    $model->account_id = $data->account_id;
    $model->artist_id = $data->artist_id;
    $result = $model->Save();
    echo(json_encode($result));
    return;
}
// DELETE
if($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new followed_artistsModels();
    $model->account_id = $data->account_id;
    $model->artist_id = $data->artist_id;
    $result = $model->Delete();
    echo(json_encode($result));
    return;
}
?>