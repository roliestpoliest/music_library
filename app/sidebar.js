var SidebarModel = angular.module('SidebarModel', []);

SidebarModel.controller('SidebarController', function ($scope, $http) {
    $scope.getRole = function(){
        $http({
            url: "/api/accounts.php?role=true",
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
                $scope.user_role = data;
            }
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    }; 

    $scope.logOff = function(){
        $http({
            url: "/api/login.php",
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            if(!validateResponse(data)){
                displayErrorMessage(data.description);
            }
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.getRole();
});