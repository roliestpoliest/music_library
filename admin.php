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
                            <!-- <div class="sidebarButton" ng-click="showGenresSections();">Generes</div> -->
                            <div class="sidebarButton" ng-click="showReportsSections();">Reports</div>
                            <div>
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
                <div class="col s10">
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
                            <form>
                            <div>
                                <label for="userFilter_startDate">Start Date</label>
                                <input class="datepicker" autocomplete="off" type="text" ng-model="userFilter.startDate" ng-change="filterUserList();" id="userFilter_startDate">
                            </div>
                            <div>
                                <label for="userFilter_endDate">End Date</label>
                                <input class="datepicker" autocomplete="off" type="text" ng-model="userFilter.endDate" ng-change="filterUserList();" id="userFilter_endDate">
                            </div>
                            </form>
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
                                    <th ng-click="sortByProperty('member_since','userList')">Member Since</th>
                                    <th ng-click="sortByNumericProperty('number_of_artistsFollowed','userList')"># of artists followed</th>
                                    <th ng-click="sortByNumericProperty('number_of_playlist','userList')"># of playlist</th>
                                    <th ng-click="sortByNumericProperty('number_of_playcount','userList')"># of songs played</th>

                                    <th></th>
                                </tr>
                                <tr ng-repeat="user in userList">
                                    <td>{{user.account_id}}</td>
                                    <td>{{user.user_role}}</td>
                                    <td>{{user.fname}}</td>
                                    <td>{{user.lname}}</td>
                                    <td>{{user.username}}</td>
                                    <td>{{user.bio}}</td>
                                    <td>{{user.gender}}</td>
                                    <td>{{user.DOB | date: 'MMM dd, yyyy'}}</td>
                                    <td>{{user.region}}</td>
                                    <td>{{user.email}}</td>
                                    <td>{{toDate(user.member_since) | date: 'MMM dd, yyyy'}}</td>
                                    <td>{{user.number_of_artistsFollowed}}</td>
                                    <td>{{user.number_of_playlist}}</td>
                                    <td>{{user.number_of_playcount}}</td>
                                    <td>
                                        <span class="deletePlaylistButton" ng-click="showDeleteUserWarning(user);">Delete</span>
                                    </td>
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
                                    <th ng-click="sortByProperty('followers','artistList')">Followers</th>
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
                                    <td class="text_center">{{(artist.number_of_songs !== 0) ? (artist.number_of_albums/artist.number_of_songs | number:0) : 0}}</td>
                                    <td class="text_center">{{artist.latest_album_title}} ({{artist.latest_album_release ? (artist.latest_album_release | date:'MMM dd, yyyy') : 'MMM dd, yyyy'}})</td>
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
                            <label>Rating</label>
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
                            <form>
                            <div>
                                <label for="songFilter_startDate">Start Date</label>
                                <input class="datepicker" autocomplete="off" type="text" ng-model="songFilter.startDate" ng-change="filterSongsReport();" id="songFilter_startDate">
                            </div>
                            <div>
                                <label for="userFilter_endDate">End Date</label>
                                <input class="datepicker" autocomplete="off" type="text" ng-model="songFilter.endDate" ng-change="filterSongsReport();" id="songFilter_endDate">
                            </div>
                            </form>
                            <!-- <span class="btn blue">Apply Filter</span> -->
                            <table class="table-border">
                                <tr>
                                    <th ng-click="sortByNumericProperty('song_id','songsReport')">Song Id</th>
                                    <th ng-click="sortByProperty('title','songsReport')">Title</th>
                                    <th ng-click="sortByProperty('artist_name','songsReport')">Artist</th>
                                    <th ng-click="sortByProperty('genre','songsReport')">Genre</th>
                                    <th ng-click="sortByProperty('release_date','songsReport')">Release Date</th>
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
                                    <td>{{toDate(song.release_date)| date: 'MMM dd, yyyy'}}</td>
                                    <td class="text_right">{{song.number_of_albums}}</td>
                                    <td class="text_right">{{song.number_of_playlist | number:0}}</td>
                                    <td class="text_right">{{song.listens}}</td>
                                    <td class="text_right">
                                        <i class="tiny material-icons" ng-if="song.general_rating >= 1">star</i>
                                        <i class="tiny material-icons" ng-if="song.general_rating < 1">star_border</i>
                                        <i class="tiny material-icons" ng-if="song.general_rating >= 2">star</i>
                                        <i class="tiny material-icons" ng-if="song.general_rating < 2">star_border</i>
                                        <i class="tiny material-icons" ng-if="song.general_rating >= 3">star</i>
                                        <i class="tiny material-icons" ng-if="song.general_rating < 3">star_border</i>
                                        <i class="tiny material-icons" ng-if="song.general_rating >= 4">star</i>
                                        <i class="tiny material-icons" ng-if="song.general_rating < 4">star_border</i>
                                        <i class="tiny material-icons" ng-if="song.general_rating == 5">star</i>
                                        <i class="tiny material-icons" ng-if="song.general_rating < 5">star_border</i>
                                    </td>
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
                            <label for="albumFilter_format">Format</label>
                            <select id="albumFilter_format" 
                                class="browser-default reportfilterDropdown"
                                ng-model="albumFilter.format"
                                ng-options='a as a for a in ambumFormats'
                                ng-init="a = albumFilter.format"
                                ng-change="filterAlbumReport();">
                                <option value="">Select Format</option>
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
                            <form>
                            <div>
                                <label for="albumFilter_startDate">Start Date</label>
                                <input class="datepicker" autocomplete="off" type="text" ng-model="albumFilter.startDate" ng-change="filterAlbumReport();" id="albumFilter_startDate">
                            </div>
                            <div>
                                <label for="albumFilter_endDate">End Date</label>
                                <input class="datepicker" autocomplete="off" type="text" ng-model="albumFilter.endDate" ng-change="filterAlbumReport();" id="albumFilter_endDate">
                            </div>
                            </form>
                            <!-- <span class="btn blue">Apply Filter</span> -->
                            <table class="table-border">
                                <tr>
                                    <th ng-click="sortByProperty('title', 'albumReport')">Title</th>
                                    <th ng-click="sortByProperty('artist_name', 'albumReport')">Artist Name</th>
                                    <th ng-click="sortByProperty('format', 'albumReport')">Format</th>
                                    <th ng-click="sortByNumericProperty('songs_in_album', 'albumReport')">Songs in Album</th>
                                    <th ng-click="sortByProperty('release_date', 'albumReport')">Release Date</th>
                                    <th ng-click="sortByNumericProperty('general_rating', 'albumReport')">Ratings</th>
                                    <th ng-click="sortByNumericProperty('total_listens', 'albumReport')">Total Listens</th>
                                </tr>
                                <tr ng-repeat="album in albumReport">
                                    <td class="text_left">{{album.title}}</td>
                                    <td>{{album.artist_name}}</td>
                                    <td>{{album.format}}</td>
                                    <td class="text_right">{{album.songs_in_album}}</td>
                                    <td class="text_center">{{album.release_date | date: 'MMM dd, yyyy'}}</td>
                                    <td class="text_right">
                                        <i class="tiny material-icons" ng-if="album.general_rating >= 1">star</i>
                                        <i class="tiny material-icons" ng-if="album.general_rating < 1">star_border</i>
                                        <i class="tiny material-icons" ng-if="album.general_rating >= 2">star</i>
                                        <i class="tiny material-icons" ng-if="album.general_rating < 2">star_border</i>
                                        <i class="tiny material-icons" ng-if="album.general_rating >= 3">star</i>
                                        <i class="tiny material-icons" ng-if="album.general_rating < 3">star_border</i>
                                        <i class="tiny material-icons" ng-if="album.general_rating >= 4">star</i>
                                        <i class="tiny material-icons" ng-if="album.general_rating < 4">star_border</i>
                                        <i class="tiny material-icons" ng-if="album.general_rating == 5">star</i>
                                        <i class="tiny material-icons" ng-if="album.general_rating < 5">star_border</i>
                                    </td>
                                    <td class="text_right">{{album.total_listens}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="deleteUserWarningWrapper" ng-if="deleteUserWarning">
        <div class="row" ng-click="hideDeleteUserWarning()">
            <div class="col s12" style="height: 75px;"></div>
        </div>
        <div class="row">
            <div class="col s4"></div>
            <div class="col s4 warningSrea">
                Are you sure you want to delete 
                <br>
                {{selectedUser.fname}} {{selectedUser.lname}}'s account?
                <br>
                This will delete all data related to this user
                <br> all songs, albums, and playlists.
                <div>
                    <button class="btn blue" style="float: left; margin:10px 0;" ng-click="deleteUser();">Delete</button>
                    <button class="btn red" style="float: right; margin:10px 0;" ng-click="hideDeleteUserWarning();">Cancel</button>
                </div>
            </div>
            <div class="col s4"></div>
        </div>
        <div class="row"  ng-click="hideDeleteUserWarning()">
            <div class="col s12" style="height: 375px;"></div>
        </div>
    </div>
    <script type="text/javascript" src="./app/admin.js"></script>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            format:'yyyy-mm-dd'
        }
    var elems = document.querySelectorAll('.datepicker', options);
    var instances = M.Datepicker.init(elems);
  });
</script>
</html>