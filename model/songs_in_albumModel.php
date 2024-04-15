<?php
class songs_in_albumModel{
  public function __construct(
    public ? int $song_id = null,
    public ? int $album_id = null,
  ){}

  // Get all songs in album
  function GetAllSongsInAlbum(){
    $db = new db();
    $result = Array();
    $query = $db->query("SELECT 
            DISTINCT 
            sia.album_id,
            s.song_id, 
            s.artist_id, 
            CONCAT(ac.fname, ' ', ac.lname) AS ArtistName,
            s.title, 
            s.duration, 
            s.listens, 
            (SELECT 
                CASE WHEN CEILING(AVG(sr.user_rating)) IS NOT NULL THEN CEILING(AVG(sr.user_rating))
                ELSE 0 END
                FROM song_ratings AS sr
                WHERE sr.song_id = s.song_id) AS general_rating,
            (SELECT sr2.user_rating
            FROM song_ratings AS sr2
            WHERE sr2.song_id = s.song_id AND sr2.account_id = ac.account_id) AS user_rating,
            s.genre_id, 
            g.title AS genreName,
            s.audio_path 
            FROM songs_in_album AS sia
            LEFT JOIN songs AS s ON sia.song_id = s.song_id
            LEFT JOIN artists AS a ON s.artist_id = a.artist_id
            LEFT JOIN accounts as ac ON a.account_id = ac.account_id
            LEFT JOIN genres AS g ON s.genre_id = g.genre_id")->fetchAll();
    foreach($query as $row){
      $obj = new songs_in_albumModel();
      $obj->song_id = $row["song_id"];
      $obj->album_id = $row["album_id"];
      array_push($result, $obj);
    }
    $db->close();
    return $query;
  }
  //get songs by album id
  function GetSongsByAlbumId($album_id){
    $db = new db();
    $result = Array();
    $query = $db->query("SELECT 
            DISTINCT 
            sia.album_id,
            s.song_id, 
            s.artist_id, 
            CONCAT(ac.fname, ' ', ac.lname) AS ArtistName,
            s.title, 
            s.duration, 
            s.listens, 
            (SELECT 
                CASE WHEN CEILING(AVG(sr.user_rating)) IS NOT NULL THEN CEILING(AVG(sr.user_rating))
                ELSE 0 END
                FROM song_ratings AS sr
                WHERE sr.song_id = s.song_id) AS general_rating,
            (SELECT sr2.user_rating
            FROM song_ratings AS sr2
            WHERE sr2.song_id = s.song_id AND sr2.account_id = ac.account_id) AS user_rating,
            s.genre_id, 
            g.title AS genreName,
            s.audio_path 
            FROM songs_in_album AS sia
            LEFT JOIN songs AS s ON sia.song_id = s.song_id
            LEFT JOIN artists AS a ON s.artist_id = a.artist_id
            LEFT JOIN accounts as ac ON a.account_id = ac.account_id
            LEFT JOIN genres AS g ON s.genre_id = g.genre_id
            WHERE sia.album_id = ?", $album_id)->fetchAll();
    $db->close();
    return $query;
  }
  // save songs in album
  function Save(){
    $db = new db();
    $query = $db->query("INSERT INTO `songs_in_album` (song_id, album_id)
    VALUES (?, ?)",
    $this->song_id, $this->album_id);
    $result = $query->lastInsertID();
    $db->close();
    return $result;
  }
  // update songs in album
  function Update(){
    $db = new db();
    $query = $db->query("UPDATE `songs_in_album` SET
    song_id = ?,
    album_id = ?
    WHERE song_id = ? AND album_id = ?",
    $this->song_id, $this->album_id, $this->song_id, $this->album_id);
    $db->close();
    return $query->affectedRows();
  }
  //SaveOrUpdate
  function SaveOrUpdate(){
    if(this->album_id == null){
      $result = $this->Save();
    }else{
      $result = $this->Update();
    }
    return $result;
  }
  // delete songs in album
  function Delete(){
    $db = new db();
    $query = $db->query("DELETE FROM `songs_in_album`
    WHERE song_id = ? AND album_id = ?",
    $this->song_id, $this->album_id);
    $db->close();
    return $query->affectedRows();
  }
}
?>