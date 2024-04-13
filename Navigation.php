<style>
    .nav-item{
        font-size: 18px;
    }
</style>
<!--This file is used for displaying the navigation bar in all pages but allows centralized changes, eliminating unnecessary redundancy -->
<?php

  //This php code requires beforehand a DB connection to be created and "SessionProcess.php"
  //Check if user is logged in
  if ( $hasSession ) {
    $option = '';
  } else {
    $option = 'disabled';
  }

  echo '
        <!-- Navigation-->
<!-- navbar-expand-lg, breaks the nav bar watch out causing it to collapse sideways in full screen. -->
<nav class="navbar fixed-top navbar-light scrolling-navbar bg-light shadow">
    <!-- When clicking make href lead to settings again-->
    <a class="navbar-brand font-weight-bold" href="Index.php" style="font-size:28px;">PetHub <img src="images/logos/pethub2.png" width="55px"></a>
    <div class="float-right">
        <a class="navbar-brand font-weight-bold" href="my_profile.php" style="font-size:24px;">' .$username . '</a>
        <button class="navbar-toggler shadow-sm" type="button" data-toggle="collapse" data-target="#naviAction" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"> </span></div>
    </button>

    <div class="collapse navbar-collapse" id="naviAction">
        <ul class="navbar-nav flex-row text-left">
            <!-- This is for simple text, keep for now -->
            <!-- <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li> -->
            <div class="col-xl-1 col-lg-1 col-md-2 col-3">
                <li class="nav-item active">
                    <h5 class="nav-link font-weight-bold">Profile<span class="sr-only">(current)</span></h5>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Login.php">Sign-in</a>
                </li>

                <!-- This is how we disble a button, keep it when someone is trying to log out and is not signed in -->
                <li class="nav-item">
                    <a class="nav-link '.$option. '" href="Logout.php" tabindex="-1">Log out</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="Register.php">Sign-up</a>
                </li>
            </div>
            <div class="col-xl-1 col-lg-1 col-md-2 col-3 pr-4">
                <li class="nav-item active">
                    <h5 class="nav-link font-weight-bold">Tools</h5>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Map.php">View and Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Search.php">Find</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="AdoptionPage.php">Adopt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="notification.php">Notifications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="charts.php">Charts</a>
                </li>
            </div>
            <div class="col-xl-1 col-lg-1 col-md-2 col-3">
                <li class="nav-item active">
                    <h5 class="nav-link font-weight-bold">Documentation</h5>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="help.php">Help</a>
                </li>
            </div>
        </nav>
      ';
?>
