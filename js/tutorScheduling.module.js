
/*Creating a module for the movie app. We'll be using the name of the app 'movies'*/

var app = angular.module("tutorScheduling",["ngRoute"]);


app.config(function($routeProvider){
    $routeProvider
    .when("/index.html", {
        templateUrl: "index.html",
        controller: "data.tutorScheduling.controller.js"
        
        })
    
    
    .when("/landing.html", {
        templateUrl: "landing.html",
        controller: "data.tutorScheduling.controller.js"
        
        })
    
    //want to be using coursedata controller eventually
    .when("/course.view", {
        templateUrl: "course.view.html",
        controller: "data.tutorScheduling.controller.js"
    });
    
}); 