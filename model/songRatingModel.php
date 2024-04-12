
<?php
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