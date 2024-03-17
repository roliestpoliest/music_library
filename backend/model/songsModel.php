<?php
class songsModel{
    // Constructor
    public function __construct(
        public ? int $song_id = null,
        public ? int $artist_id = null,
        public ? string $title = null,
        public ? int $duration = null,
        public ? int $listens = null,
        public ? int $rating = null,
        public ? int $genre_id = null,
    ){}

    // Get all songs
    function GetAllSongs(){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `songs` ORDER BY title")->fetchAll();
        foreach($query as $row){
            $obj = new songsModel();
            $obj->song_id = $row["song_id"];
            $obj->artist_id = $row["artist_id"];
            $obj->title = $row["title"];
            $obj->duration = $row["duration"];
            $obj->listens = $row["listens"];
            $obj->rating = $row["rating"];
            $obj->genre_id = $row["genre_id"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get songs by artist Id
    function GetSongsByArtistId($artist_id){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `songs`
        WHERE artist_id = ? ORDER BY title", $artist_id)->fetchAll();
        foreach($query as $row){
            $obj = new songsModel();
            $obj->song_id = $row["song_id"];
            $obj->artist_id = $row["artist_id"];
            $obj->title = $row["title"];
            $obj->duration = $row["duration"];
            $obj->listens = $row["listens"];
            $obj->rating = $row["rating"];
            $obj->genre_id = $row["genre_id"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get songs by title
    function GetSongsByTitle($title){
        $db = new db();
        $result = Array();
        $title = str_replace("'","", $title);
        $q = "SELECT * FROM `songs` as s where s.title like '%".$title."%' ORDER BY s.title";
        $query = $db->query($q)->fetchAll();
        foreach($query as $row){
            $obj = new songsModel();
            $obj->song_id = $row["song_id"];
            $obj->artist_id = $row["artist_id"];
            $obj->title = $row["title"];
            $obj->duration = $row["duration"];
            $obj->listens = $row["listens"];
            $obj->rating = $row["rating"];
            $obj->genre_id = $row["genre_id"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get songs by rating
    function GetSongsByRating($rating){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `songs`
        WHERE rating = ? ORDER BY title", $rating)->fetchAll();
        foreach($query as $row){
            $obj = new songsModel();
            $obj->song_id = $row["song_id"];
            $obj->artist_id = $row["artist_id"];
            $obj->title = $row["title"];
            $obj->duration = $row["duration"];
            $obj->listens = $row["listens"];
            $obj->rating = $row["rating"];
            $obj->genre_id = $row["genre_id"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get song song Id
    function GetSongsBySongId($song_id){
        $result = null;
        $db = new db();
        $query = $db->query("SELECT *
        FROM `songs` as s
        where s.song_id = ?", $song_id)->fetchSingle();
        if(isset($query) && sizeof($query) > 0){
            $result = new songsModel();
            $result->song_id = $query["song_id"];
            $result->artist_id = $query["artist_id"];
            $result->title = $query["title"];
            $result->duration = $query["duration"];
            $result->listens = $query["listens"];
            $result->rating = $query["rating"];
            $result->genre_id = $query["genre_id"];
        }
        $db->close();
        return $result;
    }
    // Save
    function Save(){
        $db = new db();
        $query = $db->query("INSERT INTO songs(
            artist_id,
            title,
            duration,
            listens,
            rating,
            genre_id
            )VALUES(
            ?,
            ?,
            ?,
            ?,
            ?,
            ?
            )", 
            $this->artist_id,
            $this->title,
            $this->duration,
            $this->listens,
            $this->rating,
            $this->genre_id
        );
        $result = $query->lastInsertID();
        $db->close();
        return $result;
    }
    // Update
    function Update(){
        $db = new db();
        $query = $db->query("UPDATE songs SET
                artist_id = ?,
                title = ?,
                duration = ?,
                listens = ?,
                rating = ?,
                genre_id = ?
            WHERE song_id = ?",
                $this->artist_id,
                $this->title,
                $this->duration,
                $this->listens,
                $this->rating,
                $this->genre_id,
                $this->song_id
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
    // Save or Delete
    function SaveOrUpdate(){
        $result = null;
        if(isset($this->song_id) && $this->song_id != null){
            $result = $this->Update();
        }else{
            $result = $this->Save();
        }
        return $result;
    }
    // Delete
    function Delete(){
        $db = new  db();
        $query = $db->query("DELETE FROM songs WHERE song_id = ?", $this->song_id);
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
}
?>