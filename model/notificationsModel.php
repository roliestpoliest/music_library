<?php
include_once 'db.php';

class notificationsModel{
    // Constructor
    public function __construct(
        public ? int $notification_id = null,
        public ? int $account_id = null,
        public ? string $date_created = null,
        public ? string $message = null,
        public ? int $has_been_seen = null,
    ){}

    // Get notification
    function GetNotificationsByAccountId($accountId){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `notifications` 
        WHERE account_id = ?
        AND has_been_seen = 0
        ORDER BY date_created DESC", $accountId)->fetchAll();
        // print_r($query);
        $db->close();
        $this->MarkkNotificationAsRead($accountId);
        return $query;
    }

    //save new notification
    function SaveNotificationsByAccountId($accountId, $message){
        $db = new db();
        $result = Array();
        $query = $db->query("INSERT INTO notifications
        ($account_id, $message)
        VALUES
        (?,?)", $accountId, $message)->affectedRows();
        $db->close();
        return $query;
    }

    // mark notification as read
    function MarkkNotificationAsRead($accountId){
        $db = new db();
        $result = Array();
        $query = $db->query("UPDATE notifications SET
        has_been_seen = 1
        WHERE account_id = ?", $accountId)->affectedRows();
        $db->close();
        return $query;
    }
}
?>