<?php
include_once 'db.php';
include_once 'validationModel.php';

class accountsModel{
    // Constructor
    public function __construct(
        public ? int $account_id = null,
        public ? string $user_role = null,
        public ? string $fname = null,
        public ? string $lname = null,
        public ? string $username = null,
        public ? string $bio = null,
        public ? string $gender = null,
        public ? string $DOB = null,
        public ? string $region = null,
        public ? string $email = null,
        public ? string $password = null,
        public ? string $image_path = null,
    ) {}
    // Get by id
    function GetAccountById($id){
        $db = new db();
        $query = $db->query("SELECT a.account_id, a.user_role, a.fname, a.lname, a.username, a.bio, a.gender, a.DOB, a.region, a.email, a.password, 
        CASE WHEN a.image_path IS NULL THEN 'defaultImage.jpg' ELSE a.image_path END AS image_path 
        FROM accounts as a WHERE account_id = ?", $id)->fetchSingle();
        $result = new accountsModel();
        $result->account_id = $query["account_id"];
        $result->user_role = $query["user_role"];
        $result->fname = $query["fname"];
        $result->lname = $query["lname"];
        $result->username = $query["username"];
        $result->bio = $query["bio"];
        $result->gender = $query["gender"];
        $result->DOB = $query["DOB"];
        $result->region = $query["region"];
        $result->email = $query["email"];
        $result->password = $query["password"];
        $result->image_path = $query["image_path"];
        $db->close();
        return $result;
    }
    
    // Get by email
    function GetAccountByUsername($username){
        $result = null;
        $db = new db();
        $query = $db->query("SELECT a.account_id, a.user_role, a.fname, a.lname, a.username, a.bio, a.gender, a.DOB, a.region, a.email, a.password, 
        CASE WHEN a.image_path IS NULL THEN 'defaultImage.jpg' ELSE a.image_path END AS image_path
        FROM `accounts` as a WHERE a.username = ?", $username)->fetchSingle();
        if(isset($query) && sizeof($query)){
            $result = new accountsModel();
            $result->account_id = $query["account_id"];
            $result->user_role = $query["user_role"];
            $result->fname = $query["fname"];
            $result->lname = $query["lname"];
            $result->username = $query["username"];
            $result->bio = $query["bio"];
            $result->gender = $query["gender"];
            $result->DOB = $query["DOB"];
            $result->region = $query["region"];
            $result->email = $query["email"];
            $result->password = $query["password"];
            $result->image_path = $query["image_path"];
        }
        $db->close();
        return $result;
    }
    // Get all accounts
    function GetAllAccounts(){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT SELECT a.account_id, a.user_role, a.fname, a.lname, a.username, a.bio, a.gender, a.DOB, a.region, a.email, a.password, 
        CASE WHEN a.image_path IS NULL THEN 'defaultImage.jpg' ELSE a.image_path END AS image_path
        FROM `accounts` as a")->fetchAll();
        foreach($query as $row){
            $obj = new accountsModel();
            $obj->account_id = $row["account_id"];
            $obj->user_role = $row["user_role"];
            $obj->fname = $row["fname"];
            $obj->lname = $row["lname"];
            $obj->username = $row["username"];
            $obj->bio = $row["bio"];
            $obj->gender = $row["gender"];
            $obj->DOB = $row["DOB"];
            $obj->region = $row["region"];
            $obj->email = $row["email"];
            $obj->password = $row["password"];
            $obj->image_path = $row["image_path"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Save
    function Save(){
        $db = new db();
        $query = $db->query("INSERT INTO accounts(
            user_role,
            fname,
            lname,
            username,
            bio,
            gender,
            DOB,
            region,
            email,
            password
            )VALUES(
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?
            )", 
            $this->user_role,
            $this->fname,
            $this->lname,
            $this->username,
            $this->bio,
            $this->gender,
            $this->DOB,
            $this->region,
            $this->email,
            $this->password
        );
        $result = $query->lastInsertID();
        $db->close();
        return $result;
    }
    // Update
    function Update(){
        $db = new db();
        $query = $db->query("UPDATE accounts SET
                user_role = ?, 
                fname = ?, 
                lname = ?, 
                username = ?, 
                bio = ?, 
                gender = ?, 
                DOB = ?, 
                region = ?, 
                email = ?, 
                password = ?
            WHERE account_id = ?",
                $this->user_role,
                $this->fname,
                $this->lname,
                $this->username,
                $this->bio,
                $this->gender,
                $this->DOB,
                $this->region,
                $this->email,
                $this->password,
                $this->account_id
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }

    function SaveAvatarImagePath($accountId, $filepath){
        $db = new db();
        $query = $db->query("UPDATE accounts SET
                image_path = ?
            WHERE account_id = ?",
                $filepath,
                $accountId
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
    // SaveOrUpdate
    function SaveOrUpdate(){
        $result = null;
        if($this->account_id == null || $this->account_id == ""){
            $result = $this->Save();
        }else{
            $result = $this->Update();
        }
        return $result;
    }
    // Detele
    function Delete(){
        $db = new db();
        $query = $db->query("DELETE FROM accounts
            WHERE account_id = ?",
                $this->account_id
        );
        $result = $query->affectedRows();
        $db->close();
    }
    function logIn($userInfo){
        $account = new accountsModel();
        $savedInfo = $account->GetAccountByUsername($userInfo->username);
        if(isset($savedInfo) && $userInfo->username == $savedInfo->username && 
        $userInfo->password == $savedInfo->password){
            $val = new validationModel();
            $token = $val->GenerateToken($savedInfo);

            $result = $val->GetTokenByAcountId($savedInfo->account_id);
        }else{
            $result = new errorMessage('Error', 'Login failed');
        }
        return $result;
    }
}
?>