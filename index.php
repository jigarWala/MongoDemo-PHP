<!DOCTYPE html>
<html ng-app="diaryApp">
<head>
	<title>My Diary</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="img/Book1.ico">
  
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.min.js"></script>
  <script type="text/javascript" src="js/App.js"></script>
  <script type="text/javascript" src="js/lib/jquery.js"></script>
  
  <style>
    html, body {height: 100%;}
    body {background-color:#2c3e50;color:#feffff; margin-bottom:80px;}
    .version {font-size:10pt;}
  </style>
  <script type="text/javascript">
    
    
    $('document').ready(function(){
        $('#txtPost').focus();
        //$("#mynotes").html("<tr><td style=\"text-align:center;height:300px; width:100%;background-color:white; v-align:center;\"><img src=\"img/loading.gif\"></td></tr>");
    });
    
  </script>
</head>
<body ng-controller="DiaryController">
  <div id="wrap">
  <div class="container-fluid">
  
    <div class="row-fluid">
      <div class="span12">
        <h1><a href="/mydiary"><img src="img/Book1.png" width="45" height="50">My Diary</a><span class="version">&nbsp;1.0</span></h1>
        
        <div class="alert alert-block alert-error notification fade in" data-ng-show="showDeletePopup">
            <h6>Are you sure you want to delete this note?</h6>
            <div class="form-controls-alert">
                <a href="" class="btn" ng-click="showDeleteLocationPopup(false)">No</a>
                <a href="" class="btn btn-danger" ng-click="deleteNote(locationId)" autofocus>Yes</a>
            </div>
        </div>
        
          <textarea name="txtPost" ng-model="txtPost" rows="5" class="form-control span12" placeholder="Share what's new .."  required autofocus></textarea>
          <button name="btnPost" class="btn btn-success btn-large" ng-click="saveNote()" ng-disabled="!txtPost">
            <i class="icon icon-white icon-share"></i>&nbsp;Post
          </button>
          <div ng-show="txtPost" class="muted pull-right">{{txtPost.length}} characters !</div>
        
      </div>
    </div>
  
    <hr></hr>
    <div class="pull-right label label-warning">{{notescount()}} Posts</div>
        
    <div class="row-fluid">
      <div class="span12">
        <h3 ng-show="notescount()==0" class="text-warning well">No notes in your diary yet !</h3>
        
        <table class="table" id="mynotes" ng-hide="notescount==0">
          <tr class="info" ng-repeat="item in notes">
            <td style="padding-top:15px; padding-bottom:15px;">
              <button type="button" class="close" id="{{item._id}}" ng-click="showDeleteLocationPopup(true, $index)" title="Delete note"><i class="icon icon-trash"></i></button>
              <div style="font-size:12px;">
                <span class="muted" >
                  {{item.postedon | date:'MMM d, y hh:mm a'}}
                </span>
              </div>
              <div style="color:#2c3e50;margin-top:10px;" ng-bind-html-unsafe="item.note"></div>
            </td>
          </tr>
          
        </table>
        
      </div>
    </div>
  </div> <!-- Container End -->
  </div> <!-- wrap End -->

</body>
</html>