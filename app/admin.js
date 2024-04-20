var app = angular.module('AdminModel', ['SidebarModel','ngFileUpload']);

app.config(['$compileProvider',
    function ($compileProvider) {
        $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|tel|file|blob):/);
    }
]);

app.controller('AdminController', ['$scope', '$http', 'Upload', '$timeout', function ($scope, $http, Upload, $timeout) {
    $scope.pageName = "foo";
    $scope.regions = [];
    $scope.toDate = function(dateString) {
        return new Date(dateString);
    };

    $scope.getAccountInfo = function(){
        $http({
            url: "/api/accounts.php?account_id=true",
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
                $scope.userInfo = data;
                $scope.userInfo.DOB = moment($scope.userInfo.DOB, "YYYY-MM-DD").format('MMM DD, YYYY');
            }
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
        });
    };
    
    /* $scope.getAccounts = function() {
        $http({
            url: "/api/accounts.php",
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            $scope.userList = response.data;
            $scope.userListObject = response.data;
            $scope.userList.forEach(user => {
                if(!$scope.regions.includes(user.region)){
                    $scope.regions.push(user.region);
                }
            });
        })
    }; */


    $scope.getAccountsReport = function() {
        $http({
            url: "/api/accounts.php?accountReport=true",
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            $scope.userList = response.data;
            $scope.userListObject = response.data;
            $scope.userList.forEach(user => {
                if(!$scope.regions.includes(user.region)){
                    $scope.regions.push(user.region);
                }
            });
        })
    }; 

    $scope.userFilter = [];

    $scope.filterUserList = ()=>{
        $scope.userList = [];
        $scope.userListObject.forEach(user => {
            const check = [1, 1, 1, 1, 1];
            let canAdd = [1, 1, 1, 1, 1];
            if(!isEmptyOrNull($scope.userFilter.role) && user.user_role != $scope.userFilter.role){
                canAdd[0] = 0;
            }
            if(!isEmptyOrNull($scope.userFilter.region) && user.region != $scope.userFilter.region){
                canAdd[1] = 0;
            }
            if(!isEmptyOrNull($scope.userFilter.gender) && user.gender != $scope.userFilter.gender){
                canAdd[2] = 0;
            }
            if(!isEmptyOrNull($scope.userFilter.startDate))
            {
                var memberSinceDate = $scope.toDate(user.member_since);
                var filterStartDate = $scope.toDate($scope.userFilter.startDate);
                if (memberSinceDate < filterStartDate) {
                    canAdd[3] = 0;
                }
            
            }
            if(!isEmptyOrNull($scope.userFilter.endDate))
            {
                var memberSinceDate = $scope.toDate(user.member_since);
                var filterEndDate = $scope.toDate($scope.userFilter.endDate);
                if (memberSinceDate > filterEndDate) {
                    canAdd[4] = 0;
                }
            }
            if(check.toString() == canAdd.toString()){
                $scope.userList.push(user);
            }
        });
    };
    $scope.songFilter = [];
    $scope.filterSongsReport = ()=>{
        $scope.songsReport = [];
        $scope.songsReportObject.forEach(song => {
            const check = [1,1,1,1,1];
            let canAdd = [1,1,1,1,1]
            if(!isEmptyOrNull($scope.songFilter.artist) && $scope.songFilter.artist != song.artist_name){
                canAdd[0] = 0;
            }
            if(!isEmptyOrNull($scope.songFilter.genre) && $scope.songFilter.genre != song.genre){
                canAdd[1] = 0;
            }
            if(!isEmptyOrNull($scope.songFilter.rating) && $scope.songFilter.rating != song.general_rating){
                canAdd[2] = 0;
            }
            if(!isEmptyOrNull($scope.songFilter.startDate))
            {
                var releaseDate = $scope.toDate(song.release_date);
                var filterStartDate = $scope.toDate($scope.songFilter.startDate);
                if (releaseDate < filterStartDate) {
                    canAdd[3] = 0;
                }
            
            }
            if(!isEmptyOrNull($scope.songFilter.endDate))
            {
                var releaseDate = $scope.toDate(song.release_date);
                var filterEndDate = $scope.toDate($scope.songFilter.endDate);
                if (releaseDate > filterEndDate) {
                    canAdd[4] = 0;
                }
            }
        
            if(check.toString() == canAdd.toString()){
                $scope.songsReport.push(song);
            }
        });
    };

    $scope.albumFilter = [];
    $scope.filterAlbumReport = ()=>{
        $scope.albumReport = [];
        $scope.albumReportObject.forEach(album => {
            const check = [1,1,1,1,1];
            let canAdd = [1,1,1,1,1]
            if(!isEmptyOrNull($scope.albumFilter.artist) && $scope.albumFilter.artist != album.artist_name){
                canAdd[0] = 0;
            }
            if(!isEmptyOrNull($scope.albumFilter.format) && $scope.albumFilter.format != album.format){
                canAdd[1] = 0;
            }
            if(!isEmptyOrNull($scope.albumFilter.rating) && $scope.albumFilter.rating != album.general_rating){
                canAdd[2] = 0;
            }
            if(!isEmptyOrNull($scope.albumFilter.startDate))
            {
                var releaseDate = $scope.toDate(album.release_date);
                var filterStartDate = $scope.toDate($scope.albumFilter.startDate);
                if (releaseDate < filterStartDate) {
                    canAdd[3] = 0;
                }
            
            }
            if(!isEmptyOrNull($scope.albumFilter.endDate))
            {
                var releaseDate = $scope.toDate(album.release_date);
                var filterEndDate = $scope.toDate($scope.albumFilter.endDate);
                if (releaseDate > filterEndDate) {
                    canAdd[4] = 0;
                }
            }
        
            if(check.toString() == canAdd.toString()){
                $scope.albumReport.push(album);
            }
        });
    };

    $scope.directions = {
        account_id: 0,
        user_role: 0,
        fname: 0,
        lname: 0,
        username: 0,
        bio: 0,
        gender: 0,
        DOB: 0,
        region: 0,
        email: 0,
    }

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
        });
    };

    $scope.showGenresSections = () => {
        $scope.generesView = true;
        $scope.reportsView = false;
    };

    $scope.showReportsSections = () => {
        $scope.generesView = false;
        $scope.reportsView = true;
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
        });
    };

    $scope.getSongsReport = ()=>{
        $http({
            url: "/api/songs.php?songReport=true",
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data)
            $scope.songsReport = data;
            $scope.songsReportObject = data;
            $scope.songFilter = {
                artists: []
            }
            $scope.songsReport.forEach(song => {
                if(!$scope.songFilter.artists.includes(song.artist_name)){
                    $scope.songFilter.artists.push(song.artist_name);
                }
            });
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
        });
    };

    $scope.getAlbumsReport = ()=>{
        $http({
            url: "/api/albums.php?albumReport=true",
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            validateResponse(data)
            $scope.albumReport = data;
            $scope.albumReportObject = data;
            $scope.ambumFormats = [];
            $scope.albumReport.forEach(album => {
                if(!$scope.ambumFormats.includes(album.format)){
                    $scope.ambumFormats.push(album.format);
                }
            });
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
        });
    }; 

    $scope.showReport = (report) => {
        $scope.userReportView = false;
        $scope.artistReportView = false;
        $scope.songReportView = false;
        $scope.albumReportView = false;
        switch (report) {
            case "user":
                $scope.userReportView = true;
                break;
            case "artist":
                $scope.artistReportView = true;
                break;
            case "song":
                $scope.songReportView = true;
                break;
            case "album":
                $scope.albumReportView = true;
            default:
                break;
        }
    };

    $scope.sortByProperty = function(property, reportName) {
        if ($scope.directions[property] == 0) {
            $scope.directions[property] = 1;
            switch (reportName) {
                case 'userList':
                    $scope.userList.sort((a, b) => (a[property] || "").localeCompare(b[property] || ""));
                case 'artistList':
                    $scope.artistList.sort((a, b) => (a[property] || "").localeCompare(b[property] || ""));
                    break;
                case 'albumReport':
                    $scope.albumReport.sort((a, b) => (a[property] || "").localeCompare(b[property] || ""));
                    break;
                case 'songsReport':
                    $scope.songsReport.sort((a, b) => (a[property] || "").localeCompare(b[property] || ""));
                    break;
                default:
                    break;
            }
        } else {
            $scope.directions[property] = 0;
            switch (reportName) {
                case 'userList':
                    $scope.userList.sort((a, b) => (b[property] || "").localeCompare(a[property] || ""));
                case 'artistList':
                    $scope.artistList.sort((a, b) => (b[property] || "").localeCompare(a[property] || ""));
                    break;
                case 'albumReport':
                    $scope.albumReport.sort((a, b) => (b[property] || "").localeCompare(a[property] || ""));
                    break;
                case 'songsReport':
                    $scope.songsReport.sort((a, b) => (b[property] || "").localeCompare(a[property] || ""));
                    break;
                default:
                    break;
            }
            
        }
    }

    $scope.sortByNumericProperty = function(property, reportName) {
        if ($scope.directions[property] == 0) {
            $scope.directions[property] = 1;
            switch (reportName) {
                case 'userList':
                    $scope.userList.sort((a, b) => (a[property] || 0) - (b[property] || 0));
                case 'artistList':
                    $scope.artistList.sort((a, b) => (a[property] || 0) - (b[property] || 0));
                    break;
                case 'albumReport':
                    $scope.albumReport.sort((a, b) => (a[property] || 0) - (b[property] || 0));
                    break;
                case 'songsReport':
                    $scope.songsReport.sort((a, b) => (a[property] || 0) - (b[property] || 0));
                    break;
                default:
                    break;
            }
        } else {
            $scope.directions[property] = 0;
            switch (reportName) {
                case 'userList':
                    $scope.userList.sort((a, b) => (b[property] || 0) - (a[property] || 0));
                case 'artistList':
                    $scope.artistList.sort((a, b) => (b[property] || 0) - (a[property] || 0));
                    break;
                case 'albumReport':
                    $scope.albumReport.sort((a, b) => (b[property] || 0) - (a[property] || 0));
                    break;
                case 'songsReport':
                    $scope.songsReport.sort((a, b) => (b[property] || 0) - (a[property] || 0));
                    break;
                default:
                    break;
            }
        }
    };

    $scope.showDeleteUserWarning = (user) => {
        $scope.selectedUser = angular.copy(user);
        $scope.deleteUserWarning = true;
    };
    $scope.hideDeleteUserWarning = () => {
        $scope.deleteUserWarning = false;
    };

    $scope.deleteUser = ()=>{
        console.log($scope.selectedUser);
        $http({
            url: "/api/accounts.php",
            method: "DELETE",
            data: $scope.selectedUser,
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            console.log(data);
            validateResponse(data);
            $scope.hideDeleteUserWarning();
            $scope.getAccounts();
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
        });
    };

    $scope.getAccountInfo();
    $scope.getAccounts();
    $scope.getGenres();
    $scope.getArtists();
    $scope.getSongsReport();
    $scope.getAlbumsReport();
}]);
