/*
 *Filter to enable angular to trust html so it can be displayed on a page
 */

(function() {
    'use strict';
    // the 'movies' here matches the name of the app under movies.module.js
    var myApp = angular.module("tutorScheduling");
    //use use 'trustHtml' in the html file as the name of the filter
    myApp.filter("trustHtml", function($sce) {
        return function(html) {
            return $sce.trustAsHtml(html);
        };
    });
}
)();