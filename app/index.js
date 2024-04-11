//AccessControl

var app = angular.module('LogInModel', []);

app.config(['$compileProvider',
    function ($compileProvider) {
        $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|tel|file|blob):/);
    }
]);

app.controller('LogInController', function ($scope, $http) {
    $scope.pageName = "Hello Foo!";
    var today = moment();
    $scope.newAccount = {
        DOB:moment(today).format('MMM DD, YYYY')
    }
    $scope.genders = [
        {
            name:"Male",
            value:"M"
        },
        {
            name:"Female",
            value:"F"
        }
    ];

    $scope.roles = [
        {
            role:"User"
        },
        {
            role:"Artist"
        },
        {
            role:"Admin"
        }
    ]

    $scope.regions = [
        {
        name:"Northeast",
        },
        {
            name:"Southeast",
        },
        {
            name:"Midwest", 
        },
        {
            name:"Southwest",
        },
        {
        name:"West",
        }
    ];

    $scope.newAccount_submit = function(){
        if($scope.newAccount.DOB != null){
            $scope.newAccount.DOB = moment($scope.newAccount.DOB, "MMM DD, YYYY").format('YYYY-MM-DD');
        }
        console.log($scope.newAccount);1
        $http({
            url: "/api/accounts.php",
            method: "PUT",
            data: $scope.newAccount,
            headers: {
                "Content-Type": "application/json",
                "Authorization": localStorage.getItem("token")
            }
        }).then(function (response) {
            var data = response.data;
            if(!validateResponse(data)){
                displayErrorMessage(data.description);
            }else{
                // location.assign('/login.html');
                $scope.loginWindow = true;
                $('#login.username').focus();
            }
            console.log(data);
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

    $scope.loginFunction = function(){
        $http({
            url: "/api/login.php",
            method: "POST",
            data: $scope.login,
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
                location.assign('/home.php');
            }
        },
        function errorCallback(response) {
            validateStatusCode(response, true);
            $scope.loading = false;
        });
    };

});
console.log("foo");