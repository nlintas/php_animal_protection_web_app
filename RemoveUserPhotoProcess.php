<?php
  //Create DB connection
  require('Connection.php');
  //Check if user is logged in and get details
  require('SessionProcess.php');

  //Check if user is logged in
  if($hasSession){

    //Retrieve users current photo directory
    $photoDirect = mysqli_query($conn, "SELECT photo FROM user WHERE userID = $userID;");

    //Check if query succeeded
    if($photoDirect){
      $photoDirect = mysqli_fetch_assoc($photoDirect);

      //Check if photo is default
      if(strcmp($photoDirect['photo'],"images\profile\user-no-image.png") == 0){
        //Report success
        echo 'success';
        die;
      }
      else{
        //Query Update user photo with default and check if Query succeeded
        if(mysqli_query($conn, "UPDATE user SET photo =" . " 'images\\\profile\\\user-no-image.png' " . "WHERE userID = $userID;")){
          //Remove users old photo
          unlink($photoDirect['photo']);
          echo 'success';
        }
        else{
          //Report failure
          echo 'Unable to remove photo, please contact support';
        }
      }
    }
    else{
      //Report failure
      echo 'Unable to remove photo, please contact support';
    }
  }
  else{
      echo 'Not logged in';
  }

  //exit
  mysqli_close($conn);
  die;
?>
