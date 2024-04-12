var app = angular.module('HomeModel', ['SidebarModel','ngFileUpload']);

app.config(['$compileProvider',
    function ($compileProvider) {
        $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|tel|file|blob):/);
    }
]);
// app.controller('HomeController', function ($scope, $http) {
app.controller('HomeController', ['$scope', '$http', 'Upload', '$timeout', function ($scope, $http, Upload, $timeout) {
    $scope.playlistView = true;
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
            console.log(data);
            if(!validateResponse(data)){
                displayErrorMessage(data.description);
            }else{
                $scope.playlists = data;
                console.log($scope.playlists);
            }
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
            if(!validateResponse(data)){
                displayErrorMessage(data.description);
            }else{
                song.user_rating = rating;
            }
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
            $scope.playlistView = true;
            $scope.SearchView = false;
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
            if(!validateResponse(data)){
                displayErrorMessage(data.description);
            }else{
                $scope.cancelSongMenuOption();
                $scope.getPlaylist();
            }
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };
    $scope.cancelSongMenuOption = function(){
        $scope.showSongMenuOption = false;
        $scope.selectedMenuSong.song_id = null;
        $scope.addToPlaylist.playlist_id = null;
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
        $scope.newPlaylist = null;
    };
    $scope.saveNewPlaylist = function(file){
        console.log(file);
        if(file){
            $scope.newPlaylist.file = file;
        }
        // return;
        file.upload = Upload.upload({
            url: '/api/playlists.php',
            data: $scope.newPlaylist,
          });
      
          file.upload.then(function (response) {
            $timeout(function () {
              console.log(response.data);
              $scope.cancelNewPlaylist();
              file = null;
              $scope.getPlaylist();
            });
          }, function (response) {
            if (response.status > 0)
              $scope.errorMsg = response.status + ': ' + response.data;
          }, function (evt) {
            // Math.min is to fix IE which reports 200% sometimes
            file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
          });
    };

    $scope.getPlaylist();
}]);