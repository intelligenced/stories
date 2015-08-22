stories.controller('TrackCtrl', function($scope,$http) {

$http.get("./php/get_tracks.php").then(function(response){
  $scope.tracks = response.data;

});



$scope.addTrack = function(){

  var track = $scope.add_track;
  var link = './php/add_track.php';
  $http.post(link, {track_name :track}).then(function (res){
    var result=res.data
            
            console.log(result);
 });
}








  
});
