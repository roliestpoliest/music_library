<?php
include_once 'db.php';
include_once 'validationModel.php';

class accountsModel{
    // Constructor
    public function __construct(
        public ? int $account_id = null,
        public ? string $user_role = null,
        public ? string $fname = null,
        public ? string $lname = null,
        public ? string $username = null,
        public ? string $bio = null,
        public ? string $gender = null,
        public ? string $DOB = null,
        public ? string $region = null,
        public ? string $email = null,
        public ? string $password = null,
        public ? string $image_path = null,
        public ? int $new_notifications = null,
        private ? int $artist_id = null,
        private ? int $admin_id = null,
    ) {}
    // Get by id
    function GetAccountById($id){
        $db = new db();
        $query = $db->query("SELECT a.account_id, a.user_role, a.fname, a.lname, a.username, a.bio, a.gender, a.DOB, a.region, a.email, a.password, a.new_notifications, 
        CASE WHEN a.image_path IS NULL THEN 'defaultImage.jpg' ELSE a.image_path END AS image_path 
        FROM accounts as a WHERE account_id = ?", $id)->fetchSingle();
        $result = new accountsModel();
        $result->account_id = $query["account_id"];
        $result->user_role = $query["user_role"];
        $result->fname = $query["fname"];
        $result->lname = $query["lname"];
        $result->username = $query["username"];
        $result->bio = $query["bio"];
        $result->gender = $query["gender"];
        $result->DOB = $query["DOB"];
        $result->region = $query["region"];
        $result->email = $query["email"];
        $result->password = $query["password"];
        $result->image_path = $query["image_path"];
        $result->new_notifications = $query["new_notifications"];
        $db->close();
        return $result;
    }
    
    // Get by email
    function GetAccountByUsername($username){
        $result = null;
        $db = new db();
        $query = $db->query("SELECT a.account_id, a.user_role, a.fname, a.lname, a.username, a.bio, a.gender, a.DOB, a.region, a.email, a.password, 
        CASE WHEN a.image_path IS NULL THEN 'defaultImage.jpg' ELSE a.image_path END AS image_path
        FROM `accounts` as a WHERE a.username = ?", $username)->fetchSingle();
        if(isset($query) && sizeof($query)){
            $result = new accountsModel();
            $result->account_id = $query["account_id"];
            $result->user_role = $query["user_role"];
            $result->fname = $query["fname"];
            $result->lname = $query["lname"];
            $result->username = $query["username"];
            $result->bio = $query["bio"];
            $result->gender = $query["gender"];
            $result->DOB = $query["DOB"];
            $result->region = $query["region"];
            $result->email = $query["email"];
            $result->password = $query["password"];
            $result->image_path = $query["image_path"];
        }
        $db->close();
        return $result;
    }
    // Get all accounts
    function GetAllAccounts(){
        $db = new db();
        $result = Array();
        $query = $db->query("SELECT a.account_id, a.user_role, a.fname, a.lname, a.username, a.bio, a.gender, a.DOB, a.region, a.email, a.password, 
        CASE WHEN a.image_path IS NULL THEN 'defaultImage.jpg' ELSE a.image_path END AS image_path
        FROM `accounts` as a")->fetchAll();
        foreach($query as $row){
            $obj = new accountsModel();
            $obj->account_id = $row["account_id"];
            $obj->user_role = $row["user_role"];
            $obj->fname = $row["fname"];
            $obj->lname = $row["lname"];
            $obj->username = $row["username"];
            $obj->bio = $row["bio"];
            $obj->gender = $row["gender"];
            $obj->DOB = $row["DOB"];
            $obj->region = $row["region"];
            $obj->email = $row["email"];
            $obj->password = $row["password"];
            $obj->image_path = $row["image_path"];
            array_push($result, $obj);
        } 
        $db->close();
        return $result;
    }

    function GetAccountsReport(){
        $db = new db();
        $query = $db->query("SELECT a.account_id, a.user_role, a.fname, a.lname, a.username, a.email, a.gender, a.DOB, a.region,
         a.member_since,
        (SELECT s.title FROM song_play_count AS sp JOIN songs AS s ON sp.song_id = s.song_id WHERE sp.account_id = a.account_id GROUP BY sp.song_id ORDER BY COUNT(sp.song_id) DESC LIMIT 1) AS most_played_song,
        (SELECT g.title FROM song_play_count AS pc JOIN songs AS s ON pc.song_id = s.song_id JOIN genres AS g ON s.genre_id = g.genre_id WHERE pc.account_id = a.account_id GROUP BY g.title ORDER BY 
        COUNT(pc.song_id) DESC LIMIT 1) AS most_prominent_genre
        FROM `accounts` as a")->fetchAll();
        $db->close();
        return $query;
    }
    // Save
    function Save(){
        $db = new db();
        $query = $db->query("INSERT INTO accounts(
            user_role,
            fname,
            lname,
            username,
            bio,
            gender,
            DOB,
            region,
            email,
            password
            )VALUES(
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?
            )", 
            $this->user_role,
            $this->fname,
            $this->lname,
            $this->username,
            $this->bio,
            $this->gender,
            $this->DOB,
            $this->region,
            $this->email,
            $this->password
        );
        $result = $query->lastInsertID();
        $db->close();
        return $result;
    }
    // Update
    function Update(){
        $db = new db();
        $query = $db->query("UPDATE accounts SET
                user_role = ?, 
                fname = ?, 
                lname = ?, 
                username = ?, 
                bio = ?, 
                gender = ?, 
                DOB = ?, 
                region = ?, 
                email = ?, 
                password = ?
            WHERE account_id = ?",
                $this->user_role,
                $this->fname,
                $this->lname,
                $this->username,
                $this->bio,
                $this->gender,
                $this->DOB,
                $this->region,
                $this->email,
                $this->password,
                $this->account_id
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }

    function SaveAvatarImagePath($accountId, $filepath){
        $db = new db();
        $query = $db->query("UPDATE accounts SET
                image_path = ?
            WHERE account_id = ?",
                $filepath,
                $accountId
        );
        $result = $query->affectedRows();
        $db->close();
        return $result;
    }
    // SaveOrUpdate
    function SaveOrUpdate(){
        $result = null;
        if($this->account_id == null || $this->account_id == ""){
            $result = $this->Save();
        }else{
            $result = $this->Update();
        }
        return $result;
    }

    function logIn($userInfo){
        $account = new accountsModel();
        $savedInfo = $account->GetAccountByUsername($userInfo->username);
        if(isset($savedInfo) && $userInfo->username == $savedInfo->username && 
        $userInfo->password == $savedInfo->password){
            $val = new validationModel();
            $token = $val->GenerateToken($savedInfo);

            $result = $val->GetTokenByAcountId($savedInfo->account_id);
        }else{
            $result = new errorMessage('Error', 'Login failed');
        }
        return $result;
    }
    
    // Detele
    function Delete(){
        $this->GetArtistId();
        $this->GetAdminId();
        $this->DeleteAlbums();
        $this->DeleteSongs();
        $this->DeletePlaylists();
        $this->RemoveFromFollowers();
        
        $db = new db();
        $query = $db->query("DELETE FROM accounts
            WHERE account_id = ?",
                $this->account_id
        );
        $result = $query->affectedRows();
        $db->close();
    }

    // get artist id
    function GetArtistId(){
        $db = new db();
        $query = $db->query("SELECT `artist_id` FROM artists WHERE `account_id` = ?", $this->account_id)->fetchSingle();
        if(isset($query['artist_id'])){
            $this->artist_id = $query['artist_id'];
        }
        $db->close();
    }
    // get admin id
    function GetAdminId(){
        // $db = new db();
        // $query = $db->query("SELECT `admin_id` FROM admins WHERE `account_id` = ?",
        //         $this->account_id
        // );
        $db = new db();
        $query = $db->query("SELECT `admin_id` FROM admins WHERE `account_id` = ?", $this->account_id)->fetchSingle();
        if(isset($query['admin_id'])){
            $this->admin_id = $query['admin_id'];
        }
        $db->close();
    }
    // delete songs
    function DeleteSongs(){
        $db = new db();
        $query = $db->query("DELETE FROM songs
            WHERE artist_id = ?",
                $this->artist_id
        );
        $result = $query->affectedRows();
        $db->close();
    }
    // delete albums
    function DeleteAlbums(){
        $db = new db();
        $query = $db->query("DELETE FROM albums
            WHERE artist_id = ?",
                $this->artist_id
        );
        $result = $query->affectedRows();
        $db->close();
    }
    // delete playlists
    function DeletePlaylists(){
        $db = new db();
        $query = $db->query("DELETE FROM playlists
            WHERE account_id = ?",
                $this->account_id
        );
        $result = $query->affectedRows();
        $db->close();
    }
    // delete followers
    function RemoveFromFollowers(){
        $db = new db();
        $query = $db->query("DELETE FROM followed_artists
            WHERE artist_id = ?",
                $this->artist_id
        );
        $result = $query->affectedRows();
        $db->close();
    }
}
?>