/*
  Factory methods for HTTP ajax calls
*/
app.factory('db', function($http) {
    return {
        getNotes: function(id) {
            return $http({
                    url: 'diaryapi.php', 
                    method: "POST",
                    data: {action: "get", id: '0', page: id}
                  });
        },
        getTotalCount: function(id) {
            return $http({
                    url: 'diaryapi.php', 
                    method: "POST",
                    data: {action: "getcount"}
                  });
        },
        saveNote: function(text, timestamp) {
            return $http({
                    url: 'diaryapi.php', 
                    method: "POST",
                    data: {action: "save", txtPost: text, postedon: timestamp}
                  });
        },
        deleteNote: function(id) {
            return $http({
                    url: 'diaryapi.php', 
                    method: "POST",
                    data: {action: "delete", id: id}
                });
        }
    };
});