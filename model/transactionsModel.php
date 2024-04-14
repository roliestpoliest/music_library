<?php
class transactionsModel{
    public function __construct(
        public ? int $transaction_id = null,
        public ? int $account_id = null,
        public ? string $payment_date = null,
        public ? string $payment_source = null,
        public ? float $total = null,
    ){}
    // Get all playlists
    function GetAllTransactions(){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `transactions` ORDER BY payment_date")->fetchAll();
        foreach($query as $row){
            $obj = new transactionsModel();
            $obj->transaction_id = $row["transaction_id"];
            $obj->account_id = $row["account_id"];
            $obj->payment_date = $row["payment_date"];
            $obj->payment_source = $row["payment_source"];
            $obj->total = $row["total"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get transactions by account
    function GetTransactionsByAccountId($account_id){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `transactions` 
        WHERE account_id = ?
        ORDER BY payment_date", $account_id)->fetchAll();
        foreach($query as $row){
            $obj = new transactionsModel();
            $obj->transaction_id = $row["transaction_id"];
            $obj->account_id = $row["account_id"];
            $obj->payment_date = $row["payment_date"];
            $obj->payment_source = $row["payment_source"];
            $obj->total = $row["total"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Save
    function Save(){
        $db = new db();
        $query = $db->query("INSERT INTO transactions(
            account_id,
            payment_date,
            payment_source,
            total
            )VALUES(
            ?,
            ?,
            ?,
            ?
            )", 
            $this->account_id,
            $this->payment_date,
            $this->payment_source,
            $this->total
        );
        $result = $query->lastInsertID();
        $db->close();
        return $result;
    }
    // Update
    function Update(){
        $db = new db();
        $query = $db->query("UPDATE transactions SET
                account_id = ?,
                payment_date = ?,
                payment_source = ?,
                total = ?
            WHERE transaction_id = ?",
                $this->account_id,
                $this->payment_date,
                $this->payment_source,
                $this->transaction_id
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
    // Save or Delete
    function SaveOrUpdate(){
        $result = null;
        if(isset($this->transaction_id) && $this->transaction_id != null){
            $result = $this->Update();
        }else{
            $result = $this->Save();
        }
        return $result;
    }
    // Delete
    function Delete(){
        $db = new  db();
        $query = $db->query("DELETE FROM transactions WHERE transaction_id = ?", $this->transaction_id);
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
}
?>