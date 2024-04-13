<?php
  $username = "";
  require( 'Connection.php' );
  require( 'SessionProcess.php' );

  if(!empty($_GET['username'])){

    $sentUsername =  filter_var( $_GET['username'], FILTER_SANITIZE_STRING );
    if($userResult = $conn -> query( "SELECT * FROM user WHERE username = '$sentUsername';")){

      if(mysqli_num_rows($userResult) == 1){
        $userDetails = mysqli_fetch_assoc($userResult);
        $visitedUserID = $userDetails['userID'];

        $myAdoptionQuery =
                          "
                          SELECT pet.petID, pet.name as petName, date_created, species.name as speciesName, breed.name as breedName, gender as petGender, age as petAge, health_status, colour1, colour2, colour3, description, photo
                          FROM pet, species, breed
                          WHERE pet.userID = $visitedUserID
                          AND pet.breedID = breed.breedID
                          AND species.speciesID = breed.speciesID
                          AND for_adoption = 1;
                          ";

        $myLostPetsQuery =
                          "
                          SELECT event.eventID, pet.petID, pet.name, event.date_created, event.country_short, species.name as speciesName, breed.name as breedName, gender as petGender, age as petAge, health_status, colour1, colour2, colour3, event.description, photo
                          FROM pet, event, lost_pet, breed, species
                          WHERE pet.petID = lost_pet.petID
                          AND lost_pet.eventID = event.eventID
                          AND pet.breedID = breed.breedID
                          AND breed.speciesID = species.speciesID
                          AND pet.userID = $visitedUserID
                          AND for_adoption = 0;
                          ";

        $myOtherEventsQuery =
                            "
                            SELECT event.eventID, country_short, country_long, postcode, street, radius, type, description, date_created
                            FROM event, event_type
                            WHERE event.event_typeID = event_type.event_typeID
                            AND event.userID = $visitedUserID
                            AND type != 'Lost Pet';
                            ";

        $adoptionResults = $conn -> query($myAdoptionQuery);
        $lostPetResults = $conn -> query($myLostPetsQuery);
        $eventResults = $conn -> query($myOtherEventsQuery);
      }
      else{
        header( 'Location: Index.php?errorMessage=' . urlencode( 'Unable to retrieve user details, the account may have been deleted' ) );
        mysqli_close($conn);
        die;
      }
    }
    else{
      header( 'Location: Index.php?errorMessage=' . urlencode( 'Unable to retrieve user details, please contact support' ) );
      mysqli_close($conn);
      die;
    }
  }
  else{
    header( 'Location: Index.php?errorMessage=' . urlencode( 'No user details where provided' ) );
    mysqli_close($conn);
    die;
  }


  mysqli_close( $conn );
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>PetHub! - Profile Visit - Find Information About a Fellow User</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Custom fonts Used -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <!--  Bootstrap 4.5 CSS  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!--  Our CSS Links  -->
    <link href="css/freelancer.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/lintas.css">
    <style>
        body {
            background-color: white;
        }
        /* Fixes a coloring issue with the selectable list items */
        a {
            color: inherit;
        }

        /* mouse over link */
        a:hover {
            text-decoration: none;
            color: darkcyan;
        }

        .border {
            border: 3px solid #ccc;
            margin: 3%;
        }

        .list-group {
            background-color: aliceblue;
        }

        /*        floralwhite*/
        .list-group-item {
            background-color: white;
        }

        .btn {

            visibility: hidden;
        }
        /* Fixes a footer placement issue */
        #page-container {
            position: relative;
            min-height: 100vh;
        }

        #content-wrap {
            padding-bottom: 2.5rem;
            /* Footer height */
        }

        #nav-tab a{
          font-size:30px;
        }

    </style>
</head>

<body class="pt-5 mt-5">
    <div id="page-container">

        <!-- Navigation -->
        <?php require('Navigation.php'); ?>
        <div id="content-wrap">
            <div class="container-fluid top-part">
                <form class="login100-form validate-form " Action="UpdateAccountProcess.php" Method="Post" onsubmit="return checkInput(this);" enctype="multipart/form-data">
                    <div class="row">
                        <!-- First Column -->
                        <div class='col-12 col-md-4 col-lg-5 col-xl-5' id='user'>
                            <h4 class="pl-3"><?php echo $userDetails['username'];?></h4>
                            <img id="userPhoto" class="img-fluid border shadow-lg" src="<?php echo $userDetails['photo'];?>" alt="An image from a fellow user uploaded by them">
                        </div>
                        <!-- Second Column -->
                        <div class='col-6 col-md-4 col-lg-4 col-xl-3' id='user'>
                            <h4 class="pt-4 mt-4">User and Security</h4>
                            <label class='font-weight-bold'>Account Name</label><br>
                            <label><?php echo $userDetails['username'];?></label><br>
                            <label class='make-space font-weight-bold'>Gender</label><br>
                            <label><?php echo $userDetails['gender'];?></label><br>
                            <label class='make-space font-weight-bold'>Age</label><br>
                            <label><?php echo $userDetails['age']; ?></label><br>
                            <!-- Security -->
                            <label class='make-space font-weight-bold'>Email</label><br>
                            <label><?php echo $userDetails['email']; ?></label>
                        </div>
                        <!-- Third Column -->
                        <div class='col-6 col-md-4 col-lg-3 col-xl-4' id='general'>
                            <h4 class="pt-4 mt-4">General</h4>
                            <label class='font-weight-bold'>Country</label><br>
                            <label><?php echo $userDetails['country_long']; ?></label><br>
                            <label class='make-space font-weight-bold'>Postcode</label><br>
                            <label><?php echo $userDetails['postcode']; ?></label><br>
                            <label class='make-space font-weight-bold'>Date of account creation</label><br>
                            <label><?php echo $userDetails['date_created']; ?></label>
                        </div>
                    </div>
                </form>
            </div>
            <br>
            <!--  Multi-Purpose List Populated through PHP -->
            <div class="container-fluid pb-4">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-myAdoptions-tab" data-toggle="tab" href="#nav-myAdoptions" role="tab" aria-controls="nav-myAdoptions" aria-selected="true">Adoptions</a>
                        <a class="nav-item nav-link" id="nav-myLostPets-tab" data-toggle="tab" href="#nav-myLostPets" role="tab" aria-controls="nav-myLostPets" aria-selected="false">Lost Pets</a>
                        <a class="nav-item nav-link" id="nav-myOtherEvents-tab" data-toggle="tab" href="#nav-myOtherEvents" role="tab" aria-controls="nav-myOtherEvents" aria-selected="false">Other Events</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-myAdoptions" role="tabpanel" aria-labelledby="nav-myAdoptions-tab">
                        <ul class="list-group pb-4 shadow">
                            <?php
                if(mysqli_num_rows($adoptionResults) > 0){
                  while($row = mysqli_fetch_assoc($adoptionResults)){

                    echo
                        '
                          <li class="list-group-item border border-success rounded shadow">
                            <div class="d-flex flex-row pl-3">
                            <!-- <div>Icons made by <a href="https://www.flaticon.com/authors/eucalyp" title="Eucalyp">Eucalyp</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div> -->
                              <img class="img-fluid pb-2" src="images/profile/for_adoption.png" width="45px" alt="Cat with a collar waiting for an owner">&nbsp;&nbsp;
                              <span>
                                <h4 class="pt-2 text-info text-uppercase">Adoption</h4>
                              </span>
                            </div>
                              <hr>
                              <a href="adoptionPage?petID=' . $row['petID'] .'">
                              <div class="row pl-4">
                                  <h3 class="pt-2 pr-2 text-wrap">' . $row['petName'] .'</h3>
                                  <label class="pt-3 comment-date font-weight-light text-monospace">' . $row['date_created'] .'</label>
                              </div>
                              <div class="row pr-2">
                                  <div class="col-4 col-lg-3 col-xl-3 h-25">
                                          <img class="img-fluid img-thumbnail rounded border border-primary" src="' . $row['photo'] .'" width="250px" height="250px" alt="An image of pet waiting to be adopted uploaded by a user">
                                  </div>
                                  <div class="col-4 col-lg-2 col-xl-2 h-25 pt-1">
                                          <label class="font-weight-bold">Species: &nbsp;</label><span>' . $row['speciesName'] . '</span><br>
                                          <label class="font-weight-bold">Breed: &nbsp;</label><span>' . $row['breedName'] .'</span><br>
                                          <label class="font-weight-bold">Gender: &nbsp;</label><span>' . $row['petGender'] .'</span><br>
                                          <label class="font-weight-bold">Age: &nbsp;</label><span>' . $row['petAge'] .' years old</span><br>
                                          <label class="font-weight-bold">Health Status: &nbsp;</label><span>' . $row['health_status'] .'</span><br>
                                          <label class="font-weight-bold">Color 1: &nbsp;</label><span>' . $row['colour1'] .'</span><br>
                                          <label class="font-weight-bold">Color 2: &nbsp;</label><span>' . $row['colour2'] .'</span><br>
                                          <label class="font-weight-bold">Color 3: &nbsp;</label><span>' . $row['colour3'] .'</span>
                                  </div>
                                  <div class="col-4 col-lg-7 col-xl-7 pt-1 h-25">
                                      <div class="row">
                                          <label class="font-weight-bold">Description</label>
                                      </div>
                                      <div class="row">
                                          <p class="text-wrap text-break">' . $row['description'] .'</p>
                                      </div>
                                  </div>
                              </div>
                            </a>
                          </li>
                        ';
                  }
                }
              ?>
                        </ul>

                    </div>
                    <div class="tab-pane fade" id="nav-myLostPets" role="tabpanel" aria-labelledby="nav-myLostPets-tab">
                        <ul class="list-group pb-4 shadow">

                            <?php
                if(mysqli_num_rows($lostPetResults) > 0){
                  while($row = mysqli_fetch_assoc($lostPetResults)){

                    echo
                          '
                          <li class="list-group-item border border-success rounded">
                            <div class="d-flex flex-row pl-3">
                                <!-- <div>Icons made by <a href="https://www.flaticon.com/authors/darius-dan" title="Darius Dan">Darius Dan</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div> -->
                                <img class="img-fluid pb-2" src="images/profile/lost_pet.png" width="45px" alt="Dog barking trying to find their owner">&nbsp;&nbsp;
                                <span>
                                <h4 class="pt-2 text-info text-uppercase">Lost Pet</h4>
                                </span>
                            </div>
                                <hr>
                                <a href="Map.php?eventID= ' . $row['eventID'] .' &country= ' . $row['country_short'] .'">
                                <div class="row pl-4">
                                    <h3 class="pt-2 pr-2 text-wrap">Petite Trish</h3>
                                    <label class="pt-3 font-weight-light text-monospace">' . $row['date_created'] .'</label>
                                </div>
                                <div class="row pr-2">
                                    <div class="col-4 col-lg-3 col-xl-3">
                                            <img class="img-fluid img-thumbnail rounded border border-primary" src="' . $row['photo'] .'" width="250px" height="250px" alt="An image of a lost pet waiting to be saved uploaded by a user">
                                    </div>
                                    <div class="col-4 col-lg-2 col-xl-2 h-25 pt-1">
                                            <label class="font-weight-bold">Species: &nbsp;</label><span>' . $row['speciesName'] .'</span><br>
                                            <label class="font-weight-bold">Breed: &nbsp;</label><span>' . $row['breedName'] .'</span><br>
                                            <label class="font-weight-bold">Gender: &nbsp;</label><span>' . $row['petGender'] .'</span><br>
                                            <label class="font-weight-bold">Age: &nbsp;</label><span>' . $row['petAge'] .' years old</span><br>
                                            <label class="font-weight-bold">Health Status: &nbsp;</label><span>' . $row['health_status'] .'</span><br>
                                            <label class="font-weight-bold">Color 1: &nbsp;</label><span>' . $row['colour1'] .'</span><br>
                                            <label class="font-weight-bold">Color 2: &nbsp;</label><span>' . $row['colour2'] .'</span><br>
                                            <label class="font-weight-bold">Color 3: &nbsp;</label><span>' . $row['colour3'] .'</span>
                                    </div>
                                    <div class="col-4 col-lg-7 col-xl-7 pt-1 h-25">
                                        <div class="row">
                                            <label class="font-weight-bold">Description</label>
                                        </div>
                                        <div class="row">
                                            <p class="desc">' . $row['description'] .'</p>
                                        </div>
                                    </div>
                                </div>
                              </a>
                            </li>
                          ';
                  }
                }
              ?>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-myOtherEvents" role="tabpanel" aria-labelledby="nav-myOtherEvents-tab">
                        <ul class="list-group pb-4 shadow">

                            <?php
                if(mysqli_num_rows($eventResults) > 0){
                  while($row = mysqli_fetch_assoc($eventResults)){

                    echo
                        '
                          <li class="list-group-item border border-success rounded">
                            <div class="d-flex flex-row pl-3">
                                <!-- <div>Icons made by <a href="https://www.flaticon.com/authors/eucalyp" title="Eucalyp">Eucalyp</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div> -->
                                <img class="img-fluid pb-2" src="images/map_icons/poison.png" width="45px" alt="A vial containing poison waiting to be used for evil intent">&nbsp;&nbsp;
                                <span>
                                <h4 class="pl-1 pt-2 text-info text-uppercase">Poisonous Food</h4>
                                </span>
                              </div>
                              <hr>
                              <a href="Map.php?eventID= ' . $row['eventID'] .' &country= ' . $row['country_short'] .'">
                              <div class="row pl-3 pb-2">
                                  <h3 class="pt-2 pl-2 pr-2 text-wrap">Poison</h3>
                                  <label class="pt-3 font-weight-light text-monospace">' . $row['date_created'] .'</label>
                              </div>
                              <div class="row pr-2">
                                  <div class="col-6 col-lg-3 col-xl-3 h-25">
                                      <div class="pl-3">
                                              <label class="font-weight-bold">Country: &nbsp;</label><span>' . $row['country_long'] .'</span><br>
                                              <label class="font-weight-bold">Postcode: &nbsp;</label><span>' . $row['postcode'] .'</span><br>
                                              <label class="font-weight-bold">Street Address: &nbsp;</label><span>' . $row['street'] .'</span><br>
                                              <label class="font-weight-bold">Radius: &nbsp;</label><span>' . $row['radius'] .' meters around</span>
                                      </div>
                                  </div>
                                  <div class="col-6 col-lg-9 col-xl-9 pt-1 h-25">
                                      <div class="row">
                                          <label class="font-weight-bold">Description</label>
                                      </div>
                                      <div class="row">
                                          <p class="desc text-wrap">' . $row['description'] .'</p>
                                      </div>
                                  </div>
                              </div>
                            </a>
                          </li>
                        ';
                  }
                }
              ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End of Multi-Purpose List -->
        </div>
        <!-- Footer -->
        <div style="position: absolute;bottom: 0;width:100%;height: 2.5rem;">
            <?php require('Footer.php'); ?>
        </div>
    </div>
    <!-- Bootstrap Javascript, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>
