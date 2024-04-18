var SidebarModel = angular.module('SidebarModel', []);

SidebarModel.controller('SidebarController', function ($scope, $http) {
    $scope.notificationView = false; 
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
            validateResponse(data);
            $scope.user_role = data;
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

    $scope.getNotifications = function(){
        $http({
            url: "/api/notifications.php",
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            console.log(data);
            validateResponse(data);
            $scope.notifications = data;
            $scope.notificationView = true;
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.notificationView = false;

    $scope.getRole();
    
    setInterval(() => {
        $scope.getRole();
    }, 1000);
});