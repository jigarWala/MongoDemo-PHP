var app = angular.module('diaryApp', []);

app.controller('DiaryController', function($scope, $http, db) {
    $scope.itemsperpage = 10;
    $scope.notes = [];
    $scope.pages = [];
    $scope.notescount;
    
    db.getTotalCount().success(function(data, status) {
          var count = Math.ceil(data/$scope.itemsperpage);
          $scope.notescount = data;
          $scope.pages.splice(0,$scope.pages.length);
          for(i = 1; i <= count; i++) {
            $scope.pages.push(i);
          }
    });
  
    // Get all notes  
    db.getNotes(0).success(function(data, status) {
        $scope.notes = data;
    }).error(function(data, status) {
        $scope.notes = data || "Request failed";
    });
    
    $scope.loadPage = function(id) {
        db.getNotes(id).success(function(data, status) {
            $scope.notes = data;
        }).error(function(data, status) {
            $scope.notes = data || "Request failed";
        });
    }
  
    // locationid is used for note delete feature
    $scope.updateLocationId = function(id) {
        $scope.locationId = id;
    };

    // Delete note
    $scope.deleteNote = function(id) {
      db.deleteNote($scope.notes[id]._id.$id).success(function(data, status) {
        //$scope.notes.splice(id,1);
        
        $scope.notes = data;
        
        db.getTotalCount().success(function(data, status) {
          var count = Math.ceil(data/$scope.itemsperpage);
          $scope.notescount = data;
          $scope.pages.splice(0,$scope.pages.length);
          for(i = 1; i <= count; i++) {
            $scope.pages.push(i);
          }
        });
      }).error(function(data, status) {
        $scope.notes = data || "Request failed";
      });
    }
  
    // Save note
    $scope.saveNote = function() {
      var text = $scope.txtPost;
      if (text) { text = text.replace(/\n\r?/g, '<br/>'); }
    
      var timestamp = new Date();
      db.saveNote(text, timestamp).success(function(data, status) {
        $scope.notes = data;
        $scope.txtPost = "";
        
        db.getTotalCount().success(function(data, status) {
          var count = Math.ceil(data/$scope.itemsperpage);
          $scope.notescount = data;
          $scope.pages.splice(0,$scope.pages.length);
          for(i = 1; i <= count; i++) {
            $scope.pages.push(i);
          }
        });
      }).error(function(data, status) {
        $scope.notes = data || "Request failed";
      });
    }

});