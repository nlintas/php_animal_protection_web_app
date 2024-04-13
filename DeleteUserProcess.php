<?php

  // Get DB connection
  require( 'Connection.php' );
  //Check if user is logged in and get details
  require( 'SessionProcess.php' );

  //Check if the user is logged in
  if ( $hasSession ) {

    //Get directories of pet images
    if(!($petPhotos = mysqli_query($conn, "SELECT photo FROM pet WHERE userID = $userID;"))){
      header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Unable to delete Account, cannot retrieve pet images' ));
      mysqli_close( $conn );
      die;
    }

    //Get directory of user image
    if(!($userPhoto = mysqli_query($conn, "SELECT photo FROM user WHERE userID = $userID;"))){
      //Report Error
      header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Unable to delete Account, cannot retrieve user image' ));
      mysqli_close( $conn );
      die;
    }

    // Delete user account and all postings/events/pets
    $deleteUserQuery = "DELETE FROM lost_pet WHERE petID IN (SELECT petID FROM pet WHERE userID = $userID);";
    $deleteUserQuery .=  "DELETE FROM event WHERE userID = $userID;";
    $deleteUserQuery .= "DELETE FROM notification WHERE userID = $userID;";
    $deleteUserQuery .= "DELETE FROM pet WHERE userID = $userID;";
    $deleteUserQuery .= "DELETE FROM session WHERE userID = $userID;";
    $deleteUserQuery .= "DELETE FROM user WHERE userID = $userID;";

    // Perform multi query
    if ( $conn->multi_query( $deleteUserQuery ) ) {
      //Query Success

      session_destroy();

      //Delete all pet images if they are not the default
      if(mysqli_num_rows($petPhotos) > 0){
        while($row = mysqli_fetch_assoc($petPhotos)){
          if(strcmp($row['photo'],"images\profile\pet-no-image.png") != 0){
            unlink($row['photo']);
          }
        }
      }

      //Delete all pet images if they are not the default
      if(mysqli_num_rows($userPhoto) > 0){
        $row = mysqli_fetch_assoc($userPhoto);
        if(strcmp($row['photo'],"images\profile\user-no-image.png") != 0){
          unlink($row['photo']);
        }
      }
      header( 'Location: Index.php');
    }
    else {
      //Query Failure
      header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Unable to delete Account, if the issue persists please contact support' ));
    }
  }
  else {
    //Report Error
    header( 'Location: Index.php?errorMessage=' . urlencode( 'Unable to delete Account, not logged in' ));
  }

  //Exit
  mysqli_close( $conn );
  die;
?>
