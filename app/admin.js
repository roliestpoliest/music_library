var app = angular.module('AdminModel', ['SidebarModel','ngFileUpload']);

app.config(['$compileProvider',
    function ($compileProvider) {
        $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|tel|file|blob):/);
    }
]);

app.controller('AdminController', ['$scope', '$http', 'Upload', '$timeout', function ($scope, $http, Upload, $timeout) {
    $scope.pageName = "foo";
    $scope.filterCriteria = {};
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
                console.log($scope.userInfo);
            }
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };
    
    $scope.getAccounts = function() {
        $http({
            url: "/api/accounts.php",
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            $scope.userList = response.data;
            console.log($scope.userList);
        })
    };

    $scope.filterAccountData = function()
    {
        //console.log($scope.filterCriteria);
        var formData = {
            username: $scope.filterCriteria.username,
            user_role: $scope.filterCriteria.user_role,
            gender: $scope.filterCriteria.gender,
            region: $scope.filterCriteria.region
            // Add more properties as needed
        };
        //console.log(formData);
        $http({
            url: "/api/reports/accountReports.php",
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            },
            data: formData
        }).then(function (response) {
            $scope.filteredList = response.data;
            console.log($scope.filteredList);
        }) 

    };
    $scope.filterSongData = function()
    {
        var formData = {
            artist_id: $scope.filterCriteria.artist_id,
            title: $scope.filterCriteria.title,
            genre_id: $scope.filterCriteria.genre_id,
            listens: $scope.filterCriteria.listens,
            rating: $scope.filterCriteria.rating
            // Add more properties as needed
        };
        $http({
        url: "/api/reports/songReports.php",
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            },
            data: formData
        }).then(function (response) {
            $scope.filteredList = response.data;
            console.log($scope.filteredList);
        }) 

    };

    $scope.filterAlbumData = function()
    {
        var formData = {
            album_id: $scope.filterCriteria.album_id,
            record_label: $scope.filterCriteria.record_label,
            artist_id: $scope.filterCriteria.artist_id,
            title: $scope.filterCriteria.title,
            format: $scope.filterCriteria.format,
            rating: $scope.filterCriteria.rating
            // Add more properties as needed
        };
        $http({
        url: "/api/reports/albumReports.php",
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            },
            data: formData
        }).then(function (response) {
            $scope.filteredList = response.data;
            console.log($scope.filteredList);
        }) 

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

    $scope.sortByProperty = function(property) {
        if ($scope.directions[property] == 0) {
            $scope.directions[property] = 1;
            $scope.filteredList.sort((a, b) => (a[property] || "").localeCompare(b[property] || ""));
            // console.log("asc")
        } else {
            $scope.directions[property] = 0;
            $scope.filteredList.sort((a, b) => (b[property] || "").localeCompare(a[property] || ""));
            // console.log("des")
        }
    }

    $scope.sortByNumericProperty = function(property) {
        if ($scope.directions[property] == 0) {
            $scope.directions[property] = 1;
            $scope.filteredList.sort((a, b) => (a[property] || 0) - (b[property] || 0));
            // console.log("asc")
        } else {
            $scope.directions[property] = 0;
            $scope.filteredList.sort((a, b) => (b[property] || 0) - (a[property] || 0));
            // console.log("des")
        }
    }

    $scope.getAccountInfo();
    $scope.getAccounts();
}]);
