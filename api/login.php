<?php
include '../model/accountsModel.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /**
     * This is the endpoint used to log in and request a new token
     */
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $login = new logInModel($data->username, $data->password);
    $model = new accountsModel();
    $result = $model->logIn($login);
    if(isset($result->token)){
        setcookie("Auth", $result->token, time() + (86400 * 30), "/");
    }
    // setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    echo(json_encode($result));
}


// PUT
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    
    $val = new validationModel();
    $canGo = $val->ValidateToken($_SERVER);
    if(!$canGo){
        $errMsg = new errorMessage('LogInError', 'Please log in before using this application');
        echo(json_encode($errMsg));
        return;
    }

    if(isset($canGo->account_id)){
        $res = $val->RemoveToken($canGo->account_id);
        if($res > 0){
            $logout = new errorMessage('LogInError', 'Please log in before using this application');
            echo(json_encode($logout));
        }
    }
}

?>