<?php
    class songReportsModel{
        // Constructor
        public function __construct(
            public ? int $song_id = null,
            public ? int $artist_id = null,
            public ? string $title = null,
            public ? int $duration = null,
            public ? int $listens = null,
            public ? int $rating = null,
            public ? int $genre_id = null,
            public ? string $audio_path = null,
            public ? string $ArtistName = null,
            public ? string $genreTitle = null,
        ){}

        function GetSongsByFormData($formData)
        {
            $result = array();
            $db = new db();
            //$query = 'SELECT * FROM `songs` WHERE ';
            $query = 'SELECT DISTINCT s.title, s.artist_id, s.song_id, s.genre_id, s.duration, s.listens,s.rating,
            CONCAT(ac.fname, " ", ac.lname) AS ArtistName, g.title AS genreTitle 
            FROM `songs` AS s 
            LEFT JOIN `artists` AS a ON s.artist_id = a.artist_id 
            LEFT JOIN `accounts` AS ac ON a.account_id = ac.account_id 
            LEFT JOIN genres AS g ON s.genre_id = g.genre_id
            WHERE ';
            $conditions = array();
            foreach ($formData as $key => $value) {
                $conditions[] = "s.$key = ?";
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
        function getAllSongsInfo(){
            $db = new db();
            $result = Array();
           /* $query = $db->query("SELECT *
            FROM `songs` ORDER BY title")->fetchAll(); */
            $query = 'SELECT DISTINCT s.title, s.artist_id, s.song_id, s.genre_id, s.duration, s.listens,s.rating,
            CONCAT(ac.fname, " ", ac.lname) AS ArtistName, g.title AS genreTitle
            FROM `songs` AS s 
            LEFT JOIN `artists` AS a ON s.artist_id = a.artist_id 
            LEFT JOIN `accounts` AS ac ON a.account_id = ac.account_id 
            LEFT JOIN genres AS g ON s.genre_id = g.genre_id
            ORDER BY title';
            $queryResult = $db->query($query)->fetchAll();
            foreach($queryResult as $row)
            {
                $obj = new songReportsModel();
                $obj->song_id = $row["song_id"];
                $obj->artist_id = $row["artist_id"];
                $obj->title = $row["title"];
                $obj->duration = $row["duration"];
                $obj->listens = $row["listens"];
                $obj->rating = $row["rating"];
                $obj->genre_id = $row["genre_id"];
                $obj->ArtistName = $row["ArtistName"];
                $obj->genreTitle = $row["genreTitle"];
                //$obj->audio_path = $row["audio_path"];
                array_push($result, $obj);
            }
                $db->close();
                return $result;
        }

    }

?>