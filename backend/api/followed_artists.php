<?php
include '../model/accountsModel.php';
include '../model/followed_artistsModel.php';

$val = new validationModel();
$canGo = $val->ValidateToken($_SERVER);
if(!$canGo){
    $errMsg = new errorMessage('Error', 'Please log in before using this application');
    echo(json_encode($errMsg));
    return;
}
print_r($canGo);
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
?>