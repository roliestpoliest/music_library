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
        $query = $db->query("SELECT *
        FROM `playlists` ORDER BY title")->fetchAll();
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
    function GetPlaylistByPlaylistId($song_id){
        $result = null;
        $db = new db();
        $query = $db->query("SELECT *
        FROM `playlists` as p
        where p.playlist_id = ?", $song_id)->fetchSingle();
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
    // Get all songs in playlist
    function GetSongsInPlaylist($playlist_id){
        $result = [];
        $db = new db();
        $query = $db->query("
        SELECT p.playlist_id, p.account_id, p.title as playlist_title, p.image_path, s.song_id, s.artist_id, s.title as song_title, s.duration, s.listens, s.rating, s.genre_id, s.audio_path 
        FROM songs_in_playlist as sp, songs as s, playlists as p 
        WHERE sp.song_id = s.song_id AND sp.playlist_id = p.playlist_id")->fetchAll();
        foreach($query as $row){
            $playlistInfo = array(
                "playlist_id" => $row["playlist_id"],
                "account_id" => $row["account_id"],
                "playlist_title" => $row["playlist_title"],
                "image_path" => $row["image_path"],
                "song_id" => $row["song_id"],
                "artist_id" => $row["artist_id"],
                "song_title" => $row["song_title"],
                "duration" => $row["duration"],
                "listens" => $row["listens"],
                "rating" => $row["rating"],
                "genre_id" => $row["genre_id"],
                "audio_path" => $row["audio_path"],
            );
            array_push($result, $playlistInfo);
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
                title = ?,
                image_path = ?
            WHERE playlist_id = ?",
                $this->account_id,
                $this->title,
                $this->image_path,
                $this->playlist_id
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
    // Save or Delete
    function SaveOrUpdate(){
        $result = null;
        if(isset($this->playlist_id) && $this->playlist_id != null){
            $result = $this->Update();
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