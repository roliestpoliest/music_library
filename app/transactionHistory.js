var app = angular.module('TransactionModel', ['SidebarModel','ngFileUpload']);

app.config(['$compileProvider',
    function ($compileProvider) {
        $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|tel|file|blob):/);
    }
]);

app.controller('TransactionController', ['$scope', '$http', 'Upload', '$timeout', function ($scope, $http, Upload, $timeout) {
    $scope.getTransactionInfo = function(){
        $http({
            url: "/api/transactions.php?account_id=true",
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
                $scope.transactionInfo = data;
                console.log($scope.transactionInfo);
            }
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
        });
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
    }




    $scope.getTransactionInfo();
}]);