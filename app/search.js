var app = angular.module('SearchModel', ['SidebarModel','ngFileUpload']);

app.config(['$compileProvider',
    function ($compileProvider) {
        $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|tel|file|blob):/);
    }
]);

app.controller('SearchController', ['$scope', '$http', 'Upload', '$timeout', function ($scope, $http, Upload, $timeout) {
    $scope.showSearchView = function(){
        $scope.SearchView = true;
        $scope.playlistView = false;
        setTimeout(() => {
            $("#searchBar").select();
        }, 500);
    }

    $scope.searchSong = function(playlist){
        $scope.selectedPlaylist = angular.copy(playlist);
        $http({
            url: "/api/songs.php?search=" + $scope.searchTerm,
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data);
            $scope.songsList = data;
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
            console.log(data);
            validateResponse(data);
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
        if($scope.addToPlaylist != null){
            $scope.addToPlaylist.playlist_id = null;
        }
    };
    setTimeout(() => {
        $('#searchBar').focus();
    }, 500);
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
    $scope.getPlaylist();
}]);