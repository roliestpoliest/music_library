<?php
include_once 'db.php';
include 'songsModel.php';

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
        public ? string $image_path = null
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
            $obj->image_path = $row["image_path"];
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
            $result->image_path = $query["image_path"];
        }
        $db->close();
        return $result;
    }
    // Get Album by title
    function GetAlbumsByTitle($title){
        $db = new db();
        $result = Array();
        $title = str_replace("'","", $title);
        $q = "SELECT * FROM `albums` as a where a.title_album like '%".$title."%' ORDER BY a.title";
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
            $obj->image_path = $row["image_path"];
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
            $obj->image_path = $row["image_path"];
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
            $obj->image_path = $row["image_path"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get all songs in album
    function GetSongsInAlbum($album_id){
        $result = [];
        $db = new db();
        $query = $db->query("
        SELECT a.album_id, a.record_label, a.title, a.format, a.release_date, a.release_date, a.rating, a.image_path, s.song_id, s.title, s.duration, s.listens, s.rating, s.genre_id, s.audio_path
        FROM albums as a, songs as s, songs_in_album as sa
        WHERE a.album_id = sa.album_id AND s.song_id = sa.song_id;")->fetchAll();
        foreach($query as $row){
            $songList = [];
            $albumInfo = array(
                "album_id" => $row["album_id"],
                "record_label" => $row["record_label"],
                "title" => $row["title"],
                "format" => $row["format"],
                "release_date" => $row["release_date"],
                "rating" => $row["rating"],
                "image_path" => $row["image_path"],
                "song_id" =>$row["song_id"],
                "title" => $row["title"],
                "duration" => $row["duration"],
                "listens" => $row["listens"],
                "rating" => $row["rating"],
                "genre_id" => $row["genre_id"],
                "audio_path" => $row["audio_path"],
            );
            array_push($result, $albumInfo);
        }
        $db->close();
        return $result;
    }

    // Save album
    function Save(){
        $db = new db();
        $query = $db->query("INSERT INTO albums(
            album_id,
            record_label,
            artist_id,
            title,
            format,
            release_date,
            rating,
            image_path
            )VALUES(
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?
            )", 
            $this->album_id,
            $this->record_label,
            $this->artist_id,
            $this->title,
            $this->format,
            $this->release_date,
            $this->rating,
            $this->image_path
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
                title_album = ?,
                format = ?,
                release_date = ?,
                rating = ?,
                image_path = ?
            WHERE album_id = ?",
                $this->record_label,
                $this->artist_id,
                $this->title,
                $this->format,
                $this->release_date,
                $this->rating,
                $this->album_id,
                $this->image_path
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