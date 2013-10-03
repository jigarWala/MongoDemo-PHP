var app = angular.module('diaryApp', []);

app.controller('DiaryController', function($scope, $http, db) {

    $scope.notes = [];
  
    // Get all notes  
    db.getNotes().success(function(data, status) {
        $scope.notes = data;
    }).error(function(data, status) {
        $scope.notes = data || "Request failed";
    });
  
    // locationid is used for note delete feature
    $scope.updateLocationId = function(id) {
        $scope.locationId = id;
    };

    // Delete note
    $scope.deleteNote = function(id) {
      db.deleteNote($scope.notes[id]._id.$id).success(function(data, status) {
        $scope.notes.splice(id,1);
      }).error(function(data, status) {
        $scope.notes = data || "Request failed";
      });
    }
  
    // Get count of all notes
    $scope.notescount = function() {
      return $scope.notes.length;
    }
  
    // Save note
    $scope.saveNote = function() {
      var text = $scope.txtPost;
      if (text) { text = text.replace(/\n\r?/g, '<br/>'); }
    
      var timestamp = new Date();
      db.saveNote(text, timestamp).success(function(data, status) {
        $scope.notes = data;
        $scope.txtPost = "";
      }).error(function(data, status) {
        $scope.notes = data || "Request failed";
      });
    }

});