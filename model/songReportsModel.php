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
        ){}

        function GetSongsByFormData($formData)
        {
            $result = array();
            $db = new db();
            $query = 'SELECT * FROM `songs` WHERE ';
            $conditions = array();
            foreach ($formData as $key => $value) {
                $conditions[] = "$key = ?";
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

    }

?>