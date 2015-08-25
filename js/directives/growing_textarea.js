stories.directive('textarea', function() {
  return {
    restrict: 'E',
    controller: function($scope, $element) {
      $element.css('overflow-y','hidden');
      $element.css('resize','none');
      resetHeight();
      adjustHeight();

      function resetHeight() {
        $element.css('height', 0 + 'px');
      }

      function adjustHeight() {
        var height = angular.element($element)[0]
          .scrollHeight + 1;
        $element.css('height', height + 'px');
        $element.css('max-height', height + 'px');
      }

      function keyPress(event) {
        // this handles backspace and delete
        if (_.contains([8, 46], event.keyCode)) {
          resetHeight();
        }
        adjustHeight();
      }

      $element.bind('keyup change blur', keyPress);

    }
  };
});