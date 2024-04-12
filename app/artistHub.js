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
            console.log(data);
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

    $scope.getGeres = ()=>{
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

    $scope.openAlbumDetail = (album)=>{
        if(album != null){
            $scope.selectedAlbum = album;
        }else{
            $scope.selectedAlbum = null;
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
            if(!validateResponse(data)){
                displayErrorMessage(data.description);
            }else{
                $scope.artistList = data;
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
            if(!validateResponse(data)){
                displayErrorMessage(data.description);
            }else{
                $scope.albumCardView = false;
            }
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
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

    $scope.getArtists();
    $scope.getGeres();
}]);