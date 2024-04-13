<?php

    //Check for session between the user and server via the database (session table)
    //session_set_cookie_params(3600, null, null, true, null, null);
    session_start();

    //Consider IP checking.
    $sessionID = session_id();
    $hasSession = false;

    //Query for userID, username based on current session id
    if($result = mysqli_query($conn, "SELECT user.username, session.userID FROM session, user WHERE sessionCode = '" . $sessionID . "' AND user.userID = session.userID;")){
        if(mysqli_num_rows($result) == 1){
          //In the event the user is already connected, fetch username and userID
          $row = mysqli_fetch_assoc($result);
          $hasSession = true;
          $userID = $row['userID'];
          $username = $row['username'];
        }
        else{
            //User is not logged in
            session_destroy();
        }
    }
?>
