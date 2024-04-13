<?php

  //Database Connection Details
  $servername = "localhost";
  $serverUsername = "root";
  $serverPassword = "";
  $database = "petdb";

  //Database connection
  $conn = mysqli_connect($servername, $serverUsername, $serverPassword, $database) or die("Database connection failed" . mysqli_error());

?>
