<!DOCTYPE html>
<html>
<?php
  include('mongo.php');
  
  if(isset($_POST['btnPost'])) {
    $db2 = new MongoDB1();
    $db2->saveNote($_POST['txtPost']);
    $db2 = null;
  }
?>
<head>
	<title>My Diary</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <script type="text/javascript" src="js/lib/jquery.js"></script>
  
  <style>
    html, body {height: 100%;}
    body {background-color:#2c3e50;color:#feffff; margin-bottom:80px;}
    
  </style>
  <script type="text/javascript">
    $('document').ready(function(){
        refresh();
        
        $('#txtPost').focus();
        $("#mynotes").html("<tr><td style=\"text-align:center;height:300px; width:100%;background-color:white; v-align:center;\"><img src=\"img/loading.gif\"></td></tr>");
    });
    
    function deleteNote(id) {
      if(confirm("Deleting post. Are you sure?")) {
        $.ajax({
          type: "POST",
          url: "diaryapi.php",
          data: { action: "delete", id: id}
        })
        .done(function( msg ) {
            refresh();
        });
      }
        
    }
    
    function refresh() {
        $.ajax({
          type: "POST",
          url: "diaryapi.php",
          data: { action: "get", id: "0"}
        })
        .done(function( data ) {
            //alert("Refreshed: " + data);
            $("#mynotes").html(data);
        });
        
        getcount();
    }
    
    function getcount() {
        $.ajax({
          type: "POST",
          url: "diaryapi.php",
          data: { action: "getcount", id: "0"}
        })
        .done(function( data ) {
            //alert("Refreshed: " + data);
            $("#count").html(data);
        });
    }
  </script>
</head>
<body>
  <div id="wrap">
  <div class="container-fluid">
  
    <div class="row-fluid">
      <div class="span12">
        <h1><a href="/todo"><img src="img/Book.png">My Diary</a></h1>
    
        <form class="form-inline" method="POST" action="index.php">
          <textarea name="txtPost" id="txtPost" rows="5" class="form-control" placeholder="enter note" style="width:90%;" requestfocus></textarea>
          <button name="btnPost" class="btn btn-success"><i class="icon icon-share"></i>&nbsp;Post</button>
        </form>
      </div>
    </div>
  
    <div class="pull-right"><span id="count">0</span> Posts</div>
    
    <div class="row-fluid">
      <div class="span12">
        
        <table class="table" id="mynotes">
          
        </table>
      </div>
    </div>
    
  </div> <!-- Container End -->
  </div> <!-- wrap End -->

  
  <script type="text/javascript" src="/js/lib/angular.js"></script>
</body>
</html>
