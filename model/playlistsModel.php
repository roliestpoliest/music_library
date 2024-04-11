<?php
class playlistModels{
    // Constructor
    public function __construct(
        public ? int $playlist_id = null,
        public ? int $account_id = null,
        public ? string $title = null,
        public ? string $image_path = null,

    ){}
    // Get all playlists
    function GetAllPlaylists(){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT playlist_id,
        account_id,
        title,
        CASE WHEN image_path IS NULL THEN 'defaultImage.jpg'
        ELSE image_path END AS image_path
            FROM `playlists` 
            ORDER BY title")->fetchAll();
        foreach($query as $row){
            $obj = new playlistModels();
            $obj->playlist_id = $row["playlist_id"];
            $obj->account_id = $row["account_id"];
            $obj->title = $row["title"];
            $obj->image_path = $row["image_path"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get playlist by id
    function GetPlaylistByPlaylistId($playlist_id){
        $result = null;
        $db = new db();
        $query = $db->query("SELECT *
        FROM `playlists` as p
        where p.playlist_id = ?", $playlist_id)->fetchSingle();
        if(isset($query) && sizeof($query) > 0){
            $result = new playlistModels();
            $result->playlist_id = $query["playlist_id"];
            $result->account_id = $query["account_id"];
            $result->title = $query["title"];
            $result->image_path = $query["image_path"];
        }
        $db->close();
        return $result;
    }
    // Get playlist by account
    function GetAllPlaylistsByAccountId($account_id){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `playlists` 
        WHERE account_id = ?
        ORDER BY title", $account_id)->fetchAll();
        foreach($query as $row){
            $obj = new playlistModels();
            $obj->playlist_id = $row["playlist_id"];
            $obj->account_id = $row["account_id"];
            $obj->title = $row["title"];
            $obj->image_path = $row["image_path"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Search playlist by title
    function GetSongsByTitle($title){
        $db = new db();
        $result = Array();
        $title = str_replace("'","", $title);
        $q = "SELECT * FROM `playlists` AS p 
        WHERE p.title LIKE '%".$title."%' ORDER BY p.title";
        $query = $db->query($q)->fetchAll();
        foreach($query as $row){
            $obj = new playlistModels();
            $obj->playlist_id = $row["playlist_id"];
            $obj->account_id = $row["account_id"];
            $obj->title = $row["title"];
            $obj->image_path = $row["image_path"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Save
    function Save(){
        $db = new db();
        $query = $db->query("INSERT INTO playlists(
            account_id,
            title,
            image_path
            )VALUES(
            ?,
            ?,
            ?
            )", 
            $this->account_id,
            $this->title,
            $this->image_path
        );
        $result = $query->lastInsertID();
        $db->close();
        return $result;
    }
    // Update
    function Update(){
        $db = new db();
        $query = $db->query("UPDATE playlists SET
                account_id = ?,
                title = ?
            WHERE playlist_id = ?",
                $this->account_id,
                $this->title,
                $this->playlist_id
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
    // Save Playlist Image
    function SavePlaylistImage($imagePath, $playlistId){
        $db = new db();
        $query = $db->query("UPDATE playlists SET
                image_path = ?
            WHERE playlist_id = ?",
                $imagePath,
                $playlistId
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
    // Save or Delete
    function SaveOrUpdate(){
        $result = null;
        if(isset($this->playlist_id) && $this->playlist_id != null){
            $result = $this->playlist_id;
            $this->Update();
        }else{
            $result = $this->Save();
        }
        return $result;
    }
    // Delete
    function Delete(){
        $db = new  db();
        $query = $db->query("DELETE FROM playlists WHERE playlist_id = ?", $this->playlist_id);
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
}
?>