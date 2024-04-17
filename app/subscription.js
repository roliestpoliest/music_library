var app = angular.module('SubscriptionModel', ['SidebarModel','ngFileUpload']);

app.config(['$compileProvider',
    function ($compileProvider) {
        $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|tel|file|blob):/);
    }
]);

app.controller('SubscriptionController', ['$scope', '$http', 'Upload', '$timeout', function ($scope, $http, Upload, $timeout) {
    $scope.months; 
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
    $scope.payment_source = [
        {
            name:"MasterCard"
        },
        {
            name:"Visa"
        },
        {
            name:"Discover"
        },
        {
            name:"American Express"
        }
    ]


    $scope.submitSubscription = function(){
        // console.log($scope.login);
        var currentDate = new Date();
        $scope.newSubscription.start_date = moment(currentDate, "MMM DD, YYYY").format('YYYY-MM-DD');
        $scope.newPayment.payment_date = $scope.newSubscription.start_date;
        $scope.newSubscription.length = 30;
        $scope.newPayment.total = $scope.newSubscription.price; // later on total would be price * amount of months.
        var endDate = new Date();
        endDate.setDate(currentDate.getDate() + $scope.newSubscription.length);
        $scope.newSubscription.end_date = moment(endDate, "MMM DD, YYYY").format('YYYY-MM-DD');
        //$scope.account_id = 1;
        console.log($scope.newPayment);
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
            $http({
                url: "/api/transactions.php",
                method: "POST",
                data: $scope.newPayment,
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": localStorage.getItem("token")
                }
            }).then(function (response2) {
                var data2 = response2.data;
                console.log(data2);
                if(!validateResponse(data2)){
                    displayErrorMessage(data2.description);
                }else{
                    //location.assign('/home.php');
                    console.log(data);
                }
            },
            function errorCallback(response2) {
                validateStatusCode(response2, true);
                $scope.loading = false;
            });

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
            $scope.newPayment.price = selectedPlan.price.toFixed(2);
            console.log($scope.newSubscription.description);
            console.log($scope.newSubscription.price);
            console.log($scope.newPayment.payment_source)
            return selectedPlan.price.toFixed(2); // Format the price with two decimal places
        } else {
            return "N/A"; // If no plan is selected, display "N/A"
        }
    };
  





    //$scope.getAccountInfo();
}]);