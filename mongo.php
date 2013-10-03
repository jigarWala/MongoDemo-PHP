<?php

    class MongoDB1 {
      // Constructor
      function __construct() {
        
      }
   
      // Connect to MongoDB
      private function connect() {
        $con = new Mongo("mongodb://diaryuser:diaryuser@localhost:27017/mydiary");
        return $con;
      }
      
      public function getNotesCount() {
        try{
          $con = MongoDB1::connect();
          $myCollection = $con->mydiary->diary; // mydiary: database, diary: collection

          // Find everything in our collection:
          $count = $myCollection->count();
        } catch (MongoCursorException $e) {
          echo "Error message: ".$e->getMessage()."<br/>";
          echo "Error code: ".$e->getCode()."<br/>";
        }
        return $count; 
      }
      
      public function getNotes() {
        $results = [];
        
        
        try{
          $con = MongoDB1::connect();
          $myCollection = $con->mydiary->diary;

          // Find everything in our collection:
          $results = $myCollection->find()->sort(array("_id" => -1));

        } catch (MongoCursorException $e) {
          echo "Error message: ".$e->getMessage()."<br/>";
          echo "Error code: ".$e->getCode()."<br/>";
        } 
        
        return $results;
  
      }
      
      public function saveNote($post, $timestamp) {
         try{
          $con = MongoDB1::connect();
          $myCollection = $con->mydiary->diary;
          $doc = array(
              "note" => $post,
              "postedon" => $timestamp
          );

          $myCollection->insert($doc);
          
        } catch (MongoCursorException $e) {
          echo "Error message: ".$e->getMessage()."<br/>";
          echo "Error code: ".$e->getCode()."<br/>";
        }
      }
      
      public function deleteNote($id) {
          try{
            $con = MongoDB1::connect();
            $myCollection = $con->mydiary->diary;
            $doc = array(
                "_id" => $id
            );

            $myCollection->remove(array('_id' => new MongoId($id)), true);
          
        } catch (MongoCursorException $e) {
          echo "Error message: ".$e->getMessage()."<br/>";
          echo "Error code: ".$e->getCode()."<br/>";
        }
      }
    }
    
?>
        
        } catch (MongoCursorException $e) {
          echo "Error message: ".$e->getMessage()."<br/>";
          echo "Error code: ".$e->getCode()."<br/>";
        }
      }
      
      public function deleteNote($id) {
          try{
            $con = MongoDB1::connect();
            $myCollection = $con->mydiary->diary;
            $doc = array(
                "_id" => $id
            );

            $myCollection->remove(array('_id' => new MongoId($id)), true);
          
        } catch (MongoCursorException $e) {
          echo "Error message: ".$e->getMessage()."<br/>";
          echo "Error code: ".$e->getCode()."<br/>";
        }
      }
    }
    
?>
