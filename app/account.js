var app = angular.module('AccountModel', ['SidebarModel','ngFileUpload']);

app.config(['$compileProvider',
    function ($compileProvider) {
        $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|tel|file|blob):/);
    }
]);

app.controller('AccountController', ['$scope', '$http', 'Upload', '$timeout', function ($scope, $http, Upload, $timeout) {
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
        $scope.loading = false;
    });
  };

  $scope.updateUserInfo = function(){
    if($scope.userInfo.DOB != null){
      $scope.userInfo.DOB = moment($scope.userInfo.DOB, "MMM DD, YYYY").format('YYYY-MM-DD');
    }
    $http({
        url: "/api/accounts.php?account_id=true",
        method: "PUT",
        data: $scope.userInfo,
        headers: {
            "Content-Type": "application/json",
            "Authorization": localStorage.getItem("token")
        }
    }).then(function (response) {
        var data = response.data;
        if(!validateResponse(data)){
            displayErrorMessage(data.description);
        }else{
            $scope.getAccountInfo();
        }
    },
    function errorCallback(response) {
        validateStatusCode(response, true);
        $scope.loading = false;
    });
  };

    $scope.uploadPic = function(file) {
        var params = {
            "files": file
        }
        //data: {username: $scope.username, file: file},
        file.upload = Upload.upload({
          url: '/api/accounts.php',
          data: params,
        });
    
        file.upload.then(function (response) {
          $timeout(function () {
            file.result = response.data;
            $scope.updateAvatarWindor = false;
            $scope.getAccountInfo();
          });
        }, function (response) {
          if (response.status > 0)
            $scope.errorMsg = response.status + ': ' + response.data;
        }, function (evt) {
          // Math.min is to fix IE which reports 200% sometimes
          file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        });
    }

    $scope.getAccountInfo();
}]);