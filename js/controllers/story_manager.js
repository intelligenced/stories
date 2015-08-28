stories.controller('StoryAddCtrl', function($scope, $http, $sce, $timeout) {
    $scope.showSelectEnabled = true;
    $scope.showExistingEnabled = false;
    $scope.addNewChoice = false;


    //Get initial Choices
    $http.get("./php/get_choices.php").then(function(response) {
        $scope.choices = {
            all: response.data,
            selected: response.data[0]
        };
        //console.log($scope.choices.all);
        ////console.log(response.data[0].choice_parent[0]);
        $scope.choices.myselected = response.data[0].choice_parent[0];
        user_code = response.data[0].choice_code;
        user_text = response.data[0].choice_text;

        $scope.grandParentsSelected(user_text);

        var get_story = './php/get_story_from_choice_code.php';
        $http.post(get_story, {
            code: user_code
        }).then(function(res) {
            $scope.story = res.data[0].story;
            ////console.log($scope.story);
        });

    });



    //Getting all redirects
    $scope.getAllRedirects = function() {
        $http.get("./php/get_redirects.php").then(function(response) {
            $scope.redirects = response.data;
        });
    }


    $scope.getAllRedirects();


    //Delete a redirect
    $scope.deleteRedirect = function() {

        if (angular.isUndefined($scope.redirects.selected)) {
            $scope.displayMessage("alert-warning", "select redirect is not exactly a choice, now is it? ");


        } else {
            delete_redirect = $scope.redirects.selected.choice_id;
            // //console.log(delete_redirect);
            // delete_redirect_link=
            var redirect_link = './php/delete_redirect.php';
            $http.post(redirect_link, {
                choice_id: delete_redirect
            }).then(function(res) {
                $scope.validation = res.data;
                //console.log($scope.validation);
                $scope.refreshEverything();
                $scope.displayMessage($scope.validation[0].alerttype, $scope.validation[0].message);

            });
            $scope.getAllRedirects();

        }

    }

    //Add a redirect
    $scope.addRedirect = function() {

        //  //console.log("you are inside the redirect");
        // //console.log("I am executed");

        parent = $scope.choices.selected.choice_code;
        if (angular.isUndefined($scope.choices.existing) || angular.isUndefined($scope.add_redirect_choice)) {

            $scope.displayMessage("alert-warning", "Filling the blanks would be a good idea ");

        } else {

            redirect = $scope.choices.existing.choice_code;
            redirect_text = $scope.add_redirect_choice;
            // //console.log(parent);
            // //console.log(redirect);
            // //console.log(redirect_text);

            var redirect_link = './php/add_redirect.php';
            $http.post(redirect_link, {
                parent: parent,
                choice_text: redirect_text,
                choice_code: redirect
            }).then(function(res) {
                $scope.validation = res.data;
                // //console.log($scope.validation);
                $scope.displayMessage($scope.validation[0].alerttype, $scope.validation[0].message);
                $scope.refreshEverything();

            });




        }












    }

    $scope.submit = function() {
        ////console.log("I have been executed");
        ////console.log($scope.choices.selected.choice_code)




        ////console.log(baan);


        user_code = $scope.choices.selected.choice_code;
        var get_story = './php/get_story_from_choice_code.php';
        $http.post(get_story, {
            code: user_code
        }).then(function(res) {
            $scope.story = res.data[0].story;

            $scope.renderStory($scope.story);
            ////console.log($scope.story);
        });

        var get_num_choices_from_choice_code = './php/get_num_choices_from_choice_code.php';
        $http.post(get_num_choices_from_choice_code, {
            code: user_code
        }).then(function(res) {
            $scope.have_choices = res.data;
            if ($scope.have_choices == "") {
                $scope.num_of_choices = '';
            } else {
                //  //console.log("LETS TEST IT OUT");

                $scope.num_of_choices = Object.keys($scope.have_choices).length;
                // //console.log($scope.have_choices);



            }




        });

        var getParentLink = './php/get_parents_from_choice_code.php';
        $http.post(getParentLink, {
            code: user_code
        }).then(function(res) {
            $scope.have_parents = res.data;
            ////console.log($scope.have_parents);
            ////console.log($scope.story);
        });








    }

    $scope.deleteStory = function() {


        if (angular.isUndefined($scope.choices.selected)) {
            $scope.displayMessage("alert-warning", "Nothing cannot be deleted...maybe? ");}else{

        choice_code = $scope.choices.selected.choice_code;

        //console.log(choice_code);

        $scope.showDeleterEnabled = false;

        var deleteStoryLink = './php/delete_story.php';
        $http.post(deleteStoryLink, {
                choice_code: choice_code
            })
            .then(function(res) {
                $scope.validation = res.data;
                ////console.log($scope.validation);
                $scope.refreshEverything();
                $scope.displayMessage($scope.validation[0].alerttype, $scope.validation[0].message);
            });


        }




    }

    $scope.editStory = function() {
        choice_code = $scope.choices.selected.choice_code;
        choice_text = $scope.choices.selected.choice_text;
        updated_story = $scope.story;

     if ($scope.choices.selected.choice_text=="") {
               $scope.displayMessage("alert-warning", "blank choice...? ");


     }else if($scope.story==""){
               $scope.displayMessage("alert-warning", "blank story?");



     }else{




        var update_story = './php/update_story.php';
        $http.post(update_story, {
                choice_code: choice_code,
                choice_text: choice_text,
                story: updated_story
            })
            .then(function(res) {
         $scope.validation = res.data;
                //console.log($scope.validation);
                $scope.refreshEverything();
                $scope.displayMessage($scope.validation[0].alerttype, $scope.validation[0].message);
            });


            }



    }


    $scope.postStory = function() {

       if (angular.isUndefined($scope.add_choice)||$scope.add_choice=="") {
         $scope.displayMessage("alert-warning", "Still searching for a choice... ");


       }else if (angular.isUndefined($scope.add_story)||$scope.add_story==""){
                 $scope.displayMessage("alert-warning", "A choice without a story? ");


       }else{


        parent = $scope.choices.selected.choice_code;
        choice_text = $scope.add_choice;
        story = $scope.add_story;

        //console.log(choice_text);
        //console.log(story);
        //console.log(parent);




        var add_story_link = './php/add_story.php';
        $http.post(add_story_link, {
                parent: parent,
                choice_text: choice_text,
                story: story
            })
            .then(function(res) {
                $scope.validation = res.data;
                //console.log($scope.validation);
                $scope.refreshEverything();
                $scope.displayMessage($scope.validation[0].alerttype, $scope.validation[0].message);











            });




        //RESET





        //$scope.submit();

        $scope.add_choice = "";
        $scope.add_story = "";
        }



    }


    $scope.subchoiceSelected = function(param) {

        var bam = param;
        //console.log(bam);
        //var test = $scope.choices.all[2];
        var test = $scope.choices.all;

        for (var key in test) {
            if (test.hasOwnProperty(key)) {
                if (test[key].choice_text == bam) {

                    $scope.choices.selected = test[key];
                    $scope.submit();


                };
            }
        }





        //console.log(test);
        //console.log($scope.choices.selected.choice_text);
        //console.log($scope.have_choices.choice_text);


    }

    $scope.grandParentsSelected = function(param) {

        var bam = param;
        //console.log(bam);
        //var test = $scope.choices.all[2];
        var test = $scope.choices.all;

        for (var key in test) {
            if (test.hasOwnProperty(key)) {
                if (test[key].choice_text == bam) {

                    $scope.choices.selected = test[key];
                    $scope.submit();


                };
            }
        }





        ////console.log(test);
        // //console.log($scope.choices.selected.choice_text);
        //  //console.log($scope.have_choices.choice_text);


    }

    $scope.hideMessage = function() {
        $timeout(function() {
            $scope.showMessage = "";
            //console.log("timeout occured");
        }, 3000);



    }



    $scope.showEditor = function() {
        $scope.showEditorEnabled = true;
        $scope.showPublisherEnabled = false;
        $scope.showSelectEnabled = false;


    }
    $scope.showPublisher = function() {
        $scope.showPublisherEnabled = true;
        $scope.showEditorEnabled = false;
        $scope.showSelectEnabled = false;



    }
    $scope.showSelect = function() {
        $scope.showPublisherEnabled = false;
        $scope.showEditorEnabled = false;
        $scope.showSelectEnabled = true;


    }

    $scope.showDeleter = function() {
       // $scope.showDeleterEnabled = !$scope.showDeleterEnabled;

       $scope.showDeleterEnabled=true;

             $timeout(function() {
            $scope.showDeleterEnabled =false;
            ////console.log("timeout occured");
        }, 1000);



    }

    $scope.renderStory = function(param) {
        var HTMLStory = param;
        $scope.storyHTMLRender = HTMLStory;
    }

    $scope.refreshEverything = function() {

        $scope.getAllRedirects();


        $http.get("./php/get_choices.php").then(function(response) {


            $scope.choices = {
                all: response.data,
                selected: response.data[0]
            };





            ////console.log($scope.choices.all);
            ////console.log(response.data[0].choice_parent[0]);
            $scope.choices.myselected = response.data[0].choice_parent[0];
            user_code = response.data[0].choice_code;
            var get_story = './php/get_story_from_choice_code.php';
            $http.post(get_story, {
                code: user_code
            }).then(function(res) {
                $scope.story = res.data[0].story;
                $scope.renderStory($scope.story);


                ////console.log($scope.story);

                var get_num_choices_from_choice_code = './php/get_num_choices_from_choice_code.php';
                $http.post(get_num_choices_from_choice_code, {
                    code: user_code
                }).then(function(res) {
                    $scope.have_choices = res.data;
                    if ($scope.have_choices == "") {
                        $scope.num_of_choices = '';
                    } else {
                        //  //console.log("LETS TEST IT OUT");

                        $scope.num_of_choices = Object.keys($scope.have_choices).length;
                        // //console.log($scope.have_choices);



                    }




                });


                var getParentLink = './php/get_parents_from_choice_code.php';
                $http.post(getParentLink, {
                    code: user_code
                }).then(function(res) {
                    $scope.have_parents = res.data;
                    ////console.log($scope.have_parents);
                    ////console.log($scope.story);
                });







            });



        });
    }


    $scope.displayMessage = function(alerttype, message) {

        //alert-success
        //alert-info
        //alert-warning
        //alert-danger

        $scope.alerttype = alerttype;
        $scope.showMessage = "1";
        $scope.message = message;
        $scope.hideMessage();



    }
















});
