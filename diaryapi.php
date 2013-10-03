<?php
  include('mongo.php');
  
  $params = json_decode(file_get_contents('php://input'));
  
  $action = $params->action;
  $id = $params->id;
  
  $db = new MongoDB1();
  
  if($action == "delete") {
    $db->deleteNote($id);
    echo $id;
  } else if($action == "get") {
    
    $notes = $db->getNotes();
    $result = [];
    foreach($notes as $note) {
      array_push($result, $note);
    }

    header('Content-type: application/json');
    echo json_encode($result);
    
  } else if($action == "save") {
    $db2 = new MongoDB1();
    $db2->saveNote($params->txtPost, $params->postedon);
    $notes = $db->getNotes();
    $result = [];
    foreach($notes as $note) {
      array_push($result, $note);
    }
    header('Content-type: application/json');
    echo json_encode($result);
    
  }
  
  $db = null;
?>