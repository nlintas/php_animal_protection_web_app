<?php

  //Stop the current session and return user to the previous page
  //Create DB connection
  require('Connection.php');
  //Check if user is logged in and get details
  require('SessionProcess.php');

  //Check if the user is logged in
  if($hasSession){
    //Query Deletion from session table for existing session that matches current sessionID
    if(!mysqli_query($conn, "DELETE FROM session WHERE sessionCode = '" . $sessionID . "';")){
      //Issues loggin out

    }
  }

  //Destroy session and redirect user to index page
  session_destroy();
  header('location:Index.php');
  mysqli_close($conn);
  die;
?>
