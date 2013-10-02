<?php
  include('mongo.php');
  
  $params = json_decode(file_get_contents('php://input'));
  
  //$action = $_POST['action'];
  //$id = $_POST['id'];
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
    
    
//    foreach($notes as $note) {
//      echo '<tr class="info"><td>';
//      echo '<button type="button" class="close" id="' . $note['_id'] .'" onclick="deleteNote(\'' . $note['_id'] . '\')"><i class="icon icon-trash"></i></button>';
//      echo '<div style="font-size:12px;">';
//      echo '<span class="muted" >';
//      echo date('D j M y', $createdOn = $note['_id']->getTimestamp())  . '&nbsp;&nbsp'; 
//      echo '[' . date('h:i A', $createdOn = $note['_id']->getTimestamp()) . ']</span></div>';
//      echo '<div style="color:#2c3e50;margin-top:10px;">' . $note['note'] . '</div></td></tr>';
//    }
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