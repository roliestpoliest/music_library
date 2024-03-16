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
    function GetAlbumByArtist_id($artist_id){}
    // Get Album by title
    function GetAlbumsByTitle($title){}
    // Get Albums by Record Label
    // Save album
    // Update album
    // 
}
?>