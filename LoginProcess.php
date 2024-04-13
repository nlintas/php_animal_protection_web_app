<?php

  //Check if user has submitted
  if(isset($_POST['submit'])){

    //Create BD connection
    require( 'Connection.php' );
    //Check if user is logged and get details
    require( 'SessionProcess.php' );

    //Check if user is logged
    if ( $hasSession ) {

      //Already logged in;
      header( 'Location: Login.php?errorMessage=' . urlencode( 'Already logged in' ) );
      mysqli_close( $conn );
      die;
    }

    //Get and filter user input
    $username = filter_var( $_POST['username'], FILTER_SANITIZE_STRING );
    $password = filter_var( $_POST['password'], FILTER_SANITIZE_STRING );

    // Check for empty input
    if ( empty( $username ) || empty( $password ) ) {
      header( 'Location: Login.php?errorMessage=' . urlencode( 'Missing Input' ) );
      mysqli_close( $conn );
      die;
    }
    else {

      //Check if user password and username comply with standards set by regex
      if ( !preg_match( '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z0-9]+$/', $password ) ) {
        header( 'Location: Login.php?errorMessage=' . urlencode( 'Password is invalid' ) );
        mysqli_close( $conn );
        die;
      } else if ( !preg_match( '/^[a-zA-Z0-9\d]+$/', $username ) ) {
        header( 'Location: Login.php?errorMessage=' . urlencode( 'Username is invalid' ) );
        mysqli_close( $conn );
        die;
      }

      //Check for an existing account
      $query = $conn -> prepare( 'SELECT userID, password FROM user WHERE username = ?;' );
      $query-> bind_param( 's', $username);
      if ( !$query -> execute() ) {
        //Report query error
        header( 'Location: Login.php?errorMessage=' . urlencode( 'Login failed' ) );
        mysqli_close( $conn );
        die;
      }

      //Get result from query
       $isValid = $query -> get_result();
        $isValid = mysqli_fetch_assoc( $isValid );

      //If only one specific account exists that matches the user input
      if (password_verify($password, $isValid['password']) ) {

        //Create session, save session id to event table
        //Regenerate session?
        session_start();

        $sessionID = session_id();

        mysqli_query( $conn, "INSERT INTO session(userID, sessionCode) VALUES('" . $isValid['userID'] . "' , '"  . $sessionID . "');" );
        mysqli_close( $conn );
        header( 'Location: Index.php' );
        die;
    } else {
        //Account does not exist
        header( 'Location: Login.php?errorMessage=' . urlencode( 'Account does not exists' ) );
        mysqli_close( $conn );
        die;
    }

  }
}
?>
