<?php
class genresModel{
    // Constructor
    public function __construct(
        public ? int $genre_id = null,
        public ? string $title = null,
    ){}
    // Get All Generes
    function GetAllGeneres(){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `genres` ORDER BY title")->fetchAll();
        foreach($query as $row){
            $obj = new genresModel();
            $obj->genre_id = $row["genre_id"];
            $obj->title = $row["title"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get Genere by Title
    function GetGeneresByTitle($title){
        $result = null;
        $db = new db();
        $query = $db->query("SELECT *
        FROM `genres` AS g
        where g.title = ?", $title)->fetchSingle();
        if(isset($query) && sizeof($query) > 0){
            $result = new genresModel();
            $result->genre_id = $query["genre_id"];
            $result->title = $query["title"];
        }
        $db->close();
        return $result;
    }
    // Save
    function Save(){
        $db = new db();
        $query = $db->query("INSERT INTO genres(
            title
            )VALUES(
            ?
            )", 
            $this->title
        );
        $result = $query->lastInsertID();
        $db->close();
        return $result;
    }
    // Update
    function Update(){
        $db = new db();
        $query = $db->query("UPDATE genres SET
                title = ?
            WHERE genre_id = ?",
                $this->title,
                $this->genre_id
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
    // Save or Delete
    function SaveOrUpdate(){
        $result = null;
        if(isset($this->genre_id) && $this->genre_id != null){
            $result = $this->Update();
        }else{
            $result = $this->Save();
        }
        return $result;
    }
    // Delete
    function Delete(){
        $db = new  db();
        $query = $db->query("DELETE FROM genres WHERE genre_id = ?", $this->genre_id);
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
}
?>