<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <?php include('./headers.php'); ?>
    <link rel="stylesheet" href="./style/artist_page.css">
</head>
<body ng-app="ArtistPageModel" ng-controller="ArtistPageController" ng-cloak>
    <div class="row">
        <?php include('./sidebar.php');?>
        <div class="col s10">
            <div class="row">
                <div class="col s2 sidebar">
                    <div class="sidebarButton" 
                        ng-click="selectArtist(artist);"
                        ng-repeat="artist in artistList">
                        <div class="avatar_mini" style="background-image: url(./uploads/{{artist.image_path}});"></div>
                        <span>{{artist.artist_name}}</span>
                    </div>
                </div>
                <div class="col s10">
                    <div class="avatar_jumbo" style="background-image: url(./uploads/{{selectedArtist.image_path}});"></div>
                    <h3 class="text_center">{{selectedArtist.artist_name}}</h3>
                    <div class="text_center">
                        <span class="bth black followButton" 
                            ng-if="selectedArtist.artist_name && isFollowing == 0"
                            ng-click="followArtist();">Follow</span>
                        <div class="text_center">
                            <span class="bth red followButton" 
                                ng-if="selectedArtist.artist_name && isFollowing > 0"
                                ng-click="unFollowArtist();">Unfollow</span>
                    </div>
                    <h6 class="text_center"><i>{{selectedArtist.bio}}</i></h6>
                </div>
                <div class="col s10">
                    <div class="row">
                        <div class="col s3">
                            <div class="sidebarButton albumCover"
                            ng-repeat="album in artistAlbums"
                            ng-click="getSongsInAlbum(album.album_id);"
                            style="background-image: url(./uploads/{{album.image_path}});">
                            <div class="text_center">
                                <h5>{{album.title}}</h5>
                                <div class="albumTitle">{{album.release_date}}</div>
                                <div class="albumRating">
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
                                </div>

                            </div>
                        </div>
                        </div>
                        <div class="col s9">
                            <hr>
                            <h5 class="text_center"><i>{{selectedAlbum.title}}</i></h5>
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
    </div>
    <script type="text/javascript" src="./app/artist-page.js"></script>
</body>
</html>