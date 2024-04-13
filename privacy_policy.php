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
    <title>Poujot! - Privacy Policy - Legal Documentation</title>
    <!-- Custom fonts Used -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <!--  Bootstrap 4.5 CSS  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- CSS Links-->
    <link href="css/lintas.css" rel="stylesheet">
    <link href="css/freelancer.min.css" rel="stylesheet">
    <style>
        /* Used for limiting the size of the page for easier reading of sentences */
        #docs{
            padding-left: 20%;
            padding-right: 20%;
        }
    </style>
</head>

<body class="pt-5 mt-5">
    <div id="docs" class="text-justify">
        <!-- Navigation -->
        <?php require('Navigation.php'); ?>
        <h1 class="text-center">Privacy Policy of PetHub</h1>
        <!-- Icon Divider -->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="divider-custom-line"></div>
        </div>
        <p>Poujot operates the www.PetHub.com website, which provides an animal saving service.</p>
        <p>This page is used to inform website visitors regarding our policies with the collection, use,
          and disclosure of Personal Information if anyone decided to use our Service, the Poujot website.</p>
        <p>If you choose to use our Service, then you agree to the collection and use of information in relation with this policy.
          The Personal Information that we collect are used for providing and improving the Service.
          We will not use or share your information with anyone except as described in this Privacy Policy.</p>
        <p>The terms used in this Privacy Policy have the same meanings as in our Terms and Conditions,
          which is accessible at www.poujot.com, unless otherwise defined in this Privacy Policy.</p>
        <h3>Information Collection and Use</h3>
        <p>For a better experience while using our Service, we may require you to provide us with certain personally identifiable information,
          including but not limited to your name, zip code and address. The information that we collect will be used to contact or identify you.</p>
        <h3>Log Data</h3>
        <p>We want to inform you that whenever you visit our Service, we collect information that your browser sends to us that is called Log Data.
          This Log Data may include information such as your computer's Internet Protocol (“IP”) address, browser version, pages of our Service that you visit,
           the time and date of your visit, the time spent on those pages, and other statistics.</p>
        <h3>Service Providers</h3>
        <p>We may employ third-party companies and individuals due to the following reasons:</p>
        <ul>
            <li>To facilitate our Service;</li>
            <li>To provide the Service on our behalf;</li>
            <li>To perform Service-related services; or</li>
            <li>To assist us in analyzing how our Service is used.</li>
        </ul>
        <p>We want to inform our users that these third parties have access to your Personal Information.
          The reason is to perform the tasks assigned to them on our behalf.
           However, they are obligated not to disclose or use the information for any other purpose.</p>
        <h3>Security</h3>
        <p>We value your trust in providing us your personal information, thus we are striving to use commercially acceptable means of protecting it.
          But remember that no method of transmission over the internet, or method of electronic storage is 100% secure and reliable,
          and we cannot guarantee its absolute security.</p>
        <h3>Links to Other Sites</h3>
        <p>Our Service may contain links to other sites. If you click on a third-party link, you will be directed to that site.
          Note that these external sites are not operated by us. Therefore, we strongly advise you to review the Privacy Policy of these websites.
           We have no control over, and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.</p>
        <h3>Children's Privacy</h3>
        <p>Our Services do not address anyone under the age of 14. We do not knowingly collect personal identifiable information from children under 14.
          In the case we discover that a child under 14 has provided us with personal information, we immediately delete this from our servers.
          If you are a parent or guardian and you are aware that your child has provided us with personal information,
          please contact us so that we will be able to do necessary actions.</p>
        <h3>Changes to This Privacy Policy</h3>
        <p>We may update our Privacy Policy from time to time. Thus, we advise you to review this page periodically for any changes.
          We will notify you of any changes by posting the new Privacy Policy on this page. These changes are effective immediately,
           after they are posted on this page.</p>
        <h3>Contact Us</h3>
        <p>If you have any questions or suggestions about our Privacy Policy, do not hesitate to contact us.</p>
    </div>
    <!-- Footer -->
    <?php require('Footer.php'); ?>
    <!-- Bootstrap Javascript, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>
