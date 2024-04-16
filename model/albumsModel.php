<?php
include_once 'db.php';

class albumsModel{
    //constructor
    public function __construct(
        public ? int $album_id = null,
        public ? string $record_label = null,
        public ? int $artist_id = null,
        public ? string $artist_name = "",
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
        $query = $db->query("SELECT al.*,
		CONCAT(ac.fname, ' ', ac.lname) AS artist_name
        FROM albums AS al
        LEFT JOIN artists AS ar ON al.artist_id = ar.artist_id
        LEFT JOIN accounts AS ac ON ar.account_id = ac.account_id")->fetchAll();
        foreach($query as $row){
            $obj = new albumsModel();
            $obj->album_id = $row["album_id"];
            $obj->record_label = $row["record_label"];
            $obj->artist_id = $row["artist_id"];
            $obj->artist_name = $row["artist_name"];
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
    // Get my Albums
    function GetMyAlbums($userId){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT 
        al.album_id,
        ac.account_id,
        al.record_label,
        al.artist_id,
        al.title,
        al.format,
        al.release_date,
        (SELECT 
            CASE WHEN CEILING(AVG(sr.user_rating)) IS NOT NULL THEN CEILING(AVG(sr.user_rating))
            ELSE 0 END
            FROM album_ratings AS sr
            WHERE sr.album_id = al.album_id) AS general_rating,

            (SELECT sr2.user_rating
            FROM album_ratings AS sr2
            WHERE sr2.album_id = al.album_id AND sr2.account_id = ac.account_id) AS user_rating,


        CASE WHEN al.image_path IS NULL THEN 'defaultAlbumCover.jpg'
        ELSE al.image_path END AS image_path,
                CONCAT(ac.fname, ' ', ac.lname) AS artist_name
                FROM albums AS al
                LEFT JOIN artists AS ar ON al.artist_id = ar.artist_id
                LEFT JOIN accounts AS ac ON ar.account_id = ac.account_id
                WHERE ac.account_id = ?
                ORDER BY al.title", $userId)->fetchAll();
        foreach($query as $row){
            array_push($result, $row);
        }
        $db->close();
        return $result;
    }

    // new releases
    function GetNewReleasedAlbums(){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT 
        al.album_id,
        ac.account_id,
        al.record_label,
        al.artist_id,
        al.title,
        al.format,
        al.release_date,
        (SELECT 
            CASE WHEN CEILING(AVG(sr.user_rating)) IS NOT NULL THEN CEILING(AVG(sr.user_rating))
            ELSE 0 END
            FROM album_ratings AS sr
            WHERE sr.album_id = al.album_id) AS general_rating,
            (SELECT sr2.user_rating
            FROM album_ratings AS sr2
            WHERE sr2.album_id = al.album_id AND sr2.account_id = ac.account_id) AS user_rating,
        CASE WHEN al.image_path IS NULL THEN 'defaultAlbumCover.jpg'
        ELSE al.image_path END AS image_path,
                CONCAT(ac.fname, ' ', ac.lname) AS artist_name
                FROM albums AS al
                LEFT JOIN artists AS ar ON al.artist_id = ar.artist_id
                LEFT JOIN accounts AS ac ON ar.account_id = ac.account_id
                ORDER BY al.release_date DESC
                LIMIT 6")->fetchAll();
        foreach($query as $row){
            array_push($result, $row);
        }
        $db->close();
        return $result;
    }
    // Albums Report
    function GetAlbumsReport(){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT 
        al.album_id,
        ac.account_id,
        al.record_label,
        al.artist_id,
        al.title,
        al.format,
        al.release_date,
        (SELECT COUNT(1) FROM songs_in_album as so WHERE so.album_id = al.album_id) AS songs_in_album,
        
        (SELECT 
            CASE WHEN CEILING(AVG(sr.user_rating)) IS NOT NULL THEN CEILING(AVG(sr.user_rating))
            ELSE 0 END
            FROM album_ratings AS sr
            WHERE sr.album_id = al.album_id) AS general_rating,

            (SELECT sr2.user_rating
            FROM album_ratings AS sr2
            WHERE sr2.album_id = al.album_id AND sr2.account_id = ac.account_id) AS user_rating,


        CASE WHEN al.image_path IS NULL THEN 'defaultAlbumCover.jpg'
        ELSE al.image_path END AS image_path,
                CONCAT(ac.fname, ' ', ac.lname) AS artist_name
                FROM albums AS al
                LEFT JOIN artists AS ar ON al.artist_id = ar.artist_id
                LEFT JOIN accounts AS ac ON ar.account_id = ac.account_id
                ORDER BY al.title")->fetchAll();
        foreach($query as $row){
            array_push($result, $row);
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
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT 
        al.album_id,
        ac.account_id,
        al.record_label,
        al.artist_id,
        al.title,
        al.format,
        al.release_date,
        
        (SELECT 
            CASE WHEN CEILING(AVG(sr.user_rating)) IS NOT NULL THEN CEILING(AVG(sr.user_rating))
            ELSE 0 END
            FROM album_ratings AS sr
            WHERE sr.album_id = al.album_id) AS general_rating,

            (SELECT sr2.user_rating
            FROM album_ratings AS sr2
            WHERE sr2.album_id = al.album_id AND sr2.account_id = ac.account_id) AS user_rating,


        CASE WHEN al.image_path IS NULL THEN 'defaultAlbumCover.jpg'
        ELSE al.image_path END AS image_path,
                CONCAT(ac.fname, ' ', ac.lname) AS artist_name
                FROM albums AS al
                LEFT JOIN artists AS ar ON al.artist_id = ar.artist_id
                LEFT JOIN accounts AS ac ON ar.account_id = ac.account_id
                WHERE al.artist_id = ?
                ORDER BY al.title", $artist_id)->fetchAll();
        foreach($query as $row){
            array_push($result, $row);
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
    // Save album
    function Save(){
        $db = new db();
        $query = $db->query("INSERT INTO albums(
            album_id,
            artist_id,
            title,
            format,
            release_date
            )VALUES(
            ?,
            ?,
            ?,
            ?,
            ?
            )", 
            $this->album_id,
            $this->artist_id,
            $this->title,
            $this->format,
            $this->release_date
        );
        $result = $query->lastInsertID();
        $db->close();
        return $result;
    }
    // Update album
    function Update(){
        $db = new db();
        $query = $db->query("UPDATE albums SET
                artist_id = ?,
                title = ?,
                format = ?,
                release_date = ?
            WHERE album_id = ?",
                $this->artist_id,
                $this->title,
                $this->format,
                $this->release_date,
                $this->album_id
        );
        $result = $query->affectedRows();
        $db->close();
        return $this->album_id;
    }

    function SaveAlbumCoverImage($albumId, $imagePath){
        $db = new db();
        $query = $db->query("UPDATE albums SET
                image_path = ?
            WHERE album_id = ?",
                $imagePath,
                $albumId
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
        $this->DeleteSongsInAlbum();
        $db = new  db();
        $query = $db->query("DELETE FROM albums WHERE album_id = ?", $this->album_id);
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }

    // Delete songs in album
    function DeleteSongsInAlbum(){
        $db = new  db();
        $query = $db->query("DELETE FROM songs_in_album WHERE album_id = ?", $this->album_id);
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
}
?>