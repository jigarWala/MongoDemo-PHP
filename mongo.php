<?php

    class MongoDB1 {
      function __construct() {
        // do something here if required
      }
   
      // Connect to MongoDB
      private function connect() {
      	$username = "diaryuser";
      	$pass = "diarypass";
        $con = new Mongo("mongodb://" . $username . ":" . $pass . "@ds0544345.mongolab.com:66297/mydiary");
        return $con;
      }
      
      // Get count of all the notes in collection
      public function getNotesCount() {
        try{
          $con = MongoDB1::connect();
          $myCollection = $con->mydiary->diary; // mydiary: database, diary: collection

          $count = $myCollection->count();
        } catch (MongoCursorException $e) {
          echo "Error message: ".$e->getMessage()."<br/>";
          echo "Error code: ".$e->getCode()."<br/>";
        }
        return $count; 
      }
      
      // Get all notes in collection
      public function getNotes() {
        $results = [];
        
        try{
          $con = MongoDB1::connect();
          $myCollection = $con->mydiary->diary;

          // Find everything in our collection:
          $results = $myCollection->find()->sort(array("_id" => -1));

          /*
          // Loop through all results
          foreach ($results as $document) {

            // Attributes of a document come back in an array.
            $note = $document['note'];

            // Technically, _id is a MongoId object. It can 
            // be automatically converted to a string, though.
            $id = $document['_id'];

            // Print out the values.
            //printf("Note : %s<br/>", $note);
          }
          */
          
        } catch (MongoCursorException $e) {
          echo "Error message: ".$e->getMessage()."<br/>";
          echo "Error code: ".$e->getCode()."<br/>";
        } 
        
        return $results;
  
      }
      
      // Save note to collection
      public function saveNote($post) {
         try{
          $con = MongoDB1::connect();
          $myCollection = $con->mydiary->diary;
          $doc = array(
              "note" => $post
          );

          $myCollection->insert($doc);
          
        } catch (MongoCursorException $e) {
          echo "Error message: ".$e->getMessage()."<br/>";
          echo "Error code: ".$e->getCode()."<br/>";
        }
      }
      
      // Delete note from collection
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
