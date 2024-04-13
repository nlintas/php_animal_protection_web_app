<?php

  //Check if user has submitted a form
  if(isset($_POST['submit'])){

    //Get Input and sanitize
    $username = filter_var( $_POST['username'], FILTER_SANITIZE_STRING );
    $password = filter_var( $_POST['password'], FILTER_SANITIZE_STRING );
    $confirmPassword = filter_var( $_POST['confirmPassword'], FILTER_SANITIZE_STRING );
    $gender = filter_var( $_POST['gender'], FILTER_SANITIZE_STRING );
    $country = filter_var( $_POST['country'], FILTER_SANITIZE_STRING );
    $country_long = filter_var( $_POST['country_long'], FILTER_SANITIZE_STRING );
    $postCode = filter_var( $_POST['postCode'], FILTER_SANITIZE_STRING );
    $street = filter_var( $_POST['street'], FILTER_SANITIZE_STRING );
    $age = $_POST['age'];
    $email = $_POST['email'];
    $streetNumber = $_POST['streetNumber'];

    //Validate user inputs as integers or email
    if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) || strlen($email) > 255) {
      header( 'Location: Register.php?errorMessage=' . urlencode( 'Provided Email is invalid' ) );
      die;
    } else if ( !filter_var( $streetNumber, FILTER_VALIDATE_INT ) || $streetNumber < 0) {
      header( 'Location: Register.php?errorMessage=' . urlencode( 'Provided Address Number is invalid, it must be a number' ) );
      die;
    }
    else if(!filter_var( $age, FILTER_VALIDATE_INT ) || $age < 0 || $age > 16777215){
      header( 'Location: Register.php?errorMessage=' . urlencode( 'Age is invalid, it must be a number' ) );
      die;
    }

    //Check for empty or large input
    if ( empty( $username ) || empty( $password ) || empty( $confirmPassword ) || empty( $email ) || empty( $gender ) || empty( $country )
    || empty( $country_long ) || empty( $postCode ) || empty( $street ) || empty( $streetNumber )) {
      header( 'Location: Register.php?errorMessage=' . urlencode( 'Missing Input, please check again' ) );
      die;
    }
    else if(strlen($username) > 30){
      header( 'Location: Register.php?errorMessage=' . urlencode( 'Username is too long' ) );
      die;
    }
    else if(strlen($password) > 255){
      header( 'Location: Register.php?errorMessage=' . urlencode( 'Password is too long' ) );
      die;
    }
    else if(strlen($gender) > 255){
      header( 'Location: Register.php?errorMessage=' . urlencode( 'Gender is too long' ) );
      die;
    }
    else if(strlen($country_short) > 2){
      header( 'Location: Register.php?errorMessage=' . urlencode( 'Country short name is too long' ) );
      die;
    }
    else if(strlen($country_long) > 50){
      header( 'Location: Register.php?errorMessage=' . urlencode( 'Country long name too long' ) );
      die;
    }
    else if(strlen($postCode) > 25){
      header( 'Location: Register.php?errorMessage=' . urlencode( 'Postcode is too long' ) );
      die;
    }
    else if(strlen($street) > 90){
      header( 'Location: Register.php?errorMessage=' . urlencode( 'Street name is too long' ) );
      die;
    }

    //Check for valid password and username with standards set by regex
    if ( !preg_match( '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z0-9]+$/', $password ) || strlen($password) < 4 ) {
        header( 'Location: Register.php?errorMessage=' . urlencode( 'Password is invalid, please check for size and requirements' ) );
        die;
    }
    else if ( !preg_match( '/^[a-zA-Z0-9\d]+$/', $username ) || strlen($username) < 4 ) {
        header( 'Location: Register.php?errorMessage=' . urlencode( 'Username is invalid, please check for size and requirements' ) );
        die;
    }

    //Compare Password with confirmation  Password
    if (strcmp( $password, $confirmPassword ) != 0) {
        header( 'Location: Register.php?errorMessage=' . urlencode( 'Passwords do not match' ) );
        die;
    } else {

       //HASH password
     $hash = password_hash($password, PASSWORD_BCRYPT);

      //Create DB connection
      require('Connection.php');

      //Check if user has submitted a file
      if(!empty($_FILES['userImage']['name'])){

        $image = $_FILES['userImage']['tmp_name'];
        $imageName = $_FILES['userImage']['name'];
        $imageFileType = strtolower(pathinfo($imageName,PATHINFO_EXTENSION));
        $extensions = array("jpg", "png", "jpeg");


        //Verify file does not contain php tags, wrong extension, invalid size
        $pos = strpos($imageName,'php');
        if(!($pos === false)) {
          header('Location: Register.php?errorMessage=' . urlencode('Account creation failed, Image is not safe'));
          mysqli_close($conn);
          die;
        }
        else if(!in_array($imageFileType, $extensions)){
          header('Location: Register.php?errorMessage=' . urlencode('Account creation failed, Image type not supported'));
          mysqli_close($conn);
          die;
        }
        else if($_FILES['userImage']['size'] > 5000000){
          header('Location: Register.php?errorMessage=' . urlencode('Account creation failed, Image size is too big'));
          mysqli_close($conn);
          die;
        }

        //Move provided file to permanent folder
        $targetDir = 'User_Images/Profile_Images/';
        $random = uniqid();
        // Save file directory
        $finalDirectory = $targetDir . $random . '.' . $imageFileType;
        //Move file to directory
        move_uploaded_file($image, $finalDirectory);

      }
      else{
        //Set default image for user with provided directory
        $finalDirectory = "images\profile\user-no-image.png";
      }

      //Query the databse for any existing passwords, users, emails that are already in use
      $accountDuplicateQuery = 'SELECT username FROM user WHERE username = ? OR email = ? OR password = ?;';

      $query = $conn -> prepare( $accountDuplicateQuery );
      $query-> bind_param( 'sss', $username, $email, $hash );
      if ( !$query -> execute() ) {
        header( 'Location: Register.php?errorMessage=' . urlencode( 'Registration failed, please contact support' ) );
        mysqli_close( $conn );
        die;
      }

      $isValidAccount = $query -> get_result();

      //Check if account does not exist from prior query
      if ( mysqli_num_rows( $isValidAccount ) == 0 ) {

        //Create metaphone of username for searching purposes
        $usernameMetaphone = metaphone( $username );

        //Create new account
        $insertAccountQuery = 'INSERT INTO user VALUES(DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, DEFAULT, ?);';

        // Insert new account with provided details
        $query = $conn -> prepare( $insertAccountQuery );
        $street = $street . " " . $streetNumber;
        $query-> bind_param( 'ssssissssss', $username, $hash, $email, $gender, $age, $finalDirectory ,$country, $country_long, $postCode, $street, $usernameMetaphone );
        if ( !$query -> execute() ) {
          //Remove uploaded user file if set
          if(isset($image)){
            unlink($finalDirectory);
          }

          header( 'Location: Register.php?errorMessage=' . urlencode( 'Registration failed, please contact support' ) );
          mysqli_close( $conn );
          die;
        }
      } else {
          // account already exists
          header( 'Location: Register.php?errorMessage=' . urlencode( 'Account already exist, username, email or password are already in use' ) );
          mysqli_close( $conn );
          die;
      }

      //Redirect user after success
      header( 'Location: Index.php' );
      mysqli_close( $conn );
      die;
    }
  }
?>
