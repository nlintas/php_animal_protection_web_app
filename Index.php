<?php

  //Check if user is logged in and retrieve details
  $username = "";
  include('Connection.php');
  include('SessionProcess.php');
  mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PetHub! - Index - Your Favourite Web App for Saving Pets!</title>
    <!-- Custom fonts Used -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <!--  Bootstrap 4.5 CSS  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- CSS Links-->
    <link href="css/lintas.css" rel="stylesheet">
    <link href="css/freelancer.min.css" rel="stylesheet">
    <link href="css/carousel.css" rel="stylesheet">


    <style>

    #myModal p {
      position: relative;
      font-size: 18px;
      margin-top: 15%;

    }

    </style>
</head>

<body class="pb-5">

    <!-- Navigation -->
    <?php require('Navigation.php'); ?>
    <div id="content-wrap">
        <div class="text-center pt-5 mt-5">

            <!--CAROUSEL-->
            <div id="demo" class="carousel slide pt-2" data-ride="carousel">

                <!-- Indicators -->
                <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                    <li data-target="#demo" data-slide-to="2"></li>
                    <li data-target="#demo" data-slide-to="3"></li>
                    <li data-target="#demo" data-slide-to="4"></li>
                </ul>

                <!-- The slideshow -->
                <div class="carousel" data-interval="5000000">
                    <div class="carousel-inner">
                        <!--first slide -->
                        <div class="carousel-item active">
                            <img src="images/Pictures/firstslide.jpg" alt="Welcome picture" width=100% height=600px>

                            <h1 class="welcome"><span>W</span><span>E</span><span>L</span><span>C</span><span>O</span><span>M</span><span>E</span><span>!</span></h1>

                            <div style="font-size:3vw;" id=container>

                                PET APP <br> The center for
                                <div id=flip>
                                    <div>
                                        <div>Rescuing</div>
                                    </div>
                                    <div>
                                        <div>Finding</div>
                                    </div>
                                    <div>
                                        <div>Helping</div>
                                    </div>
                                </div>
                                Animals!
                            </div>
                        </div>

                        <!--Second slide -->
                        <div class="carousel-item">
                            <img src="images/Pictures/secondslide.jpg" alt="quote" width=100% height=600px>
                            <div id="text">
                                <p style="font-size:3vw;"> <svg class="bi bi-heart" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 01.176-.17C12.72-3.042 23.333 4.867 8 15z" clip-rule="evenodd" /> </svg>

                                    Here we save animals <br> out of harmful ways but, <br>
                                    it is in your hands <br> to assist our cause!</p>
                            </div>

                        </div>

                        <!--Third slide -->

                        <div class="carousel-item">
                            <img src="images/Pictures/kitty.jpg" alt="lost cat" width=100% height=600px>

                            <div id="text3">
                                <p style="font-size:3vw;">

                                    Is Your Softie Lost?</p>
                                <button onclick="document.location = 'map.php'" style="font-size:1vw;" class="btn1">Report</button>
                            </div>
                        </div>


                        <!--Fourth slide -->
                        <div class="carousel-item">
                            <img src="images/Pictures/kitty2.jpg" alt="quote" width=100% height=600px>
<!--                            <p style="font-size:3vw;" class="textslide4">Saving one by one until there is none!</p>-->

                        </div>


                        <!--Slide 5 -->
                        <div class="carousel-item">
                            <img src="images/Pictures/bestfriend.jpg" alt="dog friend" width=100% height=600px>
                            <div id="text">
                                <p style="font-size:3vw;"> Find your new Best Friend</p>
                                <button onclick="document.location = 'adoptionPage.php'" style="font-size:1vw;" class="btn2">Find</button>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon carousel-btn"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon carousel-btn"></span>

            </a>
        </div>

        <!-- Tools and Icons Section -->
        <section class="page-section portfolio" id="portfolio">
            <div class="container">
                <!-- Tools Section Heading -->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Tools and Features!</h2>
                <!-- Icon Divider -->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Grid Items -->
                <div class="row">
                    <!-- Portfolio Item 2 -->
                    <div class="col-md-4 col-lg-4">
                        <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal2">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white">
                                    <p>View and Report</p>
                                </div>
                            </div>
                            <!-- Icons made by "https://www.flaticon.com/authors/freepik" -->
                            <img class="img-fluid" src="images/modals_and_index/view_and_report.png" alt="An image of a map with a pin">
                        </div>
                    </div>
                    <!-- Portfolio Item 3 -->
                    <div class="col-md-4 col-lg-4">
                        <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal3">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white">
                                    <p>Find</p>
                                </div>
                            </div>
                            <!-- Icons made by "https://www.flaticon.com/authors/freepik" -->
                            <img class="img-fluid" src="images/modals_and_index/find.png" alt="An image of magnifier with a dog paw in the middle">
                        </div>
                    </div>
                    <!-- Portfolio Item 4 -->
                    <div class="col-md-4 col-lg-4">
                        <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal4">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white">
                                    <p>Help</p>
                                </div>
                            </div>
                            <!-- Icons made by "https://www.flaticon.com/authors/pixel-perfect" -->
                            <img class="img-fluid" src="images/modals_and_index/help.png" alt="A circled question mark">
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </section>
        <!-- Footer -->
        <?php require('Footer.php'); ?>
        <!-- Portfolio Modals -->
        <!-- Portfolio Modal 2 -->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-labelledby="portfolioModal2Label" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <i class="fas fa-times"></i>
                        </span>
                    </button>
                    <div class="modal-body text-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title -->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">View and Report</h2>
                                    <!-- Icon Divider -->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon">
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Modal - Image -->
                                    <!-- Icons made by "https://www.flaticon.com/authors/freepik" -->
                                    <img class="img-fluid rounded mb-5" src="images/modals_and_index/view_and_report.png" alt="A map with a pin at a specific spot" width="65%">
                                    <!-- Modal - Text -->
                                    <p class="mb-5">Use this function if you want to report a lost pet, report a pet for adoption or report an area with poisonous food. <br>You can also view on a map other lost pets and poisoned food locations around
                                        you.
                                    </p>
                                    <a href="Map.php"><button class="btn btn-primary">Try it!</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 2 -->
        <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-labelledby="portfolioModal3Label" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <i class="fas fa-times"></i>
                        </span>
                    </button>
                    <div class="modal-body text-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Modal - Title -->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Find</h2>
                                    <!-- Icon Divider -->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon">
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Modal - Image -->
                                    <!-- Icons made by "https://www.flaticon.com/authors/freepik" -->
                                    <img class="img-fluid rounded mb-5" src="images/modals_and_index/find.png" alt=" An image of magnifier with a pet's paw centered in the middle" width="65%">
                                    <!-- Modal - Text -->
                                    <p class="mb-5">Use this function to search for a lost pet, a pet put for adoption and poisonous food using filters. It supports a table view (legacy) and a list view.</p>
                                    <a href="Search.php"><button class="btn btn-primary">Try it!</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 3 -->
        <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-labelledby="portfolioModal4Label" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <i class="fas fa-times"></i>
                        </span>
                    </button>
                    <div class="modal-body text-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Modal - Title -->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Help</h2>
                                    <!-- Icon Divider -->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon">
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Modal - Image -->
                                    <!-- Icons made by "https://www.flaticon.com/authors/pixel-perfect" -->
                                    <img class="img-fluid rounded mb-5" src="images/modals_and_index/help.png" alt="A circled question mark" width="65%">
                                    <!-- Modal - Text -->
                                    <p class="mb-5">Use this function to findout details for how to use our web apps tools and explore everything we offer.</p>
                                    <a href="help.php"><button class="btn btn-primary">Try it!</button></a>
                                </div>
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

        <script>
            //Precondition : Method expects to recieve a string variable
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
</body>

</html>
