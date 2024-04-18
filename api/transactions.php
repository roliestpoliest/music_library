<?php
include '../model/accountsModel.php';
include '../model/transactionsModel.php';

$val = new validationModel();
$canGo = $val->ValidateToken($_SERVER);
if(!$canGo){
    $errMsg = new errorMessage('LogInError', 'Please log in before using this application');
    echo(json_encode($errMsg));
    return;
}
// GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new transactionsModel();
    if(isset($_GET['account_id'])){
        //$result = $model->GetTransactionsByAccountId($_GET['account_id']);
        $result = $model->GetTransactionsByAccountId($canGo->account_id);
    }else{
        $result = $model->GetAllTransactions();
    }
    echo(json_encode($result));
    return;
}
// POST
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new transactionsModel();
    // $model->playlist_id = $data->playlist_id;
    $model->transaction_id = $data->transaction_id;
    //$model->account_id = $data->account_id;
    $model -> account_id = $canGo -> account_id;
    $model->payment_date = $data->payment_date;
    $model->payment_source = $data->payment_source;
    $model->total = $data->total;
    $result = $model->SaveOrUpdate();
    echo(json_encode($result));
    return;
}
// DELETE
if($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new transactionsModel();
    $model->transaction_id = $data->transaction_id;
    $model->account_id = $data->account_id;
    $model->payment_date = $data->payment_date;
    $model->payment_source = $data->payment_source;
    $model->total = $data->total;
    $result = $model->Delete();
    echo(json_encode($result));
    return;
}
?>