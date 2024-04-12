<?php
include '../model/accountsModel.php';
include '../model/songRatingModel.php';

$val = new validationModel();
$canGo = $val->ValidateToken($_SERVER);
if(!$canGo){
    $errMsg = new errorMessage('LogInError', 'Please log in before using this application');
    echo(json_encode($errMsg));
    return;
}

//POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($canGo->account_id)){
        $result = null;
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $model = new songRatingModel();
        $result = $model->SaveOrUpdate($canGo->account_id, $data->song_id, $data->user_rating);
        
        echo(json_encode($result));
        return;
    }
}
?>