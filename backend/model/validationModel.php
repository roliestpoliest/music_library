<?php
// include 'db.php';
// include 'accountsModel.php';

/*
CREATE TABLE token_storage(account_id INT NOT NULL,
token VARCHAR(555) NOT NULL,
createdDate VARCHAR(255) NOT NULL);
*/

class validationModel{
    // Constructor
    public function __construct(
        public ? int $account_id = null,
        public ? string $token = null,
        public ? string $createdDate = null,
    ){}
    // Create Token
    function GenerateToken($accountObj){
        // Token Formula
        // timestamp created + hash email + first name
        $time = time();
        $token = $time;
        $token = $token.''.hash('md5', $accountObj->account_id);
        $token = $token.''.hash('md5', $accountObj->fname);
        $token = $token.''.hash('md5', $accountObj->password);
        $this->token = hash('md5', $token);

        $this->SaveOrUpdate($accountObj->account_id, $this->token, $time);
        // $this->Save($accountObj->account_id, $token, $time);

        return $this;
    }
    // Search Account Info By Token
    function ValidateToken($headers){
        // return true;
        if(!isset($headers['HTTP_AUTHORIZATION'])){
            return false;
        }else{
            $token = $headers['HTTP_AUTHORIZATION'];
        }
        // return;
        $db = new db();
        $query = $db->query("SELECT *
        FROM `token_storage` as t 
        where t.token = ?", $token)->fetchSingle();
        $db->close();
        if(sizeof($query) == 0){
            return false;
        }
        $tokenObj = new validationModel();
        $tokenObj->account_id = $query["account_id"];
        $tokenObj->token = $query["token"];
        $tokenObj->createdDate = $query["createdDate"];

        $account = new accountsModel();
        $savedInfo = $account->GetAccountById($tokenObj->account_id);
        
        $token = $tokenObj->createdDate;
        $token = $token.''.hash('md5', $tokenObj->account_id);
        $token = $token.''.hash('md5', $savedInfo->fname);
        $token = $token.''.hash('md5', $savedInfo->password);
        $generatedToken = hash('md5', $token);

        if($generatedToken == $tokenObj->token){
            return $savedInfo;
        }
        return false;
    }
    // Search Token By Account Account Id
    function GetTokenByAcountId($account_id){
        $db = new db();
        $query = $db->query("SELECT *
        FROM `token_storage` as t 
        where t.account_id = ?", $account_id)->fetchSingle();

        if(sizeof($query) == 0){
            return null;
        }
        $result = new validationModel();
        $result->account_id = $query["account_id"];
        $result->token = $query["token"];
        $result->createdDate = $query["createdDate"];
        $db->close();
        return $result;
    }
    // Save Token
    function Save($account_id, $token, $time){
        $db = new db();
        $query = $db->query("INSERT INTO token_storage(
            account_id, token, createdDate
        )VALUES(?,?,?)",
        $account_id,
        $token,
        $time
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
    // Update
    function Update($account_id, $token, $time){
        $db = new db();
        $query = $db->query("UPDATE token_storage SET
            token = ?, 
            createdDate = ?
            WHERE account_id = ?",
            $token,
            $time,
            $account_id
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
    // Save or Update
    function SaveOrUpdate($account_id, $token, $time){
        $result = null;
        $result = $this->GetTokenByAcountId($account_id);
        if($result == null){
            // echo("save");
            $result = $this->Save($account_id, $token, $time);
        }else{
            // echo("update");
            $result = $this->Update($account_id, $token, $time);
        }
        return $result;
    }
    // Validate Token
    // function ValidateToken($externalToken){
    //     $result = false;
    //     $val = new validationModel();
    //     echo($externalToken);
    //     return $result;
    // }
    // function ValidateToken($userId, $token){}

    // Remove Token
}
?>