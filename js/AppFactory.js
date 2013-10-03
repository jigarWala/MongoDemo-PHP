/*
  Factory methods for HTTP ajax calls
*/
app.factory('db', function($http) {
    return {
        getNotes: function() {
            return $http({
                    url: 'diaryapi.php', 
                    method: "POST",
                    data: {action: "get", id: '0'},
                    headers: {'Content-Type': 'application/json'}
                  });
        },
        saveNote: function(text, timestamp) {
            return $http({
                    url: 'diaryapi.php', 
                    method: "POST",
                    data: {action: "save", txtPost: text, postedon: timestamp},
                    headers: {'Content-Type': 'application/json'}
                  });
        },
        deleteNote: function(id) {
            return $http({
                    url: 'diaryapi.php', 
                    method: "POST",
                    data: {action: "delete", id: id},
                    headers: {'Content-Type': 'application/json'}
                });
        }
    };
});