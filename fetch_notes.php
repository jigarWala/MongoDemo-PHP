<?php
 
try {
  // open connection to MongoDB server
  $conn = new Mongo('mongodb://diaryuser:diaryuser@localhost:27017/mydiary');
 
  // access database
  $db = $conn->mydiary;
 
  // access collection
  $collection = $db->diary;
 
  // execute query
  // retrieve all documents
  $page = $_POST['page'];
  $docs_per_page = 3;
  $skip = (int)($docs_per_page * ($page - 1));
  $cursor = $collection->find()->skip($skip)->limit($docs_per_page);
  $count = $cursor->count();
 
  echo $cursor->count() . ' document(s) found. <br/>';  
 
  //output results from database
  echo '<ul class="page_result">';
  foreach($cursor as $obj)
  {
    echo '<li id="item_'.$obj["_id"].'">'.$obj["note"].'. <span class="page_name">'.$obj["name"].'</span><span class="page_message">'.$obj["message"].'</span></li>';
  }
  echo '</ul>';
 
  // disconnect from server
  $conn->close();
  } catch (MongoConnectionException $e) {
      die('Error connecting to MongoDB server');
  } catch (MongoException $e) {
      die('Error: ' . $e->getMessage());
  }
?>