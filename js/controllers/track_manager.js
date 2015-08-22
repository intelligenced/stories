stories.controller('TrackCtrl', function($scope,$http) {


$scope.refreshTracks = function(){

$http.get("./php/get_tracks.php").then(function(response){
  $scope.tracks = response.data;

  });
}//Refresh Tracks


$scope.addTrack = function(){

  var track = $scope.add_track;
  var link = './php/add_track.php';
  $http.post(link, {track_name :track}).then(function (res){
    var result=res.data
    $scope.refreshTracks();
    console.log(result);

 });
}//Add Track

$scope.deleteTrack = function(){

  var track_id = $scope.tracks.selected.track_id;
  console.log(track_id);

  var link = './php/delete_track.php';
  $http.post(link, {track_id :track_id}).then(function (res){
    var result=res.data
    $scope.refreshTracks();
    console.log(result);

 });
}//Delete Track


$scope.refreshTracks();






  
});
