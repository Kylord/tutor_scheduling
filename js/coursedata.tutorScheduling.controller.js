(function () {
    var myApp = angular.module("tutorScheduling");
    //get a response containing the users current course list
    myApp.controller("courseDataControl", function($scope, $http, $window, $routeParams) {
        $http.get('testjson.json')
            .then(function(response) {
                $scope.data = response.data;
                $scope.courseprofile = response[$routeParams.id];
                console.log($scope.courseprofile); 
                
            });
            
            
            
            $scope.$on('scanner-started', function(event, data){
               console.log(data);  
            });
            
            
            
    }); 
    
    
})(); 