<?php
  include('mongo.php');
  $docs_per_page = 10;
  
  $params = json_decode(file_get_contents('php://input'));
  
  $action = $params->action;
  $id = $params->id;
  
  $db = new MongoDB1();
  
  if($action == "delete") {
    $db->deleteNote($id);
    $page = 0;
    $skip = (int)($docs_per_page * ($page));
    $notes = $db->getNotes()->skip($skip)->limit($docs_per_page);
    $result = [];
    foreach($notes as $note) {
      array_push($result, $note);
    }
    header('Content-type: application/json');
    echo json_encode($result);
  } else if($action == "get") {
    $page = $params->page;
    $skip = (int)($docs_per_page * ($page));
    $notes = $db->getNotes()->skip($skip)->limit($docs_per_page);
    $result = [];
    foreach($notes as $note) {
      array_push($result, $note);
    }

    header('Content-type: application/json');
    echo json_encode($result);
    
  } else if($action == "save") {
    $db->saveNote($params->txtPost, $params->postedon);
    $page = 0;
    $skip = (int)($docs_per_page * ($page));
    $notes = $db->getNotes()->skip($skip)->limit($docs_per_page);
    $result = [];
    foreach($notes as $note) {
      array_push($result, $note);
    }
    header('Content-type: application/json');
    echo json_encode($result);
  } else if($action = "getcount") {
    $count = $db->getNotesCount();
    header('Content-type: application/json');
    echo json_encode($count);
  }
  
  $db = null;
?>