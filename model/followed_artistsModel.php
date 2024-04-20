<?php
class followed_artistsModels{
    // Constructor
    public function __construct(
        public ? int $account_id = null,
        public ? int $artist_id = null,
    ){}

    // Get All Followed
    function GetAllFollowed(){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `followed_artists` ORDER BY account_id")->fetchAll();
        foreach($query as $row){
            $obj = new songsModel();
            $obj->account_id = $row["account_id"];
            $obj->artist_id = $row["artist_id"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }

    // Is following
    function IsFollowing($artistId, $accountId){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT 
        CASE WHEN count(1) = 0 THEN FALSE ELSE TRUE END as following
        FROM followed_artists
        WHERE artist_id = ?
        AND account_id = ?;", $artistId, $accountId)->fetchSingle();
        
        $db->close();
        return $query["following"];
    }
    // Get Artists Followed by Account Id
    function GetArtistFollowedByAccountId($account_id){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `followed_artists` 
        WHERE account_id = ?
        ORDER BY account_id", $account_id)->fetchAll();
        foreach($query as $row){
            $obj = new songsModel();
            $obj->account_id = $row["account_id"];
            $obj->artist_id = $row["artist_id"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get Accounts Following Artist
    function GetAccountstFollowingArtistId($artist_id){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT DISTINCT account_id
        FROM `followed_artists` 
        WHERE account_id = ?
        ORDER BY artist_id", $account_id)->fetchAll();
        foreach($query as $row){
            $obj = new songsModel();
            $obj->account_id = $row["account_id"];
            $obj->artist_id = $row["artist_id"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Save
    function Save(){
        $db = new db();
        $query = $db->query("INSERT INTO followed_artists(
            artist_id,
            account_id
            )VALUES(
            ?,
            ?
            )", 
            $this->artist_id,
            $this->account_id
        );
        $result = $query->lastInsertID();

        $db->close();
        return $result;
    }
    // Delete
    function Delete($artistId, $accountId){
        $db = new  db();
        $query = $db->query("DELETE FROM followed_artists 
        WHERE artist_id = ? AND account_id = ?", 
        $artistId, $accountId);
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
}
?>