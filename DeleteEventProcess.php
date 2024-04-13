<?php

  //Get eventID and petID for records to be deleted
  if(isset($_GET['eventID']) || isset($_GET['petID'])){

    //Get DB connection
    require('Connection.php');
    //Check if user is logged in and get details
    require('SessionProcess.php');

    //If the the user is logged in
    if($hasSession){

      //Get eventID and petID
      $eventID = json_decode($_GET['eventID']);
      $petID = json_decode($_GET['petID']);

      //Check both IDs for validity (integer)
      if ( (!filter_var( $eventID, FILTER_VALIDATE_INT ) || $eventID <= 0) && $eventID != null) {
        //Report error
        echo "Selected event is invalid, it may not exist";
        mysqli_close($conn);
        die;
      }
      else if ( (!filter_var( $petID, FILTER_VALIDATE_INT ) || $petID <= 0) && $petID != null) {
        //Report error
        echo "Selected pet is invalid, it may not exist ";
        mysqli_close($conn);
        die;
      }

      //Base eventDeletionQuery
      $eventDeletionQuery = "";

      //Check if requested deletion is lost pet
      if(!empty($eventID) && !empty($petID)){

        //Delete lost_pet record
        $eventDeletionQuery .=
                              "
                              DELETE FROM lost_pet
                              WHERE eventID = $eventID
                              AND petID = $petID;
                              ";
      }

      //Check if Event is being deleted
      if(!empty($eventID)){
        //Delete event record
        $eventDeletionQuery .=
                              "
                              DELETE FROM event
                              WHERE eventID = $eventID
                              AND userID = $userID;
                              ";
      }

      //Check if pet is being deleted
      if(!empty($petID)){

        //Get directory of pet image
        if($result = mysqli_query($conn, "SELECT photo FROM pet WHERE petID = $petID;")){
          $photo = mysqli_fetch_assoc($result);
          $photo = $photo['photo'];
        }
        else{
          //Report error
          echo "Unable to delete pet, if the issue persists please call for support";
          mysqli_close($conn);
          die;

        }

        // Delete pet record
        $eventDeletionQuery .=
                            "
                            DELETE FROM pet
                            WHERE petID = $petID
                            AND userID = $userID;
                            ";
      }

      //Execute multi-query
      if(mysqli_multi_query($conn, $eventDeletionQuery)){

        //If the pet photo was not the default, delete it
        if(!empty($petID) && (strcmp($photo,"images\profile\pet-no-image.png") != 0)){
          unlink($photo);
        }

        //Report success
        echo "Post was successfully deleted!";
        mysqli_close($conn);
        die;
      }
      else{
        //Report Query Error
        echo "Unable to perform deletion, please report this issue";
      }
    }
    else{
      //Report logged in error
      echo "Unable to delete post, User is not logged in";
    }

    //Exit
    mysqli_close($conn);
    die;
  }
 ?>
