angular.module('starter.services', [])


.factory('Logs', function($http, $q) {
var logs = [];
  return {
    all: function(){
      var dfd = $q.defer();
      $http.get("http://ec2-50-112-187-245.us-west-2.compute.amazonaws.com/simpletest/function.php").then(function(response){
        logs = response.data;
        dfd.resolve(logs);
      });
      return dfd.promise;
    }
  }
})