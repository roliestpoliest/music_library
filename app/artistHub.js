var app = angular.module('ArtistHubModel', ['SidebarModel','ngFileUpload']);

app.config(['$compileProvider',
    function ($compileProvider) {
        $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|tel|file|blob):/);
    }
]);

app.controller('ArtistHubController', ['$scope', '$http', 'Upload', '$timeout', function ($scope, $http, Upload, $timeout) {
    $scope.formats = [
        {name:"Album"},
        {name:"Single"},
        {name:"EP"},
        {name:"LP"},
        {name:"SP"},
    ];
    $scope.getAlbums = ()=>{
        $http({
            url: "/api/albums.php?myAlbums=true",
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            // console.log(data);
            validateResponse(data)
            $scope.myAlbums = data;
            for(this.i = 0; this.i < $scope.myAlbums.length; this.i++){
                $scope.myAlbums[this.i].release_date = moment($scope.myAlbums[this.i].release_date, 'YYYY-MM-DD').format('MMM DD, YYYY');
            }
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.getGenres = ()=>{
        $http({
            url: "/api/genres.php",
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            if(!validateResponse(data)){
                displayErrorMessage(data.description);
            }else{
                $scope.genres = data;
            }
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.showArtistAlbumHub = ()=>{
        $scope.myAlbumsSection = true;
        $scope.mySongsSection = false;
        $scope.cancelSongMenuOption();
        $scope.getAlbums();
    }

    $scope.saveAlbumRating = function(album, rating){
        var params = {
            "album_id": album.album_id,
            "user_rating":rating
        }
        $http({
            url: "/api/albumRatings.php",
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
                album.user_rating = rating;
            }
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.showArtistSongsHub = ()=>{
        $scope.myAlbumsSection = false;
        $scope.mySongsSection = true;
        $scope.getArtistSongs();
    };

    $scope.getSongsInAlbum = (albumId)=>{
        // console.log(albumId);
        $http({
            url: "/api/songs_in_album.php?album_id=" + albumId,
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            // console.log(data);
            validateResponse(data);
            $scope.songsInAlbum = data;
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.openAlbumDetail = (album)=>{
        if(album != null){
            $scope.selectedAlbum = album;
            $scope.getSongsInAlbum(album.album_id);
        }else{
            $scope.selectedAlbum = {artist_id: $scope.myArtistId};
        }
        $scope.albumCardView = true;
    };

    $scope.getArtists = ()=>{
        $http({
            url: "/api/artists.php",
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data);
            $scope.artistList = [];

            for(this.i = 0; this.i < data.length; this.i++){
                if(data[this.i].account_id.toString() == $scope.myArtistId.toString()){
                    $scope.artistList.push(data[this.i]);
                }
            }
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.saveAlbumInfo = (file)=>{
        $scope.selectedAlbum.files = file;
        $scope.selectedAlbum.release_date = moment($scope.selectedAlbum.release_date, "MMM DD, YYYY").format('YYYY-MM-DD');
        //data: {username: $scope.username, file: file},
        file.upload = Upload.upload({
          url: '/api/albums.php',
          data: $scope.selectedAlbum,
        });
    
        file.upload.then(function (response) {
          $timeout(function () {
            file.result = response.data;
            $scope.albumCardView = false;
            $scope.getAlbums();
          });
        }, function (response) {
          if (response.status > 0)
            $scope.errorMsg = response.status + ': ' + response.data;
        }, function (evt) {
          // Math.min is to fix IE which reports 200% sometimes
          file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        });
    };

    $scope.saveSongInfo = () =>{
        var file = document.getElementById('audioFile').files,
        r = new FileReader();
        if(!$scope.selectedSong.song_id && !file){
            displayErrorMessage("A new song requires an attached audio file");
            return;
        }
        
        if(file != null){
            $scope.selectedSong.audioFile = file;
        }
        file.upload = Upload.upload({
        url: '/api/songs.php',
        data: $scope.selectedSong,
      });
        file.upload.then(function (response) {
          $timeout(function () {
            file.result = response.data;
            $scope.songCardView = false;
            $scope.getArtistSongs();
          });
        }, function (response) {
          if (response.status > 0)
            $scope.errorMsg = response.status + ': ' + response.data;
        }, function (evt) {
          // Math.min is to fix IE which reports 200% sometimes
          file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        });
    };
    
    $scope.deleteAlbumButton = ()=>{
        if(confirm("Are you sure you want to delete this album?")){
            $http({
                url: "/api/albums.php",
                method: "DELETE",
                data: $scope.selectedAlbum,
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": localStorage.getItem("token")
                }
            }).then(function (response) {
                var data = response.data;
                validateResponse(data);
                $scope.showArtistAlbumHub();
                $scope.albumCardView = false;
                $scope.myAlbums = data;
                alert("Album successfully deleted!")
            },
            function errorCallback(response) {
                validateStatusCode(response, true);
                $scope.loading = false;
            });
        }
    };

    $scope.deleteSongButton = ()=>{
        // console.log($scope.selectedAlbum);
        if(confirm("Are you sure you want to delete this song?")){
            $http({
                url: "/api/songs.php",
                method: "DELETE",
                data: $scope.selectedSong,
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
            $scope.songCardView = false; 
            $scope.getArtistSongs();
            $scope.showArtistSongsHub();
            alert("Song sucessfully deleted!")
        }
    };

    $scope.getArtistSongs = ()=>{
        $http({
            url: "/api/songs.php?artist_id=true",
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data)
            $scope.artistSongs = data;
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.editSong = (song)=>{
        if(song != null){
            $scope.selectedSong = song;
        }else{
            $scope.selectedSong = null;
        }
        $scope.songCardView = true;
    };

    $scope.songMenuOption = function($event, song){
        $scope.getAlbums();
        $scope.selectedMenuSong = song;
        $scope.showSongMenuOption = true;
        $('#songMenu').css({'top':$event.clientY + 10, 'left':$event.clientX - 300});
    };
    $scope.cancelSongMenuOption = ()=>{
        $scope.showSongMenuOption = false;
        if($scope.selectedMenuSong != null){
            $scope.selectedMenuSong.song_id = null;
        }
        if($scope.addToAlbum != null){
            $scope.addToAlbum.album_id = null;
        }
    };

    $scope.saveSongToAlbum = ()=>{
        var params = {
            "song_id": $scope.selectedMenuSong.song_id,
            "album_id":$scope.addToAlbum.album_id
        };
        $http({
            url: "/api/songs_in_album.php",
            method: "POST",
            data: params,
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            // console.log(response.data);
            validateResponse(data);
            $scope.cancelSongMenuOption();
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.RemoveSongFromAlbum = (songId, albumId)=>{
        var params = {
            "song_id": songId,
            "album_id": albumId
        };
        $http({
            url: "/api/songs_in_album.php",
            method: "DELETE",
            data: params,
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            console.log(response.data);
            validateResponse(data);
            // $scope.cancelSongMenuOption();
            $scope.getSongsInAlbum(albumId);
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    }

    $scope.getuserInfo = function(callback){
        $http({
            url: "/api/artists.php?getArtistId=true",
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data);
            $scope.myArtistId = parseInt(data);
            if(callback){callback()};
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
        });
    }; 


    $scope.getuserInfo(function(){
        $scope.getArtists();
        $scope.getArtistSongs();
    });
    $scope.getGenres();
    $scope.getArtistSongs();
}]);