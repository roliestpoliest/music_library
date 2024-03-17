<?php
// include 'db.php';

class albumsModel{
    //constructor
    public function __construct(
        public ? int $album_id = null,
        public ? string $record_label = null,
        public ? int $artist_id = null,
        public ? string $title = null,
        public ? string $format = null,
        public ? string $release_date = null,
        public ? int $rating = null,
        public ? array $songs = [],
    ){}
    //Get All Albums
    function GetAllAlbums(){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `albums`")->fetchAll();
        foreach($query as $row){
            $obj = new albumsModel();
            $obj->album_id = $row["album_id"];
            $obj->record_label = $row["record_label"];
            $obj->artist_id = $row["artist_id"];
            $obj->title = $row["title"];
            $obj->format = $row["format"];
            $obj->release_date = $row["release_date"];
            $obj->rating = $row["rating"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get Album By Id
    function GetAlbumById($album_id){
        $result = null;
        $db = new db();
        $query = $db->query("SELECT *
        FROM `albums` as a 
        where a.album_id = ?", $album_id)->fetchSingle();
        if(isset($query) && sizeof($query) > 0){
            $result = new albumsModel();
            $result->album_id = $query["album_id"];
            $result->record_label = $query["record_label"];
            $result->artist_id = $query["artist_id"];
            $result->title = $query["title"];
            $result->format = $query["format"];
            $result->release_date = $query["release_date"];
            $result->rating = $query["rating"];
        }
        $db->close();
        return $result;
    }
    // Get Albums By Artist
    function GetAlbumByArtist_id($artist_id){
        $result = null;
        $db = new db();
        $query = $db->query("SELECT *
        FROM `albums` as a 
        where a.artist_id = ?", $artist_id)->fetchSingle();
        if(isset($query) && sizeof($query) > 0){
            $result = new albumsModel();
            $result->album_id = $query["album_id"];
            $result->record_label = $query["record_label"];
            $result->artist_id = $query["artist_id"];
            $result->title = $query["title"];
            $result->format = $query["format"];
            $result->release_date = $query["release_date"];
            $result->rating = $query["rating"];
        }
        $db->close();
        return $result;
    }
    // Get Album by title
    function GetAlbumsByTitle($title){
        $db = new db();
        $result = Array();
        $title = str_replace("'","", $title);
        $q = "SELECT * FROM `albums` as a where a.title like '%".$title."%' ORDER BY a.title";
        $query = $db->query($q)->fetchAll();
        foreach($query as $row){
            $obj = new albumsModel();
            $obj->album_id = $row["album_id"];
            $obj->record_label = $row["record_label"];
            $obj->artist_id = $row["artist_id"];
            $obj->title = $row["title"];
            $obj->format = $row["format"];
            $obj->release_date = $row["release_date"];
            $obj->rating = $row["rating"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get Albums by Record Label
    function GetAlbumsByRecodLabel($record_label){
        $db = new db();
        $result = Array();
        $title = str_replace("'","", $record_label);
        $q = "SELECT * FROM `albums` as a where a.record_label like '%".$record_label."%'";
        $query = $db->query($q)->fetchAll();
        foreach($query as $row){
            $obj = new albumsModel();
            $obj->album_id = $row["album_id"];
            $obj->record_label = $row["record_label"];
            $obj->artist_id = $row["artist_id"];
            $obj->title = $row["title"];
            $obj->format = $row["format"];
            $obj->release_date = $row["release_date"];
            $obj->rating = $row["rating"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get Albums by Format
    function GetAlbumsByFormat($format){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `albums` as a 
        where a.format = ?", $format)->fetchAll();
        foreach($query as $row){
            $obj = new albumsModel();
            $obj->album_id = $row["album_id"];
            $obj->record_label = $row["record_label"];
            $obj->artist_id = $row["artist_id"];
            $obj->title = $row["title"];
            $obj->format = $row["format"];
            $obj->release_date = $row["release_date"];
            $obj->rating = $row["rating"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Save album
    function Save(){
        $db = new db();
        $query = $db->query("INSERT INTO albums(
            record_label,
            artist_id,
            title,
            format,
            release_date,
            rating
            )VALUES(
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?
            )", 
            $this->record_label,
            $this->artist_id,
            $this->title,
            $this->format,
            $this->release_date,
            $this->rating
        );
        $result = $query->lastInsertID();
        $db->close();
        return $result;
    }
    // Update album
    function Update(){
        $db = new db();
        $query = $db->query("UPDATE albums SET
                record_label = ?,
                artist_id = ?,
                title = ?,
                format = ?,
                release_date = ?,
                rating = ?
            WHERE album_id = ?",
                $this->record_label,
                $this->artist_id,
                $this->title,
                $this->format,
                $this->release_date,
                $this->rating,
                $this->album_id
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
    // Save or Update
    function SaveOrUpdate(){
        $result = null;
        if(isset($this->album_id) && $this->album_id != null){
            $result = $this->Update();
        }else{
            $result = $this->Save();
        }
        return $result;
    }
    // Delete Album
    function Delete(){
        $db = new  db();
        $query = $db->query("DELETE FROM albums WHERE album_id = ?", $this->album_id);
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
}
?>