<?php
include_once 'db.php';
include_once 'validationModel.php';

class accountReportsModel{
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


    function GetAccountByFormData($formData)
    {
    $result = array();
    $db = new db();
    $query = 'SELECT * FROM `accounts` WHERE ';
    $conditions = array();
    foreach ($formData as $key => $value) {
        $conditions[] = "$key = ?";
    }
    $query .= implode(' AND ', $conditions);
    // Execute the query
    //echo "SQL Query: $query";
    $accountData = $db->query($query, ...array_values($formData))->fetchAll();
    if (isset($accountData)) {
        $result = array();
        foreach ($accountData as $key => $value) {
            $result[$key] = $value;
            //echo "$result[$key]";
        }
    } 
    $db->close();
    //return $query;
    return $result;
}
    function GetInfoForAllAccounts(){
        $db = new db();
        $result = Array();
        // $query = $db->query('SELECT *, CASE  WHEN (SELECT admin_id FROM admins WHERE account_id = a.account_id IS NOT NULL) THEN 1 ELSE 0 END as isAdmin FROM `accounts` as a')->fetchAll();
        $query = $db->query("SELECT a. *FROM `accounts` as a")->fetchAll();
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
        // $obj->isAdmin = $row["isAdmin"];
        array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
}
?>