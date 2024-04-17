var app = angular.module('SubscriptionModel', ['SidebarModel','ngFileUpload']);

app.config(['$compileProvider',
    function ($compileProvider) {
        $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|tel|file|blob):/);
    }
]);

app.controller('SubscriptionController', ['$scope', '$http', 'Upload', '$timeout', function ($scope, $http, Upload, $timeout) {
    $scope.newPayment = {};
    $scope.newSubscription = {};
    $scope.description = [
        {
            name:"Prenium",
            price: 10.99
        },
        {
            name:"Student Prenium",
            price: 5.99
        }
    ];


    $scope.submitSubscription = function(){
        // console.log($scope.login);
        var currentDate = new Date();
        $scope.newSubscription.start_date = moment(currentDate, "MMM DD, YYYY").format('YYYY-MM-DD');
        $scope.newSubscription.length = 30;
        var endDate = new Date();
        endDate.setDate(currentDate.getDate() + $scope.newSubscription.length);
        $scope.newSubscription.end_date = moment(endDate, "MMM DD, YYYY").format('YYYY-MM-DD');
        //$scope.account_id = 1;
        $http({
            url: "/api/subscriptions.php",
            method: "POST",
            data: $scope.newSubscription,
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            console.log(data);
            if(!validateResponse(data)){
                displayErrorMessage(data.description);
            }else{
                //location.assign('/home.php');
                console.log(data);
            }
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };


    $scope.getSubscriptionPrice = function(description) {
        // Find the selected subscription plan by its name
        var selectedPlan = $scope.description.find(function(plan) {
            return plan.name === description;
        });

        // Return the price of the selected plan
        if (selectedPlan) {
            $scope.newSubscription.price = selectedPlan.price.toFixed(2);
            console.log($scope.newSubscription.description);
            console.log($scope.newSubscription.price);
            /*var currentDate = new Date();
            //$scope.newSubscription.start_date = currentDate;
            $scope.newSubscription.start_date = moment(currentDate, "MMM DD, YYYY").format('YYYY-MM-DD');
            $scope.newSubscription.length = 30;
            var endDate = new Date();
            endDate.setDate(currentDate.getDate() + $scope.newSubscription.length);
            //$scope.newSubscription.end_date = endDate;
            $scope.newSubscription.end_date = moment(endDate, "MMM DD, YYYY").format('YYYY-MM-DD');
            console.log($scope.newSubscription.start_date);
            console.log($scope.newSubscription.length);
            console.log($scope.newSubscription.end_date); */
            return selectedPlan.price.toFixed(2); // Format the price with two decimal places
        } else {
            return "N/A"; // If no plan is selected, display "N/A"
        }
    };
  





    //$scope.getAccountInfo();
}]);