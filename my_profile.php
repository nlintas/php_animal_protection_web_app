<?php
  $username = "";
  require( 'Connection.php' );
  require( 'SessionProcess.php' );

  if ( !$hasSession ) {
      header( 'Location: Index.php?errorMessage=' . urlencode( 'Not logged in' ) );
      die;

  } else {

      $userResult = $conn -> query( "SELECT * FROM user WHERE userID = $userID;" );
      if ( mysqli_num_rows( $userResult ) == 1 ) {
          $userDetails = mysqli_fetch_assoc( $userResult );
      }

      $myAdoptionQuery =
                        "
                        SELECT pet.petID, pet.name as petName, date_created, species.name as speciesName, breed.name as breedName, gender as petGender, age as petAge, health_status, colour1, colour2, colour3, description, photo
                        FROM pet, species, breed
                        WHERE pet.userID = $userID
                        AND pet.breedID = breed.breedID
                        AND species.speciesID = breed.speciesID
                        AND for_adoption = 1;
                        ";

      $myLostPetsQuery =
                        "
                        SELECT event.eventID, pet.petID, pet.name, event.date_created, event.country_short, species.name as speciesName, breed.name as breedName, gender as petGender, age as petAge, health_status, colour1, colour2, colour3, event.description, photo
                        FROM pet, event, lost_pet, breed, species
                        WHERE pet.petID = lost_pet.petID
                        AND lost_pet.eventID = event.eventID
                        AND pet.breedID = breed.breedID
                        AND breed.speciesID = species.speciesID
                        AND pet.userID = $userID
                        AND for_adoption = 0;
                        ";

      $myOtherEventsQuery =
                          "
                          SELECT event.eventID, country_short, country_long, postcode, street, radius, type, description, date_created
                          FROM event, event_type
                          WHERE event.event_typeID = event_type.event_typeID
                          AND event.userID = $userID
                          AND type != 'Lost Pet';
                          ";

      $adoptionResults = $conn -> query($myAdoptionQuery);
      $lostPetResults = $conn -> query($myLostPetsQuery);
      $eventResults = $conn -> query($myOtherEventsQuery);
  }

  mysqli_close( $conn );
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>PetHub! - My Profile - Explore your Posts and Edit your Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Custom fonts Used -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <!--  Bootstrap 4.5 CSS  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!--  Our CSS Links  -->
    <link href="css/freelancer.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/lintas.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
        body {
            background-color: white;
        }

        /* Fixes a coloring issue with the selectable list items */

        a {
            color: inherit;
        }

        /* mouse over link */
        a:hover {
            text-decoration: none;
            color: darkcyan;
        }

        .border {
            border: 3px solid #ccc;
            margin: 3%;
        }

        .list-group {
            background-color: aliceblue;
        }

        .list-group-item {
            background-color: white;
        }

        /* Padlock Hover for reacting to the users actions */
        .padlock:hover {
            border: 7px solid aquamarine;
        }

        /* Fixes a footer placement issue */
        #page-container {
            position: relative;
            min-height: 100vh;
        }

        #content-wrap {
            padding-bottom: 2.5rem;
            /* Footer height */
        }

        #nav-tab a {
            font-size: 30px;
        }

    </style>
</head>

<body class="pt-5 mt-5">
    <div id="page-container">

        <!-- Navigation -->
        <?php require('Navigation.php'); ?>
        <div id="content-wrap">
            <div class="container-fluid top-part">
                <form class="login100-form validate-form " Action="UpdateAccountProcess.php" Method="Post" onsubmit="return checkInput(this);" enctype="multipart/form-data">
                    <div class="row">
                        <!-- User Details Column -->
                        <div class='col-12 col-md-4 col-lg-5 col-xl-5' id='user'>
                            <h4 class="pl-3"><?php echo $userDetails['username'];?></h4>
                            <img id="userPhoto" class="img-fluid border shadow-lg" src="<?php echo $userDetails['photo'];?>" alt="User image">
                            <div class='make-button-space'>
                                <button id='removePhoto' class='btn btn-danger bt-cance' type='button' style="visibility: visible" onclick="removeUserPhoto()">Remove Photo</button>
                            </div><br>
                            <label class='font-weight-bold'>Update Photo</label>
                            <input type='file' name='photo' id='newUserPhoto' onchange="updateUserPhoto()">
                        </div>
                        <!-- User and Security Column -->
                        <div class='col-6 col-md-4 col-lg-4 col-xl-3' id='user'>
                            <h4>User and Security</h4>
                            <label class='font-weight-bold'>Account Name</label><br>
                            <input class="shadow-sm" type='text' name='username' id='in-name' value="<?php echo $userDetails['username'];?>" onkeypress="checkMax(this, 55)" readonly>
                            <!--                    <div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div><div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>-->
                            <span><img class='fit-picture padlock' src='images/profile/padlock.png' onclick="unlockText('in-name')" alt='An image of a padlock with a key'></span><br>
                            <label class='make-space font-weight-bold'>Gender</label><br>
                            <select id="in-gender" name="gender" disabled>
                                <option value="<?php echo $userDetails['gender'];?>"> <?php echo $userDetails['gender'];?> </option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            <!--                    <div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>-->
                            <span><img class='fit-picture padlock' src='images/profile/padlock.png' onclick="unlockSelect('in-gender')" alt='An image of a padlock with a key'></span><br>
                            <label class='make-space font-weight-bold'>Age</label><br>
                            <input class="shadow-sm" type='number' min="0" name='age' id='in-age' value="<?php echo $userDetails['age']; ?>" readonly>
                            <!--                    <div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>-->
                            <span><img class='fit-picture padlock' src='images/profile/padlock.png' onclick="unlockText('in-age')" alt='An image of a padlock with a key'></span><br>
                            <label class='make-space font-weight-bold'>Email</label><br>
                            <input class="shadow-sm" type='email' name='email' id='in-email' value="<?php echo $userDetails['email']; ?>" onkeypress="checkMax(this, 255)" readonly>
                            <!--                    <div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>-->
                            <span><img class="fit-picture padlock" src='images/profile/padlock.png' onclick="unlockText('in-email')" alt='An image of a padlock with a key'></span><br>
                            <label class='make-space font-weight-bold'>Change Password</label>
                            <!--                    <div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>-->
                            <span><img class='fit-picture padlock' src='images/profile/padlock.png' onclick="unlockPasswords('passwordFields')" alt='An image of a padlock with a key'></span><br>
                            <div id='passwordFields' style="visibility: hidden">
                                <label class='make-space font-weight-bold'>New Password</label><br>
                                <input type='password' name='password' id="in-password" onkeypress="checkMax(this, 55)"><br>
                                <label class='make-space font-weight-bold'>Re-enter New Password</label><br>
                                <input type='password' name='confirm-password' id="in-confirmPassword" onkeypress="checkMax(this, 55)"><br>
                            </div>
                        </div>
                        <div class="row">

                        </div>
                        <!-- General Options Column -->
                        <div class='col-6 col-md-4 col-lg-3 col-xl-4' id='general'>
                            <h4>General</h4>
                            <label class='font-weight-bold'>Street Name and Number</label><br>
                            <input class="shadow-sm" type='text' name='street' id='in-street' value="<?php echo $userDetails['street']; ?>" onkeypress="checkMax(this, 55)" readonly>
                            <!--                   <div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>-->
                            <span><img class='fit-picture padlock' src='images/profile/padlock.png' onclick="unlockText('in-street')" alt='An image of a padlock with a key'></span><br>
                            <input type="hidden" value="<?php echo $userDetails['country_long']; ?>" id="country_long" name="country_long">
                            <label class='make-space font-weight-bold'>Country</label><br>
                            <select class="shadow-sm" name='country_short' id='country_short' onchange="updateCountry(this.options[this.selectedIndex].text)" disabled style="font-size:14px;">
                                <option value="<?php echo $userDetails['country_short'];?>"> <?php echo $userDetails['country_long']; ?> </option>
                                <option value=AF>
                                    Afghanistan </option>
                                <option value=AX>
                                    Ãland Islands </option>
                                <option value=AL>
                                    Albania </option>
                                <option value=DZ>
                                    Algeria </option>
                                <option value=AS>
                                    American Samoa </option>
                                <option value=AD>
                                    Andorra </option>
                                <option value=AO>
                                    Angola </option>
                                <option value=AI>
                                    Anguilla </option>
                                <option value=AQ>
                                    Antarctica </option>
                                <option value=AG>
                                    Antigua and Barbuda </option>
                                <option value=AR>
                                    Argentina </option>
                                <option value=AM>
                                    Armenia </option>
                                <option value=AW>
                                    Aruba </option>
                                <option value=AU>
                                    Australia </option>
                                <option value=AT>
                                    Austria </option>
                                <option value=AZ>
                                    Azerbaijan </option>
                                <option value=BS>
                                    Bahamas </option>
                                <option value=BH>
                                    Bahrain </option>
                                <option value=BD>
                                    Bangladesh </option>
                                <option value=BB>
                                    Barbados </option>
                                <option value=BY>
                                    Belarus </option>
                                <option value=BE>
                                    Belgium </option>
                                <option value=BZ>
                                    Belize </option>
                                <option value=BJ>
                                    Benin </option>
                                <option value=BM>
                                    Bermuda </option>
                                <option value=BT>
                                    Bhutan </option>
                                <option value=BO>
                                    Plurinational State of Bolivia </option>
                                <option value=BQ>
                                    Sint Eustatius and Saba Bonaire </option>
                                <option value=BA>
                                    Bosnia and Herzegovina </option>
                                <option value=BW>
                                    Botswana </option>
                                <option value=BV>
                                    Bouvet Island </option>
                                <option value=BR>
                                    Brazil </option>
                                <option value=IO>
                                    British Indian Ocean Territory </option>
                                <option value=BN>
                                    Brunei Darussalam </option>
                                <option value=BG>
                                    Bulgaria </option>
                                <option value=BF>
                                    Burkina Faso </option>
                                <option value=BI>
                                    Burundi </option>
                                <option value=KH>
                                    Cambodia </option>
                                <option value=CM>
                                    Cameroon </option>
                                <option value=CA>
                                    Canada </option>
                                <option value=CV>
                                    Cape Verde </option>
                                <option value=KY>
                                    Cayman Islands </option>
                                <option value=CF>
                                    Central African Republic </option>
                                <option value=TD>
                                    Chad </option>
                                <option value=CL>
                                    Chile </option>
                                <option value=CN>
                                    China </option>
                                <option value=CX>
                                    Christmas Island </option>
                                <option value=CC>
                                    Cocos (Keeling) Islands </option>
                                <option value=CO>
                                    Colombia </option>
                                <option value=KM>
                                    Comoros </option>
                                <option value=CG>
                                    Congo </option>
                                <option value=CD>
                                    The Democratic Republic of the Congo </option>
                                <option value=CK>
                                    Cook Islands </option>
                                <option value=CR>
                                    Costa Rica </option>
                                <option value=CI>
                                    CÃ´te d'Ivoire </option>
                                <option value=HR>
                                    Croatia </option>
                                <option value=CU>
                                    Cuba </option>
                                <option value=CW>
                                    Curaçao </option>
                                <option value=CY>
                                    Cyprus </option>
                                <option value=CZ>
                                    Czech Republic </option>
                                <option value=DK>
                                    Denmark </option>
                                <option value=DJ>
                                    Djibouti </option>
                                <option value=DM>
                                    Dominica </option>
                                <option value=DO>
                                    Dominican Republic </option>
                                <option value=EC>
                                    Ecuador </option>
                                <option value=EG>
                                    Egypt </option>
                                <option value=SV>
                                    El Salvador </option>
                                <option value=GQ>
                                    Equatorial Guinea </option>
                                <option value=ER>
                                    Eritrea </option>
                                <option value=EE>
                                    Estonia </option>
                                <option value=ET>
                                    Ethiopia </option>
                                <option value=FK>
                                    Falkland Islands (Malvinas) </option>
                                <option value=FO>
                                    Faroe Islands </option>
                                <option value=FJ>
                                    Fiji </option>
                                <option value=FI>
                                    Finland </option>
                                <option value=FR>
                                    France </option>
                                <option value=GF>
                                    French Guiana </option>
                                <option value=PF>
                                    French Polynesia </option>
                                <option value=TF>
                                    French Southern Territories </option>
                                <option value=GA>
                                    Gabon </option>
                                <option value=GM>
                                    Gambia </option>
                                <option value=GE>
                                    Georgia </option>
                                <option value=DE>
                                    Germany </option>
                                <option value=GH>
                                    Ghana </option>
                                <option value=GI>
                                    Gibraltar </option>
                                <option value=GR>
                                    Greece </option>
                                <option value=GL>
                                    Greenland </option>
                                <option value=GD>
                                    Grenada </option>
                                <option value=GP>
                                    Guadeloupe </option>
                                <option value=GU>
                                    Guam </option>
                                <option value=GT>
                                    Guatemala </option>
                                <option value=GG>
                                    Guernsey </option>
                                <option value=GN>
                                    Guinea </option>
                                <option value=GW>
                                    Guinea-Bissau </option>
                                <option value=GY>
                                    Guyana </option>
                                <option value=HT>
                                    Haiti </option>
                                <option value=HM>
                                    Heard Island and McDonald Islands </option>
                                <option value=VA>
                                    Holy See (Vatican City State) </option>
                                <option value=HN>
                                    Honduras </option>
                                <option value=HK>
                                    Hong Kong </option>
                                <option value=HU>
                                    Hungary </option>
                                <option value=IS>
                                    Iceland </option>
                                <option value=IN>
                                    India </option>
                                <option value=ID>
                                    Indonesia </option>
                                <option value=IR>
                                    Islamic Republic of Iran </option>
                                <option value=IQ>
                                    Iraq </option>
                                <option value=IE>
                                    Ireland </option>
                                <option value=IM>
                                    Isle of Man </option>
                                <option value=IL>
                                    Israel </option>
                                <option value=IT>
                                    Italy </option>
                                <option value=JM>
                                    Jamaica </option>
                                <option value=JP>
                                    Japan </option>
                                <option value=JE>
                                    Jersey </option>
                                <option value=JO>
                                    Jordan </option>
                                <option value=KZ>
                                    Kazakhstan </option>
                                <option value=KE>
                                    Kenya </option>
                                <option value=KI>
                                    Kiribati </option>
                                <option value=KP>
                                    Democratic People's Republic of Korea </option>
                                <option value=KR>
                                    Republic of Korea </option>
                                <option value=KW>
                                    Kuwait </option>
                                <option value=KG>
                                    Kyrgyzstan </option>
                                <option value=LA>
                                    Lao People's Democratic Republic </option>
                                <option value=LV>
                                    Latvia </option>
                                <option value=LB>
                                    Lebanon </option>
                                <option value=LS>
                                    Lesotho </option>
                                <option value=LR>
                                    Liberia </option>
                                <option value=LY>
                                    Libya </option>
                                <option value=LI>
                                    Liechtenstein </option>
                                <option value=LT>
                                    Lithuania </option>
                                <option value=LU>
                                    Luxembourg </option>
                                <option value=MO>
                                    Macao </option>
                                <option value=MK>
                                    The Former Yugoslav Republic of Macedonia </option>
                                <option value=MG>
                                    Madagascar </option>
                                <option value=MW>
                                    Malawi </option>
                                <option value=MY>
                                    Malaysia </option>
                                <option value=MV>
                                    Maldives </option>
                                <option value=ML>
                                    Mali </option>
                                <option value=MT>
                                    Malta </option>
                                <option value=MH>
                                    Marshall Islands </option>
                                <option value=MQ>
                                    Martinique </option>
                                <option value=MR>
                                    Mauritania </option>
                                <option value=MU>
                                    Mauritius </option>
                                <option value=YT>
                                    Mayotte </option>
                                <option value=MX>
                                    Mexico </option>
                                <option value=FM>
                                    Federated States of Micronesia </option>
                                <option value=MD>
                                    Republic of Moldova </option>
                                <option value=MC>
                                    Monaco </option>
                                <option value=MN>
                                    Mongolia </option>
                                <option value=ME>
                                    Montenegro </option>
                                <option value=MS>
                                    Montserrat </option>
                                <option value=MA>
                                    Morocco </option>
                                <option value=MZ>
                                    Mozambique </option>
                                <option value=MM>
                                    Myanmar </option>
                                <option value=NA>
                                    Namibia </option>
                                <option value=NR>
                                    Nauru </option>
                                <option value=NP>
                                    Nepal </option>
                                <option value=NL>
                                    Netherlands </option>
                                <option value=NC>
                                    New Caledonia </option>
                                <option value=NZ>
                                    New Zealand </option>
                                <option value=NI>
                                    Nicaragua </option>
                                <option value=NE>
                                    Niger </option>
                                <option value=NG>
                                    Nigeria </option>
                                <option value=NU>
                                    Niue </option>
                                <option value=NF>
                                    Norfolk Island </option>
                                <option value=MP>
                                    Northern Mariana Islands </option>
                                <option value=NO>
                                    Norway </option>
                                <option value=OM>
                                    Oman </option>
                                <option value=PK>
                                    Pakistan </option>
                                <option value=PW>
                                    Palau </option>
                                <option value=PS>
                                    State of Palestine </option>
                                <option value=PA>
                                    Panama </option>
                                <option value=PG>
                                    Papua New Guinea </option>
                                <option value=PY>
                                    Paraguay </option>
                                <option value=PE>
                                    Peru </option>
                                <option value=PH>
                                    Philippines </option>
                                <option value=PN>
                                    Pitcairn </option>
                                <option value=PL>
                                    Poland </option>
                                <option value=PT>
                                    Portugal </option>
                                <option value=PR>
                                    Puerto Rico </option>
                                <option value=QA>
                                    Qatar </option>
                                <option value=RE>
                                    Réunion </option>
                                <option value=RO>
                                    Romania </option>
                                <option value=RU>
                                    Russian Federation </option>
                                <option value=RW>
                                    Rwanda </option>
                                <option value=BL>
                                    Saint Barthélemy </option>
                                <option value=SH>
                                    Saint Helena, Ascension and Tristan da Cunha </option>
                                <option value=KN>
                                    Saint Kitts and Nevis </option>
                                <option value=LC>
                                    Saint Lucia </option>
                                <option value=MF>
                                    Saint Martin (French part) </option>
                                <option value=PM>
                                    Saint Pierre and Miquelon </option>
                                <option value=VC>
                                    Saint Vincent and the Grenadines </option>
                                <option value=WS>
                                    Samoa </option>
                                <option value=SM>
                                    San Marino </option>
                                <option value=ST>
                                    Sao Tome and Principe </option>
                                <option value=SA>
                                    Saudi Arabia </option>
                                <option value=SN>
                                    Senegal </option>
                                <option value=RS>
                                    Serbia </option>
                                <option value=SC>
                                    Seychelles </option>
                                <option value=SL>
                                    Sierra Leone </option>
                                <option value=SG>
                                    Singapore </option>
                                <option value=SX>
                                    Sint Maarten (Dutch part) </option>
                                <option value=SK>
                                    Slovakia </option>
                                <option value=SI>
                                    Slovenia </option>
                                <option value=SB>
                                    Solomon Islands </option>
                                <option value=SO>
                                    Somalia </option>
                                <option value=ZA>
                                    South Africa </option>
                                <option value=GS>
                                    South Georgia and the South Sandwich Islands </option>
                                <option value=SS>
                                    South Sudan </option>
                                <option value=ES>
                                    Spain </option>
                                <option value=LK>
                                    Sri Lanka </option>
                                <option value=SD>
                                    Sudan </option>
                                <option value=SR>
                                    Suriname </option>
                                <option value=SJ>
                                    Svalbard and Jan Mayen </option>
                                <option value=SZ>
                                    Swaziland </option>
                                <option value=SE>
                                    Sweden </option>
                                <option value=CH>
                                    Switzerland </option>
                                <option value=SY>
                                    Syrian Arab Republic </option>
                                <option value=TW>
                                    Province of China Taiwan </option>
                                <option value=TJ>
                                    Tajikistan </option>
                                <option value=TZ>
                                    United Republic of Tanzania </option>
                                <option value=TH>
                                    Thailand </option>
                                <option value=TL>
                                    Timor-Leste </option>
                                <option value=TG>
                                    Togo </option>
                                <option value=TK>
                                    Tokelau </option>
                                <option value=TO>
                                    Tonga </option>
                                <option value=TT>
                                    Trinidad and Tobago </option>
                                <option value=TN>
                                    Tunisia </option>
                                <option value=TR>
                                    Turkey </option>
                                <option value=TM>
                                    Turkmenistan </option>
                                <option value=TC>
                                    Turks and Caicos Islands </option>
                                <option value=TV>
                                    Tuvalu </option>
                                <option value=UG>
                                    Uganda </option>
                                <option value=UA>
                                    Ukraine </option>
                                <option value=AE>
                                    United Arab Emirates </option>
                                <option value=GB>
                                    United Kingdom </option>
                                <option value=US>
                                    United States </option>
                                <option value=UM>
                                    United States Minor Outlying Islands </option>
                                <option value=UY>
                                    Uruguay </option>
                                <option value=UZ>
                                    Uzbekistan </option>
                                <option value=VU>
                                    Vanuatu </option>
                                <option value=VE>
                                    Venezuela </option>
                                <option value=VN>
                                    VietNam </option>
                                <option value=VG>
                                    British Virgin Islands </option>
                                <option value=VI>
                                    U.S. Virgin Islands </option>
                                <option value=WF>
                                    Wallis and Futuna </option>
                                <option value=EH>
                                    Western Sahara </option>
                                <option value=YE>
                                    Yemen </option>
                                <option value=ZM>
                                    Zambia </option>
                                <option value=ZW>
                                    Zimbabwe </option>
                                <!-- <div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>-->
                            </select <span><img class='fit-picture padlock' src='images/profile/padlock.png' onclick="unlockSelect('country_short')" alt='An image of a padlock with a key'></span><br>
                            <label class='make-space font-weight-bold'>Postcode</label><br>
                            <input class="shadow-sm" type='text' name='postCode' id='in-postcode' value="<?php echo $userDetails['postcode']; ?>" onkeypress="checkMax(this, 25)" readonly>
                            <!-- <div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>-->
                            <span><img class='fit-picture padlock' src='images/profile/padlock.png' onclick="unlockText('in-postcode')" alt='An image of a padlock with a key'></span><br><br>
                            <label class='make-space font-weight-bold'>Date of account creation</label><br>
                            <p><?php echo $userDetails['date_created']; ?></p>
                            <div class='make-space'>
                                <label class='font-weight-bold'>Delete account?</label>
                                <!--<div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>-->
                                <span><img class='fit-picture padlock' src='images/profile/padlock.png' onclick="document.getElementById('delete-account-update').style.visibility = 'visible'" alt='An image of a padlock with a key'></span><br>
                            </div>
                            <!-- Delete Account Button -->
                            <div class='make-button-space'>
                                <button id='delete-account-update' class='btn btn-danger bt-update' type='button' onclick="if(confirm('Are you sure you wish to delete your account?, this cannot be undone')){location.href = 'DeleteUserProcess.php';}">Delete my account</button><br>
                            </div>
                            <!-- Common Update and Cancel Buttons -->
                            <div class='make-button-space'>
                                <button id='update' class='btn btn-primary bt-update' type='submit' name="submit" onclick="">Update!</button>
                            </div>
                            <div class='make-button-space'>
                                <button id='cancel' class='btn btn-danger bt-cancel' type='button' onclick="location.reload()">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <br>
            <!--  Multi-Purpose List Populated through PHP -->
            <div class="container-fluid pb-4">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist" style="font-size:260px">
                        <a class="nav-item nav-link active" id="nav-myAdoptions-tab" data-toggle="tab" href="#nav-myAdoptions" role="tab" aria-controls="nav-myAdoptions" aria-selected="true">My Adoptions</a>
                        <a class="nav-item nav-link" id="nav-myLostPets-tab" data-toggle="tab" href="#nav-myLostPets" role="tab" aria-controls="nav-myLostPets" aria-selected="false">My Lost Pets</a>
                        <a class="nav-item nav-link" id="nav-myOtherEvents-tab" data-toggle="tab" href="#nav-myOtherEvents" role="tab" aria-controls="nav-myOtherEvents" aria-selected="false">My Other Events</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-myAdoptions" role="tabpanel" aria-labelledby="nav-myAdoptions-tab">
                        <ul class="list-group pb-4 shadow">
                            <?php
                  $id = 0;
                  if(mysqli_num_rows($adoptionResults) > 0){
                    while($row = mysqli_fetch_assoc($adoptionResults)){

                      echo
                          '
                            <li class="list-group-item border border-success rounded shadow" id="'.$id.'">
                              <div class="d-flex flex-row pl-3">
                                <img class="img-fluid pb-2" src="images/profile/for_adoption.png" width="45px" alt="Cat with a collar waiting for an owner">&nbsp;&nbsp;
                                <span>
                                  <h4 class="pt-2 text-info text-uppercase">Adoption</h4>
                                </span>
                                <!-- <div>Icons made by <a href="https://www.flaticon.com/authors/itim2101" title="itim2101">itim2101</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>-->
                                <a href="" class="ml-auto"> <div><img class="img-fluid pb-2" src="images/profile/delete-post.png" width="40px" alt="X button for deleting a post" onclick="deletePosting(' . $row['petID'] .', null, '.$id.')"></div></a>
                              </div>
                                <hr>
                                <a href="adoptionPage?petID=' . $row['petID'] .'">
                                <div class="row pl-4">
                                    <h3 class="pt-2 pr-2 text-wrap">' . $row['petName'] .'</h3>
                                    <label class="pt-3 comment-date font-weight-light text-monospace">' . $row['date_created'] .'</label>
                                </div>
                                <div class="row pr-2">
                                    <div class="col-4 col-lg-3 col-xl-3 h-25">
                                            <img class="img-fluid img-thumbnail rounded border border-primary" src="' . $row['photo'] .'" width="250px" height="250px" alt="An image of pet waiting to be adopted uploaded by a user">
                                    </div>
                                    <div class="col-4 col-lg-2 col-xl-2 h-25 pt-1">
                                            <label class="font-weight-bold">Species: &nbsp;</label><span>' . $row['speciesName'] . '</span><br>
                                            <label class="font-weight-bold">Breed: &nbsp;</label><span>' . $row['breedName'] .'</span><br>
                                            <label class="font-weight-bold">Gender: &nbsp;</label><span>' . $row['petGender'] .'</span><br>
                                            <label class="font-weight-bold">Age: &nbsp;</label><span>' . $row['petAge'] .' years old</span><br>
                                            <label class="font-weight-bold">Health Status: &nbsp;</label><span>' . $row['health_status'] .'</span><br>
                                            <label class="font-weight-bold">Color 1: &nbsp;</label><span>' . $row['colour1'] .'</span><br>
                                            <label class="font-weight-bold">Color 2: &nbsp;</label><span>' . $row['colour2'] .'</span><br>
                                            <label class="font-weight-bold">Color 3: &nbsp;</label><span>' . $row['colour3'] .'</span>
                                    </div>
                                    <div class="col-4 col-lg-7 col-xl-7 pt-1 h-25">
                                        <div class="row">
                                            <label class="font-weight-bold">Description</label>
                                        </div>
                                        <div class="row">
                                            <p class="text-wrap text-break">' . $row['description'] .'</p>
                                        </div>
                                    </div>
                                </div>
                              </a>
                            </li>
                          ';
                      $id++;
                    }
                  }
              ?>
                        </ul>

                    </div>
                    <div class="tab-pane fade" id="nav-myLostPets" role="tabpanel" aria-labelledby="nav-myLostPets-tab">
                        <ul class="list-group pb-4 shadow">

                            <?php
                if(mysqli_num_rows($lostPetResults) > 0){
                  while($row = mysqli_fetch_assoc($lostPetResults)){

                    echo
                          '
                          <li class="list-group-item border border-success rounded" id="'.$id.'">
                            <div class="d-flex flex-row pl-3">
                                <!-- <div>Icons made by <a href="https://www.flaticon.com/authors/darius-dan" title="Darius Dan">Darius Dan</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div> -->
                                <img class="img-fluid pb-2" src="images/profile/lost_pet.png" width="45px" alt="Dog barking trying to find their owner">&nbsp;&nbsp;
                                <span>
                                <h4 class="pt-2 text-info text-uppercase">Lost Pet</h4>
                                </span>
                                 <!-- <div>Icons made by <a href="https://www.flaticon.com/authors/itim2101" title="itim2101">itim2101</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>-->
                                <a href="" class="ml-auto"> <div><img class="img-fluid pb-2" src="images/profile/delete-post.png" width="40px" alt="X button for deleting a post" onclick="deletePosting(' . $row['petID'] .', ' . $row['eventID'] .', '.$id.')"></div></a>
                            </div>
                                <hr>
                                <a href="Map.php?eventID= ' . $row['eventID'] .' &country= ' . $row['country_short'] .'">
                                <div class="row pl-4">
                                    <h3 class="pt-2 pr-2 text-wrap">Petite Trish</h3>
                                    <label class="pt-3 font-weight-light text-monospace">' . $row['date_created'] .'</label>
                                </div>
                                <div class="row pr-2">
                                    <div class="col-4 col-lg-3 col-xl-3">
                                            <img class="img-fluid img-thumbnail rounded border border-primary" alt="An image of a lost pet waiting to be saved uploaded by a user" src="' . $row['photo'] .'" width="250px" height="250px">
                                    </div>
                                    <div class="col-4 col-lg-2 col-xl-2 h-25 pt-1">
                                            <label class="font-weight-bold">Species: &nbsp;</label><span>' . $row['speciesName'] .'</span><br>
                                            <label class="font-weight-bold">Breed: &nbsp;</label><span>' . $row['breedName'] .'</span><br>
                                            <label class="font-weight-bold">Gender: &nbsp;</label><span>' . $row['petGender'] .'</span><br>
                                            <label class="font-weight-bold">Age: &nbsp;</label><span>' . $row['petAge'] .' years old</span><br>
                                            <label class="font-weight-bold">Health Status: &nbsp;</label><span>' . $row['health_status'] .'</span><br>
                                            <label class="font-weight-bold">Color 1: &nbsp;</label><span>' . $row['colour1'] .'</span><br>
                                            <label class="font-weight-bold">Color 2: &nbsp;</label><span>' . $row['colour2'] .'</span><br>
                                            <label class="font-weight-bold">Color 3: &nbsp;</label><span>' . $row['colour3'] .'</span>
                                    </div>
                                    <div class="col-4 col-lg-7 col-xl-7 pt-1 h-25">
                                        <div class="row">
                                            <label class="font-weight-bold">Description</label>
                                        </div>
                                        <div class="row">
                                            <p class="desc">' . $row['description'] .'</p>
                                        </div>
                                    </div>
                                </div>
                              </a>
                            </li>
                          ';
                    $id++;
                  }
                }
              ?>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-myOtherEvents" role="tabpanel" aria-labelledby="nav-myOtherEvents-tab">
                        <ul class="list-group pb-4 shadow">

                            <?php
                if(mysqli_num_rows($eventResults) > 0){
                  while($row = mysqli_fetch_assoc($eventResults)){

                    echo
                        '
                          <li class="list-group-item border border-success rounded" id="'.$id.'">
                            <div class="d-flex flex-row pl-3">
                                <img class="img-fluid pb-2" src="images/map_icons/poison.png" width="45px" alt="A vial containing poison waiting to be used for evil intent">&nbsp;&nbsp;
                                <span>
                                <h4 class="pl-1 pt-2 text-info text-uppercase">Poisonous Food</h4>
                                </span>
                                 <!-- <div>Icons made by <a href="https://www.flaticon.com/authors/itim2101" title="itim2101">itim2101</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>-->
                                <a href="" class="ml-auto"><div><img class="img-fluid pb-2" src="images/profile/delete-post.png" width="40px" alt="X button for deleting a post" onclick="deletePosting(null, ' . $row['eventID'] .', '.$id.')"></div></a>
                              </div>
                              <hr>
                              <a href="Map.php?eventID= ' . $row['eventID'] .' &country= ' . $row['country_short'] .'">
                              <div class="row pl-3 pb-2">
                                  <h3 class="pt-2 pl-2 pr-2 text-wrap">Poison</h3>
                                  <label class="pt-3 font-weight-light text-monospace">' . $row['date_created'] .'</label>
                              </div>
                              <div class="row pr-2">
                                  <div class="col-6 col-lg-3 col-xl-3 h-25">
                                      <div class="pl-3">
                                              <label class="font-weight-bold">Country: &nbsp;</label><span>' . $row['country_long'] .'</span><br>
                                              <label class="font-weight-bold">Postcode: &nbsp;</label><span>' . $row['postcode'] .'</span><br>
                                              <label class="font-weight-bold">Street Address: &nbsp;</label><span>' . $row['street'] .'</span><br>
                                              <label class="font-weight-bold">Radius: &nbsp;</label><span>' . $row['radius'] .' meters around</span>
                                      </div>
                                  </div>
                                  <div class="col-6 col-lg-9 col-xl-9 pt-1 h-25">
                                      <div class="row">
                                          <label class="font-weight-bold">Description</label>
                                      </div>
                                      <div class="row">
                                          <p class="desc text-wrap">' . $row['description'] .'</p>
                                      </div>
                                  </div>
                              </div>
                            </a>
                          </li>
                        ';
                    $id++;
                  }
                }
              ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <div style="position: absolute;bottom: 0;width:100%;height: 2.5rem;">
            <?php require('Footer.php'); ?>
        </div>
    </div>
    <script>
        function removeUserPhoto() {

            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", "RemoveUserPhotoProcess.php", true);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.response == "success") {
                        reportError("Photo successfully removed");
                        //<div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
                        document.getElementById("userPhoto").src = "images\\profile\\user-no-image.png";
                    } else {
                        reportError(this.response);
                    }
                    this.abort;
                }
            }
            xhttp.send();
        }



        function updateUserPhoto() {

            var filesSelect = document.getElementById("newUserPhoto");
            var files = filesSelect.files;
            var file = files[0];

            var form_data = new FormData();
            form_data.enctype = "multipart/form-data";
            form_data.append('photo', file, file.name);


            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "UpdateUserPhotoProcess.php", true);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.response) {
                        reportError("Photo successfully updated");
                        document.getElementById("userPhoto").src = this.response;
                    } else {
                        reportError("Unable to update photo");
                    }

                    this.abort();
                }
            }
            xhttp.send(form_data);
        }

        function deletePosting(petID, eventID, id) {

            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", "DeleteEventProcess.php?petID=" + petID + "&eventID=" + eventID, true);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    if (this.response == "Posting was successfully deleted") {
                        reportError(this.response);
                        //<div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
                        document.getElementById(id).outerHTML = "";
                    } else {
                        reportError(this.response);
                    }
                    this.abort();
                }
            }
            xhttp.send();
        }


        function unlockText(id) {
            document.getElementById(id).readOnly = false;
            revealButtons();
        }

        function unlockSelect(id) {

            document.getElementById(id).disabled = false;
            revealButtons();

        }

        function unlockPasswords(id) {
            document.getElementById(id).style.visibility = "visible"
            revealButtons();
        }

        function updateCountry(country_long) {
            document.getElementById("country_long").value = country_long;
        }

        function revealButtons() {
            document.getElementById("update").style.visibility = "visible";
            document.getElementById("cancel").style.visibility = "visible";
        }

        function checkInput(form) {

            //Get data
            unlockSelect('country_short');
            unlockSelect('in-gender');
            var username = document.getElementById("in-name").value;
            var password = document.getElementById("in-password").value;
            var country = document.getElementById("country_short").value;
            var country_long = document.getElementById("country_long").value;
            var email = document.getElementById("in-email").value;
            var postCode = document.getElementById("in-postcode").value;
            var street = document.getElementById("in-street").value;
            var age = document.getElementById("in-age").value;
            var confirmPassword = document.getElementById("in-confirmPassword").value;
            var gender = document.getElementById("in-gender").value;

            //Check for empty data
            if (!(username && country && country_long && email && postCode && street && gender && age)) {
                reportError("Missing Input");
                return false;
            } else if (username.length < 4) {
                reportError("Username is to small");
                return false;
            }


            var passwordTester = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)[a-zA-Z0-9]+$");
            var usernameTester = new RegExp("^[a-zA-Z0-9\d@]+$");

            if (!usernameTester.test(username)) {
                reportError("Username is incorrect");
                return false;
            }

            if (!(password === "") && !(confirmPassword === "")) {
                if (!passwordTester.test(password)) {
                    reportError("Password is incorrect");
                    return false;
                } else if (!(password === confirmPassword)) {
                    reportError("Passwords do not match");
                    return false;
                }
            }

            return true;
        }

        //Precondition : Method expects to receive a string variable
        //Postcondition : Method displays an alert window with the provided "message" string
        function reportError(message) {
            window.alert(message);
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
                reportError("Maximum word length reached");
            }
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
