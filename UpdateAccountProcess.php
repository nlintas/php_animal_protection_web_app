<?php

//Check if user submitted new details
  if(isset($_POST['submit'])){

    //Create DB connection
    require('Connection.php');
    //Check if user is logged in and get details
    require('SessionProcess.php');

    //Check if user is logged in
    if(!$hasSession){
      header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Not logged in' ) );
      die;
    }

    //Get Input from user and sanitize
    $username = filter_var( $_POST['username'], FILTER_SANITIZE_STRING );
    $password = filter_var( $_POST['password'], FILTER_SANITIZE_STRING );
    $confirmPassword = filter_var( $_POST['confirm-password'], FILTER_SANITIZE_STRING );
    $gender = filter_var( $_POST['gender'], FILTER_SANITIZE_STRING );
    $countryShort = filter_var( $_POST['country_short'], FILTER_SANITIZE_STRING );
    $countryLong = filter_var( $_POST['country_long'], FILTER_SANITIZE_STRING );
    $postCode = filter_var( $_POST['postCode'], FILTER_SANITIZE_STRING );
    $street = filter_var( $_POST['street'], FILTER_SANITIZE_STRING );
    $age = $_POST['age'];
    $email = $_POST['email'];


    //Check for valid integers and email
    if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) || strlen($email) > 255) {
      header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Email is invalid' ) );
      die;
    }
    else if(!filter_var( $age, FILTER_VALIDATE_INT ) || $age < 0 || $age > 16777215){
      header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Age is invalid' ) );
      die;
    }

    //Check for empty input or large input
    if ( empty( $username ) || empty( $email ) || empty( $gender ) || empty( $countryShort )
    || empty( $countryLong ) || empty( $postCode ) || empty( $street )) {
      header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Missing New Input') );
      die;
    }
    else if(strlen($username) > 30){
      header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Username is too long' ) );
      die;
    }
    else if(strlen($password) > 255){
      header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Password is too long' ) );
      die;
    }
    else if(strlen($gender) > 255){
      header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Gender is too long' ) );
      die;
    }
    else if(strlen($country_short) > 2){
      header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Country short name is too long' ) );
      die;
    }
    else if(strlen($country_long) > 50){
      header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Country long name too long' ) );
      die;
    }
    else if(strlen($postCode) > 25){
      header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Postcode is too long' ) );
      die;
    }
    else if(strlen($street) > 90){
      header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Street name is too long' ) );
      die;
    }

    //Check if username is valid by standards set by regex
    if ( !preg_match( '/^[a-zA-Z0-9\d]+$/', $username ) || strlen($username) < 4 ) {
      header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Username is invalid or too short' ) );
      die;
    }


    //Check if user submitted new Password
    if(!empty($password) && !empty($confirmPassword)){

      //Check is passwords are equal and within standards set by regex
      if ( !preg_match( '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z0-9]+$/', $password ) || strlen($password) < 4 ) {
          header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Password is invalid or too short' ) );
          mysqli_close( $conn );
          die;
      } else if ( strcmp( $password, $confirmPassword ) ) {
          header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Passwords do not match' ) );
          mysqli_close( $conn );
          die;
      }


      $passwordQuery .=
                      "
                      UPDATE user
                      SET password = ?
                      WHERE userID = $userID;
                      ";

      //Execute query for updating user password
      $query = $conn -> prepare($passwordQuery);
      $query-> bind_param( 's', $password);
      if ( !$query -> execute() ) {
        //Report error
        header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Unable to update account password, all other changes have been ignored' ) );
        mysqli_close( $conn );
        die;
      }
    }

    //Create new metaphone for searching purposes
    $usernameMetaphone = metaphone($username);
    $updateAccountQuery =
                        "
                        UPDATE user
                        SET username = ?,
                        email = ?,
                        gender = ?,
                        age = ?,
                        country_short = ?,
                        country_long = ?,
                        postcode = ?,
                        street = ?,
                        username_metaphone = ?
                        WHERE userID = $userID;
                        ";


    //Execute query and update user details with newly provided user values
    $query = $conn -> prepare( $updateAccountQuery);
    $query-> bind_param('sssisssss', $username, $email, $gender, $age, $countryShort, $countryLong, $postCode, $street, $usernameMetaphone);
    if ( !$query -> execute() ) {

      //In the event of failure, add message to url if the password has been updated.
      if(!empty($password)){
        $message = ",Passwords have been updated";
      }
      else{
        $message = "";
      }

      header( 'Location: my_profile.php?errorMessage=' . urlencode( 'Unable to update account' . $message ) );
      mysqli_close( $conn );
      die;
    }

    //Exit
    header( 'Location: my_profile.php');
    mysqli_close( $conn );
    die;
  }
?>
