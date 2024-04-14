<?php
class albumReportsModel{
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
        public ? string $ArtistName = null,
        //public ? string $image_path = null
    ){}
    function GetAlbumsByFormData($formData)
        {
            $result = array();
            $db = new db();
            //$query = 'SELECT * FROM `songs` WHERE ';
            $query = 'SELECT DISTINCT al.title, al.artist_id, al.album_id, al.record_label, al.format, al.release_date,al.rating,
            CONCAT(ac.fname, " ", ac.lname) AS ArtistName 
            FROM `albums` AS al 
            LEFT JOIN `artists` AS a ON al.artist_id = a.artist_id 
            LEFT JOIN `accounts` AS ac ON a.account_id = ac.account_id 
            WHERE ';
            $conditions = array();
            foreach ($formData as $key => $value) {
                $conditions[] = "al.$key = ?";
            }
            $query .= implode(' AND ', $conditions);
            // Execute the query
            //echo "SQL Query: $query";
            $songData = $db->query($query, ...array_values($formData))->fetchAll();
            if (isset($songData)) {
                $result = array();
                foreach ($songData as $key => $value) {
                    $result[$key] = $value;
                //echo "$result[$key]";
                }
            } 
            $db->close();
            //return $query;
            return $result;
        }
    function getAllAlbumsInfo()
    {
            $db = new db();
            $result = Array();
           /* $query = $db->query("SELECT *
            FROM `songs` ORDER BY title")->fetchAll(); */
            $query = 'SELECT DISTINCT al.title, al.artist_id, al.album_id, al.record_label, al.format, al.release_date,al.rating,
            CONCAT(ac.fname, " ", ac.lname) AS ArtistName
            FROM `albums` AS al 
            LEFT JOIN `artists` AS a ON al.artist_id = a.artist_id 
            LEFT JOIN `accounts` AS ac ON a.account_id = ac.account_id 
            ORDER BY title';
            $queryResult = $db->query($query)->fetchAll();
            foreach($queryResult as $row)
            {
                $obj = new albumReportsModel();
                $obj->album_id = $row["album_id"];
                $obj->artist_id = $row["artist_id"];
                $obj->title = $row["title"];
                $obj->record_label = $row["record_label"];
                $obj->format = $row["format"];
                $obj->rating = $row["rating"];
                $obj->release_date = $row["release_date"];
                $obj->ArtistName = $row["ArtistName"];
                //$obj->audio_path = $row["audio_path"];
                array_push($result, $obj);
            }
                $db->close();
                return $result;
    } 
    
    



}


?>