<?php

    $username = "";
    //Create DB Connection
    include('Connection.php');
    //Check if user is logged in and get details
    include('SessionProcess.php');
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Custom fonts Used -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--  Bootstrap 4.5 CSS  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="css/freelancer.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title>PetHub! - Search - Find Pets for Adoption, Fellow Users, Lost Pets and Poisoned Food</title>

    <style>
        .butn {
            border: none;
            margin: 10px;
            padding: 14px;
            width: 200px;
            font-family: "montserrat", sans-serif;
            text-transform: uppercase;
            border-radius: 50px;
            cursor: pointer;
            color: #fff;
            background-size: 200%;
            transition: 0.6s;
            text-align: center;
        }

        .butn1 {
            background-image: linear-gradient(to left, #BDC3C6, #7BC342, #4AB2D6, #006594);
        }

        .butn:hover {
            background-position: right;
        }

        a {
            color: inherit;
        }

        /* mouse over link */
        a:hover {
            text-decoration: none;
            color: darkcyan;
        }

        .top-part {
            color: white;
            text-shadow: 1px 1px black;
        }

        /* Same as the profile page */
        .move {
            float: right;
            padding: 100px;
        }

        .border {
            border: 3px solid #ccc;
            margin: 3%;
        }

        .desc {
            width: 100%;
            word-wrap: break-word;
            word-break: break-all;
        }
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

<body class="pt-5 mt-5">
    <div id="page-container">
        <div id="content-wrap">
            <!-- Navigation -->
            <?php require('Navigation.php'); ?>
            <div class="container p-3">
                <div class="row">
                    <!-- Search Bar -->
                    <div class="col-8">
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control shadow" placeholder="Search..." aria-label="Search..." aria-describedby="button-addon2" id="searchbar">
                            <div class="input-group-append ">
                                <button class="btn btn-outline-secondary shadow" type="button" id="button-addon2" onclick="search()">Search</button>
                            </div>
                        </div>
                    </div>
                    <!-- Advanced Search Options Menu -->
                    <div class="col pt-2">
                        <a data-toggle="collapse" href="#advanceSearch" role="button" aria-expanded="false" aria-controls="advanceSearch">
                            <h4 class="font-weight-normal">Advanced Search</h4>
                        </a>
                    </div>
                </div>
                <!-- Advanced Search Contents -->
                <div class="collapse pt-3" id="advanceSearch">
                    <div class="card card-body shadow">
                        <div class="row py-2">
                            <div class="col-md">
                                <label for="searchFor">Search for:</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="searchLostPets">
                                    <label class="form-check-label" for="inlineRadio1">Lost Pet</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="searchPoisonousFood">
                                    <label class="form-check-label" for="inlineRadio2">Poisonous Food</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="searchAdoptions">
                                    <label class="form-check-label" for="inlineRadio2">Pet for Adoption</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="searchUsers">
                                    <label class="form-check-label" for="inlineRadio2">Users</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <label for="searchFor">Gender:</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="gender" id="maleBox" value="Male">
                                    <label class="form-check-label" for="inlineRadio2">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="gender" id="femaleBox" value="Female">
                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="gender" id="otherBox" value="Other">
                                    <label class="form-check-label" for="inlineRadio2">Other</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="gender" id="unknownBox" value="Unknown">
                                    <label class="form-check-label" for="inlineRadio2">Unknown</label>
                                </div>
                            </div>
                            <div class="col-md">

                                <label class="label-input100">First Color: </label>
                                <select name="firstColour" id="firstColour">
                                    <option selected="selected" value="">None</option>
                                    <option value="Green">Green</option>
                                    <option value="Blue">Blue </option>
                                    <option value="Brown">Brown</option>
                                    <option value="Black">Black </option>
                                </select>
                                <br>

                                <label class="label-input100">Second Color: </label>
                                <select name="secondColour" id="secondColour">
                                    <option selected="selected" value="">None</option>
                                    <option value="Green">Green</option>
                                    <option value="Blue">Blue </option>
                                    <option value="Brown">Brown</option>
                                    <option value="Black">Black </option>
                                </select>
                                <br>

                                <label class="label-input100">Third Color: </label>
                                <select name="thirdColour" id="thirdColour">
                                    <option selected="selected" value="">None</option>
                                    <option value="Green">Green</option>
                                    <option value="Blue">Blue </option>
                                    <option value="Brown">Brown</option>
                                    <option value="Black">Black </option>
                                </select>
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-md">
                                <label for="petType">Pet Species:</label>
                                <select id="species" class="form-control" onchange="updateBreed(this)">
                                    <option value="0"> None </option>
                                    <?php
                              $speciesQuery = 'SELECT speciesID, name FROM species;';
                              $result = $conn -> query($speciesQuery);

                              //If a result is returned, echo options tags for each row inside the select tag
                              if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                  echo "<option value=" . $row['speciesID'] .">" .$row['name'] . "</option>";
                                }
                              }

                              mysqli_close($conn);
                          ?>

                                </select>
                            </div>
                            <div class="col-md">
                                <label for="petBreed">Pet Breed:</label>
                                <select id="breed" class="form-control">
                                    <option value="0">None</option>

                                </select>
                            </div>
                            <div class="col-md">
                                <label for="healthStatus">Health status:</label>
                                <select id="healthStatusSelection" class="form-control">
                                    <option selected value=""> None</option>
                                    <option value="Healthy">Healthy</option>
                                    <option value="Injured">Injured</option>
                                    <option value="In recovery">In recovery</option>
                                </select>
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-md-4">
                                <label for="age">Minimum Age:</label>
                                <input type="number" id="minAge" name="minAge" min="0" value="0" style="width:35%;">
                                <br>
                                <label for="age">Maximum Age:</label>
                                <input type="number" id="maxAge" name="maxAge" min="0" value="0" style="width:35%;">
                            </div>
                            <div class="col-md pt-4">
                                <label for="country">Country:</label>
                                <select name="country" id="country">
                                    <option value=""></option>
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
                                </select>
                            </div>

                        </div>
                        <div style="text-align:center;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container p-2 rounded border shadow align-center text-center" style="margin-left:auto;margin-right:auto">
                <h4 class="pb-2">Sorting Options</h4>
                <div class="row">
                    <div class="col">
                        <label for="sortAlphabeticaly">In Alphabetical Order:</label>&nbsp;
                        <input class="form-check-label" type="checkbox" id="sortAlphabeticaly" onchange="sortAlphabeticaly = !sortAlphabeticaly; nextPage(0);">
                    </div>
                    <div class="col">
                        <label for="sortDate">By Most Recent Date:</label>&nbsp;
                        <input class="form-check-label" type="checkbox" id="sortDate" onchange="sortDate = !sortDate; nextPage(0);">
                    </div>
                    <div class="col">
                        <label for="searchFor">Show Only Near Me:</label>&nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="nearMe" id="nearMe">
                        </div>
                    </div>
                </div>
            </div>

            <ul id="results">

            </ul>

            <div id="pageButtons" class="pageButtons text-center pb-3"></div>
        </div>
        <!-- Footer -->
        <div style="position: absolute;bottom: 0;width:100%;height: 2.5rem;">
            <?php require('Footer.php'); ?>
        </div>
    </div>

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

    <!-- Bootstrap Javascript, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
<script>
    //Varaibles for current page status, search settings, page
    var sortAlphabeticaly = false;
    var byDate = false;
    var page = 1;
    var input;
    var species;
    var breed;
    var health;
    var minAge;
    var maxAge;
    var firstColour;
    var secondColour;
    var thirdColour;
    var nearMe;
    var searchPoisons;
    var searchLostPets;
    var searchUsers;
    var searchAdoptions;
    var country;
    var gender;


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


    //Precondition : Method expects to receive species ID
    //Postcondition: Method updates a select tag with id of "breed" with new option
    // elements from ajax, a empty valued option is always placed
    function updateBreed(select) {

      var xhttp = new XMLHttpRequest();
      xhttp.open("GET", "breedGetter.php?choice=" + select.value, true);
      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {

            select = document.getElementById("breed");
            var opt = document.createElement('option');
            opt.value = null;
            opt.appendChild(document.createTextNode('None'));
            select.innerHTML = xhttp.responseText;
            select.add(opt, 0);
            this.abort();
          }
      }
      xhttp.send();
    }

    /*
      Precondition: None
      Postcondition : Method retrieves all user inputs from advanced search filters
      including the search input itself. A request is sent to the DB along
      with obtained inputs in order to receive a resulting JSON object
      of arrays for each category of results. These arrays (or JSON object) are later displayed with
      the use of "updateResult()" and "createPageButtons()".

      NOTE: This method always searches with the page set to 1 (The first page).
    */
    function search() {

      //Disable user sorting
      sortAlphabeticaly = false;
      sortDate = false;

      //Get all user inputs and modifications of filters
      input = document.getElementById("searchbar").value;
      species = document.getElementById("species").value;
      breed = document.getElementById("breed").value;
      health = document.getElementById("healthStatusSelection").value;
      minAge = document.getElementById("minAge").value;
      maxAge = document.getElementById("maxAge").value;
      firstColour = document.getElementById("firstColour").value;
      secondColour = document.getElementById("secondColour").value;
      thirdColour = document.getElementById("thirdColour").value;
      nearMe = document.getElementById("nearMe").checked;
      searchPoisons = document.getElementById("searchPoisonousFood").checked;
      searchLostPets = document.getElementById("searchLostPets").checked;
      searchUsers = document.getElementById("searchUsers").checked;
      searchAdoptions = document.getElementById("searchAdoptions").checked;
      country = document.getElementById("country").value;

      gender = [];

      genderBoxes = document.getElementsByName("gender");

      //Check if min, max Age is valid
      if (minAge > maxAge) {
          reportError("Minimum Age cannot be bigger than the maximum");
          return;
      }

      //Get all selected genders from user and store them into an array
      for (var checkbox of genderBoxes) {
          if (checkbox.checked) {
              gender.push(checkbox.value);
          }
      }

      //Send request for search with all filters and user input
      var xhttp = new XMLHttpRequest();
      xhttp.responseType = "json";
      var url = "SearchProcess.php?search=" + input + "&species=" + species + "&breed=" + breed + "&health=" + health + "&minAge=" +
          minAge + "&maxAge=" + maxAge + "&nearMe=" + nearMe + "&firstColour=" + firstColour + "&secondColour=" + secondColour +
          "&thirdColour=" + thirdColour + "&searchUsers=" + searchUsers + "&country=" + country + "&searchAdoptions=" + searchAdoptions +
          "&gender=" + JSON.stringify(gender) + "&searchPoisons=" + searchPoisons + "&searchLostPets=" + searchLostPets +
          "&page=" + 1 + "&sortDate=" + sortDate + "&sortAlphabeticaly=" + sortAlphabeticaly;

      xhttp.open("GET", url, true);
      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            //Display results
            var result = this.response;
            if(this.response.error != null){
              reportError(this.response.error);
            }
            else{
              createPageButtons(result.pageCount);
              updateResult(result);
            }
            this.abort();

          }
      }
      xhttp.send();
    }


    //Precondition : Method expects to receive new page number the user has selected
    //Postcondition : Method querys the DB through ajax with stored filter settings variables and a search input variable
    //providing an offset (newPage). Results/Responses are displayed with "updateResult()" and "createPageButtons()"
    function nextPage(newPage) {

      page = newPage;
      var xhttp = new XMLHttpRequest();
      xhttp.responseType = "json";
      var url = "SearchProcess.php?search=" + input + "&species=" + species + "&breed=" + breed + "&health=" + health + "&minAge=" +
          minAge + "&maxAge=" + maxAge + "&nearMe=" + nearMe + "&firstColour=" + firstColour + "&secondColour=" + secondColour +
          "&thirdColour=" + thirdColour + "&searchUsers=" + searchUsers + "&country=" + country + "&searchAdoptions=" + searchAdoptions +
          "&gender=" + JSON.stringify(gender) + "&searchPoisons=" + searchPoisons + "&searchLostPets=" + searchLostPets +
          "&page=" + page + "&sortDate=" + sortDate + "&sortAlphabeticaly=" + sortAlphabeticaly;

      xhttp.open("GET", url, true);
      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {

            var result = this.response;
            if(this.response.error != null){
              reportError(this.response.error);
            }
            else{
              createPageButtons(result.pageCount);
              updateResult(result);
            }
            this.abort();
          }
      }
      xhttp.send();
    }

    //Precondition: Method expects to receive JSON object consisting of arrays
    //with the names of "users","adoptions","lostPets" and "poisons".
    //Postcondition: Method displays the contents of each array (should they be not empty)
    //in a round robin fashion in a element with an id of "results". The order of
    //array access is : "users" -> "adoptions" -> "lostPets" -> "poisons"
    function updateResult(result) {
        var list = document.getElementById("results");
        list.innerHTML = null;

        var users = result.users;
        var adoptions = result.adoptions;
        var lostPets = result.lostPets;
        var poisons = result.poisons;

        //Find the largest array size
        var longest = Math.max(users.length, adoptions.length, lostPets.length, poisons.length);

        for (var i = 0; (i < longest); i++) {
            if (users[i] != null) {
                list.innerHTML +=
                              `
                                <li class="list-group-item border border-success rounded">
                                  <div class="d-flex flex-row pl-3">
                                      <!-- <div>Icons made by <a href="https://www.flaticon.com/authors/kiranshastry" title="Kiranshastry">Kiranshastry</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div> -->
                                    <img class="img-fluid pb-2" src="images/profile/user-icon.png" width="45px" alt="An icon of a generic user stick figure">
                                    <span>
                                      <h4 class="pl-2 pt-2 mt-1 text-info text-uppercase">User</h4>
                                    </span>
                                  </div>
                                    <hr>
                                  <a href="visit_profile.php?username=` + users[i].username + `">
                                    <div class="row pl-3">
                                        <h3 class="pt-2 pr-2 text-wrap">` + users[i].username + `</h3>
                                        <label class="pt-3 font-weight-light text-monospace"> ` + users[i].date_created + `</label>
                                    </div>
                                    <div class="row pr-2">
                                        <div class="col-4 col-lg-3 col-xl-3 h-25">
                                                <img class="img-fluid img-thumbnail rounded border border-primary" src="` + users[i].photo + `" alt="Fellow user uploaded image">
                                        </div>
                                        <div class="col-8 col-lg-9 col-xl-9 h-25 pt-1">
                                                <label class="font-weight-bold">Country: &nbsp;</label><span>` + users[i].country_long + `</span><br>
                                                <label class="font-weight-bold">Gender: &nbsp;</label><span>` + users[i].gender + `</span><br>
                                                <label class="font-weight-bold">Email: &nbsp;</label><span>` + users[i].email + `</span>
                                        </div>
                                    </div>
                                  </a>
                                </li>
                              `;
            }
            if (adoptions[i] != null) {
                list.innerHTML +=
                                `
                                  <li class="list-group-item border border-success rounded shadow">
                                    <div class="d-flex flex-row pl-3">
                                      <!-- <div>Icons made by <a href="https://www.flaticon.com/authors/eucalyp" title="Eucalyp">Eucalyp</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div> -->
                                      <img class="img-fluid pb-2" src="images/profile/for_adoption.png" width="45px" alt="Cat with a collar waiting for an owner">&nbsp;&nbsp;
                                      <span>
                                        <h4 class="pt-2 mt-1 text-info text-uppercase">Adoption</h4>
                                      </span>
                                      <div class="ml-auto"></div>
                                    </div>
                                      <hr>
                                  <a href="AdoptionPage.php?petID=` + adoptions[i].petID + `">
                                      <div class="row pl-4">
                                          <h3 class="pt-2 pr-2 text-wrap">` + adoptions[i].petName + `</h3>
                                          <label class="pt-3 comment-date font-weight-light text-monospace"> ` + adoptions[i].date_created + `</label>
                                      </div>
                                      <div class="row pr-2">
                                          <div class="col-4 col-lg-3 col-xl-3 h-25">
                                                  <img class="img-fluid img-thumbnail rounded border border-primary" src="` + adoptions[i].photo + `" alt="An image of pet waiting to be adopted uploaded by a user">
                                          </div>
                                          <div class="col-4 col-lg-2 col-xl-2 h-25 pt-1">
                                                  <label class="font-weight-bold">Species: &nbsp;</label><span>` + adoptions[i].speciesName + `</span><br>
                                                  <label class="font-weight-bold">Breed: &nbsp;</label><span>` + adoptions[i].breedName + `</span><br>
                                                  <label class="font-weight-bold">Gender: &nbsp;</label><span>` + adoptions[i].petGender + `</span><br>
                                                  <label class="font-weight-bold">Age: &nbsp;</label><span>` + adoptions[i].petAge + ` years old</span><br>
                                                  <label class="font-weight-bold">Health Status: &nbsp;</label><span>` + adoptions[i].health_status + `</span><br>
                                                  <label class="font-weight-bold">Color 1: &nbsp;</label><span>` + adoptions[i].colour1 + `</span><br>
                                                  <label class="font-weight-bold">Color 2: &nbsp;</label><span>` + adoptions[i].colour2 + `</span><br>
                                                  <label class="font-weight-bold">Color 3: &nbsp;</label><span>` + adoptions[i].colour2 + `</span><br>
                                                  <label class="font-weight-bold">Country: &nbsp;</label><span>` + adoptions[i].country_long + `</span>
                                          </div>
                                          <div class="col-4 col-lg-7 col-xl-7 pt-1 h-25">
                                              <div class="row">
                                                  <label class="font-weight-bold">Description</label>
                                              </div>
                                          </div>
                                      </div>
                                   </a>
                                  </li>
                                `;
            }
            if (lostPets[i] != null) {
              //If the lostPets array is not empty, print into the list.innerHTML predifined html code with new data from the array
                list.innerHTML +=
                                `
                                <a href="Map.php?eventID=` + lostPets[i].eventID + `&country=` + lostPets[i].country_short + `">
                                  <li class="list-group-item border border-success rounded">
                                    <div class="d-flex flex-row pl-3">
                                    <!-- <div>Icons made by <a href="https://www.flaticon.com/authors/darius-dan" title="Darius Dan">Darius Dan</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div> -->
                                        <img class="img-fluid pb-2" src="images/profile/lost_pet.png" width="45px">&nbsp;&nbsp;
                                        <span>
                                        <h4 class="pt-2 text-info text-uppercase">Lost Pet</h4>
                                        </span>
                                      </div>
                                        <hr>
                                        <div class="row pl-4">
                                            <h3 class="pt-2 pr-2 text-wrap">` + lostPets[i].petName + `</h3>
                                            <label class="pt-3 font-weight-light text-monospace"> ` + lostPets[i].date_created + `</label>
                                        </div>
                                        <div class="row pr-2">
                                            <div class="col-4 col-lg-3 col-xl-3 h-25">
                                                <div class="row pl-3">
                                                    <img class="img-fluid border border-primary" src="` + lostPets[i].photo + `" width="80%" height="80%">
                                                </div>
                                            </div>
                                            <div class="col-4 col-lg-2 col-xl-2 h-25 pt-1">
                                                <div class="row">
                                                    <label class="font-weight-bold">Species: &nbsp;</label><span>` + lostPets[i].speciesName + `</span>
                                                </div>
                                                <div class="row">
                                                    <label class="font-weight-bold">Breed: &nbsp;</label><span>` + lostPets[i].breedName + `</span>
                                                </div>
                                                <div class="row">
                                                    <label class="font-weight-bold">Gender: &nbsp;</label><span>` + lostPets[i].petGender + `</span>
                                                </div>
                                                <div class="row">
                                                    <label class="font-weight-bold">Age: &nbsp;</label><span>` + lostPets[i].petAge + ` years old</span>
                                                </div>
                                                <div class="row">
                                                    <label class="font-weight-bold">Health Status: &nbsp;</label><span>` + lostPets[i].health_status + `</span>
                                                </div>
                                                <div class="row">
                                                    <label class="font-weight-bold">Color 1: &nbsp;</label><span>` + lostPets[i].colour1 + `</span>
                                                </div>
                                                <div class="row">
                                                    <label class="font-weight-bold">Color 2: &nbsp;</label><span>` + lostPets[i].colour2 + `</span>
                                                </div>
                                                <div class="row">
                                                    <label class="font-weight-bold">Color 3: &nbsp;</label><span>` + lostPets[i].colour3 + `</span>
                                                </div>
                                                <div class="row">
                                                    <label class="font-weight-bold">Country: &nbsp;</label><span>` + lostPets[i].country_long + `</span>
                                                </div>
                                            </div>
                                            <div class="col-4 col-lg-7 col-xl-7 pt-1 h-25">
                                                <div class="row">
                                                    <label class="font-weight-bold">Description</label>
                                                </div>
                                                <div class="row">
                                                    <p class="desc">` + lostPets[i].description + `</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </a>
                                </li>
                            `;

            }
            if (poisons[i] != null) {
                list.innerHTML +=
                            `
                              <li class="list-group-item border border-success rounded">
                                <div class="d-flex flex-row pl-3">
                                      <!-- <div>Icons made by <a href="https://www.flaticon.com/authors/eucalyp" title="Eucalyp">Eucalyp</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div> -->
                                    <img class="img-fluid pb-2" src="images/map_icons/poison.png" width="45px" alt="A vial containing poison waiting to be used for evil intent">&nbsp;&nbsp;
                                    <span>
                                    <h4 class="pl-1 pt-2 mt-1 text-info text-uppercase">Poisonous Food</h4>
                                    </span>
                                  </div>
                                  <hr>
                              <a href="Map.php?eventID=` + poisons[i].eventID + `&country=` + poisons[i].country_short + `">
                                  <div class="row pl-4 pb-2">
                                      <h3 class="pt-2 pr-2 text-wrap">Poison</h3>
                                      <label class="pt-3 font-weight-light text-monospace">` + poisons[i].date_created + `</label>
                                  </div>

                                  <div class="row pr-2">
                                      <div class="col-6 col-lg-3 col-xl-3 h-25">
                                          <div class="pl-3">
                                                  <label class="font-weight-bold">Country: &nbsp;</label><span>` + poisons[i].country_long + `</span><br>
                                                  <label class="font-weight-bold">Postcode: &nbsp;</label><span>` + poisons[i].postcode + `</span><br>
                                                  <label class="font-weight-bold">Street Address: &nbsp;</label><span>` + poisons[i].street + `</span><br>
                                                  <label class="font-weight-bold">Radius: &nbsp;</label><span>` + poisons[i].radius + ` meters around</span>
                                          </div>
                                      </div>
                                      <div class="col-6 col-lg-9 col-xl-9 pt-1 h-25">
                                          <div class="row">
                                              <label class="font-weight-bold">Description</label>
                                          </div>
                                          <div class="row">
                                              <p class="desc text-wrap">` + poisons[i].description + `</p>
                                          </div>
                                      </div>
                                  </div>
                              </a>
                              </li>
                            `;
            }
        }
    }

    function createPageButtons(amount) {

        var container = document.getElementById("pageButtons");
        var btn;
        container.innerHTML = null;

        if (page > 1) {
            btn = document.createElement("BUTTON");
            btn.className += "btn btn-primary";
            btn.innerHTML = "<-";
            btn.value = parseInt(page) - 1;
            btn.addEventListener("click", function() {
                nextPage(this.value)
            });
            container.appendChild(btn);
        }

        for (var i = parseInt(page) - 5; i < parseInt(page); i++) {
            if (i > 0) {
                btn = document.createElement("BUTTON");
                btn.className += "btn btn-primary";
                btn.innerHTML = i;
                btn.value = i;
                btn.addEventListener("click", function() {
                    nextPage(this.value)
                });
                container.appendChild(btn);
            }
        }

        for (var i = parseInt(page);
            ((i < amount) && (i <= parseInt(page) + 5)); i++) {
            btn = document.createElement("BUTTON");
            btn.className += "btn btn-primary";
            btn.innerHTML = i;
            btn.value = i;
            btn.addEventListener("click", function() {
                nextPage(this.value)
            });
            container.appendChild(btn);
        }

        if (parseInt(page) + 1 < amount) {
            btn = document.createElement("BUTTON");
            btn.className += "btn btn-primary";
            btn.innerHTML = "->";
            btn.value = parseInt(page) + 1;
            btn.addEventListener("click", function() {
                nextPage(this.value)
            });
            container.appendChild(btn);
        }
    }

</script>
</html>
