var app = angular.module('ArtistPageModel', ['SidebarModel','ngFileUpload']);

app.config(['$compileProvider',
    function ($compileProvider) {
        $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|tel|file|blob):/);
    }
]);
// app.controller('artist_pageController', function ($scope, $http) {
app.controller('ArtistPageController', function ($scope, $http) {
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
            $scope.artistList = data;
            $scope.loadOptions();
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
        });
    };

    $scope.getAlbums = (callback)=>{
        $http({
            url: "/api/albums.php?artist_id=" + $scope.selectedArtist.artist_id,
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data)
            $scope.artistAlbums = data;
            if($scope.artistAlbums != null){
                for(this.i = 0; this.i < $scope.artistAlbums.length; this.i++){
                    $scope.artistAlbums[this.i].release_date = moment($scope.artistAlbums[this.i].release_date, 'YYYY-MM-DD').format('MMM DD, YYYY');
                }
            }
            if(callback)(callback());
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.getSongsInAlbum = (albumId)=>{
        for(this.i = 0; this.i < $scope.artistAlbums.length; this.i++){
            if($scope.artistAlbums[this.i].album_id == albumId){
                $scope.selectedAlbum = $scope.artistAlbums[this.i];
                break;
            }
            $scope.artistAlbums[this.i].release_date = moment($scope.artistAlbums[this.i].release_date, 'YYYY-MM-DD').format('MMM DD, YYYY');
        }
        
        $http({
            url: "/api/songs_in_album.php?album_id=" + albumId,
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data);
            $scope.songsInAlbum = data;
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.isFollowingArtist = ()=>{
        $http({
            url: "/api/followed_artists.php?isFollowing=" + $scope.selectedArtist.artist_id,
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data);
            $scope.isFollowing = data;
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.followArtist = ()=>{
        var params = {
            artist_id: $scope.selectedArtist.artist_id
        };

        $http({
            url: "/api/followed_artists.php",
            method: "POST",
            data:params,
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data);
            $scope.isFollowingArtist();
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.unFollowArtist = ()=>{
        var params = {
            artist_id: $scope.selectedArtist.artist_id
        };

        $http({
            url: "/api/followed_artists.php",
            method: "DELETE",
            data:params,
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data);
            $scope.isFollowingArtist();
            // $scope.songsInAlbum = data;
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.selectArtist = (artist)=>{
        $scope.selectedArtist = artist;
        $scope.isFollowingArtist();
        $scope.getAlbums();
    };

    $scope.loadOptions = ()=>{
        var albumId = getURLParameterValue("albumId");
        var artistId = getURLParameterValue("artistId");
        if (!isEmptyOrNull(albumId) && !isEmptyOrNull(artistId)) {
            for(this.i = 0; this.i < $scope.artistList.length; this.i++){
                if($scope.artistList[this.i].artist_id == artistId){
                    $scope.selectedArtist = $scope.artistList[this.i];
                    $scope.getAlbums(()=>{$scope.getSongsInAlbum(albumId);});
                    break;
                }
            }
            
            $scope.getAlbums();
        }
    };

    $scope.getArtists();
});