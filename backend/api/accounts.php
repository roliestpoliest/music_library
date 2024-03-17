<?php
include '../model/accountsModel.php';

$val = new validationModel();
$canGo = $val->ValidateToken($_SERVER);
if(!$canGo){
    $errMsg = new errorMessage('Error', 'Please log in before using this application');
    echo(json_encode($errMsg));
    return;
}


// GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new accountsModel();
    if(isset($_GET['account_id'])){
    $result = $model->GetAccountById($_GET['account_id']);
    }elseif (isset($_GET['username'])){
        $result = $model->GetAccountByUsername($_GET['username']);
    }else{
    $result = $model->GetAllAccounts();
    }
    echo(json_encode($result));
    return;
  }

  // POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $model = new accountsModel();
    $model->account_id = $data->account_id;
    $model->user_role = $data->user_role;
    $model->fname = $data->fname;
    $model->lname = $data->lname;
    $model->username = $data->username;
    $model->bio = $data->bio;
    $model->gender = $data->gender;
    $model->DOB = $data->DOB;
    $model->region = $data->region;
    $model->email = $data->email;
    $model->password = $data->password;
    $model->isAdmin = $data->isAdmin;

    $result = $model->SaveOrUpdate();
    echo(json_encode($result));
    return;
  }
?>