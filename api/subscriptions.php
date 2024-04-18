<?php
include '../model/accountsModel.php';
include '../model/subscriptionsModel.php';

$val = new validationModel();
$canGo = $val->ValidateToken($_SERVER);
if(!$canGo){
    $errMsg = new errorMessage('LogInError', 'Please log in before using this application');
    echo(json_encode($errMsg));
    return;
}
// GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new subscriptionsModel();
    if(isset($_GET['account_id'])){
        $result = $model->GetSubscriptionByAccountId($_GET['account_id']);
    }else{
        $result = $model->GetAllSubscriptions();
    }
    echo(json_encode($result));
    return;
}
// POST
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new subscriptionsModel();
    $model->subscription_id = $data->subscription_id;
    $model->start_date = $data->start_date;
    $model->end_date = $data->end_date;
    $model->length = $data->length;
    $model->price = $data->price;
    //$model->account_id = $data->account_id;
    $model->account_id = $canGo->account_id;
    $model->description = $data->description;
    $result = $model->SaveOrUpdate();
    echo(json_encode($result));
    return;
}
// DELETE
if($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new subscriptionsModel();
    $model->subscription_id = $data->subscription_id;
    $model->start_date = $data->start_date;
    $model->end_date = $data->end_date;
    $model->length = $data->length;
    $model->price = $data->price;
    $model->account_id = $data->account_id;
    $model->description = $data->description;
    $result = $model->Delete();
    echo(json_encode($result));
    return;
}
?>