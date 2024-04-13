
<?php
  //Check if variable was sent
  if(!empty($_GET['country'])){
    //Get and sanitize input
    $location = filter_var($_GET['country'], FILTER_SANITIZE_STRING);
    //Create DB connection
    require('Connection.php');

    $queryGeneralEvents = "
                            SELECT event.country_long, event.street, event.postcode, description, radius, type ,username, event.date_created, event.eventID, event.country_short
                            FROM event, user, event_type
                            WHERE event.event_typeID = event_type.event_typeID
                            AND user.userID = event.userID
                            AND type != 'Lost Pet'
                            AND event.country_short = ?;
                        ";

    //Execute Query and retrieve all general events (E.x poison) from DB based on input variable
    $query = $conn -> prepare($queryGeneralEvents);
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
