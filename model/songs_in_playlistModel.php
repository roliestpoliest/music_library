<?php
include_once 'db.php';

class songs_in_playlistModel{
    // Constructor
    public function __construct(
        public ? int $song_id = null,
        public ? int $playlist_id = null,
    ){}
    // Get All Songs in Playlist
    function GetAllSongsInPlaylist(){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `songs_in_playlist` ORDER BY song_id")->fetchAll();
        foreach($query as $row){
            $obj = new songs_in_playlistModel();
            $obj->song_id = $row["song_id"];
            $obj->playlist_id = $row["playlist_id"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Save
    function Save(){
        $db = new db();
        $query = $db->query("INSERT INTO songs_in_playlist(
            song_id,
            playlist_id
            )VALUES(
            ?,
            ?
            )", 
            $this->song_id,
            $this->playlist_id
        );
        $result = $query->lastInsertID();
        $db->close();
        return $result;
    }
    // Update
    function Update(){
        $db = new db();
        $query = $db->query("UPDATE songs_in_playlist SET
            song_id = ?,
            playlist_id = ?
            WHERE song_id = ? AND playlist_id = ?",
            $this->song_id,
            $this->playlist_id,
            $this->song_id,
            $this->playlist_id
        );
        $result = $query->rowCount();
        $db->close();
        return $result;
    }
    // Delete
    function Delete(){
        $db = new db();
        $query = $db->query("DELETE FROM songs_in_playlist
            WHERE song_id = ?
            AND playlist_id = ?",
            $this->song_id,
            $this->playlist_id
        );
        $result = $query->rowCount();
        $db->close();
        return $result;
    }
}


?>