<?php
include_once 'db.php';

class notificationsModel{
    // Constructor
    public function __construct(
        public ? int $notification_id = null,
        public ? int $account_id,
        public ? string $date_created,
        public ? string $message,
        public ? int $has_been_seen,
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
        $db->close();
        return $query;
    }

    //save new notification
    function GetNotificationsByAccountId($accountId, $message){
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
    function MarkNotificationAsRead($notificationId){
        $db = new db();
        $result = Array();
        $query = $db->query("UPDATE notifications SET
        notificationId = ?", $notificationId)->affectedRows();
        $db->close();
        return $query;
    }
}
?>