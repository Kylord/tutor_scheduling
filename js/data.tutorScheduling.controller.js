
(function () {
    'use strict';

    var myApp = angular.module("tutorScheduling");

    myApp.controller("dataControl", function($scope, $http, $window) {
        $http.get('php/getcourses.php')
            .then(function(response) {
                $scope.data = response.data.value;
            }
            
                );

         
        $scope.query = {};
        $scope.queryBy = "$";
        
        $scope.menuHighlight = 0;
        
        
        $scope.login = function(accountDetails) {
          var accountupload = angular.copy(accountDetails);
          
          $http.post("php/login.php", accountupload)
            .then(function (response) {
               if (response.status == 200) {
                    if (response.data.status == 'error') {
                        alert('error: ' + response.data.message);
                    } if (response.data.permission == 'student'){
                        $window.location.href = "landing.html";
                    }
                    if (response.data.permission == 'tutor'){
                        $window.location.href = "landing_tutor.html";
                    }
                    if (response.data.permission == 'admin'){
                        $window.location.href = "landing_admin.html"; 
                    }
               } else {
                    alert('unexpected error');
               }
            });                        
        };
        
        
        $scope.logout = function() {
          $http.post("php/logout.php")
            .then(function (response) {
               if (response.status == 200) {
                    if (response.data.status == 'error') {
                        alert('error: ' + response.data.message);
                    } else {
                        $window.location.href = "index.html";
                    }
               } else {
                    alert('unexpected error');
               }
            });                        
        };             
        
        $scope.checkifloggedin = function() {
          $http.post("php/isloggedin.php")
            .then(function (response) {
               if (response.status == 200) {
                    if (response.data.status == 'error') {
                        alert('error: ' + response.data.message);
                    } else {
                        $scope.isloggedin = response.data.loggedin;
                    }
               } else {
                    alert('unexpected error');
               }
            });                        
        };
        

    
     });

} )();
        
