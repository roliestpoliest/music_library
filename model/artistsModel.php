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
        $query = $db->query("SELECT `artist_id`,
        ac.account_id,
        ac.bio,
        ar.followers,
        CASE WHEN ac.image_path IS NULL THEN 'defaultImage.jpg'
        ELSE ac.image_path END AS image_path,
        CONCAT(ac.fname, ' ', ac.lname) AS artist_name,
        (SELECT COUNT(1) FROM songs AS so WHERE so.artist_id = ar.artist_id) AS number_of_songs,
        (SELECT COUNT(1) FROM albums AS al WHERE al.artist_id = ar.artist_id) AS number_of_albums,
        (SELECT al2.release_date FROM albums AS al2 WHERE al2.artist_id = ar.artist_id ORDER BY al2.release_date DESC LIMIT 1 ) AS latest_album_release,
        (SELECT al3.title FROM albums AS al3 WHERE al3.artist_id = ar.artist_id ORDER BY al3.release_date DESC LIMIT 1 ) AS latest_album_title
                FROM `artists` AS ar
                LEFT JOIN accounts AS ac ON ar.account_id = ac.account_id
                ORDER BY artist_name;")->fetchAll();
        foreach($query as $row){
            // $obj = new artistsModel();
            // $obj->artist_id = $row["artist_id"];
            // $obj->account_id = $row["account_id"];
            array_push($result, $row);
        }
        $db->close();
        return $result;
    }
    // Get All ID and Artist Names
    function GetAllArtistNames() {
        $db = new db();
        $result = array();
        $query = $db->query("
            SELECT artists.`artist_id`, accounts.`fname`, accounts.`lname`
            FROM accounts, artists
            WHERE accounts.`account_id` = artists.`account_id`
            ORDER BY accounts.`fname`, accounts.`lname`")->fetchAll();
        
        foreach ($query as $row) {
            $artistInfo = array(
                "artist_id" => $row["artist_id"],
                // "account_id" => $row["account_id"],
                "fname" => $row["fname"],
                "lname" => $row["lname"],
            );
            array_push($result, $artistInfo);
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
    function GetArtistId($account_id){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `artists` 
        WHERE account_id = ?
        ORDER BY account_id", $account_id)->fetchSingle();
        $result = $query["artist_id"];
        // foreach($query as $row){
        //     $obj = new artistsModel();
        //     $obj->artist_id = $row["artist_id"];
        //     array_push($result, $obj);
        // }
        $db->close();
        return $result;
    }
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