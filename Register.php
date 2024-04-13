<?php

  $username = "";
  //Create DB connection
  include('Connection.php');
  //Check if the user is logged in and get details
  include('SessionProcess.php');
  mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>PetHub! - Registration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Our Favicons -->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--  Bootstrap 4.5 CSS  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Our CSS Links -->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="css/util_registration.css">
    <link rel="stylesheet" type="text/css" href="css/main_registration.css">
    <link rel="stylesheet" type="text/css" href="css/freelancer.min.css">
    <link rel="stylesheet" type="text/css" href="css/lintas.css">
    <!--===============================================================================================-->

</head>

<body>

    <!-- Navigation -->
    <?php require('Navigation.php'); ?>
    <!-- Limits the size of the page for the purpose of placing other elements -->
    <div class="limiter">
        <div class="container-login100 pt-5 mt-5" style="background-image: url('images/bg-01.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54 ">
                <span class="login90-form-title p-b-20">
                    Welcome to PetHub
                </span>
                <span class="login100-form-title p-b-10">
                    Registration Form
                </span>
                <br>
                <!-- Registration Form -->
                <form class="login100-form validate-form " Action="RegisterProcess.php" Method="Post" onsubmit="return checkInput(this)">
                    <div class="row row-space">
                        <div class="col-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
                                <span class="label-input100">Username</span>
                                <input class="input100" type="text" name="username" placeholder="Type your username" id="username" onkeypress="checkMax(this,55)">
                                <span class="focus-input100" data-symbol="&#xf206;"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <input type="hidden" value="" id="country_long" name="country_long">
                            <div data-validate="Country is required">
                                <span class="label-input100">Country</span>
                                <div class="pt-4 mt-2"></div>
                                <select name="country" id="country" onchange="updateCountry(this.options[this.selectedIndex].text)">
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
                    </div>
                    <div class="row row-space">
                        <div class="col-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate="Email is required">
                                <span class="label-input100">Email</span>
                                <input class="input100" type="email" name="email" placeholder="Type your Email" id="email" onkeypress="checkMax(this,255)">
                                <span class="focus-input100" data-symbol="&#9993;"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate="Post code is required">
                                <span class="label-input100">Post code</span>
                                <input class="input100" type="text" name="postCode" placeholder="Type your Post Code" id="postCode" onkeypress="checkMax(this,25)">
                                <span class="focus-input100" data-symbol="&#9998;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate="Password is required">
                                <span class="label-input100">Password</span>
                                <input class="input100" type="password" name="password" placeholder="Type your Password" id="password" onkeypress="checkMax(this,255)">
                                <span class="focus-input100" data-symbol="&#xf190;"></span>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate="Street is required">
                                <span class="label-input100">Street</span>
                                <input class="input100" type="text" name="street" placeholder="Type your Street" id="street" onkeypress="checkMax(this,90)">
                                <span class="focus-input100" data-symbol="&#9998;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate="Confirmation is required">
                                <span class="label-input100">Confirm Password</span>
                                <input class="input100" type="password" name="confirmPassword" placeholder="Confirm your Password" id="confirmPassword" onkeypress="checkMax(this,255)">
                                <span class="focus-input100" data-symbol="&#xf190;"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate="Street number is required">
                                <span class="label-input100">Street number</span>
                                <input class="input100" type="number" name="streetNumber" min="0" placeholder="Type your Street Number" id="streetNumber" onkeypress="checkMax(this,20)">
                                <span class="focus-input100" data-symbol="&#9998;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate="Confirmation is required">
                                <span class="label-input100">Age</span>
                                <input class="input100" type='number' min="0" name='age' id='age' placeholder="0">
                                <span class="focus-input100" data-symbol="&#9998;"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="label-input100">Gender</label>
                            <div class="pl-2 pt-2 mt-1">
                                <label class="radio-container">Male
                                    <input type="radio" name="gender" value="Male">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-container">Female
                                    <input type="radio" name="gender" value="Female">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-container">Other
                                    <input type="radio" name="gender" value="Other">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col-6">
                            <div class=" validate-input m-b-23">
                                <span class="label-input100">User Image</span>
                                <br>
                                <div class="pt-3 pl-2">
                                    <input type="file" name="userImage" id="userImage">
                                    <br>
                                    <p class="pt-1" style="font-size:13px;">Only jpeg, png images below 5MB are supported</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 pt-3">
                            <div class="container-login100-form-btn">
                               <span id="error"></span>
                                <div class="wrap-login100-form-btn">
                                    <div class="login100-form-bgbtn"></div>
                                    <button class="login100-form-btn" type="submit" name="submit">
                                        Complete
                                    </button>
                                </div>
                                <div class="pl-3 pt-2 text-justify" data-validate="Explanation">
                                    <p>By clicking complete, you agree to our <a href="terms_and_conditions.php">Terms & Conditions</a> and <a href="privacy_policy.php">Privacy Policy</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php require('Footer.php'); ?>

    <script>
        //Precondition: Method expects to receive value of selected option in a select tag
        //Postcondition : Method updates hidden input for existing form with id of "country_long" with provided variable
        function updateCountry(country_long) {
            document.getElementById("country_long").value = country_long;
        }

        //Check user input for errors before submitting
        //Precondition : Method expects to receive form element
        //Postcondition : Method returns true if data from inputs and selected elementIDs are valid, otherwise false
        function checkInput(form) {
            //Get data from form

            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var country = document.getElementById("country").value;
            var country_long = document.getElementById("country_long").value;
            var email = document.getElementById("email").value;
            var postCode = document.getElementById("postCode").value;
            var street = document.getElementById("street").value;
            var streetNumber = document.getElementById("streetNumber").value;
            var age = document.getElementById("age").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
            var image = document.getElementById('userImage');
            var gender = getRadioVal(form, "gender");

            //Check for empty data
            if (!(username && password && age && country && country_long && email && postCode && street && streetNumber && confirmPassword && gender)) {
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
                reportError("Username is incorrect, make sure the username contains only alphanumeric letters without spaces");
                return false;
            } else if (!passwordTester.test(password)) {
                reportError("Password is incorrect, please make sure the password contains atleast one capital letter, number and only alphanumeric letters");
                return false;
            } else if (!(password === confirmPassword)) {
                reportError("Passwords do not match");
                return false;
            }

            // Check if a file exists
            if (image.files.length > 0 && false) {

                //Array of acceptable file types
                var imageTypes = ["image/jpeg", "image/png", "image/jpg"];

                if (!imageTypes.includes(image.files.item(0).type)) {
                    reportError("Uploaded file can only be JPEG, PNG or JPG");
                    return false;
                }

                var fsize = image.files.item(0).size;
                var file = Math.round((fsize / 1024));
                // The size of the file.
                if (file > 5120) {
                    reportError("Provided image is too large, Please make sure it is below 5MB");
                    return false;
                }
            }

            return true;
        }


        //Precondition : Method expects to receive form element and name of radia buttons group
        //Postcondition : Method returns value of the first checked radio button
        function getRadioVal(form, name) {
            var val;
            // get list of radio buttons with specified name
            var radios = form.elements[name];

            // loop through list of radio buttons
            for (var i = 0, len = radios.length; i < len; i++) {
                if (radios[i].checked) {
                    val = radios[i].value;
                    break;
                }
            }
            return val; // return value of checked radio or undefined if none checked
        }

        //Precondition: Method expects to receive string
        //Postcondition: Method displays provided string to element with an id of "error"
        function reportError(message) {
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
            } else {
                clearError();
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
