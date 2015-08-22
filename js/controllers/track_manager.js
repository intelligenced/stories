stories.controller('TrackCtrl', function($scope,$http) {


$scope.refreshTracks = function(){

$http.get("./php/get_tracks.php").then(function(responses){
  $scope.tracks = responses.data;

  });
}//Refresh Tracks

$scope.refreshChoices = function(){

$http.get("./php/get_choices.php").then(function(response){
  $scope.choices = response.data;

  });
}//Refresh Choices


$scope.addTrack = function(){

  var track = $scope.add_track;
  console.log(track);
  var link = './php/add_track.php';
  $http.post(link, {track_name :track}).then(function (res){
    var result=res.data
    $scope.refreshTracks();
    console.log(result);

 });
}//Add Track

$scope.addTracktoChoice = function(){

  var track = $scope.tracks.selected.track_id;
  var choice = $scope.choices.selected.choice_id;

console.log(track);
console.log(choice);

  var link = './php/add_track_to_choice.php';
  $http.post(link, {track_id :track, choice_id:choice}).then(function (res){
    var result=res.data
    $scope.refreshTracks();
    console.log(result);

 }); 
}//Add Track to Choice

$scope.addTrackCheck = function(){

  var track = $scope.tracks.selected.track_id;
  var choice = $scope.choices.selected.choice_id;

console.log(track);
console.log(choice);

  var link = './php/add_track_check.php';
  $http.post(link, {track_id :track, choice_id:choice}).then(function (res){
    var result=res.data
    $scope.refreshTracks();
    console.log(result);

 }); 
}//Add Track to Choice

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
$scope.refreshChoices();






  
});
