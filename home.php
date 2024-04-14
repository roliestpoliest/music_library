<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <?php include('./headers.php'); ?>
    <link rel="stylesheet" href="./style/home.css">
</head>
<body ng-app="HomeModel" ng-controller="HomeController" ng-cloak>
    <div class="row">
    <?php include('./sidebar.php');?>
        <div class="col s9">
            <div class="row" ng-show="SearchView">
                <form name="searchBar">
                    <div class="searchWrapper">
                        <input 
                            placeholder="Search"
                            class="searchBar autocomplete"
                            autocomplete="off" 
                            type="text" 
                            id="searchBar" 
                            ng-model="searchTerm"
                            ng-change="searchSong();">
                        <i class="material-icons searchIcon">search</i>
                    </div>
                </form>
            </div>
            <div class="col s2 playlist" ng-show="playlistView">
                <div class="btn blue clickable" ng-click="showNewPlaylist($event);">New Playlist</div>
                <div ng-if="!playlists">No Playlist yet</div>
                <ul class="">
                    <li class="clickable" ng-repeat="playlist in playlists" ng-click="loadPlaylist(playlist);">
                        <img src="./uploads/{{playlist.image_path}}">
                        {{playlist.title}}
                    </li>
                </ul>
            </div>
                
            <div class="col s10 playlistHeader" ng-if="selectedPlaylist">
                <div class="playlistCover" style="background-image: url(./uploads/{{selectedPlaylist.image_path}});"></div>
                <!-- <img src="./uploads/{{selectedPlaylist.image_path}}"> -->
                <h3>
                    {{selectedPlaylist.title}} 
                    <i class="material-icons searchIcon clickable" 
                    title="Edit Playlist" 
                    ng-click="showNewPlaylist($event, selectedPlaylist)"
                    style="margin: -40px 2px; position: absolute;">edit</i>
                </h3>
            </div>
            <div class="col s10 songTable" ng-if="songsList">
                <div class="playlistGrid">
                    <table class="playlistTable">
                        <tr>
                            <th></th>
                            <th>Title</th>
                            <th>Artist</th>
                            <th>Genre</th>
                            <th>Rating</th>
                        </tr>
                        <tr ng-repeat="song in songsList">
                            <td class="audioCell" ng-click="playSong(song.song_id)" id="row_{{song.song_id}}">
                                <div class="playerDisabler"></div>
                                <audio controls id="player_{{song.song_id}}"1>
                                    <source src="./uploads/audio{{song.audio_path}}" type="audio/ogg">
                                    Your browser does not support the audio element.
                                </audio>
                            </td>
                            <td ng-click="playSong(song.song_id)" id="row_{{song.song_id}}">
                                {{song.title}}
                            </td>
                            <td ng-click="playSong(song.song_id)" id="row_{{song.song_id}}">{{song.ArtistName}}</td>
                            <td ng-click="playSong(song.song_id)" id="row_{{song.song_id}}">{{song.genreName}}</td>
                            <td>
                                <div ng-if="song.user_rating != null">
                                    <i class="tiny material-icons yellow-text text-accent-2" ng-if="song.user_rating >= 1" ng-click="saveSongRating(song, 1);">star</i>
                                    <i class="tiny material-icons" ng-if="song.user_rating < 1" ng-click="saveSongRating(song, 1);">star_border</i>
                                    <i class="tiny material-icons yellow-text text-accent-2" ng-if="song.user_rating >= 2" ng-click="saveSongRating(song, 2);">star</i>
                                    <i class="tiny material-icons" ng-if="song.user_rating < 2" ng-click="saveSongRating(song, 2);">star_border</i>
                                    <i class="tiny material-icons yellow-text text-accent-2" ng-if="song.user_rating >= 3" ng-click="saveSongRating(song, 3);">star</i>
                                    <i class="tiny material-icons" ng-if="song.user_rating < 3" ng-click="saveSongRating(song, 3);">star_border</i>
                                    <i class="tiny material-icons yellow-text text-accent-2" ng-if="song.user_rating >= 4" ng-click="saveSongRating(song, 4);">star</i>
                                    <i class="tiny material-icons" ng-if="song.user_rating < 4" ng-click="saveSongRating(song, 4);">star_border</i>
                                    <i class="tiny material-icons yellow-text text-accent-2" ng-if="song.user_rating == 5" ng-click="saveSongRating(song, 5);">star</i>
                                    <i class="tiny material-icons" ng-if="song.user_rating < 5" ng-click="saveSongRating(song, 5);">star_border</i>

                                </div>
                                <div ng-if="song.user_rating == null">

                                    <i class="tiny material-icons" ng-if="song.general_rating >= 1" ng-click="saveSongRating(song, 1);">star</i>
                                    <i class="tiny material-icons" ng-if="song.general_rating < 1" ng-click="saveSongRating(song, 1);">star_border</i>
                                    <i class="tiny material-icons" ng-if="song.general_rating >= 2" ng-click="saveSongRating(song, 2);">star</i>
                                    <i class="tiny material-icons" ng-if="song.general_rating < 2" ng-click="saveSongRating(song, 2);">star_border</i>
                                    <i class="tiny material-icons" ng-if="song.general_rating >= 3" ng-click="saveSongRating(song, 3);">star</i>
                                    <i class="tiny material-icons" ng-if="song.general_rating < 3" ng-click="saveSongRating(song, 3);">star_border</i>
                                    <i class="tiny material-icons" ng-if="song.general_rating >= 4" ng-click="saveSongRating(song, 4);">star</i>
                                    <i class="tiny material-icons" ng-if="song.general_rating < 4" ng-click="saveSongRating(song, 4);">star_border</i>
                                    <i class="tiny material-icons" ng-if="song.general_rating == 5" ng-click="saveSongRating(song, 5);">star</i>
                                    <i class="tiny material-icons" ng-if="song.general_rating < 5" ng-click="saveSongRating(song, 5);">star_border</i>
                                </div>
                            </td>
                            <td>{{song.rating}}</td>
                            <td>
                                <i class="small material-icons" ng-click="songMenuOption($event, song);">more_horiz</i>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id='songMenu' class='songMenu row' ng-show="showSongMenuOption">
                <div class="col s12 clickable"><i class="tiny material-icons">add</i> Add to Playlist</div>
                <div class="col s12">
                    <select id="addToPlaylistDropdDown" 
                        class="browser-default"
                        ng-model="addToPlaylist.playlist_id"
                        ng-options='p.playlist_id as p.title for p in playlists'>
                        <option value="">Select Playlist</option>
                    </select>
                    <button class="btn" ng-click="saveSongToPlaylist();">Save</button>
                    <button class="btn red" ng-click="cancelSongMenuOption();">Cancel</button>
                </div>
            </div>

            <div id='newPlaylisMenu' class='newPlaylisMenu row' ng-show="showNewPlaylisMenu">
                <div class="col s1"></div>
                <div class="col s10">
                <!-- <form name="myForm"> -->
                    <!-- <fieldset> -->
                        <!-- <legend>New Playlist</legend> -->
                        <div>Nea Playlist</div>
                        Title:
                        <input type="text" id="newPlaylist_name" name="userName" ng-model="newPlaylist.title" required>
                        <i ng-show="myForm.userName.$error.required">*required</i>
                        <br>Playlist Cover:
                        <input type="file" 
                                ngf-select 
                                ng-model="picFile" 
                                name="file"    
                                accept="image/*" ngf-max-size="20MB" required
                                ngf-model-invalid="errorFile">
                        <i ng-show="myForm.file.$error.required">*required</i>
                        <img class="imageUploadPreview" ng-show="myForm.file.$valid" ngf-thumbnail="picFile" class="thumb">
                        <br>
                        <button ng-click="picFile = null" ng-show="picFile">Remove</button>
                        <br>
                        <button class="btn blue" ng-disabled="!newPlaylist.title" ng-click="saveNewPlaylist(picFile)">Submit</button>
                        <button class="btn red" ng-click="cancelNewPlaylist(); picFile = null;">Cancel</button>
                        <span ng-show="picFile.result">Upload Successful</span>
                        <span class="err" ng-show="errorMsg">{{errorMsg}}</span>
                    <!-- </fieldset>
                    <br>
                </form> -->
                </div>
            </div>
            <script type="text/javascript" src="./app/home.js"></script>
        </div>
    </div>
    
</body>
</html>
