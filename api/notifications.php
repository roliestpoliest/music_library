<?php
include '../model/accountsModel.php';
include '../model/notificationsModel.php';

$val = new validationModel();
$canGo = $val->ValidateToken($_SERVER);
if(!$canGo){
    $errMsg = new errorMessage('LogInError', 'Please log in before using this application');
    echo(json_encode($errMsg));
    return;
}

// GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new notificationsModel();
    $result = $model->GetNotificationsByAccountId($canGo->account_id);
    // print_r($result);
    echo(json_encode($result));
}
?>