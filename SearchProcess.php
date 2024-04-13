<?php

  //Create DB connection
  require('Connection.php');
  //Check if user is logged in and get details
  require('SessionProcess.php');

  //Get all input from user / url
  $species = $_REQUEST['species'];
  $breed = $_REQUEST['breed'];
  $minAge = $_REQUEST['minAge'];
  $maxAge = $_REQUEST['maxAge'];
  $page = $_REQUEST['page'];
  $sortDate = json_decode($_REQUEST['sortDate']);
  $sortAlphabeticaly = json_decode($_REQUEST['sortAlphabeticaly']);

  //Sanitize string,boolean variable input
  $health = filter_var( $_REQUEST['health'], FILTER_SANITIZE_STRING );
  $country = filter_var( $_REQUEST['country'], FILTER_SANITIZE_STRING );
  $firstColour =  filter_var( $_REQUEST['firstColour'], FILTER_SANITIZE_STRING );
  $secondColour =  filter_var( $_REQUEST['secondColour'], FILTER_SANITIZE_STRING );
  $thirdColour =  filter_var( $_REQUEST['thirdColour'], FILTER_SANITIZE_STRING );

  $searchUsers = filter_var($_REQUEST['searchUsers'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
  $searchAdoptions = filter_var($_REQUEST['searchAdoptions'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
  $searchPoisons = filter_var($_REQUEST['searchPoisons'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
  $searchLostPets = filter_var($_REQUEST['searchLostPets'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
  $nearMe = filter_var($_REQUEST['nearMe'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

  $gender = json_decode($_REQUEST['gender']);

  //Sanitize gender array
  if(!empty($gender)){
    foreach ($gender as $key => $value) {
      $gender[$key] = filter_var( $value, FILTER_SANITIZE_STRING );
    }
  }

  //Validate user input as integer
  if((!filter_var( $minAge, FILTER_VALIDATE_INT ) && $minAge != 0) || (!filter_var( $maxAge, FILTER_VALIDATE_INT ) && $maxAge !=0) || $minAge > $maxAge){
    echo json_encode(array('error' => "Invalid age"));
    mysqli_close($conn);
    die;
  }
  else if(!filter_var( $species, FILTER_VALIDATE_INT ) && $species != 0){
    echo json_encode(array('error' => "Invalid pet species"));
    mysqli_close($conn);
    die;
  }
  else if(!filter_var( $breed, FILTER_VALIDATE_INT ) && $breed != 0){
    echo json_encode(array('error' => "Invalid pet breed"));
    mysqli_close($conn);
    die;
  }
  else if(!filter_var( $page, FILTER_VALIDATE_INT ) && $page != 0){
    echo json_encode(array('error' => "Error, offset is invalid"));
    mysqli_close($conn);
    die;
  }

  //Check if user is searching for "nearMe" (nearby events, pets) and is not logged in
  if($nearMe == true && !$hasSession){
    echo json_encode(array('error' => "Not logged in, you cannot search for nearby pets or features"));
    mysqli_close($conn);
    die;
  }
  else if($nearMe){

    //Execute query to get current logged in users location information
    $result = mysqli_query($conn, "SELECT country, postcode FROM user WHERE userID = $userID;");

    if(mysqli_num_rows($result) == 1){
      //Store users location information
      $row = mysqli_fetch_assoc($result);
      $userCountry = $row['country'];
      $userPostcode = $row['postcode'];
    }
    else {
      //Report Error
      echo json_encode(array('error' => "Unable to use nearMe function, please contact support"));
      mysqli_close($conn);
      die;
    }
  }

  //$Limit is the total maximum amount of rows returned for each query
  $limit = 10;

  //Check if the user has not selected any specific category of searching and if they have selected any pet filters
  if(!$searchLostPets && !$searchAdoptions && !$searchUsers && !$searchPoisons){
    if(!empty($firstColour) || !empty($secondColour) || !empty($thirdColour)
    || !empty($breed) || !empty($species) || !empty($country) || !empty($health) || !empty($gender) || ($minAge != 0 && $maxAge != 0)){
      //In the event the user has chosen no specific category of search but has chosen pet filters, limit the search to adoptions or lost pets
      //Limit the total amount of records per query to 5
      $limit = 5;
      $searchAdoptions = true;
      $searchLostPets = true;
    }
    else{
      //Allow all types of search to be quiried limiting each to a total of three records
      $limit = 3;
      $searchUsers = true;
      $searchPoisons = true;
      $searchAdoptions = true;
      $searchLostPets = true;
    }
  }

  //Check the requested user page and find the offset required
  if($page > 1){
    $start = ($page * $limit) - $limit;
  }
  else{
    $start = 0;
  }

  $search = trim($_REQUEST['search']);

  //Check if search input is provided
  if(!empty($search)){
    //Escape search input and explode it into an array of words
    $filtered = preg_replace("#[^0-9a-z\ ]#i","",$search);
    $filtered = mysqli_escape_string($conn, $filtered);
    $search = explode(" ", $filtered);
    $metaAll = metaphone($filtered);
  }

  //initialize query result arrays
  $userArray = array();
  $adoptionArray = array();
  $poisonArray = array();
  $lostPetArray = array();

  //initialize counters for total amount of records per query
  //This is used for page button creation client side
  $userCount = 0;
  $adoptionCount = 0;
  $poisonCount = 0;
  $lostPetCount = 0;


  //query to search users
  $searchUserQuery =
                    "
                    SELECT username, gender, email, country_long, country_short, photo, date_created
                    FROM user
                    ";

  //query to search poisons
  $searchPoisonsQuery =
                        "
                        SELECT country_long, country_short, street, postcode, description, radius, date_created, type, eventID
                        FROM event, event_type
                        WHERE event.event_typeID = event_type.event_typeID
                        AND type = 'Poison'
                        ";
  //query to search lost pets
  $searchLostPetsQuery =
                      "
                      SELECT country_long, country_short, street, postcode, event.description as description, radius, event.date_created as dateCreated, type, pet.petID as petID, pet.name as petName, pet.gender as petGender, health_status, pet.age as petAge, colour1, colour2, colour3, breed.name as breedName, species.name as speciesName, pet.photo, event.eventID
                      FROM event, lost_pet, event_type, breed, species, pet
                      WHERE event.event_typeID = event_type.event_typeID
                      AND type = 'Lost Pet'
                      AND for_adoption = 0
                      AND event.eventID = lost_pet.eventID
                      AND pet.petID = lost_pet.petID
                      AND pet.breedID = breed.breedID
                      AND breed.speciesID = species.speciesID
                      ";

  //query to search adoptions
  $searchAdoptionsQuery =
                          "
                          SELECT user.country_long, pet.petID as petID, pet.name as petName, pet.gender petGender, description, health_status, pet.age as petAge, pet.date_created as dateCreated, colour1, colour2, colour3, breed.name as breedName, species.name as speciesName, pet.photo
                          FROM breed, species, user, pet
                          WHERE user.userID = pet.userID
                          AND pet.breedID = breed.breedID
                          AND breed.speciesID = species.speciesID
                          AND pet.for_adoption = 1
                          ";


  //Check if user is searching for poisons
  if($searchPoisons){
    //Check if user is searching for "nearMe"
    if($nearMe){
      //Append additional SQL code to the query for vicinity
      $searchPoisonsQuery .=
                            "
                            AND event.country = '$userCountry'
                            AND event.postcode LIKE '%$userPostcode%'
                            ";
    }
    else if($country){
      //Append additional SQL code to the query for vicinity based on user selected country
      $searchPoisonsQuery .=
                            "
                            AND event.country = '$country'
                            ";
    }
  }

  //Check if user is searching for adoptions
  if($searchAdoptions){

    //Check if user has selected a specific breed and append SQl code to query
    if($breed != 0){
      $searchAdoptionsQuery .=
                              "
                              AND pet.breedID = $breed
                              ";
    }

    //Check if user has selected a specific species and append SQl code to query
    if($species != 0){
      $searchAdoptionsQuery .=
                              "
                              AND breed.speciesID = $species
                              ";
    }

    //Check if user is searching for "nearMe"
    if($nearMe){
      //Append additional SQL code to the query for vicinity
      $searchAdoptionsQuery .=
                              "
                              AND user.country = '$userCountry'
                              AND user.postcode = '$userPostcode'
                              ";
    }
    else if($country){
      //Append additional SQL code to the query for vicinity based on user selected country
      $searchAdoptionsQuery .=
                              "
                              AND user.country = '$country'
                              ";
    }

    //check if user has selected health and append SQL code to query
    if(!empty($health)){
        $searchAdoptionsQuery .= "AND health_status = '$health' ";
    }

    //check if user has selected genders and append SQL code to query
    if(!empty($gender)){

      $searchAdoptionsQuery .= "and (pet.gender = '$gender[0]' ";

      for($i = 1; $i < sizeof($gender); $i++){
        $searchAdoptionsQuery .= "OR pet.gender = '$gender[$i]' ";
      }

      $searchAdoptionsQuery .= ") ";
    }

    //check if user has selected an age range and append SQL code to query
    if($minAge != 0 || $maxAge != 0){
      $searchAdoptionsQuery .=
                              "
                              AND pet.age >= $minAge
                              AND pet.age <= $maxAge
                              ";
    }

    //check if user has selected any colours and append SQL code to query
    if(!empty($firstColour)){
      $searchAdoptionsQuery .=
                              "
                              AND (colour1 = '$firstColour'
                              OR colour2 = '$firstColour'
                              OR colour3 = '$firstColour')
                              ";
    }

    if(!empty($secondColour)){
      $searchAdoptionsQuery .=
                              "
                              AND (colour1 = '$secondColour'
                              OR colour2 = '$secondColour'
                              OR colour3 = '$secondColour')
                              ";
    }

    if(!empty($thirdColour)) {
      $searchAdoptionsQuery .=
                              "
                              AND (colour1 = '$thirdColour'
                              OR colour2 = '$thirdColour'
                              OR colour3 = '$thirdColour')
                              ";
    }
  }

  //check if user is searching for lost Pets
  if($searchLostPets){

    //Check if user has selected a specific breed and append SQl code to query
    if($breed != 0){
      $searchLostPetsQuery .=
                              "
                              AND pet.breedID = $breed
                              ";
    }

    //Check if user has selected a specific species and append SQl code to query
    if($species != 0){
      $searchLostPetsQuery .=
                              "
                              AND breed.speciesID = $species
                              ";
    }

    //Check if user is searching for "nearMe"
    if($nearMe){
      //Append additional SQL code to the query for vicinity
      $searchLostPetsQuery .=
                              "
                              AND event.country = '$userCountry'
                              AND event.postcode = '$userPostcode'
                              ";
    }
    else if($country){
      //Append additional SQL code to the query for vicinity based on user selected country
      $searchLostPetsQuery .=
                              "
                              AND event.country = '$country'
                              ";
    }

    //check if user has selected health and append SQL code to query
    if(!empty($health)){
        $searchLostPetsQuery .= "AND health_status = '$health' ";
    }

    //check if user has selected genders and append SQL code to query
    if(!empty($gender)){

      $searchLostPetsQuery .= "and (pet.gender = '$gender[0]' ";

      for($i = 1; $i < sizeof($gender); $i++){
        $searchLostPetsQuery .= "OR pet.gender = '$gender[$i]' ";
      }

      $searchLostPetsQuery .= ") ";
    }

    //check if user has selected an age range and append SQL code to query
    if($minAge != 0 || $maxAge != 0){
      $searchLostPetsQuery .=
                              "
                              AND pet.age >= $minAge
                              AND pet.age <= $maxAge
                              ";
    }

    //check if user has selected any colours and append SQL code to query
    if(!empty($firstColour)){
      $searchLostPetsQuery .=
                              "
                              AND (colour1 = '$firstColour'
                              OR colour2 = '$firstColour'
                              OR colour3 = '$firstColour')
                              ";
    }

    if(!empty($secondColour)){
      $searchLostPetsQuery .=
                              "
                              AND (colour1 = '$secondColour'
                              OR colour2 = '$secondColour'
                              OR colour3 = '$secondColour')
                              ";
    }

    if(!empty($thirdColour)) {
      $searchLostPetsQuery .=
                              "
                              AND (colour1 = '$thirdColour'
                              OR colour2 = '$thirdColour'
                              OR colour3 = '$thirdColour')
                              ";
    }
  }

  //Check if the search input provided from the user is empty
  if(!empty($search)){

    //Check which searches the user wants to perform and append additional SQL code
    if($searchUsers){
      $searchUserQuery .= "WHERE username_metaphone LIKE '%$metaAll%'";
    }

    if($searchAdoptions){
      $searchAdoptionsQuery .= "and ( name_metaphone LIKE '%$metaAll%'";
    }

    if($searchLostPets){
      $searchLostPetsQuery .= "and ( name_metaphone LIKE '%$metaAll%'";
    }

    if($searchPoisons){
      $searchPoisonsQuery .= " and ( true = false ";
    }

    //Iterate through the $search array for each word of the search input
    for($i = 0; $i <  sizeof($search); $i++){

      //For each word of the $search array create a metaphone for search and store it into a temporary variable
      $meta = metaphone($search[$i]);
      $word = $search[$i];

      //Check if the word is numeric
      if(!is_numeric($word)){

        //Check if the user is searching for poisons
        if($searchPoisons){

          $searchPoisonsQuery .=
                                "
                                OR country_long LIKE '%$word%'
                                OR description LIKE '%$word%'
                                OR street LIKE '%$word%'
                                OR postcode LIKE '%$word%'
                                ";
        }

        // Check if the user is searching for users
        if($searchUsers){
          $searchUserQuery .= "OR username_metaphone LIKE '%$meta%'";
        }

        //Check if the user is searching for lost pets
        if($searchLostPets){
          $searchLostPetsQuery .=
                                  "
                                  OR name_metaphone LIKE '%$meta%'
                                  OR event.description LIKE '%$word%'
                                  ";

          if(empty($firstColour) && empty($secondColour) && empty($thirdColour)){
            $searchLostPetsQuery .=
                                    "
                                    OR colour1 = '$word'
                                    OR colour2 = '$word'
                                    OR colour3 = '$word'
                                    ";
          }

          if(empty($gender)){
            $searchLostPetsQuery .=
                                    "
                                    OR pet.gender = '$word'
                                    ";
          }

          if(empty($country) && !$nearMe){
            $searchLostPetsQuery .=
                                    "
                                    OR event.country_long LIKE '%$word%'
                                    ";
          }

          if($breed == 0 ){
            $searchLostPetsQuery .=
                                    "
                                    OR breed.name LIKE '$word'
                                    ";
          }

          if($species == 0){
            $searchLostPetsQuery .=
                                    "
                                    OR species.name LIKE '$word'
                                    ";
          }

          if(empty($health)){

            $searchLostPetsQuery .=
                                    "
                                    OR health_status LIKE '$word'
                                    ";
          }
        }

        if($searchAdoptions){

          $searchAdoptionsQuery .=
                                  "
                                  OR name_metaphone LIKE '%$meta%'
                                  OR description LIKE '%$word%'
                                  ";


          if(empty($firstColour) && empty($secondColour) && empty($thirdColour)){
            $searchAdoptionsQuery .=
                                    "
                                    OR colour1 = '$word'
                                    OR colour2 = '$word'
                                    OR colour3 = '$word'
                                    ";
          }

          if(empty($gender)){
            $searchAdoptionsQuery .=
                                    "
                                    OR pet.gender = '$word'
                                    ";
          }

          if(empty($country) && !$nearMe){
            $searchAdoptionsQuery .=
                                    "
                                    OR user.country_long LIKE '%$word%'
                                    ";
          }

          if($breed == 0){
            $searchAdoptionsQuery .=
                                    "
                                    OR breed.name LIKE '$word'
                                    ";
          }

          if($species == 0){
            $searchAdoptionsQuery .=
                                    "
                                    OR species.name LIKE '$word'
                                    ";
          }

          if(empty($health)){

            $searchAdoptionsQuery .=
                                    "
                                    OR health_status LIKE '$word'
                                    ";
          }
        }
      }
      else{
        // In the event the word from the $search array is numeric

        //Check if the user is searching for lost pets
        if($searchLostPets){
          if($minAge == 0 && $maxAge == 0){

            $searchLostPetsQuery .=
                                    "
                                    OR pet.age = $word
                                    ";
          }
        }

        //Check if the user is searching for adoptions
        if($searchAdoptions){

          if($minAge == 0 && $maxAge == 0){
            $searchAdoptionsQuery .=
                                    "
                                    OR pet.age = $word
                                    ";
          }
        }
      }
    }

    //Append parentheses, These signify the end of the extra search words the user has entered
    $searchPoisonsQuery .= " ) ";
    $searchLostPetsQuery .= ") ";
    $searchAdoptionsQuery .= ") ";
  }

  // Create duplicate querys of the users selected search for counting the total amount of rows the user can expect (aids in page button creation)
  $countPoisonQuery = $searchPoisonsQuery . ";";
  $countUserQuery = $searchUserQuery . ";";
  $countLostPetQuery = $searchLostPetsQuery . ";";
  $countAdoptionQuery =  $searchAdoptionsQuery . ";";

  //Check if the user has selected any sorting filters
  if($sortDate){
    $searchPoisonsQuery .= " ORDER BY event.date_created DESC ";
    $searchUserQuery .= " ORDER BY date_created DESC ";
    $searchLostPetsQuery .= " ORDER BY event.date_created DESC ";
    $searchAdoptionsQuery .= " ORDER BY pet.date_created DESC ";
  }
  else if($sortAlphabeticaly){
    $searchUserQuery .= " ORDER BY LOWER(username) ASC ";
    $searchLostPetsQuery .= " ORDER BY LOWER(petName) ASC ";
    $searchAdoptionsQuery .= " ORDER BY LOWER(petName) ASC ";
  }

  //Check if the user is searching for users
  if($searchUsers){

    //Append Final SQL code for search with appropriate limit and offset
    $searchUserQuery .= " LIMIT $start, $limit;";
    $userResult = mysqli_query($conn, $searchUserQuery);

    //Modify $countUserQuery in order for it to peform COUNT rather than selecting as $searchUserQuery originally does
    $countUserQuery = preg_replace('/SELECT[\s\S]+?FROM/', 'SELECT COUNT(*) FROM', $countUserQuery);
    $userCount = mysqli_query($conn, $countUserQuery);
    $userCount = mysqli_fetch_row($userCount);
    $userCount = $userCount[0];

    //Fetch results from $searchUserQuery and store then into an array
    if(mysqli_num_rows($userResult) > 0){
      while($row = mysqli_fetch_assoc($userResult)){
        $userArray[] = $row;
      }
    }
  }

  //Check if the user is searching for poisons
  if($searchPoisons){

    //Append Final SQL code for search with appropriate limit and offset
    $searchPoisonsQuery .= " LIMIT $start, $limit;";
    $poisonResult = mysqli_query($conn, $searchPoisonsQuery);

    //Modify $countPoisonQuery in order for it to peform COUNT rather than selecting as $searchPoisonsQuery originally does
    $countPoisonQuery = preg_replace('/SELECT[\s\S]+?FROM/', 'SELECT COUNT(*) FROM', $countPoisonQuery);
    $poisonCount = mysqli_query($conn, $countPoisonQuery);
    $poisonCount = mysqli_fetch_row($poisonCount);
    $poisonCount = $poisonCount[0];

    //Fetch results from $searchPoisonsQuery and store then into an array
    if(mysqli_num_rows($poisonResult) > 0){
      while($row = mysqli_fetch_assoc($poisonResult)){
        $poisonArray[] = $row;
      }
    }
  }

  //Append Final SQL code for search with appropriate limit and offset
  if($searchLostPets){
    $searchLostPetsQuery .= " LIMIT $start, $limit;";
    $lostPetResult = mysqli_query($conn, $searchLostPetsQuery);

    //Modify $countLostPetQuery in order for it to peform COUNT rather than selecting as $searchLostPetsQuery originally does
    $countLostPetQuery = preg_replace('/SELECT[\s\S]+?FROM/', 'SELECT COUNT(*) FROM', $countLostPetQuery);
    $lostPetCount = mysqli_query($conn, $countLostPetQuery);
    $lostPetCount = mysqli_fetch_row($lostPetCount);
    $lostPetCount = $lostPetCount[0];

    //Fetch results from $searchLostPetsQuery and store then into an array
    if(mysqli_num_rows($lostPetResult) > 0){
      while($row = mysqli_fetch_assoc($lostPetResult)){
        $lostPetArray[] = $row;
      }
    }
  }

  //Check if the user is searching for adoptions
  if($searchAdoptions){

    //Append Final SQL code for search with appropriate limit and offset
    $searchAdoptionsQuery .= " LIMIT $start, $limit;";
    $adoptionResult = mysqli_query($conn, $searchAdoptionsQuery);

    //Modify $countAdoptionQuery in order for it to peform COUNT rather than selecting as $searchAdoptionsQuery originally does
    $countAdoptionQuery = preg_replace('/SELECT[\s\S]+?FROM/', 'SELECT COUNT(*) FROM', $countAdoptionQuery);
    $adoptionCount = mysqli_query($conn, $countAdoptionQuery);
    $adoptionCount = mysqli_fetch_row($adoptionCount);
    $adoptionCount = $adoptionCount[0];

    //Fetch results from $searchAdoptionsQuery and store then into an array
    if(mysqli_num_rows($adoptionResult) > 0){
      while($row = mysqli_fetch_assoc($adoptionResult)){
        $adoptionArray[] = $row;
      }
    }
  }

  //Calculate the total amount of pages the users input provides
  $pageCount = ($userCount + $adoptionCount + $poisonCount + $lostPetCount)/ $limit;


  // Store results into an array and json-encode to the users page with echo
  $results = array( 'users' => $userArray, 'adoptions' => $adoptionArray, 'poisons' => $poisonArray, 'lostPets' => $lostPetArray, 'pageCount' => $pageCount);
  echo json_encode($results);
  mysqli_close($conn);
  die;
?>
