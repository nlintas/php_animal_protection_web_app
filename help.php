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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetHub! - Help Page - Developers Answer The Users Frequently Asked Questions</title>
    <!-- Custom fonts Used -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <!--  Bootstrap 4.5 CSS  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Our CSS Links-->
    <link href="css/lintas.css" rel="stylesheet">
    <link href="css/freelancer.min.css" rel="stylesheet">
    <style>
        /* Fixes footer placement */
        #page-container {
            position: relative;
            min-height: 100vh;
        }

        #content-wrap {
            padding-bottom: 2.5rem;
            /* Footer height */
        }

    </style>
</head>

<body class="pt-5 mt-5 mb-5">
    <div id="page-container">
        <!-- Navigation -->
        <?php require('Navigation.php'); ?>
        <div id="content-wrap">
            <!--      Title     -->
            <h1 class="text-center pb-5">Frequently Asked Questions!</h1>
            <div class="container">
                <div class="row">
                    <!--         Tab Titles          -->
                    <div class="col-lg-4">
                        <div class="nav nav-pills faq-nav" id="faq-tabs" role="tablist" aria-orientation="vertical">
                            <a href="#tab1" class="nav-link active" data-toggle="pill" role="tab" aria-controls="tab1" aria-selected="true">
                                <i class="mdi mdi-help-circle"></i> General</a>
                            <a href="#tab2" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab2" aria-selected="false">
                                <i class="mdi mdi-account"></i> Services</a>
                            <a href="#tab3" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab3" aria-selected="false">
                                <i class="mdi mdi-account-settings"></i> Account</a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="tab-content" id="faq-tab-content">
                            <!-- General Tab -->
                            <div class="tab-pane show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="accordion" id="accordion-tab-1">
                                    <div class="card">
                                        <div class="card-header" id="accordion-tab-1-heading-1">
                                            <h5>
                                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-1" aria-expanded="false" aria-controls="accordion-tab-1-content-1">How did you come up with the idea of saving pets using a Web App?</button>
                                            </h5>
                                        </div>
                                        <div class="collapse" id="accordion-tab-1-content-1" aria-labelledby="accordion-tab-1-heading-1" data-parent="#accordion-tab-1">
                                            <div class="card-body">
                                                <p><strong>Developer Lintas Answers...</strong></p>
                                                <p>In a universe far far away...a man fell in a river in LEGO city.<br>No, no, no my bad. I mean the legendary wizard teacher "Thanos the Student Consumer" told us the great secret of Tartarus: "Never fall in a river in LEGO city"<br>NO<br>"Save, rescue and protecc the pets." - Future Thanos, in Cyberpunk 2027<br>Me and my fellow developers heeded the master's call.</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Services Tab -->
                            <div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="tab2">
                                <div class="accordion" id="accordion-tab-2">
                                    <div class="card">
                                        <div class="card-header" id="accordion-tab-2-heading-1">
                                            <h5>
                                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-2-content-1" aria-expanded="false" aria-controls="accordion-tab-2-content-1">How do you find my location when I am trying to submit a pet lost or a poisonous food spot?</button>
                                            </h5>
                                        </div>
                                        <div class="collapse" id="accordion-tab-2-content-1" aria-labelledby="accordion-tab-2-heading-1" data-parent="#accordion-tab-2">
                                            <div class="card-body">
                                                <p><strong>Developer Phillipos Answers...</strong></p>
                                                <p>Advanced Tracking Mechanized Systems, WW2 Weapons, On-Man Drones, Laser Sights. All are completely irrelevant XD<br>HTML5 Geolocation is the trick. Uses a GPS, mulitiple satelites and some mathetics and voila.<br>"A little setup here, a little tinkering there and your windows 10 installation will be finished in no time!" - Cortana, everytime you install windows 10<br>NO NO NO<br>What I mean is this which describes our service: "It justs works!" - every presenter of products ever</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="tab3">
                                <div class="accordion" id="accordion-tab-3">
                                    <div class="card">
                                        <div class="card-header" id="accordion-tab-3-heading-1">
                                            <h5>
                                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-3-content-1" aria-expanded="false" aria-controls="accordion-tab-3-content-1">What happens if I accidentally delete my account?</button>
                                            </h5>
                                        </div>
                                        <div class="active collapse" id="accordion-tab-3-content-1" aria-labelledby="accordion-tab-3-heading-1" data-parent="#accordion-tab-3">
                                            <div class="card-body">
                                                <p><strong>Developer Katerina Answers...</strong></p>
                                                <p>I get the hard drive from our server, I open it, I read the magnetized data on the drive and translate the near invisible lines and I FIRE MY LASERS on it to delete it.<br>All jokes aside, I am afraid there is no way to retrieve the account.<br>But you can always re-create it!</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="accordion-tab-3-heading-2">
                                            <h5>
                                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-3-content-2" aria-expanded="false" aria-controls="accordion-tab-3-content-2">What happens if I lose my notebook that has my password?</button>
                                            </h5>
                                        </div>
                                        <div class="active collapse" id="accordion-tab-3-content-2" aria-labelledby="accordion-tab-3-heading-2" data-parent="#accordion-tab-3">
                                            <div class="card-body">
                                                <p><strong>Developer Kostandin Answers...</strong></p>
                                                <p>"First it takes my money, then it disappears... just like my fourth wife!" - Nikolai the Russian Bear, 720 b.c.<br>Hmm, NOO.<br>What I mean is:<br>"Part of the journey is the end" - Tony Stark, Avengers: Endgame.<br>Sadly, there is nothing we can do it about the notebook, but the password can be reset in the login page just click the button and watch the magic happen.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
