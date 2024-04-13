<?php

  if(isset($_POST['submit'])){
    //Create DB connection
    include('Connection.php');
    //Check if user is logged in and get details
    include('SessionProcess.php');

    if(!$hasSession){
        header('Location: AdoptionPage.php?errorMessage=' . urlencode('User is not logged in'));
        die;
    }

    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $firstColour = filter_var( $_POST['firstColour'], FILTER_SANITIZE_STRING);
    $secondColour = json_decode(filter_var( $_POST['secondColour'], FILTER_SANITIZE_STRING));
    $thirdColour = json_decode(filter_var( $_POST['thirdColour'], FILTER_SANITIZE_STRING));
    $health = filter_var( $_POST['pet_hstatus'], FILTER_SANITIZE_STRING );
    $age = $_POST['age'];
    $breed = $_POST['breed'];
    $species = $_POST['species'];

    //check for unvalid data

    if(empty($gender) || empty($age) || empty($breed) || empty($firstColour) || empty($name) || empty($species) || empty($health)){

        header('Location: AdoptionPage.php?errorMessage=' . urlencode('Missing pet information'));
        mysqli_close($conn);
        die;
    }
    else if(strlen($description) > 600){

        header('Location:AdoptionPage.php?errorMessage=' . urlencode('Adoption description is to big'));
        mysqli_close($conn);
        die;
    }

    //Validate input as integer values
    if ( !filter_var( $species, FILTER_VALIDATE_INT ) ) {
        header( 'Location: AdoptionPage.php?errorMessage=' . urlencode( 'Provided pet species is invalid' ) );
        mysqli_close($conn);
        die;
    } else if ( !filter_var( $breed, FILTER_VALIDATE_INT ) ) {
        header( 'Location: AdoptionPage.php?errorMessage=' . urlencode( 'Provided breed is invalid' ) );
        mysqli_close($conn);
        die;
    } else if ( !filter_var( $age, FILTER_VALIDATE_INT ) ) {
        header( 'Location: AdoptionPage.php?errorMessage=' . urlencode( 'Pet age is invalid' ) );
        mysqli_close($conn);
        die;
    }


    //image code

    if(!empty($_FILES['adoptionImage']['name'])){

      $image = $_FILES['adoptionImage']['tmp_name'];
      $imageName = $_FILES['adoptionImage']['name'];
      $imageFileType = strtolower(pathinfo($imageName,PATHINFO_EXTENSION));
      $extensions = array("jpg", "png", "jpeg");


      $pos = strpos($imageName,'php');
      if(!($pos === false)) {
        header('Location: AdoptionPage.php?errorMessage=' . urlencode('Adoption creation failed, Image is not considered safe'));
        mysqli_close($conn);
        die;
      }
      else if(!in_array($imageFileType, $extensions)){
        header('Location: AdoptionPage.php?errorMessage=' . urlencode('Adoption creation failed, Image type not supported please use jpeg/jpg/png'));
        mysqli_close($conn);
        die;
      }
      else if($_FILES['adoptionImage']['size'] > 5000000){
        header('Location: AdoptionPage.php?errorMessage=' . urlencode('Adoption creation failed, Image size is too big please use images below 5MB'));
        mysqli_close($conn);
        die;
      }

      $targetDir = 'User_Images/Adoption_Images/';
      $random = uniqid();
      $finalDirectory = $targetDir . $random . '.' . $imageFileType;
      move_uploaded_file($image, $finalDirectory);

    }
    else{
      $finalDirectory = "images\profile\pet-no-image.png";
    }

    $petQuery = "INSERT INTO pet VALUES (DEFAULT, ?, ?, ?, ?, ?, 1, ?, DEFAULT, ?, ?, ?, ?, ?, ?);";

    //Generate metaphone of username for searching purposes
    $nameMetaphone = metaphone( $name );

    //Insert pet query
    $query = $conn -> prepare($petQuery);
    $query-> bind_param('ssssisssssii', $name, $gender, $description, $health, $age, $finalDirectory, $nameMetaphone, $firstColour, $secondColour, $thirdColour, $userID, $breed);
    if(!$query -> execute()){

      header('Location: AdoptionPage.php?errorMessage=' . urlencode('Adoption creation failed, please contact support'));
      mysqli_close($conn);
      die;
    }

    header('Location: AdoptionPage.php');
    mysqli_close($conn);
    die;
  }
?>
