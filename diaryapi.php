<?php
  include('mongo.php');
  
  $action = $_POST['action'];
  $id = $_POST['id'];
  
  $db = new MongoDB1();
  
  if($action == "delete") {
    $db->deleteNote($id);
    echo $id;
  } else if($action == "get") {
    $notes = $db->getNotes();
    foreach($notes as $note) {
      echo '<tr class="info"><td>';
      echo '<button type="button" class="close" id="' . $note['_id'] .'" onclick="deleteNote(\'' . $note['_id'] . '\')"><i class="icon icon-trash"></i></button>';
      echo '<div style="font-size:12px;">';
      echo '<span class="muted" >';
      echo date('D j M y', $createdOn = $note['_id']->getTimestamp())  . '&nbsp;&nbsp'; 
      echo '[' . date('h:i A', $createdOn = $note['_id']->getTimestamp()) . ']</span></div>';
      echo '<div style="color:#2c3e50;margin-top:10px;">' . $note['note'] . '</div></td></tr>';
    }
  } else if($action == "getcount") {
    $count = $db->getNotesCount();
    echo $count;
  }
  
  $db = null;
?>
