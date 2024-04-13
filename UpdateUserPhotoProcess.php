<?php

  //Create DB connection
  require('Connection.php');
  //Check if user is logged in and get details
  require('SessionProcess.php');

  //Check if user is logged in
  if($hasSession){

    //Check if user has submitted a file
    if(!empty($_FILES['photo']['name'])){

      $image = $_FILES['photo']['tmp_name'];
      $imageName = $_FILES['photo']['name'];
      $imageFileType = strtolower(pathinfo($imageName,PATHINFO_EXTENSION));
      $extensions = array("jpg", "png", "jpeg");

      //Verify file does not contain php tags, wrong extension, invalid size
      $pos = strpos($imageName,'php');
      if(!($pos === false)) {
        mysqli_close($conn);
        die;
      }
      else if(!in_array($imageFileType, $extensions)){
        mysqli_close($conn);
        die;
      }
      else if($_FILES['photo']['size'] > 5000000){
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

      //Query for users current photo directory
      $photoDirect = mysqli_query($conn, "SELECT photo FROM user WHERE userID = $userID;");

      //Check if query succeeded
      if($photoDirect){
        $photoDirect = mysqli_fetch_assoc($photoDirect);
      }
      else{
        mysqli_close($conn);
        die;
      }

      $updateUserPhoto = "UPDATE user SET photo = ? WHERE userID = $userID;";

      //Execute Query and update user with new photo provided
      $query = $conn -> prepare( $updateUserPhoto);
      $query-> bind_param( 's', $finalDirectory);
      if ($query -> execute() ) {
        //In the event of query success, Check if old user photo is default
        if(strcmp($photoDirect['photo'],"images\profile\user-no-image.png") != 0){
          //Remove old photo
          unlink($photoDirect['photo']);
        }
        //Return new photo directory to user page through ajax echo
        echo $finalDirectory;
      }
    }
  }

  //Exit
  mysqli_close($conn);
  die;
 ?>
