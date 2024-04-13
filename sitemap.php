<?php

    $username = "";
    //Create DB connection
    include('Connection.php');
    //Check if user is loggen in and get details
    include('SessionProcess.php');
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poujot! - Sitemap Explore The Features of PetHub</title>
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
        /* Footer Fix */
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

<body class="sitemap">
    <div id="page-container">
        <div id="content-wrap">
            <div class="pt-5 mt-5"></div>
            <!-- Navigation -->
            <?php require('Navigation.php'); ?>
            <div class="container">
                <!-- Sitemap Options That Lead to Main Web App Functions -->
                <div class="row">
                    <div class="col-6">
                        <p>
                            <h5>About Poujot</h5>
                            <a href="about_us.php" class="make-button-space badge badge-primary">About Us</a>
                        </p>
                        <p>
                            <h5 class="make-space">Documentation</h5>
                            <a href="help.php" class="make-button-space badge badge-primary">Help</a>
                        </p>
                    </div>
                    <div class="col-6">
                        <p>
                            <h5>Services</h5>
                            <a href="Map.php" class="badge badge-primary">View and Report</a>
                            <a href="Search.php" class="badge badge-primary">Find</a>
                        </p>
                        <p>
                            <h5 class="make-space">Legal</h5>
                            <a href="terms_and_conditions.php" class="badge badge-primary">Terms and Conditions</a>
                            <a href="privacy_policy.php" class="badge badge-primary">Privacy Policy</a>
                        </p>
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
