<?php

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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poujot! - Terms and Conditions - Legal Documentation</title>
    <!-- Custom fonts Used -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <!--  Bootstrap 4.5 CSS  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- CSS Links-->
    <link href="css/lintas.css" rel="stylesheet">
    <link href="css/freelancer.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
        /* Used for limiting the size of the page for easier reading of sentences */
        #docs {
            padding-left: 20%;
            padding-right: 20%;
        }

    </style>
</head>

<body>
    <div id="docs" class="mt-5 pt-5 text-justify">
        <!-- Navigation -->
        <?php require('Navigation.php'); ?>
        <h2 class="text-center">Terms and Conditions for Poujot!</h2>
        <!-- Icon Divider -->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Main Text -->
        <h3>Introduction</h3>
        <p>These Website Standard Terms and Conditions written on this webpage shall manage your use of our website, Poujot accessible at www.Poujot.com.</p>
        <h3>Intellectual Property Rights</h3>
        <p>Other than the content you own, under these Terms, Poujot and/or its licensors own all the intellectual property rights and materials contained in this Website.</p>
        <p>You are granted limited license only for purposes of viewing the material contained on this Website.</p>
        <h3>Restrictions</h3>
        <p>You are specifically restricted from all of the following: <br>
            <ul>
                <li>Publishing any Website material in any other media;</li>
                <li>Selling, sublicensing and/or otherwise commercializing any Website material;</li>
                <li>Publicly performing and/or showing any Website material;</li>
                <li>Using this Website in any way that is or may be damaging to this Website;</li>
                <li>Using this Website in any way that impacts user access to this Website;</li>
                <li>Using this Website contrary to applicable laws and regulations, or in any way may cause harm to the Website, or to any person or business entity;</li>
                <li>Engaging in any data mining, data harvesting, data extracting or any other similar activity in relation to this Website;</li>
                <li>Using this Website to engage in any advertising or marketing.</li>
            </ul>
            <p>Certain areas of this Website are restricted from being access by you and Poujot may further restrict access by you to any areas of this Website, at any time, in absolute discretion. Any user ID and password you may have for this Website are confidential and you must maintain confidentiality as well.</p>
        </p>
        <h3>Your Content</h3>
        <p>In these Website Standard Terms and Conditions, “Your Content” shall mean any audio, video text, images or other material you choose to display on this Website. By displaying Your Content, you grant Poujot a non-exclusive, worldwide irrevocable, sub licensable license to use, reproduce, adapt, publish, translate and distribute it in any and all media.</p>
        <p>Your Content must be your own and must not be invading any third-party's rights. Poujot reserves the right to remove any of Your Content from this Website at any time without notice.</p>
        <h3>No warranties</h3>
        <p>This Website is provided “as is,” with all faults, and Poujot express no representations or warranties, of any kind related to this Website or the materials contained on this Website. Also, nothing contained on this Website shall be interpreted as advising you.</p>
        <h3>Limitation of liability</h3>
        <p>In no event shall Poujot, nor any of its officers, directors and employees, shall be held liable for anything arising out of or in any way connected with your use of this Website whether such liability is under contract. Poujot, including its officers, directors and employees shall not be held liable for any indirect, consequential or special liability arising out of or in any way related to your use of this Website.</p>
        <h3>Indemnification</h3>
        <p>You hereby indemnify to the fullest extent Poujot from and against any and/or all liabilities, costs, demands, causes of action, damages and expenses arising in any way related to your breach of any of the provisions of these Terms.</p>
        <h3>Severability</h3>
        <p>If any provision of these Terms is found to be invalid under any applicable law, such provisions shall be deleted without affecting the remaining provisions herein.</p>
        <h3>Variation of Terms</h3>
        <p>Poujot is permitted to revise these Terms at any time as it sees fit, and by using this Website you are expected to review these Terms on a regular basis.</p>
        <h3>Assignment</h3>
        <p>Poujot is allowed to assign, transfer, and subcontract its rights and/or obligations under these Terms without any notification. However, you are not allowed to assign, transfer, or subcontract any of your rights and/or obligations under these Terms.</p>
        <h3>Entire Agreement</h3>
        <p>These Terms constitute the entire agreement between Poujot and you in relation to your use of this Website, and supersede all prior agreements and understandings.</p>
        <h3>Governing Law and Jurisdiction</h3>
        <p>These Terms will be governed by and interpreted in accordance with the laws of the State of Greece, and you submit to the non-exclusive jurisdiction of the state and federal courts located in Greece for the resolution of any disputes.</p>
    </div>
    <!-- Footer -->
    <?php require('Footer.php'); ?>
    <!-- Bootstrap Javascript, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>
