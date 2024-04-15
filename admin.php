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
        <div class="col s10 reportPanel">
            <div class="row">
                <!-- <div class="col s2"> -->
                    <div class="col s2 sidebar">
                        <div class="sidebarGroup">
                            <div class="sidebarButton" ng-click="showGenresSections();">Generes</div>
                            <div class="sidebarButton" ng-click="showReportsSections();">Reports</div>
                            <div class="" ng-if="reportsView">
                                <ul>
                                    <li ng-click="showReport('user');">User Report</li>
                                    <li ng-click="showReport('artist');">Artist Report</li>
                                    <li ng-click="showReport('song');">Song Reports</li>
                                    <li ng-click="showReport('album');">Albums Reports</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
                <div class="col s10" ng-if="generesView">
                    <div class="contentWrapper">
                        <h3>Generes</h3>
                        <button>Add Genere</button>
                        <div class="genresList">No generes have been set yet</div>
                        <div class="genresList" ng-repeat="genere in genres">{{genere.title}}</div>
                    </div>
                </div>
                <div class="col s10" ng-if="reportsView">
                    <div class="contentWrapper">
                        <!-- User Report -->
                        <div ng-if="userReportView">
                            <h3>User Report</h3>
                            <h6>Report Filters</h6>
                            <label>Role</label>
                            <select id="userFilter_role" 
                                class="browser-default reportfilterDropdown"
                                ng-model="userFilter.role"
                                ng-change="filterUserList();">
                                <option value="">Select Role</option>
                                <option value="Admin">Admin</option>
                                <option value="Artist">Artist</option>
                                <option value="User">User</option>
                            </select>
                            <labe>Region</labe>
                            <select id="userFilter_region" 
                                class="browser-default reportfilterDropdown"
                                ng-model="userFilter.region"
                                ng-options='region for region in regions'
                                ng-init="region = userFilter.region"
                                ng-change="filterUserList();">
                                <option value="">Select Region</option>
                            </select>
                            <label>Gender</label>
                            <select id="userFilter_gender" 
                                class="browser-default reportfilterDropdown"
                                ng-model="userFilter.gender"
                                ng-change="filterUserList();">
                                <option value="">Select Gender</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                            <!-- <span class="btn blue" ng-click="filterUserList();">Apply Filter</span> -->
                            <table class="table-border">
                                <tr>
                                    <th ng-click="sortByNumericProperty('account_id','userList')">Account Id</th>
                                    <th ng-click="sortByProperty('user_role','userList')">Role</th>
                                    <th ng-click="sortByProperty('fname','userList')">First Name</th>
                                    <th ng-click="sortByProperty('lname','userList')">Last Name</th>
                                    <th ng-click="sortByProperty('username','userList')">Username</th>
                                    <th ng-click="sortByProperty('bio','userList')">Bio</th>
                                    <th ng-click="sortByProperty('gender','userList')">Gender</th>
                                    <th ng-click="sortByProperty('DOB','userList')">DOB</th>
                                    <th ng-click="sortByProperty('region','userList')">Region</th>
                                    <th ng-click="sortByProperty('email','userList')">email</th>
                                </tr>
                                <tr ng-repeat="user in userList">
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

                        <!-- Arist Report -->
                        <div ng-if="artistReportView">
                            <h3>Artist Report</h3>
                            <table class="table-border">
                                <tr>
                                    <th ng-click="sortByNumericProperty('account_id','artistList')">Account Id</th>
                                    <th ng-click="sortByNumericProperty('artist_id','artistList')">Artist Id</th>
                                    <th ng-click="sortByProperty('artist_name','artistList')">Artist Name</th>
                                    <th ng-click="sortByNumericProperty('number_of_albums','artistList')">Number of Albums</th>
                                    <th ng-click="sortByNumericProperty('number_of_songs','artistList')">Number of songs</th>
                                    <th ng-click="sortByProperty('followers','artistList')">followers</th>
                                    <th>Average Songs/Album</th>
                                    <th ng-click="sortByProperty('latest_album_release')">Latest Album Release</th>
                                </tr>
                                <tr ng-repeat="artist in artistList">
                                    <td class="text_right">{{artist.account_id}}</td>
                                    <td class="text_right">{{artist.artist_id}}</td>
                                    <td>{{artist.artist_name}}</td>
                                    <td class="text_center">{{artist.number_of_albums}}</td>
                                    <td class="text_center">{{artist.number_of_songs}}</td>
                                    <td class="text_center">{{artist.followers}}</td>
                                    <td class="text_center">{{artist.number_of_albums/artist.number_of_songs | number:0}}</td>
                                    <td class="text_center">{{artist.latest_album_title}} ({{artist.latest_album_release | date:'MMM dd, yyyy'}})</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Songs Report -->
                        <div ng-if="songReportView">
                            <h3>Songs Report</h3>
                            <h6>Report Filters</h6>
                            <label for="songFilter_artist">Artist</label>
                            <select id="songFilter_artist" 
                                class="browser-default reportfilterDropdown"
                                ng-model="songFilter.artist"
                                ng-options='a as a for a in songFilter.artists'
                                ng-init="a = songFilter.artist"
                                ng-change="filterSongsReport();">
                                <option value="">Select Artist</option>
                            </select>
                            <label for="songFilter_genre">Genre</label>
                            <select id="songFilter_genre" 
                                class="browser-default reportfilterDropdown"
                                ng-model="songFilter.genre"
                                ng-options='a.title as a.title for a in genres'
                                ng-init="a.title = songFilter.genre"
                                ng-change="filterSongsReport();">
                                <option value="">Select Genre</option>
                            </select>
                            <labe>Rating</labe>
                            <select id="songFilter_rating" 
                                class="browser-default reportfilterDropdown"
                                ng-model="songFilter.rating"
                                ng-change="filterSongsReport();">
                                <option value="">Select Rating</option>
                                <option value="1">1 Star</option>
                                <option value="2">2 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="5">5 Stars</option>
                            </select>
                            <!-- <span class="btn blue">Apply Filter</span> -->
                            <table class="table-border">
                                <tr>
                                    <th ng-click="sortByNumericProperty('song_id','songsReport')">Song Id</th>
                                    <th ng-click="sortByProperty('title','songsReport')">Title</th>
                                    <th ng-click="sortByProperty('artist_name','songsReport')">Artist</th>
                                    <th ng-click="sortByProperty('genre','songsReport')">Genre</th>
                                    <th ng-click="sortByNumericProperty('number_of_albums','songsReport')">Album Count</th>
                                    <th ng-click="sortByNumericProperty('number_of_playlist','songsReport')">Playlist Count</th>
                                    <th ng-click="sortByNumericProperty('listens','songsReport')">Listens</th>
                                    <th ng-click="sortByNumericProperty('general_rating','songsReport')">Ratings</th>
                                </tr>
                                <tr ng-repeat="song in songsReport">
                                    <td class="text_right">{{song.song_id}}</td>
                                    <td>{{song.title}}</td>
                                    <td>{{song.artist_name}}</td>
                                    <td class="text_left">{{song.genre}}</td>
                                    <td class="text_right">{{song.number_of_albums}}</td>
                                    <td class="text_right">{{song.number_of_playlist | number:0}}</td>
                                    <td class="text_right">{{song.listens}}</td>
                                    <td class="text_right">{{song.general_rating}}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Albums Report -->
                        <div ng-if="albumReportView">
                            <h3>Albums Report</h3>
                            <h6>Report Filters</h6>
                            <label for="albumFilter_artist">Artist</label>
                            <select id="albumFilter_artist" 
                                class="browser-default reportfilterDropdown"
                                ng-model="albumFilter.artist"
                                ng-options='a as a for a in songFilter.artists'
                                ng-init="a = songFilter.artist"
                                ng-change="filterAlbumReport();">
                                <option value="">Select Artist</option>
                            </select>
                            <label for="albumFilter_format">Genre</label>
                            <select id="albumFilter_format" 
                                class="browser-default reportfilterDropdown"
                                ng-model="albumFilter.format"
                                ng-options='a as a for a in ambumFormats'
                                ng-init="a = albumFilter.format"
                                ng-change="filterAlbumReport();">
                                <option value="">Select Genre</option>
                            </select>
                            <labe for="albumFilter_rating">Rating</labe>
                            <select id="albumFilter_rating" 
                                class="browser-default reportfilterDropdown"
                                ng-model="albumFilter.rating"
                                ng-change="filterAlbumReport();">
                                <option value="">Select Rating</option>
                                <option value="1">1 Star</option>
                                <option value="2">2 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="5">5 Stars</option>
                            </select>
                            <!-- <span class="btn blue">Apply Filter</span> -->
                            <table class="table-border">
                                <tr>
                                    <th ng-click="sortByProperty('title', 'albumReport')">Title</th>
                                    <th ng-click="sortByProperty('artist_name', 'albumReport')">Artist Name</th>
                                    <th ng-click="sortByProperty('format', 'albumReport')">Format</th>
                                    <th ng-click="sortByNumericProperty('songs_in_album', 'albumReport')">Songs in Album</th>
                                    <th ng-click="sortByProperty('release_date', 'albumReport')">Release Date</th>
                                    <th ng-click="sortByNumericProperty('general_rating', 'albumReport')">Ratings</th>
                                </tr>
                                <tr ng-repeat="album in albumReport">
                                    <td class="text_left">{{album.title}}</td>
                                    <td>{{album.artist_name}}</td>
                                    <td>{{album.format}}</td>
                                    <td class="text_right">{{album.songs_in_album}}</td>
                                    <td class="text_left">{{album.release_date}}</td>
                                    <td class="text_right">{{album.general_rating}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="./app/admin.js"></script>
</body>
</html>