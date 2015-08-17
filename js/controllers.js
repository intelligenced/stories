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
    //console.log($scope.choices.all);
    //console.log(response.data[0].choice_parent[0]);
    $scope.choices.myselected=response.data[0].choice_parent[0];
    user_code=response.data[0].choice_code;
       var get_story = 'js/get_story_from_choice_code.php';
          $http.post(get_story, {code :user_code}).then(function (res){
            $scope.story = res.data[0].story;
            //console.log($scope.story);
          });






  })

  $scope.submit=function(){
    //console.log("I have been executed");
    //console.log($scope.choices.selected.choice_code)

      user_code=$scope.choices.selected.choice_code;   
          var get_story = 'js/get_story_from_choice_code.php';
          $http.post(get_story, {code :user_code}).then(function (res){
            $scope.story = res.data[0].story;
            //console.log($scope.story);
          });

          var get_num_choices_from_choice_code='js/get_num_choices_from_choice_code.php';
          $http.post(get_num_choices_from_choice_code,{code :user_code}).then(function(res){
            $scope.have_choices=res.data;
            if($scope.have_choices==""){$scope.num_of_choices='';
          }else{
           //  console.log("LETS TEST IT OUT");

            $scope.num_of_choices=Object.keys($scope.have_choices).length;
           // console.log($scope.have_choices);



          }
           


          });

        





  }

  $scope.editStory=function(){
    choice_code=$scope.choices.selected.choice_code;
    choice_text=$scope.choices.selected.choice_text;
    updated_story=$scope.story;

    

    var update_story = 'js/update_story.php';
    $http.post(update_story, {choice_code :choice_code,choice_text:choice_text,story:updated_story})
   .then(function (res){
            $scope.message = res.data;
            console.log($scope.message);
          });

  }


   $scope.postStory=function(){
    parent=$scope.choices.selected.choice_code;
    choice_text=$scope.add_choice;
    story=$scope.add_story;

    console.log(choice_text);
    console.log(story);
    console.log(parent);


    

    var add_story_link = 'js/add_story.php';
    $http.post(add_story_link, {parent :parent,choice_text:choice_text,story:story})
   .then(function (res){
            $scope.message = res.data;
            console.log($scope.message);

            
  $http.get("js/get_choices.php").then(function(response){


    $scope.choices={all:response.data,selected:response.data[0]};
    //console.log($scope.choices.all);
    //console.log(response.data[0].choice_parent[0]);
    $scope.choices.myselected=response.data[0].choice_parent[0];
    user_code=response.data[0].choice_code;
       var get_story = 'js/get_story_from_choice_code.php';
          $http.post(get_story, {code :user_code}).then(function (res){
            $scope.story = res.data[0].story;
            //console.log($scope.story);
          });



  });









          });

   //RESET
  




$scope.submit();

$scope.add_choice="";
  $scope.add_story="";




  }

  $scope.showEditor=function(){
    $scope.showEditorEnabled=true;
        $scope.showPublisherEnabled=false;
                $scope.showSelectEnabled=false;


  }
 $scope.showPublisher=function(){
    $scope.showPublisherEnabled=true;
        $scope.showEditorEnabled=false;
                $scope.showSelectEnabled=false;



  }
 $scope.showSelect=function(){
    $scope.showPublisherEnabled=false;
        $scope.showEditorEnabled=false;
        $scope.showSelectEnabled=true;


  }







});     

