var app = angular.module('diaryApp', []);

app.controller('DiaryController', function($scope, $http) {

  $scope.notes = [];
  $scope.showDeletePopup = false;
  
  // Get all todos
  $http({
      url: 'diaryapi.php', 
      method: "POST",
      data: {action: "get", id: "0"},
      headers: {'Content-Type': 'application/json'}
  }).success(function(data, status) {
      $scope.notes = data;
  }).
  error(function(data, status) {
      $scope.notes = data || "Request failed";
  });
  
  $scope.showDeleteLocationPopup = function(options, id) {
    if (options === true) {
        $scope.showDeletePopup = true;
    } else {
        $scope.showDeletePopup = false;
    }
    $scope.locationId = id;
  };

  $scope.deleteNote = function(locationId) {
      var id =  locationId;
      
      //alert($scope.notes[id]._id.$id);
      // Delete note
      $http({
          url: 'diaryapi.php', 
          method: "POST",
          data: {action: "delete", id: $scope.notes[id]._id.$id},
          headers: {'Content-Type': 'application/json'}
      }).success(function(data, status) {
          $scope.notes.splice(id,1);
          $scope.showDeletePopup = false;
      }).
      error(function(data, status) {
          $scope.notes = data || "Request failed";
      });
  }
  
  $scope.notescount = function() {
    return $scope.notes.length;
  }
  
  $scope.saveNote = function() {
    if($scope.txtPost != "") {
        $http({
          url: 'diaryapi.php', 
          method: "POST",
          data: {action: "save", txtPost: $scope.txtPost},
          headers: {'Content-Type': 'application/json'}
        }).success(function(data, status) {
            $scope.notes = data;
            $scope.txtPost = "";
        }).
        error(function(data, status) {
            $scope.notes = data || "Request failed";
        });
    }
  }


});
