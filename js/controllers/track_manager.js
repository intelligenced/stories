stories.controller('TrackCtrl', function($scope,$http) {



$scope.addTrack = function(){

  var track = $scope.add_track;
  var link = './php/add_track.php';
  $http.post(link, {track_name :track}).then(function (res){
    var result=res.data
            
            console.log(result);
          });




}








  
});
