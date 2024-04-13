<?php
    $username="";
  //Create DB connection
  require('Connection.php');
  //Check if user is logged in and get details
  require('SessionProcess.php');

  if($hasSession){
    $buttonEvent = "getElementById('adoptionForm').style.display = 'block';";
  }
  else{
    $buttonEvent = "reportError('You must be logged in in-order to create new adoptions! ')";
  }

  if(!empty($_GET['petID'])){

    $petID = $_GET['petID'];

    if( !filter_var( $petID, FILTER_VALIDATE_INT )) {
      header( 'Location: AdoptionPage.php?errorMessage=' . urlencode( 'The requested pets ID is not valid' ) );
      mysqli_close($conn);
      die;
    }
    else{

      $selectPetQuery =
                      "
                      SELECT email, pet.photo, pet.name as petName , pet.age, pet.gender, species.name as speciesName,
                      breed.name as breedName, pet.health_status, pet.description, colour1, colour2, colour3
                      FROM pet, user, breed, species
                      WHERE  pet.userID = user.userID
                      AND pet.breedID = breed.breedID
                      AND breed.speciesID = species.speciesID
                      AND petID = $petID
                      AND for_adoption = 1;
                      ";

      if($result = mysqli_query($conn, $selectPetQuery)){
        if(mysqli_num_rows($result) ==1){

          $pet = mysqli_fetch_assoc($result);

          $petName = $pet['petName'];
          $petAge = $pet['age'];
          $petGender = $pet['gender'];
          $petHealth = $pet['health_status'];
          $petColour1 = $pet['colour1'];
          $petColour2 = $pet['colour2'];
          $petColour3 = $pet['colour3'];
          $petDescription = $pet['description'];
          $petBreed = $pet['breedName'];
          $petSpecies = $pet['speciesName'];
          $petPhoto = $pet['photo'];
          $userEmail = $pet['email'];

        }
        else{
          header( 'Location: AdoptionPage.php?errorMessage=' . urlencode( 'Unable to find the requested pet, it may have been deleted' ) );
          mysqli_close($conn);
          die;
        }
      }
      else{
        header( 'Location: AdoptionPage.php?errorMessage=' . urlencode( 'Unable to search for pet, please report this issue' ) );
        mysqli_close($conn);
        die;
      }
    }
  }
  else{

    $petName = "";
    $petAge = "";
    $petGender = "";
    $petSpecies = "";
    $petBreed = "";
    $petHealth = "";
    $petColour1 = "";
    $petColour2 = "";
    $petColour3 = "";
    $petDescription = "";
    $petPhoto = 'images\profile\pet-no-image.png';
    $userEmail = "";
  }

  $catalogQuery = 'SELECT pet.name AS petName, gender, description, health_status, age, colour1, colour2, colour3, species.name as speciesName,photo ,breed.name as breedName from pet, species, breed where pet.breedID = breed.breedID and breed.speciesID = species.speciesID and for_adoption = 1';
  $catalogResult = $conn -> query($catalogQuery);
?>
<!doctype html>
<html lang="en">
<!--    perdor for dhe modulo-->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Custom fonts Used -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!--Our css-->
    <link rel="stylesheet" href="css/aboutUs.css">
    <link rel="stylesheet" href="main_adaption.css">
    <link rel="stylesheet" type="text/css" href="util_registration.css">
    <link rel="stylesheet" type="text/css" href="main_registration.css">
    <link rel="stylesheet" href="css/freelancer.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <title>PetHub! - Adoption - Find pets for adoption from fellow users</title>
    <style>
        #petImg {
            width: 260px;
            height: 190px;
        }

        #button:link {
            color: white;
        }

        #button:link {
            text-decoration: none;
        }

    </style>
</head>

<body class="pt-5 mt-5">



    <!-- Navigation -->
    <?php require('Navigation.php'); ?>
    <!-- The image that appears when you go inside the adoption page -->
    <div class="parallax"></div>
    <div class="container">
        <div class="content my-5">
            <h1 class="display-1" style="font-size:22px;">Saving one dog will not change the world, but surely for that one dog, the world will change forever.</h1>
            <h3 class="text-right lead">― Karen Davison</h3>
        </div>
    </div>
    <!-- A suggestion for the user (it may be linked with the search as well) -->
    <div class="container-fluid bg-light text-dark py-5">
        <h1 class="display-4 text-center">ADOPTION</h1>
        <div class="container">
            <div class="row pt-3">
                <div class="col-md">
                    <div>
                        <img class=" rounded mx-auto d-block" id="petImg" src="<?php echo $petPhoto;?>" />
                    </div>
                </div>
                <div class="col-md">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pet Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Description</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact Information</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active blockquote py-3" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col">
                                    <b>Name:</b> <?php echo $petName;?>
                                </div>
                                <div class="col">
                                    <b>Gender:</b> <?php echo $petGender;?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <b>Species:</b> <?php echo $petSpecies;?>
                                </div>
                                <div class="col">
                                    <b>Breed:</b> <?php echo $petBreed;?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <b>Age:</b> <?php echo $petAge;?>
                                </div>
                                <div class="col">
                                    <b>Health status:</b> <?php echo $petHealth;?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <b>Colour(s):</b> <?php echo $petColour1;?>,
                                    <?php echo $petColour2;?>,
                                    <?php echo $petColour3;?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <b><?php echo $petDescription; ?></b>
                        </div><br>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"> <b>Email : <?php echo $userEmail;?></b></div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-4">
                    <div class="container-login100-form-btn my-4">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn btn btn-primary" type="button" onclick="<?php echo $buttonEvent;?>" data-toggle="modal" data-target="#exampleModal"> Create a new Adoption </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Adoption Form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--  Adoption Form  -->
                    <form id="adoptionForm" class="login100-form validate-form " Action="InsertAdoption.php" Method="Post" enctype="multipart/form-data" onsubmit="return checkInput(this)" style="display : none;">
                        <div class="container pt-2" id="lostPetForm">
                            <div class="row">
                                <div class="col-6">
                                    <h6>Pet Name: </h6>
                                    <input class="shadow-sm" type="text" name="name" value="" id="name">
                                    <br><br>
                                    <h6>Picture: </h6>
                                    <input type="file" name="adoptionImage" id="adoptionImage">
                                    <br><br>
                                    <h6>Gender: </h6>
                                    <div class="ml-3">
                                        <div class="row">
                                            <input type="radio" name="gender" value="Male">
                                            <h6 class="radio-container form-check-label">&nbsp; Male</h6>
                                        </div>
                                        <div class="row">
                                            <input type="radio" name="gender" value="Female">
                                            <h6 class="radio-container form-check-label">&nbsp; Female</h6>
                                        </div>
                                        <div class="row">
                                            <input type="radio" name="gender" value="Other">
                                            <h6 class="radio-container form-check-label">&nbsp; Other</h6>
                                        </div>
                                        <div class="row">
                                            <input type="radio" name="gender" value="Unknown">
                                            <h6 class="radio-container form-check-label">&nbsp; Unknown</h6>
                                        </div>
                                    </div><br>
                                    <h6>Health Status:</h6>
                                    <div class="ml-3">
                                        <div class="row">
                                            <input type="radio" name="pet_hstatus" value="Injured">
                                            <h6 class="radio-container form-check-label">&nbsp; Injured</h6>
                                        </div>
                                        <div class="row">
                                            <input type="radio" name="pet_hstatus" value="In Recovery">
                                            <h6 class="radio-container form-check-label">&nbsp; In recovery</h6>
                                        </div>
                                        <div class="row">
                                            <input type="radio" name="pet_hstatus" value="Healthy">
                                            <h6 class="radio-container form-check-label">&nbsp; Healthy</h6>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <h6>Age: </h6>
                                    <input class="shadow-sm" type=number name="age" id="age" min="0"><br><br>

                                    <h6>Description:</h6>
                                    <textarea class="form-control shadow-sm" id="desc" name="description" onkeypress="checkMax(this,600);"></textarea>

                                    <h6>Species: </h6>
                                    <select class="form-control" name="species" id="species" onchange="updateBreed(this);">
                                        <option selected="selected" value="null"> None </option>

                                        <?php
                            $speciesQuery = 'SELECT speciesID, name FROM species;';
                            $result = $conn -> query($speciesQuery);

                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                 echo "<option value=" . $row['speciesID'] .">" .$row['name'] . "</option>";
                                }
                            }
                            mysqli_close($conn);
                          ?>
                                    </select>
                                    <br>
                                    <h6>Breed: </h6>
                                    <select class="form-control" name="breed" id="breed">
                                        <option selected="selected" value="null"> None </option>
                                        <!--Code is updated based on species selection -->
                                    </select>
                                    <br>
                                    <h6>First Color: </h6>
                                    <select class="form-control" name="firstColour" id="firstColour">
                                        <option selected="selected" value="null">None</option>
                                        <option value="null">None</option>
                                        <option value="Green">Green</option>
                                        <option value="Blue">Blue</option>
                                        <option value="Black">Black</option>
                                        <option value="White">White</option>
                                        <option value="Grey">Grey</option>
                                        <option value="Brown">Brown</option>
                                        <option value="Orange">Orange</option>
                                        <option value="Red">Red</option>
                                        <option value="Yellow">Yellow</option>
                                        <option value="Purple">Purple</option>
                                    </select>
                                    <br>
                                    <h6>Second Color: </h6>
                                    <select class="form-control" name="secondColour" id="secondColour">
                                        <option selected="selected" value="null">None</option>
                                        <option value="null">None</option>
                                        <option value="Green">Green</option>
                                        <option value="Blue">Blue</option>
                                        <option value="Black">Black</option>
                                        <option value="White">White</option>
                                        <option value="Grey">Grey</option>
                                        <option value="Brown">Brown</option>
                                        <option value="Orange">Orange</option>
                                        <option value="Red">Red</option>
                                        <option value="Yellow">Yellow</option>
                                        <option value="Purple">Purple</option>
                                    </select>
                                    <br>
                                    <h6>Third Color: </h6>
                                    <select class="form-control" name="thirdColour" id="thirdColour">
                                        <option selected="selected" value="null">None</option>
                                        <option value="null">None</option>
                                        <option value="Green">Green</option>
                                        <option value="Blue">Blue</option>
                                        <option value="Black">Black</option>
                                        <option value="White">White</option>
                                        <option value="Grey">Grey</option>
                                        <option value="Brown">Brown</option>
                                        <option value="Orange">Orange</option>
                                        <option value="Red">Red</option>
                                        <option value="Yellow">Yellow</option>
                                        <option value="Purple">Purple</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row float-right">
                                <button type="button" class="btn btn-secondary mt-5" data-dismiss="modal">Close</button>
                                <span class="pr-3"></span>
                                <input type="submit" class="btn btn-success mt-5" name="submit">
                                <span class="pr-3"></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <h4>Ooops!</h4>
                    <p></p>
                    <button class="btn btn-success" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- here begins the catalog  -->
    <div class="container-fluid alert alert-success py-5">
        <h1 class="display-4 text-center">Catalog</h1>
        <div class="container">
            <div class="row">
                <!-- The loop helps to display all the pets which are for adoption making the catalog dynamic. The catalog will contain as much cards as pets for adoptions are -->
                <?php while($row = $catalogResult-> fetch_assoc()){

                    ?>
                <div class="col-md-3 py-3">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">

                                <br>
                                <img id="petImg" src="<?php echo $row["photo"];?>">
                                <br>
                                <h1 class="name">Description:</h1>
                                <p class="description"><?php echo $row["description"];?></p>
                            </div>
                            <div class="flip-card-back px-3 p-3 mb-2 bg-light text-dark text-success">
                                <div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><b>Name:</b>
                                            <?php echo $row['petName'];?>
                                        </li>
                                        <li class="list-group-item"><b>Gender:</b> <?php echo $row["gender"]; ?> <b>, Age:</b> <?php echo $row["age"]; ?></li>
                                        <li class="list-group-item"><b>Breed:</b> <?php echo $row["breedName"]; ?></li>
                                        <li class="list-group-item"><b>Species:</b> <?php echo $row["speciesName"]; ?></li>
                                        <li class="list-group-item"><b>Colour(s):</b> <?php echo $row["colour1"] . "," . $row['colour2'] . "," . $row['colour3']; ?></li>
                                        <li class="list-group-item"><b>Health status:</b> <?php echo $row["health_status"]; ?></li>
                                    </ul>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-secondary">Adopt me!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                      }
                    ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php require('Footer.php'); ?>

    <script>
        //Check user input for errors before submitting
        //Precondition : Method expects to receive form element
        //Postcondition : Method returns true if data from inputs and selected elementIDs are valid, otherwise false
        function checkInput(form) {

            var petNameTester = new RegExp("^[a-zA-Z0-9\d@ ]+$");


            var health = getRadioVal(form, "pet_hstatus");
            var gender = getRadioVal(form, "gender");
            var name = document.getElementById("name").value;
            var age = document.getElementById("age").value;
            var species = document.getElementById("species").value;
            var breed = document.getElementById("breed").value;
            var firstColour = document.getElementById("firstColour").value;
            var image = document.getElementById('adoptionImage');

            if (!health) {
                reportError("Missing pet health status");
                return false;
            } else if (!gender) {
                reportError("Missing pet gender");
                return false;

            } else if (!age) {
                reportError("Missing pet age status");
                return false;

            } else if (species == "null") {
                reportError("Missing pet species");
                return false;

            } else if (breed == "null") {
                reportError("Missing pet breed");
                return false;

            } else if (firstColour == "null") {
                reportError("Must provide first pet colour");
                return false;
            } else if (!name) {
                reportError("Must provide pet name");
                return false;
            } else if (!petNameTester.test(name)) {
                reportError("Invalid Pet name, Only Alphanumeric names are allowed");
                return false;
            }

            // Check if a file exists
            if (image.files.length > 0) {

                //Array of acceptable file types
                var imageTypes = ["image/jpeg", "image/png", "image/jpg"];

                if (!imageTypes.includes(image.files.item(0).type)) {
                    reportError("Uploaded file can only be JPEG, PNG or JPG, please check again");
                    return false;
                }

                var fsize = image.files.item(0).size;
                var file = Math.round((fsize / 1024));
                // The size of the file.
                if (file > 5120) {
                    reportError("Provided image is too large, Please make sure it is below 5MB");
                    return false;
                }
            }

            return true;
        }


        //Precondition : Method expects to receive species ID
        //Postcondition: Method updates a select tag with id of "breed" with new option
        // elements from ajax, a empty valued option is always placed
        function updateBreed(select) {

            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", "breedGetter.php?choice=" + select.value, true);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    select = document.getElementById("breed");
                    var opt = document.createElement('option');
                    opt.value = null;
                    opt.appendChild(document.createTextNode('None'));
                    select.innerHTML = xhttp.responseText;
                    select.add(opt, 0);
                    this.abort();
                }
            }
            xhttp.send();
        }

        //Precondition : Method expects to receive form element and name of radia buttons group
        //Postcondition : Method returns value of the first checked radio button
        function getRadioVal(form, name) {
            var val;
            // get list of radio buttons with specified name
            var radios = form.elements[name];

            // loop through list of radio buttons
            for (var i = 0, len = radios.length; i < len; i++) {
                if (radios[i].checked) {
                    val = radios[i].value;
                    break;
                }
            }
            return val; // return value of checked radio or undefined if none checked
        }

        //Precondition : Method expects to receive a string variable
        //Postcondition : Method displays a modal with the id of "myModal" in the html
        //page with the provided "message" string
        function reportError(message) {
            var targetDiv = document.getElementById("myModal").getElementsByTagName("P")[0];
            targetDiv.innerHTML = message;
            $(document).ready(function() {
                $("#myModal").modal();
            });
        }

        <?php
            //Check if any errors has been sent back from the server
            if(isset($_GET['errorMessage'])){
                $error = $_GET['errorMessage'];
                echo "reportError(\"$error\");";
            }
          ?>

    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>
