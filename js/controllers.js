angular.module('starter.controllers', [])

.controller('StoryCtrl', function($scope,$http) {

      $http.get("js/function.php").then(function(response){
        $scope.logs = response.data;
        $scope.story= $scope.logs[0].story;
          user_code=$scope.logs[0].code;          
          var link = 'js/get_choices_from_story_choice_code.php';
          $http.post(link, {code :user_code}).then(function (res){
            $scope.legs = res.data;
          });
          
      });



      $scope.submit = function(){
          user_code=$scope.data.choice_code;
          var get_story = 'js/get_story_from_choice_code.php';
           $http.post(get_story, {code :user_code}).then(function (res){
            $scope.logs = res.data;
            $scope.story= $scope.logs[0].story;
                 var link = 'js/get_choices_from_story_choice_code.php';
          $http.post(link, {code :user_code}).then(function (res){
            $scope.legs = res.data;
          });



          });






      }
   







  
})

.controller('StoryAddCtrl',function($scope,$http){
        $scope.showSelectEnabled=true;



  $http.get("js/get_choices.php").then(function(response){


    $scope.choices={all:response.data,selected:response.data[0]};
    console.log($scope.choices.all);
    console.log(response.data[0].choice_parent[0]);
    $scope.choices.myselected=response.data[0].choice_parent[0];
    user_code=response.data[0].choice_code;
       var get_story = 'js/get_story_from_choice_code.php';
          $http.post(get_story, {code :user_code}).then(function (res){
            $scope.story = res.data[0].story;
            console.log($scope.story);
          });





  })

  $scope.submit=function(){
    console.log("I have been executed");
    console.log($scope.choices.selected.choice_code)

      user_code=$scope.choices.selected.choice_code;   
          var get_story = 'js/get_story_from_choice_code.php';
          $http.post(get_story, {code :user_code}).then(function (res){
            $scope.story = res.data[0].story;
            console.log($scope.story);
          });






  }
  console.log("I am inside the controller");

  $scope.showEditor=function(){
    $scope.showEditorEnabled=true;
        $scope.showPublisherEnabled=false;
                $scope.showSelectEnabled=false;


    console.log("you are in ");
  }
 $scope.showPublisher=function(){
    $scope.showPublisherEnabled=true;
        $scope.showEditorEnabled=false;
                $scope.showSelectEnabled=false;



    console.log("you are in ");
  }
 $scope.showSelect=function(){
    $scope.showPublisherEnabled=false;
        $scope.showEditorEnabled=false;
        $scope.showSelectEnabled=true;


    console.log("you are in ");
  }







});     

