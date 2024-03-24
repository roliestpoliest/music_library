<?php
header("Access-Control-Allow-Origin: *");
include '../model/accountsModel.php';

// PUT
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
  $json = file_get_contents('php://input');
  $data = json_decode($json);
  $model = new accountsModel();
  if(isset($data->account_id)){
    $model->account_id = $data->account_id;
  }
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
  // $model->image_path = $data->image_path;
  // $model->isAdmin = $data->isAdmin;

  $result = $model->SaveOrUpdate();
  echo(json_encode($result));
  return;
}

$val = new validationModel();
$canGo = $val->ValidateToken($_SERVER);
// print_r($canGo);
if(!$canGo){
    $errMsg = new errorMessage('Error', 'Please log in before using this application');
    echo(json_encode($errMsg));
    return;
}


// GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new accountsModel();
    if(isset($_GET['account_id'])){
    $result = $model->GetAccountById($canGo->account_id);
    }elseif (isset($_GET['username'])){
        $result = $model->GetAccountByUsername($_GET['username']);
    }else{
    $result = $model->GetAllAccounts();
    }
    echo(json_encode($result));
    return;
  }

  //POST
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/";
    $file = $_FILES['files'];
    $file_tmp = $file['tmp_name'][0];
    $timestamp = time();
    $timestamp = time();
    $newfileName = $timestamp.$file['name'][0];
    $file_ext = explode('.', $newfileName);
    $file_ext = strtolower(end($file_ext));
    $file_destination = '../uploads/'.$newfileName;

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if(isset($canGo->account_id)){
      $allowed = ['jpg', 'jpeg', 'png', 'gif'];

      if (!in_array($file_ext, $allowed)) {
        echo('only files with extansion jpg, jpeg, png, or gif are allowed');
      }

      if (move_uploaded_file($file_tmp, $file_destination)) {
        $model = new accountsModel();
        $model->SaveAvatarImagePath($canGo->account_id, $newfileName);
        echo 'File uploaded successfully';
      } else {
          echo('Error moving the file.');
      }
    }else{
      $errMsg = new errorMessage('Error', 'Account Id not found');
    echo(json_encode($errMsg));
    }
    return;
  }
  
?>