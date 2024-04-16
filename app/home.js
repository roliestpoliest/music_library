var app = angular.module('HomeModel', ['SidebarModel','ngFileUpload']);

app.config(['$compileProvider',
    function ($compileProvider) {
        $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|tel|file|blob):/);
    }
]);
// app.controller('HomeController', function ($scope, $http) {
app.controller('HomeController', ['$scope', '$http', 'Upload', '$timeout', function ($scope, $http, Upload, $timeout) {
    $scope.playlistView = true;
    $scope.recentlyAddedSongsView = true;
    $scope.getRecentSongs = function(){
        $http({
            url: "/api/songs.php?recentSongs=true",
            method: "GET",
            data: $scope.login,
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data);
            $scope.suggestedSongs = data;
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };
    //newReleases
    $scope.getNewAlbumReleases = function(){
        $http({
            url: "/api/albums.php?newReleases=true",
            method: "GET",
            data: $scope.login,
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data);
            $scope.albumReleases = data;
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.goToAlbumPage = function(artistId, albumId){
        location.assign('/artist_page.php?albumId=' + albumId + "&artistId=" + artistId);
    };

    $scope.getPlaylist = function(){
        $http({
            url: "/api/playlists.php?account_id=true",
            method: "GET",
            data: $scope.login,
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data);
            $scope.playlists = data;
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.saveSongRating = function(song, rating){
        var params = {
            "song_id": song.song_id,
            "user_rating":rating
        }
        $http({
            url: "/api/songRatings.php",
            method: "POST",
            data: params,
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data);
            song.user_rating = rating;
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };
    
    $scope.increasePlayCount = function(songId){
        $http({
            url: "/api/songs.php?playCount=" + songId,
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data);
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.loadPlaylist = function(playlist){
        $scope.selectedPlaylist = angular.copy(playlist);
        $http({
            url: "/api/songs.php?playlist_id=" + playlist.playlist_id,
            method: "GET",
            data: $scope.login,
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            $scope.songsList = data;
            $scope.cancelSongMenuOption();
            $scope.cancelNewPlaylist();
            $scope.playlistView = true;
            $scope.recentlyAddedSongsView = false;
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.playSong = function(songId){
        if($scope.currentlyPlaying == songId && $scope.isPaused != true){
            $('#player_'+$scope.currentlyPlaying).trigger("pause");
            $scope.isPaused = true;
        }else{
            $('.selected').removeClass('selected');
            $('audio').trigger("pause");
            $scope.increasePlayCount(songId);
            $scope.currentlyPlaying = songId;
            $('#player_'+$scope.currentlyPlaying).trigger("play");
            $('#row_' + $scope.currentlyPlaying).addClass('selected');
            $scope.isPaused = false;
        }
        $scope.currentlyPlaying = songId;
    };

    $scope.songMenuOption = function($event, song){
        $scope.selectedMenuSong = song;
        $scope.showSongMenuOption = true;
        $('#songMenu').css({'top':$event.clientY + 10, 'left':$event.clientX - 200});
    };
    $scope.saveSongToPlaylist = function(){
        var params = {
            "song_id": $scope.selectedMenuSong.song_id,
            "playlist_id":$scope.addToPlaylist.playlist_id
        };
        $http({
            url: "/api/songs_in_playlist.php",
            method: "POST",
            data: params,
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data);
            $scope.cancelSongMenuOption();
            $scope.getPlaylist();
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };
    $scope.removeFromPlaylist = function(){
        var params = {
            "song_id": $scope.selectedMenuSong.song_id,
            "playlist_id":$scope.selectedPlaylist.playlist_id
        };
        $http({
            url: "/api/songs_in_playlist.php",
            method: "DELETE",
            data: params,
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data);
            $scope.addToPlaylist = {};
            $scope.cancelSongMenuOption();
            $scope.getPlaylist();
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };
    $scope.cancelSongMenuOption = function(){
        $scope.showSongMenuOption = false;
        if($scope.selectedMenuSong != null){
            $scope.selectedMenuSong.song_id = null;
        }
        $scope.addToPlaylist = {};
    };

    $scope.showNewPlaylist = function($event, playlist){
        if(playlist != null){
            $scope.newPlaylist = playlist;
        }
        $scope.showNewPlaylisMenu = true;
        $('#newPlaylisMenu').css({'top':$event.clientY + 10, 'left':$event.clientX - 200});
        setTimeout(() => {
            $('#newPlaylist_name').focus();
        }, 500);
    };
    $scope.cancelNewPlaylist = function(){
        $scope.showNewPlaylisMenu = false;
        $scope.newPlaylist = {};
    };
    $scope.saveNewPlaylist = function(){
        $http({
            url: "/api/playlists.php",
            method: "PUT",
            data: $scope.newPlaylist,
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data);
            $scope.cancelNewPlaylist();
            $scope.getPlaylist();
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };
    $scope.showUpdatePlaylistImageView = function(){
        $scope.updatePlaylistImage = true;
    };
    $scope.hideUpdatePlaylistImageView = function(){
        $scope.updatePlaylistImage = false;
    };
    $scope.savePlaylistImage = function(file){
        if(file){
            $scope.selectedPlaylist.file = file;
        }
        // return;
        file.upload = Upload.upload({
            url: '/api/playlists.php',
            data: $scope.selectedPlaylist,
          });
      
          file.upload.then(function (response) {
            $timeout(function () {
              $scope.hideUpdatePlaylistImageView();
              file = null;
              $scope.getPlaylist();
              setTimeout(() => {
                for(this.i = 0; this.i < $scope.playlists.length; this.i++){
                    if($scope.playlists[this.i].playlist_id == $scope.selectedPlaylist.playlist_id){
                        $scope.selectedPlaylist = $scope.playlists[this.i];
                        $scope.loadPlaylist($scope.selectedPlaylist);
                        break;
                    }
                  }  
              }, 300);
              
            });
          }, function (response) {
            if (response.status > 0)
              $scope.errorMsg = response.status + ': ' + response.data;
          }, function (evt) {
            // Math.min is to fix IE which reports 200% sometimes
            file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
          });
    };

    $scope.deletePlaylistButton = function(){
        $http({
            url: "/api/playlists.php",
            method: "DELETE",
            data: $scope.selectedPlaylist,
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data);
            $scope.selectedPlaylist = null;
            $scope.getPlaylist();
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.getPlaylist();
    $scope.getRecentSongs();
    $scope.getNewAlbumReleases();
}]);