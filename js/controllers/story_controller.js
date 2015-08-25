stories.controller('StoryCtrl', function($scope,$http) {

      $http.get("./php/function.php").then(function(response){
        $scope.logs = response.data;
        $scope.story= $scope.logs[0].story;
          user_code=$scope.logs[0].code;    

          var link = './php/get_choices_from_story_choice_code.php';
          $http.post(link, {code :user_code}).then(function (res){
            $scope.legs = res.data;
            console.log($scope.legs);
          });
          
      });



      $scope.submit = function(){
          user_code=$scope.data.choice_code;
          var get_story = './php/get_story_from_choice_code.php';
           $http.post(get_story, {code :user_code}).then(function (res){
            $scope.logs = res.data;
            $scope.story= $scope.logs[0].story;
                 var link = './php/get_choices_from_story_choice_code.php';
          $http.post(link, {code :user_code}).then(function (res){
            $scope.legs = res.data;
          });



          });








      }
   







  
});
