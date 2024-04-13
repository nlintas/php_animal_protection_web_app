<?php

  if(isset($_GET['choice'])){

    //Get the chosen species ID from user
    $choice = $_GET['choice'];

    //Validate that value is an integer
    if(!filter_var($choice, FILTER_VALIDATE_INT) || $choice <= 0){
        die;
    }

    //Create a connection to the database
    require('Connection.php');

    //Query forr all breeds on a specific species ID
    $queryBreed = "SELECT breedID, breed.name FROM breed WHERE speciesID= ?;";

    //prepare query and execute
    $query = $conn -> prepare($queryBreed);
    $query-> bind_param('i', $choice);
    if(!$query -> execute()){
      //If an error occurs
      mysqli_close($conn);
      die;
    }

    // Get results from query
    $result = $query -> get_result();

    //Echo into text form all breed names and IDs as <option> tags
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<option value =" . $row['breedID'] . ">" . $row['name'] . "</option>";
        }
    }
    //Close DB connection
    mysqli_close($conn);
  }

  die;
?>
