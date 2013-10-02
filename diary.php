<!DOCTYPE html>
<html ng-app="diaryApp">

<head>
	<title>My Diary</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.min.js"></script>
  <script type="text/javascript" src="js/App.js"></script>
  
</head>
<body ng-controller="DiaryController">
  <input type="text" ></input>
  <div class="well" ng-repeat="item in notes">{{item.note}}</div>

</body>
</html>



