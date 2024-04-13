<?php 

require("Connection.php");
//Name of the pet
//SELECT pet.name, gender, description, health_status, age, colour1, colour2, colour3, species.name, breed.name from pet, species, breed where pet.breedID = breed.breedID and breed.speciesID = species.speciesID and for_adoption = 1
$query = 'SELECT pet.name AS PN, gender, description, health_status, age, colour1, colour2, colour3, species.name as SN,photo ,breed.name as BN from pet, species, breed where pet.breedID = breed.breedID and breed.speciesID = species.speciesID and for_adoption = 1';
$result = $conn -> query($query);
$query2 = 'SELECT pet.name AS PN, gender, description, health_status, age, colour1, colour2, colour3, species.name as SN,photo ,breed.name as BN from pet, species, breed where pet.breedID = breed.breedID and breed.speciesID = species.speciesID and petID = 8';
$result2 = $conn -> query($query2);
$query3 = 'SELECT email FROM user, pet Where user.userID = pet.userID and petID = 8';
$result3 = $conn -> query($query3);
//$n = mysqli_fetch_assoc($nameResult);
//SELECT name from pet where for_adoption = 1 and petID = per emrin
//SELECT gender from pet where for_adoption = 1 per gjinine
//SELECT description FROM pet where for_adoption = 1 pershkrimi
//SELECT health_status FROM pet where for_adoption = 1 shendeti
//SELECT age FROM pet where for_adoption = 1 mosha
//SELECT colour1, colour2,colour3 FROM pet where for_adoption = 1 ngjyrat
//SELECT breed.name from pet, breed where pet.breedID = breed.breedID and for_adoption = 1 breed
//SELECT species.name from pet, breed, species where pet.breedID = breed.breedID and breed.speciesID = species.speciesID and for_adoption = 1 species
?>
<!doctype html>
<html lang="en">
    <!--    perdor for dhe modulo-->
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <!--our css-->
        <link rel="stylesheet" href="css/aboutUs.css">
        <link rel="stylesheet" href="/css/main_adaption.css">
        <link rel="stylesheet" type="text/css" href="/css/util_registration.css">
        <link rel="stylesheet" type="text/css" href="/css/main_registration.css">
        <!--
<link href="css/owl.carousel.min.css " rel="stylesheet">
<link href="css/owl.theme.default.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/util_registration.css">
<link rel="stylesheet" type="text/css" href="css/main_registration.css">
-->

        <title>Catalog</title>
        <style>
            #petImg{
                width:260px;
                height:190px;
            }
            #button:link {
                color: white;
            }
            #button:link {
  text-decoration: none;
}
        </style>
    </head>
    <body>
<!-- The image that appears when you go inside the adoption page -->
        <div class="parallax"></div>
        <div class="container">
            <div class="content my-5">
                <h1 class="display-1">Saving one dog will not change the world, but surely for that one dog, the world will change forever.</h1>
                <h3 class="text-right lead">― Karen Davison</h3>
            </div>
        </div>
        <!-- A suggestion for the user (it may be linked with the search as well) -->
        <div class="container-fluid bg-light text-dark py-5">
            <h1 class="display-4 text-center">I think you might like me</h1>
            <div class="container">
                <div class="row py-5">
                    <div class="col-md">
                        <?php if($row = $result2-> fetch_assoc()){
                        ?>
                        <div >
                            <?php 
    echo '<img class=" rounded mx-auto d-block" id="petImg" src = "data:image/jpeg;base64,'.base64_encode($row["photo"]).'"/>';
                            ?>
                        </div>
                    </div>
                    <div class="col-md">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Details</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Description</a>

                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Adopt me</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active blockquote py-3" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">

                                    <div class="col">
                                        <b>Name:</b>  <?php echo $row["PN"]; ?>

                                    </div>
                                    <div class="col">
                                        <b>Gender:</b> <?php echo $row["gender"]; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <b>Species:</b> <?php echo $row["SN"]; ?>
                                    </div>
                                    <div class="col">
                                        <b>Breed:</b> <?php echo $row["BN"]; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <b>Age:</b> <?php echo $row["age"]." year(s) old"; ?>
                                    </div>
                                    <div class="col">
                                        <b>Health status:</b> <?php echo $row["health_status"]; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <b>Colour(s):</b> <?php echo $row["colour1"]; ?>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <b><?php echo $row["description"]; ?></b>
                            </div>
                            <?php if($row = $result3-> fetch_assoc()){
                            ?>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"> <b>Email : <?php echo $row["email"]; ?></b></div>

                            <?php } ?> 
                            <?php } ?> 

                        </div>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-md-4">
                        <div class="container-login100-form-btn my-2">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button class="login100-form-btn" type="submit" data-toggle="modal" data-target="#staticBackdrop">
                                    <a id="button" href="adoption_form.php">Put a pet for adoption!</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
            </div>
        </div>
        <!-- here begins the catalog  -->
        <div class="container-fluid alert alert-success py-5">
            <h1 class="display-4 text-center">Catalog</h1>
            <div class="container">
                <?php $counter=0; ?>
                <div class="row">
                    <!-- The loop helps to display all the pets which are for adoption making the catalog dynamic. The catalog will contain as much cards as pets for adoptions are -->
                    <?php while($row = $result-> fetch_assoc()){
                    ?>
                    <div class="col-md-3 py-3">
                        <div class="flip-card">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">

                                    <!--                                    <img src="images/gallery-image-1-1200x800-original.jpg" style="width:260px;height:170px;">-->
                                    <?php 
    echo '<img id="petImg" src = "data:image/jpeg;base64,'.base64_encode($row["photo"]).'"/>';
                                    ?>
                                    <br>
                                    <h1 class="name">Description:</h1>
                                    <p class="description"><?php echo $row["description"]; ?></p>
                                </div>
                                <div class="flip-card-back px-3 p-3 mb-2 bg-light text-dark text-success">
                                    <div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><b>Name:</b> 
                                                <?php echo $row["PN"]; ?>
                                            </li>
                                            <li class="list-group-item"><b>Gender:</b> <?php echo $row["gender"]; ?> <b>Age:</b> <?php echo $row["age"]; ?></li>
                                            <li class="list-group-item"><b>Breed:</b> <?php echo $row["BN"]; ?></li>
                                            <li class="list-group-item"><b>Species:</b> <?php echo $row["SN"]; ?></li>
                                            <li class="list-group-item"><b>Colour(s):</b> <?php echo $row["colour1"]; ?></li>
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



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>
