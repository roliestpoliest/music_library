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
    $query = $db->query("SELECT *
    FROM `songs_in_album` ORDER BY song_id")->fetchAll();
    foreach($query as $row){
      $obj = new songs_in_albumModel();
      $obj->song_id = $row["song_id"];
      $obj->album_id = $row["album_id"];
      array_push($result, $obj);
    }
    $db->close();
    return $result;
  }
  //get songs by album id
  function GetSongsByAlbumId($album_id){
    $db = new db();
    $result = Array();
    $query = $db->query("SELECT *
    FROM `songs_in_album`
    WHERE album_id = ? ORDER BY song_id", $album_id)->fetchAll();
    foreach($query as $row){
      $obj = new songs_in_albumModel();
      $obj->song_id = $row["song_id"];
      $obj->album_id = $row["album_id"];
      array_push($result, $obj);
    }
    $db->close();
    return $result;
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