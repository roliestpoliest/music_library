<?php
class artistsModel{
    public function __construct(
        public ? int $artist_id = null,
        public ? int $account_id = null,
    ){}
    // Get All Artits
    function GetAllArtist(){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `artists` ORDER BY account_id")->fetchAll();
        foreach($query as $row){
            $obj = new artistsModel();
            $obj->artist_id = $row["artist_id"];
            $obj->account_id = $row["account_id"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get Artist By Artist Id
    function GetArtistByArtistId($artist_id){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `artists` 
        WHERE artist_id = ?
        ORDER BY account_id", $artist_id)->fetchSingle();
        foreach($query as $row){
            $obj = new artistsModel();
            $obj->artist_id = $row["artist_id"];
            $obj->account_id = $row["account_id"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get Artist By Account Id
    function GetArtistByAcountId($account_id){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `artists` 
        WHERE account_id = ?
        ORDER BY account_id", $account_id)->fetchSingle();
        foreach($query as $row){
            $obj = new artistsModel();
            $obj->artist_id = $row["artist_id"];
            $obj->account_id = $row["account_id"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Assign User as Artist
    // Unassign User as Artist
    // Save
    function Save(){
        $db = new db();
        $query = $db->query("INSERT INTO artists(
            account_id
            )VALUES(
            ?
            )", 
            $this->account_id
        );
        $result = $query->lastInsertID();
        $db->close();
        return $result;
    }
    // Update
    function Update(){
        $db = new db();
        $query = $db->query("UPDATE artists SET
                account_id = ?
            WHERE artist_id = ?",
                $this->account_id,
                $this->artist_id
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
    // Delete
    function Delete(){
        $db = new  db();
        $query = $db->query("DELETE FROM artists WHERE artist_id = ?", $this->artist_id);
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
}
?>