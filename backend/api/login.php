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
?>