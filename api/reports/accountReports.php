<?php
include '../../model/accountsModel.php';
//include '../../model/songsModel.php';
//include '../../model/albumsModel.php';
include '../../model/accountReportsModel.php';


$val = new validationModel();
$canGo = $val->ValidateToken($_SERVER);
if(!$canGo){
    $errMsg = new errorMessage('LogInError', 'Please log in before using this application');
    echo(json_encode($errMsg));
    return;
}
/*if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new accountReportsModel();
    if(isset($_GET['account_id'])){
    $result = $model->GetInfoById($_GET['account_id']);
    }elseif (isset($_GET['username'])){
        $result = $model->GetInfoByUsername($_GET['username']);
    }else{
    $result = $model->GetInfoForAllAccounts();
    }
    echo(json_encode($result));
    return;
  } */
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    //$model = new reportsModel();
    /*$formData = array(
        'account_id' => $data->account_id,
        'username' => $data->username
        // Add more fields as needed
    ); */
    $formData = array();
    //if(isset($data->account_id))
    if (!empty($data -> username) && trim($data -> username) !== '')
    {
        //echo"$data->account_id";
        $formData['username'] = $data->username;
    } 
    //if(isset($data->username))
    if (!empty($data -> user_role) && trim($data -> user_role) !== '')
    {
        //echo"$data->username";
        $formData['user_role'] = $data->user_role;
    } 
    if (!empty($data -> gender) && trim($data -> gender) !== '')
    {
        $formData['gender'] = $data->gender;
    } 
    if (!empty($data -> region) && trim($data -> region) !== '')
    {
        $formData['region'] = $data->region;
    } 
    $model = new accountReportsModel();
    //if(empty($formData))
    if (!empty($formData))
    {  
        $result = $model->GetAccountByFormData($formData);   
    }
    else
    {
        $result = $model->GetInfoForAllAccounts();  
        //$result = $model->GetAccountByFormData($formData);  
    }
    //$result = $model->GetAccountByFormData($formData);
    echo(json_encode($result));
    return;
}
?> 
