<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="./style/admin.css">
<head>
    <title>Admin</title>
    <?php include('./headers.php'); ?>
</head>
<body ng-app="AdminModel" ng-controller="AdminController" ng-cloak>
    <div class="row">
        <?php include('./sidebar.php');?>
        <div class="col s9 reportPanel">
            <div class="row">
                <div class="col s12">
                    <form ng-submit="filterAccountData()">
                        <label>Filter by:</label>
                        <!--input type="text" ng-model="filters.account_id" placeholder="Account Id"-->
                        <input type="text" ng-model="filterCriteria.username" placeholder="UserName">
                        <input type="text" ng-model="filterCriteria.user_role" placeholder="UserRole">
                        <input type="text" ng-model="filterCriteria.gender" placeholder="Gender">
                        <input type="text" ng-model="filterCriteria.region" placeholder="Region">
                        
                        <!-- Add more input fields for other properties -->
                        <button type="submit">Apply Filter</button>
                    </form>
                    <table class="table-border">
                        <tr>
                            <th ng-click="sortByNumericProperty('account_id')">Account Id</th>
                            <th ng-click="sortByProperty('user_role')">Role</th>
                            <th ng-click="sortByProperty('fname')">First Name</th>
                            <th ng-click="sortByProperty('lname')">Last Name</th>
                            <th ng-click="sortByProperty('username')">Username</th>
                            <th ng-click="sortByProperty('bio')">Bio</th>
                            <th ng-click="sortByProperty('gender')">Gender</th>
                            <th ng-click="sortByProperty('DOB')">DOB</th>
                            <th ng-click="sortByProperty('region')">Region</th>
                            <th ng-click="sortByProperty('email')">email</th>
                        </tr>
                        <tr ng-repeat="user in filteredList track by user.account_id">
                            <td>{{user.account_id}}</td>
                            <td>{{user.user_role}}</td>
                            <td>{{user.fname}}</td>
                            <td>{{user.lname}}</td>
                            <td>{{user.username}}</td>
                            <td>{{user.bio}}</td>
                            <td>{{user.gender}}</td>
                            <td>{{user.DOB}}</td>
                            <td>{{user.region}}</td>
                            <td>{{user.email}}</td>
                        </tr>
                    </table>
                    
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                <form ng-submit="filterSongData()">
                    <label>Filter by:</label>
                    <!--input type="text" ng-model="filters.account_id" placeholder="Account Id"-->
                    <input type="text" ng-model="filterCriteria.artist_id" placeholder="ArtistID">
                    <input type="text" ng-model="filterCriteria.title" placeholder="Title">
                    <input type="text" ng-model="filterCriteria.genre_id" placeholder="GenreID">
                    <input type="text" ng-model="filterCriteria.listens" placeholder="listens">
                    <input type="text" ng-model="filterCriteria.rating" placeholder="rating">
                    <!-- Add more input fields for other properties -->
                    <button type="submit">Apply Filter</button>
                </form>

                <table class="table-border">
                        <tr>
                            <th ng-click="sortByNumericProperty('song_id')">Song Id</th>
                            <th ng-click="sortByNumericProperty('artist_id')">Artist Id</th>
                            <th ng-click="sortByProperty('ArtistName')">ArtistName</th>
                            <th ng-click="sortByProperty('title')">Song Title</th>
                            <th ng-click="sortByNumericProperty('duration')">Duration</th>
                            <th ng-click="sortByNumericProperty('listens')">Listens</th>
                            <th ng-click="sortByNumericProperty('rating')">Rating</th>
                            <th ng-click="sortByNumericProperty('genre_id')">GenreID</th>
                            <th ng-click="sortByProperty('genreTitle')">Genre Title</th>
                        </tr>
                        <tr ng-repeat="user in filteredList track by user.song_id">
                            <td>{{user.song_id}}</td>
                            <td>{{user.artist_id}}</td>
                            <td>{{user.ArtistName}}</td>
                            <td>{{user.title}}</td>
                            <td>{{user.duration}}</td>
                            <td>{{user.listens}}</td>
                            <td>{{user.rating}}</td>
                            <td>{{user.genre_id}}</td>
                            <td>{{user.genreTitle}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                <form ng-submit="filterAlbumData()">
                    <label>Filter by:</label>
                    <!--input type="text" ng-model="filters.account_id" placeholder="Account Id"-->
                    <input type="text" ng-model="filterCriteria.album_id" placeholder="AlbumID">
                    <input type="text" ng-model="filterCriteria.record_label" placeholder="Record Label">
                    <input type="text" ng-model="filterCriteria.artist_id" placeholder="ArtistID">
                    <input type="text" ng-model="filterCriteria.title" placeholder="Album Title">
                    <input type="text" ng-model="filterCriteria.format" placeholder="Format">
                    <input type="text" ng-model="filterCriteria.rating" placeholder="rating">
                    <!-- Add more input fields for other properties -->
                    <button type="submit">Apply Filter</button>
                </form>

                <table class="table-border">
                        <tr>
                            <th ng-click="sortByNumericProperty('album_id')">Album ID</th>
                            <th ng-click="sortByProperty('record_label')">Record Label</th>
                            <th ng-click="sortByNumericProperty('artist_id')">Artist ID</th>
                            <th ng-click="sortByProperty('ArtistName')">ArtistName</th>
                            <th ng-click="sortByProperty('title')">Album Title</th>
                            <th ng-click="sortByNumericProperty('rating')">Rating</th>
                            <th ng-click="sortByProperty('format')">Format</th>
                            <th ng-click="sortByProperty('release_date')">Release Date</th>
                        </tr>
                        <tr ng-repeat="user in filteredList track by user.album_id">
                            <td>{{user.album_id}}</td>
                            <td>{{user.record_label}}</td>
                            <td>{{user.artist_id}}</td>
                            <td>{{user.ArtistName}}</td>
                            <td>{{user.title}}</td>
                            <td>{{user.rating}}</td>
                            <td>{{user.format}}</td>
                            <td>{{user.release_date}}</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript" src="./app/admin.js"></script>
</body>
</html>