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
        public ? string $audio_path = null,
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
            $obj->audio_path = $row["audio_path"];
            array_push($result, $obj);
        }
        $db->close();
        return $result;
    }
    // Get songs by artist Id
    function GetSongsByArtistId($accountId){
        $result = [];
        $db = new db();
        $query = $db->query("SELECT 
        DISTINCT 
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
        WHERE sr2.song_id = s.song_id AND sr2.account_id = ?) AS user_rating,
        s.genre_id, 
        g.title AS genreName,
        s.audio_path 
        FROM songs AS s 
        LEFT JOIN artists AS a ON s.artist_id = a.artist_id
        LEFT JOIN accounts as ac ON a.account_id = ac.account_id
        LEFT JOIN genres AS g ON s.genre_id = g.genre_id
        WHERE ac.account_id = ?", $accountId, $accountId)->fetchAll();
        
        $result = $query;
        foreach($result as $row){
            if(!file_exists("../uploads/".$row["audio_path"])){
                $row["audio_path"] = "foo.mp3";
            }
        }
        // print_r($result);
        $db->close();
        return $result;
    }

    // Songs Report
    function GetSongsReport(){
        $result = [];
        $db = new db();
        $query = $db->query("SELECT 
        s.song_id,
        s.artist_id,
        CONCAT(ac.fname, ' ', ac.lname) AS artist_name,
        s.title,
        s.listens,
        s.release_date,
        (SELECT 
                    CASE WHEN CEILING(AVG(sr.user_rating)) IS NOT NULL THEN CEILING(AVG(sr.user_rating))
                    ELSE 0 END
                    FROM song_ratings AS sr
                    WHERE sr.song_id = s.song_id) AS general_rating,
        s.genre_id,
        (SELECT COUNT(1) FROM songs_in_album as sia WHERE sia.song_id = s.song_id ) AS number_of_albums,
        (SELECT COUNT(1) FROM songs_in_playlist AS sip WHERE sip.song_id = s.song_id ) AS number_of_playlist,
        g.title AS genre
        FROM `songs` AS s
        LEFT JOIN genres AS g ON s.genre_id = g.genre_id
        LEFT JOIN artists AS ar ON s.artist_id = ar.artist_id
        LEFT JOIN accounts AS ac ON ar.account_id = ac.account_id;")->fetchAll();
        $db->close();
        return $query;
    }

    // Get All Songs ID and titles
    function GetAllSongTitles() {
        $db = new db();
        $result = array();
        $query = $db->query("
            SELECT songs.`song_id`, songs.`title`
            FROM songs
            ORDER BY songs.`title`")->fetchAll();
        
        foreach ($query as $row) {
            $songInfo = array(
                "song_id" => $row["song_id"],
                "title" => $row["title"],
            );
            array_push($result, $songInfo);
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
            $obj->audio_path = $row["audio_path"];
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
            $obj->audio_path = $row["audio_path"];
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
            $result->audio_path = $query["audio_path"];
        }
        $db->close();
        return $result;
    }
    // Search Song
    function searchSong($searchTerm, $userId){
        $result = [];
        $db = new db();
        $query = $db->query("SELECT 
        DISTINCT 
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
        WHERE sr2.song_id = s.song_id AND sr2.account_id = ?) AS user_rating,
        s.genre_id, 
        g.title AS genreName,
        s.audio_path 
        FROM songs AS s 
        LEFT JOIN artists AS a ON s.artist_id = a.artist_id
        LEFT JOIN accounts as ac ON a.account_id = ac.account_id
        LEFT JOIN genres AS g ON s.genre_id = g.genre_id
        WHERE s.title like '%".$searchTerm."%'"." OR ac.fname like '%".$searchTerm."%' ".
        " OR ac.lname like '%".$searchTerm."%' ".
        " OR g.title like '%".$searchTerm."%' ".
        " ORDER BY s.title", $userId)->fetchAll();
        
        $result = $query;
        foreach($result as $row){
            if(!file_exists("../uploads/".$row["audio_path"])){
                $row["audio_path"] = "foo.mp3";
            }
        }
        // print_r($result);
        $db->close();
        return $result;
    }
    // Get songs in playlist
    function GetSongsInPlaylist($playlist_id, $userId){
        $result = [];
        $db = new db();
        $query = $db->query("SELECT 
        DISTINCT 
        sp.playlist_id, 
        p.title AS PlaylistName, 
        p.image_path, 
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
        WHERE sr2.song_id = s.song_id AND sr2.account_id = ?) AS user_rating,
        s.genre_id, 
        g.title AS genreName,
        s.audio_path 
        FROM songs_in_playlist AS sp 
        LEFT JOIN playlists AS p ON sp.playlist_id = p.playlist_id 
        LEFT JOIN songs AS s ON s.song_id = sp.song_id 
        LEFT JOIN artists AS a ON s.artist_id = a.artist_id
        LEFT JOIN accounts as ac ON a.account_id = ac.account_id
        LEFT JOIN genres AS g ON s.genre_id = g.genre_id
        WHERE sp.playlist_id = ?
        ORDER BY s.title", $userId, $playlist_id)->fetchAll();
        
        $result = $query;
        foreach($result as $row){
            if(!file_exists("../uploads/".$row["audio_path"])){
                $row["audio_path"] = "foo.mp3";
            }
        }
        $db->close();
        return $result;
    }
    // 
    function GetRecentSongs(){
        $result = [];
        $db = new db();
        $query = $db->query("SELECT 
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
        s.genre_id, 
        g.title AS genreName,
        s.audio_path 
        FROM songs AS s
        LEFT JOIN artists AS a ON s.artist_id = a.artist_id
        LEFT JOIN accounts as ac ON a.account_id = ac.account_id
        LEFT JOIN genres AS g ON s.genre_id = g.genre_id
        ORDER BY s.release_date DESC
        LIMIT 5")->fetchAll();
        $result = $query;
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
        return $this->song_id;
    }
    // SaveAudioPath
    function SaveAudioPath($songId, $filePath){
        $db = new db();
        $query = $db->query("UPDATE songs SET
                audio_path = ?
            WHERE song_id = ?",
                $filePath,
                $songId
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
    // Increase play count
    function IncreasePlayCount($songId, $accountId){
        $db = new db();
        $query = $db->query("INSERT INTO song_play_count(
                song_id,
                account_id)
                VALUES(?,?);",
                $songId,
                $accountId
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
    // Save or Delete
    function SaveOrUpdate(){
        $result = null;
        echo($this->song_id);
        if(isset($this->song_id) && $this->song_id != null){
            print_r("update");
            $result = $this->Update();
        }else{
            print_r("save");
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