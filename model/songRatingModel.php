
<?php
// CREATE TABLE song_ratings(
//     account_id INT NOT NULL,
//     song_id INT NOT NULL,
//     user_rating INT NOT NULL
// );

class songRatingModel{
    // Get song rating by user
    function GetSongRatingByUser($accountId, $songId){
        $result = null;
        $db = new db();
        $query = $db->query("SELECT *
        FROM `song_ratings` as r
        where r.account_id = ?
        AND r.song_id = ?", $accountId,$songId)->fetchSingle();
        if(isset($query) && sizeof($query) > 0){
            $result = $query;
        }
        // if(isset($query) && sizeof($query) > 0){
        //     $result = new songsModel();
        //     $result->song_id = $query["song_id"];
        //     $result->artist_id = $query["artist_id"];
        //     $result->title = $query["title"];
        //     $result->duration = $query["duration"];
        //     $result->listens = $query["listens"];
        //     $result->rating = $query["rating"];
        //     $result->genre_id = $query["genre_id"];
        //     $result->audio_path = $query["audio_path"];
        // }
        $db->close();
        return $result;
    }
    // Save
    function Save($accountId, $songId, $userRating){
        $db = new db();
        $query = $db->query("INSERT INTO song_ratings(
            account_id,
            song_id,
            user_rating
            )VALUES(
            ?,
            ?,
            ?
            )", 
            $accountId,
            $songId,
            $userRating
        );
        $result = $query->lastInsertID();
        $db->close();
        return $result;
    }
    // Update
    function Update($accountId, $songId, $userRating){
        $db = new db();
        $result = null;
        $query = $db->query("UPDATE song_ratings SET
                user_rating = ?
            WHERE song_id = ?
            AND account_id = ?",
                $userRating,
                $songId,
                $accountId
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
    // Save or Update
    function SaveOrUpdate($accountId, $songId, $userRating){
        $result = null;
        $exist = $this->GetSongRatingByUser($accountId, $songId);
        if(isset($exist) && sizeof($exist) > 0){
            $result = $this->Update($accountId, $songId, $userRating);
        }else{
            $result = $this->Save($accountId, $songId, $userRating);
        }
        return $result;
    }
}
?>