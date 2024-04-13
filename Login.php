<?php
  //Check if user is logged in and retrieve details
  $username = "";
  //Create DB connection
  include('Connection.php');
  //Check if user is logged in and get details
  include('SessionProcess.php');
  mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>PetHub! - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Our Favicons -->
    <link rel="icon" type="image/png" href="images/favicons/favicon.ico">
    <!-- Custom fonts Used -->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <!--  Bootstrap 4.5 CSS  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!--  Our CSS  -->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
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

<body>
    <div id="page-container">
        <!-- Navigation -->
        <?php require('Navigation.php'); ?>
            <!-- Limits the size of the page for the purpose of placing other elements -->
            <div class="limiter">
                <div id="content-wrap">
                <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
                    <div class="container">
                        <div class="col-6">
                            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54 ">
                                <form class="login100-form validate-form" action="LoginProcess.php" method="post" onsubmit="return checkInput();">
                                    <span class="login90-form-title p-b-20">
                                        Welcome to PetHub
                                    </span>
                                    <span class="login100-form-title p-b-49">
                                        Login
                                    </span>

                                    <div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
                                        <span class="label-input100">Username</span>
                                        <input class="input100" type="text" name="username" placeholder="Type your username" id="userID" onkeypress="checkMax(this, 55)">
                                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                                    </div>

                                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                                        <span class="label-input100">Password</span>
                                        <input class="input100" type="password" name="password" placeholder="Type your password" id="passID" onkeypress="checkMax(this, 55)">
                                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                                    </div>
                                    <span id="error" style="display: none;"></span>
                                    <div class="text-right p-t-8 p-b-31">
                                        <a href="#">
                                            Forgot password?
                                        </a>
                                    </div>
                                    <div class="container-login100-form-btn">
                                        <div class="wrap-login100-form-btn">
                                            <div class="login100-form-bgbtn"></div>
                                            <button class="login100-form-btn" type="submit" name="submit">
                                                Login
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex-col-c p-t-50 pl-4">
                                        <span class="txt1 p-b-17">
                                            Having trouble logging in? Maybe you don't have an account with us: <a href="Register.php" class="txt2">
                                                Sign-Up here!
                                            </a>
                                        </span>
                                    </div>
                                </form>
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
        <!-- In the event the server find errors with the provided data -->
    </div>
    <script>
        function checkInput() {

            //Get data
            var isLoggedIn = <?php echo json_encode($hasSession); ?>;

            if (!isLoggedIn) {

                var username = document.getElementById("userID").value;
                var password = document.getElementById("passID").value;

                //Check for empty data
                if (!(username && password)) {
                  reportError("Missing Input");
                  return false;
                } else if (username.length < 4) {
                  reportError("Username is too small, it must be atleast 4 letters long");
                  return false;
                }
                else if(password.length < 6){
                  reportError("password is too small, it must be atleast 6 letters long");
                  return false;
                }

                var passwordTester = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)[a-zA-Z0-9]+$");
                var usernameTester = new RegExp("^[a-zA-Z0-9\d@]+$");

                //Check if user password or username comply with standards set by regex
                if (!usernameTester.test(username)) {
                    reportError("Username is incorrect, please make sure the username contains only alphanumeric letters without spaces");
                    return false;
                } else if (!passwordTester.test(password)) {
                    reportError("Password is incorrect, please make sure the password contains atleast one capital letter, number and only alphanumeric letters");
                    return false;
                }

                return true;
              } else {

                //Report error
                reportError("Already Logged In");
                return false;
              }
            }


            //Precondition : Method expects to receive element "text" that contains text like value and an integer variable "limit".
            //Postcondition : Method will report an error through the "reportError" method in the event the provided "text" element
            // has passed its integer "limit" in text size, all extra characters are deleted. In the event the text size is lower
            //than the limit, any previously shown errors with "reportError" are cleared with "clearError".
            function checkMax(text, limit) {

                //Check if text area holds more char than allowed
                if (text.value.length >= limit) {
                    str = text.value;
                    //Remove extra char
                    text.value = str.substring(0, str.length - 1);
                    reportError("Max size reached");
                } else {
                    clearError();
                }
            }



            //Precondition: Method expects to receive string
            //Postcondition: Method displays provided string to element with an id of "error"
            function reportError(message) {
                ///Display a customised error message
                document.getElementById("error").innerHTML = message;
                document.getElementById("error").style.display = "block";
                document.getElementById("error").style.color = "red";
            }




            //Precondition : none
            //Postcondition : Method hides element with id of "error"
            function clearError() {
              //Hide displayed error message
              document.getElementById("error").style.display = "none";
            }


        <?php
            if(isset($_GET['errorMessage'])){
                $error = $_GET['errorMessage'];
                echo "reportError(\"$error\");";
            }
        ?>

    </script>
    <!-- Bootstrap Javascript, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>
