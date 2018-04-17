var myApp = angular.module("tutorScheduling");
    
myApp.controller("adminDataControl", function($scope, $http, $window) {
    $http.get('php/getusers.php')
            .then(function(response) {
                $scope.data = response.data;
                console.log($scope.data);
            });
            
            
}); 
                
