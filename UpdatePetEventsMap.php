
<?php
  //Check if variable was sent
  if(!empty($_GET['country'])){
    //Get and sanitize input
    $location = filter_var($_GET['country'], FILTER_SANITIZE_STRING);
    //Create DB connection
    require('Connection.php');

    $queryPetEvents = "
                        SELECT username, event.eventID, event.country_long, event.country_short, event.street, event.postcode, event.description, radius, event.date_created, type, breed.name as breedName, species.name as speciesName, pet.name as petName, pet.gender as petGender, health_status, pet.age as petAge, colour1, colour2, colour3, pet.photo
                        FROM event, user, event_type, pet, breed, lost_pet, species
                        WHERE event.event_typeID = event_type.event_typeID
                        AND user.userID = event.userID
                        AND event.eventID = lost_pet.eventID
                        AND lost_pet.petID = pet.petID
                        AND pet.breedID = breed.breedID
                        AND breed.speciesID = species.speciesID
                        AND type = 'Lost Pet'
                        AND event.country_short = ?;
                        ";

    //Execute Query and retrieve all lost pets from DB based on input variable
    $query = $conn -> prepare($queryPetEvents);
    $query-> bind_param('s', $location);
    if(!$query -> execute()){
      echo 'null';
      mysqli_close($conn);
      die;
    }

    $result = $query -> get_result();
    $array = [];

    //Store all rows into an array
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
          array_push($array, $row);
      }
    }

    //Echo Json object of the completed array;
    echo json_encode($array);
    mysqli_close($conn);
    die;
  }
?>
