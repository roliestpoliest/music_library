
<?php
class albumRatingModel{
    // Get album rating by user
    function GetAlbumRatingByUser($accountId, $albumId){
        $result = null;
        $db = new db();
        $query = $db->query("SELECT *
        FROM `album_ratings` as r
        where r.account_id = ?
        AND r.album_id = ?", $accountId,$albumId)->fetchSingle();
        if(isset($query) && sizeof($query) > 0){
            $result = $query;
        }
        $db->close();
        return $result;
    }
    // Save
    function Save($accountId, $albumId, $userRating){
        $db = new db();
        $query = $db->query("INSERT INTO album_ratings(
            account_id,
            album_id,
            user_rating
            )VALUES(
            ?,
            ?,
            ?
            )", 
            $accountId,
            $albumId,
            $userRating
        );
        $result = $query->lastInsertID();
        $db->close();
        return $result;
    }
    // Update
    function Update($accountId, $albumId, $userRating){
        $db = new db();
        $result = null;
        $query = $db->query("UPDATE album_ratings SET
                user_rating = ?
            WHERE album_id = ?
            AND account_id = ?",
                $userRating,
                $albumId,
                $accountId
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
    // Save or Update
    function SaveOrUpdate($accountId, $albumId, $userRating){
        $result = null;
        $exist = $this->GetAlbumRatingByUser($accountId, $albumId);
        if(isset($exist) && sizeof($exist) > 0){
            $result = $this->Update($accountId, $albumId, $userRating);
        }else{
            $result = $this->Save($accountId, $albumId, $userRating);
        }
        return $result;
    }
}
?>