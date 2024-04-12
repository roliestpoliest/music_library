var app = angular.module('AdminModel', ['SidebarModel','ngFileUpload']);

app.config(['$compileProvider',
    function ($compileProvider) {
        $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|tel|file|blob):/);
    }
]);

app.controller('AdminController', ['$scope', '$http', 'Upload', '$timeout', function ($scope, $http, Upload, $timeout) {
    $scope.pageName = "foo";

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
            $scope.userList.sort((a, b) => (a[property] || "").localeCompare(b[property] || ""));
            // console.log("asc")
        } else {
            $scope.directions[property] = 0;
            $scope.userList.sort((a, b) => (b[property] || "").localeCompare(a[property] || ""));
            // console.log("des")
        }
    }

    $scope.sortByNumericProperty = function(property) {
        if ($scope.directions[property] == 0) {
            $scope.directions[property] = 1;
            $scope.userList.sort((a, b) => (a[property] || 0) - (b[property] || 0));
            // console.log("asc")
        } else {
            $scope.directions[property] = 0;
            $scope.userList.sort((a, b) => (b[property] || 0) - (a[property] || 0));
            // console.log("des")
        }
    }

    $scope.getAccountInfo();
    $scope.getAccounts();
}]);
