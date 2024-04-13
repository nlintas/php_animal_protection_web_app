<?php

  // Check if user has submitted
  if(isset($_POST['submit'])){
    //Create DB Connection
    require( 'Connection.php' );
    //Check if the user is logged in and get details
    require( 'SessionProcess.php' );

    //Check if the user is logged in
    if ( !$hasSession ) {
        header( 'Location: Map.php?errorMessage=' . urlencode( 'Not logged in' ) );
        mysqli_close( $conn );
        die;
    }

    //Get data and sanitize
    $description = filter_var( $_POST['description'], FILTER_SANITIZE_STRING );
    $country = filter_var( $_POST['country'], FILTER_SANITIZE_STRING );
    $country_long = filter_var( $_POST['country_long'], FILTER_SANITIZE_STRING );
    $street = filter_var( $_POST['street'], FILTER_SANITIZE_STRING );
    $postcode = filter_var( $_POST['postcode'], FILTER_SANITIZE_STRING );
    $gender = filter_var( $_POST['gender'], FILTER_SANITIZE_STRING );
    $name = filter_var( $_POST['name'], FILTER_SANITIZE_STRING );
    $health = filter_var( $_POST['pet_hstatus'], FILTER_SANITIZE_STRING );
    $firstColour = filter_var( $_POST['firstColour'], FILTER_SANITIZE_STRING);
    $secondColour = filter_var( $_POST['secondColour'], FILTER_SANITIZE_STRING);
    $thirdColour = filter_var( $_POST['thirdColour'], FILTER_SANITIZE_STRING);

    $formType = $_POST['form-input'];
    $radius = $_POST['radius'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];

    //Check for valid data
    if ( empty( $formType ) ) {
        header( 'Location: Map.php?errorMessage=' . urlencode( 'The event type was not chosen' ) );
        die;
    }

    if ( !( filter_var( $formType, FILTER_VALIDATE_INT ) < 3 ) ) {
        header( 'Location: Map.php?errorMessage=' . urlencode( 'Event type is invalid' ) );
        die;
    }

    if ( !filter_var( $radius, FILTER_VALIDATE_INT ) && $radius != 0 ) {
        header( 'Location: Map.php?errorMessage=' . urlencode( 'Radius is invalid' ) );
        die;
    }

    if ( strlen( $description ) > 600 ) {
        header( 'Location: Map.php?errorMessage=' . urlencode( 'Description is to big' ) );
        die;
    }

    if ( empty( $country ) || empty( $country_long ) || empty( $street ) || empty( $postcode ) ) {
        header( 'Location: Map.php?errorMessage=' . urlencode( 'Missing event location data, please try again' ) );
        die;
    }

    //Query for event insertion
    $eventQuery = 'INSERT INTO event VALUES(DEFAULT, ?, ?, ?, ?, ?, ?, DEFAULT, ?, ?);';

    //Execute event insertion query
    $query = $conn -> prepare( $eventQuery );
    $query-> bind_param( 'sssssiii', $country, $country_long, $street, $postcode, $description, $radius, $formType, $userID );
    if ( !$query -> execute() ) {

      //Report Error
      header( 'Location: Map.php?errorMessage=' . urlencode( 'Event creation failed, please contact support' ) );
      mysqli_close( $conn );
      die;
    }
    else {
      //Save last inserted record ID
      $lastEventID = $conn -> insert_id;
    }

    //Check type of form user has requested
    if ( $formType == 1 ) {

      //Check data for validity
      if ( empty( $gender ) || empty( $health ) || empty( $firstColour ) || empty( $species ) || empty( $breed ) || empty( $name ) ) {
          header( 'Location: Map.php?errorMessage=' . urlencode( 'Missing lost pet information, please check again' ) );
          die;
      }

      //Check pet name conforms with standards set by regex
      if ( !preg_match( '/^[a-zA-Z0-9\d\s]+$/', $name ) ) {

          header( 'Location: Map.php?errorMessage=' . urlencode( 'invalid pet name, only alphanumeric letters are allowed' ) );
          die;
      }

      //Validate input as integer values
      if ( !filter_var( $species, FILTER_VALIDATE_INT ) ) {
          header( 'Location: Map.php?errorMessage=' . urlencode( 'Species is invalid' ) );
          die;
      } else if ( !filter_var( $breed, FILTER_VALIDATE_INT ) ) {
          header( 'Location: Map.php?errorMessage=' . urlencode( 'Breed is invalid' ) );
          die;
      } else if ( !filter_var( $age, FILTER_VALIDATE_INT ) ) {
          header( 'Location: Map.php?errorMessage=' . urlencode( 'Age is invalid' ) );
          die;
      }

      //Check if user has submitted a file
      if (!empty( $_FILES['eventImage']['name'] ) ) {

        $image = $_FILES['eventImage']['tmp_name'];
        $imageName = $_FILES['eventImage']['name'];
        $imageFileType = strtolower( pathinfo( $imageName, PATHINFO_EXTENSION ) );
        $extensions = array( 'jpg', 'png', 'gif', 'peg' );

        //Verify file does not contain php tags, wrong extension, invalid size
        $pos = strpos($imageName,'php');
        if(!($pos === false)) {
          mysqli_query($conn, $undoEventQuery);
          header('Location: Map.php?errorMessage=' . urlencode('Lost Pet creation failed, Image is not safe'));
          mysqli_close($conn);
          die;
        }
        else if(!in_array($imageFileType, $extensions)){
          mysqli_query($conn, $undoEventQuery);
          header('Location: Map.php?errorMessage=' . urlencode('Lost Pet creation failed, Image type not supported'));
          mysqli_close($conn);
          die;
        }
        else if($_FILES['eventImage']['size'] > 5000000){
          mysqli_query($conn, $undoEventQuery);
          header('Location: Map.php?errorMessage=' . urlencode('Lost Pet creation failed, Image size is too big'));
          mysqli_close($conn);
          die;
        }

        //Move provided file to permanent folder
        $targetDir = 'User_Images/Lost_Pets_Images/';
        $random = uniqid();
        $finalDirectory = $targetDir . $random . '.' . $imageFileType;
        move_uploaded_file($image, $finalDirectory);

      }
      else{
        //Set default image for pet with provided directory
        //<div>Icons made by <a href="https://www.flaticon.com/authors/darius-dan" title="Darius Dan">Darius Dan</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
        $finalDirectory = 'images\profile\pet-no-image.png';
      }

      //query code for the event a failure occurs in query execution later, this query code removes the already inserted event previously
      $undoEventQuery = "DELETE FROM event WHERE eventID = $lastEventID;";

      //Generate metaphone of username for searching purposes
      $nameMetaphone = metaphone( $name );

      // Pet insertion query
      $petQuery = 'INSERT INTO pet VALUES (DEFAULT, ?, ?, ?, ?, ?, 0, ?, DEFAULT, ?, ?, ?, ?, ?, ?);';

      //Insert pet query
      $query = $conn -> prepare( $petQuery );
      $query-> bind_param( 'ssssisssssii', $name, $gender, $description, $health, $age, $finalDirectory, $nameMetaphone, $firstColour, $secondColour, $thirdColour, $userID, $breed );
      if ( !$query -> execute() ) {

        // In the event the query fails, remove the last inserted image from the file directory it is stored in and undo the event insertion
        mysqli_query( $conn, $undoEventQuery );
        unlink($finalDirectory);
        header( 'Location: Map.php?errorMessage=' . urlencode( 'Lost Pet creation failed, please contact support' ) );
        mysqli_close( $conn );
        die;

      } else {
        //Store last pet insertion ID for later
        $lastPetID = $conn -> insert_id;
      }

      //query code for the event a failure occurs in query execution later, this query code removes the already inserted pet previously
      $undoPetQuery = "DELETE FROM pet WHERE petID = $lastPetID;";

      //Lost pet insertion query
      $petEventQuery = 'INSERT INTO lost_pet VALUES (DEFAULT, ?, ?);';

      //Execute lost per insertion query
      $query = $conn -> prepare( $petEventQuery );
      $query-> bind_param( 'ii', $lastPetID, $lastEventID );
      if ( !$query -> execute() ) {

        // In the event the query fails, remove the last inserted image from the file directory it is stored in and undo the event, pet insertion
        unlink($finalDirectory);
        mysqli_query( $conn, $undoPetQuery );
        mysqli_query( $conn, $undoEventQuery );
        header( 'Location: Map.php?errorMessage=' . urlencode( 'Lost Pet creation failed, please contact support' ) );
        mysqli_close( $conn );
        die;
      }
    }
  }

  header( 'Location: Map.php' );
  die;
?>
