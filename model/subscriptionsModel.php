<?php
class subscriptionsModel{
    // Constructor
    public function __construct(
        public ? int $subscription_id = null,
        public ? string $start_date = null,
        public ? string $end_date = null,
        public ? string $type = null,
        public ? float $price = null,
        public ? string $length = null,
        public ? int $account_id = null,
        public ? string $description = null,
    ){}
    // Get all Subscriptions
    function GetAllSubscriptions(){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `subscriptions`")->fetchAll();
        foreach($query as $row){
            $obj = new subscriptionsModel();
            $obj->subscription_id = $row["subscription_id"];
            $obj->start_date = $row["start_date"];
            $obj->end_date = $row["end_date"];
            $obj->type = $row["type"];
            $obj->price = $row["price"];
            $obj->account_id = $row["account_id"];
            $obj->description = $row["description"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get Subscription By Account
    function GetSubscriptionByAccountId($account_id){
        $result = null;
        $db = new db();
        $query = $db->query("SELECT *
        FROM `subscriptions` as p
        where p.account_id = ?", $account_id)->fetchSingle();
        if(isset($query) && sizeof($query) > 0){
            $result = new subscriptionsModel();
            $result->subscription_id = $query["subscription_id"];
            $result->start_date = $query["start_date"];
            $result->end_date = $query["end_date"];
            $result->type = $query["type"];
            $result->price = $query["price"];
            $result->account_id = $query["account_id"];
            $result->description = $query["description"];
        }
        $db->close();
        return $result;
    }
    // Save
    function Save(){
        $db = new db();
        $query = $db->query("INSERT INTO subscriptions(
            start_date,
            end_date,
            length,
            price,
            account_id,
            description
            )VALUES(
            ?,
            ?,
            ?,
            ?,
            ?,
            ?
            )", 
            $this->start_date,
            $this->end_date,
            $this->length,
            $this->price,
            $this->account_id,
            $this->description
        );
        $result = $query->lastInsertID();
        $db->close();
        return $result;
    }
    // Update
    function Update(){
        $db = new db();
        $query = $db->query("UPDATE subscriptions SET
            start_date = ?,
            end_date = ?,
            length = ?,
            price = ?,
            account_id = ?,
            description = ?
            WHERE subscription_id = ?",
                $this->start_date,
                $this->end_date,
                $this->length,
                $this->price,
                $this->account_id,
                $this->description,
                $this->subscription_id
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
    // Save or Delete
    function SaveOrUpdate(){
        $result = null;
        if(isset($this->subscription_id) && $this->subscription_id != null){
            $result = $this->Update();
        }else{
            $result = $this->Save();
        }
        return $result;
    }
    // Delete
    function Delete(){
        $db = new  db();
        $query = $db->query("DELETE FROM subscriptions WHERE subscription_id = ?", $this->subscription_id);
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
}
?>