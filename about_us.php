<?php
  //Check if user is logged in and retrieve details
  $username = "";
  include('Connection.php');
  include('SessionProcess.php');
  mysqli_close($conn);
?>

<!Doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PetHub! - About Us - Learn about the Developers of PetHub</title>
    <!-- Custom fonts Used -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <!--  Bootstrap 4.5 CSS  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Our CSS Links -->
    <link href="css/aboutUs.css" rel="stylesheet">
    <link href="css/freelancer.min.css" rel="stylesheet">
    <link href="css/lintas.css" rel="stylesheet">
    <style>
        /* Fixing about us spacing of cards issue. */
        .card {
            padding: 10px;
        }

    </style>
</head>

<body>
    <!-- Navigation -->
    <?php require('Navigation.php'); ?>
    <!--  Top Part Title and Description  -->
    <div class="jumbotron text-center">
        <div class="container shadow p-4">
            <h1 class="display-4">About us</h1>
            <p class="lead">Different People - One Mission </p>
            <h3>To impress the supreme sorcerer Thanos</h3>
            <p class="lead">A group of sorcerers from the magic university of Sheffield are assigned by the supreme sorcerer Thanos to return the stolen jewel of Sheffield from the evil witch, Stamatopoulou. Will they return the jewel and impress the supreme sorcerer? Stay tuned and enjoy, the chilling adventures of Pujtos!</p>
        </div>
    </div>


    <div class="container pb-5">
        <div class="row">

            <div class="col-md-6 col-lg-3 pb-3">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img class="p-2 img-fluid" src="images/bg-01.jpg" style="height:315px;" alt="Developer of the PetHub Web App">
                            <h1 class="name pt-2 pb-2">KATERINA MATRAKU</h1>
                        </div>
                        <div class="flip-card-back">
                            <p class="pt-2">KATERINA MATRAKU</p>
                            <p class="uni"> The University of Sheffield <br>
                                International Faculty City College </p>
                            <p class="dep">Department of Computer Science </p>
                            <hr class="new4">
                            <i style="font-size:18px" class="fa">&#xf0e0;</i>
                            <a class="email" href="mailto:kmatraku@citycollege.sheffield.eu" style="font-size:14px"> kmatraku@citycollege.sheffield.eu</a>
                            <hr class="new4">
                            <p class="info"> Social Media </p>
                            <a href="https://www.facebook.com/katerina.matraku.5" class="fa fa-facebook"></a>
                            <a href="https://www.instagram.com/katerina_matraku/?hl=en" class="fa fa-instagram"></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 pb-3">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img class="p-2 img-fluid" src="images/bg-01.jpg" style="height:315px;" alt="Developer of the PetHub Web App">
                            <h1 class="name pt-2 pb-2">PHILIPPOS KALATZIS</h1>
                        </div>
                        <div class="flip-card-back">
                            <p class="pt-2">PHILIPPOS KALATZIS</p>
                            <p class="uni"> The University of Sheffield <br>
                                International Faculty City College </p>
                            <p class="dep">Department of Computer Science </p>
                            <hr class="new4">
                            <i style="font-size:18px" class="fa">&#xf0e0;</i>
                            <a class="email" href="mailto:pkalatzis@citycollege.sheffield.eu" style="font-size:14px"> pkalatzis@citycollege.sheffield.eu</a>
                            <hr class="new4">
                            <p class="info"> Social Media </p>
                            <p>UNAVAILABLE - N/A</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 pb-3">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img class="p-2 img-fluid" src="images/bg-01.jpg" style="height:315px;" alt="Developer of the PetHub Web App">
                            <h1 class="name pt-2 pb-2">KOSTANDIN DERVISHAJ</h1>
                        </div>
                        <div class="flip-card-back">
                            <p class="pt-2">KOSTANDIN DERVISHAJ</p>
                            <p class="uni"> The University of Sheffield <br>
                                International Faculty City College </p>
                            <p class="dep">Department of Computer Science </p>
                            <hr class="new4">
                            <i style="font-size:18px" class="fa">&#xf0e0;</i>
                            <a class="email" href="mailto:kdervishaj@citycollege.sheffield.eu" style="font-size:14px"> kdervishaj@citycollege.sheffield.eu</a>
                            <hr class="new4">
                            <p class="info"> Social Media </p>
                            <a href="https://ms-my.facebook.com/kostandin.dervishaj?comment_id=Y29tbWVudDoxNjcxMDgzMjI2NDM2NzQ0XzE2NzMwMjQ3NzYyNDI1ODk%3D" class="fa fa-facebook"></a>
                            <a href="https://www.instagram.com/kostandin_dervishaj/" class="fa fa-instagram"></a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-lg-3 pb-3">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img class="p-2 img-fluid" src="images/bg-01.jpg" style="height:315px;" alt="Developer of the PetHub Web App">
                            <h1 class="name pt-2 pb-2">NIKOLAOS LINTAS</h1>
                        </div>
                        <div class="flip-card-back">
                            <p class="pt-2">NIKOLAOS LINTAS</p>
                            <p class="uni"> The University of Sheffield <br>
                                International Faculty City College </p>
                            <p class="dep">Department of Computer Science </p>
                            <hr class="new4">
                            <i style="font-size:18px" class="fa">&#xf0e0;</i>
                            <a class="email" href="mailto:nlintas@citycollege.sheffield.eu" style="font-size:14px"> nlintas@citycollege.sheffield.eu</a>
                            <hr class="new4">
                            <p class="info"> Social Media </p>
                            <p>CONFIDENTIAL</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Javascript, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <!-- Footer -->
    <?php require('Footer.php'); ?>
</body>

</html>
