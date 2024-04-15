<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <?php include('./headers.php'); ?>
    <link rel="stylesheet" href="./style/artistHub.css">
</head>
<body ng-app="ArtistHubModel" ng-controller="ArtistHubController" ng-cloak>
    <div class="row">
    <?php include('./sidebar.php');?>
        <!-- <div class="col s3 sidebar">
            <div class="sidebarButton"><a href="home.php"><i class="tiny material-icons">home</i> Home</a></div>
            <div class="sidebarButton" class="clickable"><a href="./account.php"><i class="tiny material-icons">account_circle</i> Account</a></div>
            <div class="sidebarButton" ng-if="role == 'Artist' || role == 'Admin'"><a href="artistHub.php"><i class="tiny material-icons">music_video</i> Artist Hub</a></div>
            <div class="sidebarButton" ng-if="role == 'Admin'"><a href="admin.php"><i class="tiny material-icons">settings</i> Admin</a></div>
            <div class="sidebarButton" ng-click="showArtistAlbumHub();">My Albums</div>
            <div class="sidebarButton" ng-click="showArtistSongsHub();">My Songs</div>
        </div> -->
        <div class="col s10">
            <div class="row">
                <div class="col s2">
                    <div class="sidebarGroup">
                        <div class="sidebarButton" ng-click="showArtistAlbumHub();">My Albums</div>
                        <div class="sidebarButton" ng-click="showArtistSongsHub();">My Songs</div>
                    </div>
                </div>
                <div class="col s10 albumList" ng-show="myAlbumsSection">
                    <div class="contentWrapper">
                        <h3>My Albums <button class="btn blue" style="float: right;" ng-click="openAlbumDetail()">New Album</button></h3>
                        <div ng-if="myAlbums.length == 0">You haven't created any albums yet</div>
                        <table ng-if="myAlbums.length > 0">
                            <tr>
                                <th>Cover</th>
                                <th>Title</th>
                                <th>Artist</th>
                                <th>Format</th>
                                <th>Rating</th>
                                <th>Release Date</th>
                            </tr>
                            <tr ng-repeat="row in myAlbums">
                                <td ng-click="openAlbumDetail(row)">
                                    <div class="albumCover" style="background-image: url(./uploads/{{row.image_path}});" 
                                    ng-click="albumWindow = true"></div>
                                </td>
                                <td ng-click="openAlbumDetail(row)">{{row.title}}</td>
                                <td ng-click="openAlbumDetail(row)">{{row.artist_name}}</td>
                                <td ng-click="openAlbumDetail(row)">{{row.format}}</td>
                                <td>{{row.rating}}
                                    <div ng-if="row.user_rating != null">
                                        <i class="tiny material-icons yellow-text text-accent-2" ng-if="row.user_rating >= 1" ng-click="saveAlbumRating(row, 1);">star</i>
                                        <i class="tiny material-icons" ng-if="row.user_rating < 1" ng-click="saveAlbumRating(row, 1);">star_border</i>
                                        <i class="tiny material-icons yellow-text text-accent-2" ng-if="row.user_rating >= 2" ng-click="saveAlbumRating(row, 2);">star</i>
                                        <i class="tiny material-icons" ng-if="row.user_rating < 2" ng-click="saveAlbumRating(row, 2);">star_border</i>
                                        <i class="tiny material-icons yellow-text text-accent-2" ng-if="row.user_rating >= 3" ng-click="saveAlbumRating(row, 3);">star</i>
                                        <i class="tiny material-icons" ng-if="row.user_rating < 3" ng-click="saveAlbumRating(row, 3);">star_border</i>
                                        <i class="tiny material-icons yellow-text text-accent-2" ng-if="row.user_rating >= 4" ng-click="saveAlbumRating(row, 4);">star</i>
                                        <i class="tiny material-icons" ng-if="row.user_rating < 4" ng-click="saveAlbumRating(row, 4);">star_border</i>
                                        <i class="tiny material-icons yellow-text text-accent-2" ng-if="row.user_rating == 5" ng-click="saveAlbumRating(row, 5);">star</i>
                                        <i class="tiny material-icons" ng-if="row.user_rating < 5" ng-click="saveAlbumRating(row, 5);">star_border</i>

                                    </div>
                                    <div ng-if="row.user_rating == null">
                                        <i class="tiny material-icons" ng-if="row.general_rating >= 1" ng-click="saveAlbumRating(row, 1);">star</i>
                                        <i class="tiny material-icons" ng-if="row.general_rating < 1" ng-click="saveAlbumRating(row, 1);">star_border</i>
                                        <i class="tiny material-icons" ng-if="row.general_rating >= 2" ng-click="saveAlbumRating(row, 2);">star</i>
                                        <i class="tiny material-icons" ng-if="row.general_rating < 2" ng-click="saveAlbumRating(row, 2);">star_border</i>
                                        <i class="tiny material-icons" ng-if="row.general_rating >= 3" ng-click="saveAlbumRating(row, 3);">star</i>
                                        <i class="tiny material-icons" ng-if="row.general_rating < 3" ng-click="saveAlbumRating(row, 3);">star_border</i>
                                        <i class="tiny material-icons" ng-if="row.general_rating >= 4" ng-click="saveAlbumRating(row, 4);">star</i>
                                        <i class="tiny material-icons" ng-if="row.general_rating < 4" ng-click="saveAlbumRating(row, 4);">star_border</i>
                                        <i class="tiny material-icons" ng-if="row.general_rating == 5" ng-click="saveAlbumRating(row, 5);">star</i>
                                        <i class="tiny material-icons" ng-if="row.general_rating < 5" ng-click="saveAlbumRating(row, 5);">star_border</i>
                                    </div>
                                </td>
                                <td ng-click="openAlbumDetail(row)">{{row.release_date}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="col s10 playlistGrid" ng-if="mySongsSection">
                    <div class="contentWrapper">
                        <h3>My Songs <button class="btn blue" style="float: right;" ng-click="editSong()">Add Song</button></h3>
                        <div ng-if="artistSongs.length == 0">You haven't uploaded any songs yet</div>
                        <table class="playlistTable" ng-if="artistSongs.length > 0">
                            <tr>
                                <!-- <th></th> -->
                                <th>Title</th>
                                <th>Artist</th>
                                <th>Genre</th>
                                <th>Rating</th>
                            </tr>
                            <tr ng-repeat="song in artistSongs">
                                <!-- <td class="audioCell" ng-click="playSong(song.song_id)" id="row_{{song.song_id}}">
                                    <div class="playerDisabler"></div>
                                    <audio controls id="player_{{song.song_id}}"1>
                                        <source src="./uploads/audio{{song.audio_path}}" type="audio/ogg">
                                        Your browser does not support the audio element.
                                    </audio>
                                </td> -->
                                <td ng-click="editSong(song)" id="row_{{song.song_id}}">
                                    {{song.title}}
                                </td>
                                <td ng-click="editSong(song)" id="row_{{song.song_id}}">{{song.ArtistName}}</td>
                                <td ng-click="editSong(song)" id="row_{{song.song_id}}">{{song.genreName}}</td>
                                <td>
                                    <div ng-if="song.user_rating != null">
                                        <i class="tiny material-icons yellow-text text-accent-2" ng-if="song.user_rating >= 1">star</i>
                                        <i class="tiny material-icons" ng-if="song.user_rating < 1">star_border</i>
                                        <i class="tiny material-icons yellow-text text-accent-2" ng-if="song.user_rating >= 2">star</i>
                                        <i class="tiny material-icons" ng-if="song.user_rating < 2">star_border</i>
                                        <i class="tiny material-icons yellow-text text-accent-2" ng-if="song.user_rating >= 3">star</i>
                                        <i class="tiny material-icons" ng-if="song.user_rating < 3">star_border</i>
                                        <i class="tiny material-icons yellow-text text-accent-2" ng-if="song.user_rating >= 4">star</i>
                                        <i class="tiny material-icons" ng-if="song.user_rating < 4">star_border</i>
                                        <i class="tiny material-icons yellow-text text-accent-2" ng-if="song.user_rating == 5">star</i>
                                        <i class="tiny material-icons" ng-if="song.user_rating < 5">star_border</i>

                                    </div>
                                    <div ng-if="song.user_rating == null">
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
                                    </div>
                                </td>
                                <td>
                                    <i class="small material-icons" ng-click="songMenuOption($event, song);">more_horiz</i>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="albumCardSelector" ng-show="albumCardView">
            <div class="row">
                <div class="col s2" ng-click="albumCardView = false" style="height: 100vh;"></div>
                <div class="col s8">
                    <div class="row">
                        <div class="col s6 albumDetailWrapper">
                            <div ng-click="albumCardView = false" style="height: 50px;"></div>
                            <!-- <div class="albumDetailWrapper"> -->
                                <div class="deleteAlbumButton" ng-click="deleteAlbumButton();">Delete</div>
                                <div class="albumCoverEditingPanel" style="background-image: url(./uploads/{{selectedAlbum.image_path}});">
                                    <span ng-if="!selectedAlbum.image_path">No Picture</span>
                                </div>
                                <div class="row">
                                    <div class="col s4"></div>
                                    <form class="col 8">
                                        <div>
                                            <label for="selectedAlbum_title">Title</label>
                                            <input autocomplete="off" type="text" ng-model="selectedAlbum.title">
                                        </div>
                                        <div>
                                            <label for="selectedAlbum_artist_id">Artist</label>
                                            <select id="selectedAlbum_artist_id" 
                                                class="browser-default"
                                                ng-model="selectedAlbum.artist_id"
                                                ng-options='p.artist_id as p.artist_name for p in artistList'
                                                ng-init="selectedAlbum.artist_id = p.artist_id">
                                                <option value="">Select Artist</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="selectedAlbum_format">Format</label>
                                            <select id="selectedAlbum_format" 
                                                class="browser-default"
                                                ng-model="selectedAlbum.format"
                                                ng-options='p.name as p.name for p in formats'
                                                ng-init="selectedAlbum.format = p.name">
                                                <option value="">Select Format</option>
                                            <!-- <input autocomplete="off" type="text" ng-model="selectedAlbum.format"> -->
                                        </div>
                                        <div class="input-field">
                                            <input autocomplete="off" class="datepicker" type="text" ng-model="selectedAlbum.release_date">
                                            <label for="selectedAlbum_release_date">Release Date</label>
                                        </div>
                                        <div>
                                            <label>Album Cover</label>
                                            <input type="file" 
                                                ngf-select 
                                                ng-model="picFile" 
                                                name="file"    
                                                accept="image/*" ngf-max-size="20MB" required
                                                ngf-model-invalid="errorFile">
                                        </div>
                                        <div>
                                            <button class="btn blue" ng-click="saveAlbumInfo(picFile);">Save</button>
                                            <button class="btn red" ng-click="albumCardView = false" style="float: right;">Cancel</button>
                                        </div>
                                    </form>
                                <!-- </div> -->
                            </div>
                    </div>

                    <div class="col s6 albumDetailWrapper">
                        <h4>Track List</h4>
                        <div ng-if="songsInAlbum.length == 0">There are no songs in this album</div>
                        <table ng-if="songsInAlbum.length > 0">
                            <tr>
                                <th>Title</th>
                                <th>Genre</th>
                                <th>Rating</th>
                            </tr>
                            <tr ng-repeat="song in songsInAlbum">
                                <td>{{song.title}}</td>
                                <td>{{song.genreName}}</td>
                                <td>
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
                </div>
            </div>
        </div>
    </div>
    <div class="albumCardSelector" ng-show="songCardView">
        <div class="row">
            <div class="col s2" ng-click="songCardView = false" style="height: 100vh;"></div>
            <div class="col s8">
                <div ng-click="albumCardView = false" style="height: 50px;"></div>
                <div class="songeditingArea">
                    <div class="deleteAlbumButton" ng-click="deleteSongButton();">Delete</div>
                    <h3>Song Details</h3>
                    <form>
                        <div>
                            <label for="selectedSong_title">title</label>
                            <input autocomplete="off" ng-model="selectedSong.title">
                        </div>
                        <div>
                            <label for="selectedSong_artist_id">Artist</label>
                                <select id="selectedSong_artist_id" 
                                    class="browser-default"
                                    ng-model="selectedSong.artist_id"
                                    ng-options='p.artist_id as p.artist_name for p in artistList'
                                    ng-init="selectedSong.artist_id = p.artist_id">
                                    <option value="">Select Artist</option>
                                </select>
                            <!-- <input autocomplete="off" ng-model="selectedSong.artist_id"> -->
                        </div>
                        <div>
                            <label for="selectedSong_genre_id">Genre</label>
                            <select id="selectedSong_genre_id" 
                                class="browser-default"
                                ng-model="selectedSong.genre_id"
                                ng-options='p.genre_id as p.title for p in genres'
                                ng-init="selectedSong.genre_id = p.genre_id">
                                <option value="">Select Genre</option>
                            </select>
                            <!-- <input autocomplete="off" ng-model="selectedSong.genre_id"> -->
                        </div>
                        <div>
                            <input type="file" id="audioFile" ng-model="selectedSong.audioFile" name="file"/>
                        </div>
                            <button class="btn blue" ng-click="saveSongInfo();">Save</button>
                            <button class="btn red" style="float: right;" ng-click="songCardView = false">Cancel</button>
                    </form>
                </div>
            </div>
            <div class="col s2" ng-click="songCardView = false" style="height: 100vh;"></div>
        </div>
    </div>
    <div id='songMenu' class='songMenu row' ng-show="showSongMenuOption">
        <div class="col s12 clickable"><i class="tiny material-icons">add</i> Add to Album</div>
        <div class="col s12">
            <select id="addToAlbumDropdDown" 
                class="browser-default"
                ng-model="addToAlbum.album_id"
                ng-options='p.album_id as p.title for p in myAlbums'>
                <option value="">Select Playlist</option>
            </select>
            <button class="btn" ng-click="saveSongToAlbum();">Save</button>
            <button class="btn red" ng-click="cancelSongMenuOption();" style="float:right">Cancel</button>
        </div>
    </div>
    <script type="text/javascript" src="./app/artistHub.js"></script>
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