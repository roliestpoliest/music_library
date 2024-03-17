<?php
class eventsModel{
    public function __construct(
        public ? int $event_id = null,
        public ? string $title = null,
        public ? string $description = null,
        public ? string $date = null,
        public ? string $start_time = null,
        public ? string $end_time = null,
        public ? string $region = null,
        public ? int $artist_id = null,
    ){}

    // Get Events by id
    function GetEventsByEventId($event_id){
        $result = null;
        $db = new db();
        $query = $db->query("SELECT *
        FROM `events` as s
        where s.event_id = ?", $event_id)->fetchSingle();
        if(isset($query) && sizeof($query) > 0){
            $result = new eventsModel();
            $result->event_id = $query["event_id"];
            $result->title = $query["title"];
            $result->description = $query["description"];
            $result->date = $query["date"];
            $result->start_time = $query["start_time"];
            $result->end_time = $query["end_time"];
            $result->region = $query["region"];
            $result->artist_id = $query["artist_id"];
        }
        $db->close();
        return $result;
    }
    // Get Events by artist Id
    function GetEventsByArtistId($artist_id){
        $result = null;
        $db = new db();
        $query = $db->query("SELECT *
        FROM `events` as s
        where s.artist_id = ?", $artist_id)->fetchSingle();
        if(isset($query) && sizeof($query) > 0){
            $result = new eventsModel();
            $result->event_id = $query["event_id"];
            $result->title = $query["title"];
            $result->description = $query["description"];
            $result->date = $query["date"];
            $result->start_time = $query["start_time"];
            $result->end_time = $query["end_time"];
            $result->region = $query["region"];
            $result->artist_id = $query["artist_id"];
        }
        $db->close();
        return $result;
    }
    // Get all events
    function GetAllEvents(){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `events` ORDER BY start_time")->fetchAll();
        foreach($query as $row){
            $obj = new eventsModel();
            $obj->event_id = $row["event_id"];
            $obj->title = $row["title"];
            $obj->description = $row["description"];
            $obj->date = $row["date"];
            $obj->start_time = $row["start_time"];
            $obj->end_time = $row["end_time"];
            $obj->region = $row["region"];
            $obj->artist_id = $row["artist_id"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get Events by date
    function GetAllEventsByDate($date){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `events` 
        WHERE date = ?
        ORDER BY date", $date)->fetchAll();
        foreach($query as $row){
            $obj = new eventsModel();
            $obj->event_id = $row["event_id"];
            $obj->title = $row["title"];
            $obj->description = $row["description"];
            $obj->date = $row["date"];
            $obj->start_time = $row["start_time"];
            $obj->end_time = $row["end_time"];
            $obj->region = $row["region"];
            $obj->artist_id = $row["artist_id"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get Events by title
    function GetAllEventsByTitle($title){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `events` 
        WHERE title = ?
        ORDER BY date", $title)->fetchAll();
        foreach($query as $row){
            $obj = new eventsModel();
            $obj->event_id = $row["event_id"];
            $obj->title = $row["title"];
            $obj->description = $row["description"];
            $obj->date = $row["date"];
            $obj->start_time = $row["start_time"];
            $obj->end_time = $row["end_time"];
            $obj->region = $row["region"];
            $obj->artist_id = $row["artist_id"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get Events by region
    function GetAllEventsByRegion($region){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT *
        FROM `events` 
        WHERE region = ?
        ORDER BY date", $region)->fetchAll();
        foreach($query as $row){
            $obj = new eventsModel();
            $obj->event_id = $row["event_id"];
            $obj->title = $row["title"];
            $obj->description = $row["description"];
            $obj->date = $row["date"];
            $obj->start_time = $row["start_time"];
            $obj->end_time = $row["end_time"];
            $obj->region = $row["region"];
            $obj->artist_id = $row["artist_id"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Save
    function Save(){
        $db = new db();
        $query = $db->query("INSERT INTO events(
            title,
            description,
            date,
            start_time,
            end_time,
            region,
            artist_id
            )VALUES(
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?
            )", 
            $this->title,
            $this->description,
            $this->date,
            $this->start_time,
            $this->end_time,
            $this->region,
            $this->artist_id
        );
        $result = $query->lastInsertID();
        $db->close();
        return $result;
    }
    // Update
    function Update(){
        $db = new db();
        $query = $db->query("UPDATE events SET
                title = ?,
                description = ?,
                date = ?,
                start_time = ?,
                end_time = ?,
                region = ?,
                artist_id = ?
            WHERE event_id = ?",
                $this->title,
                $this->description,
                $this->date,
                $this->start_time,
                $this->end_time,
                $this->region,
                $this->artist_id,
                $this->event_id
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
    // Save or Update
    function SaveOrUpdate(){
        $result = null;
        if(isset($this->event_id) && $this->event_id != null){
            $result = $this->Update();
        }else{
            $result = $this->Save();
        }
        return $result;
    }
    // Delete
    function Delete(){
        $db = new  db();
        $query = $db->query("DELETE FROM events WHERE event_id = ?", $this->event_id);
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
}
?>