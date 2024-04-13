<?php

    $username = "";
    //Create DB connection
    include('Connection.php');
    //Check if user if logged and get details
    include('SessionProcess.php');

    //Check if user is logged in
    if($hasSession){

      //Retrieve user location information
      $result = mysqli_query($conn, "SELECT country_short, street, postcode FROM user WHERE userID = $userID;");
      if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
      }
    }
    else{
      //Set default values
      $row['country_short'] = "";
      $row['street'] = "";
      $row['postcode'] = "";
    }

    //Check if eventID and country have been sent through URL and set values
    if(isset($_GET['eventID']) && isset($_GET['country'])){
      $eventID = $_GET['eventID'];
      $country = $_GET['country'];
    }
    else{
      $eventID = null;
      $country = null;
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PetHub! - Map - Report Lost Pets and Poisonous Traps</title>
    <!-- Custom fonts Used -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <!--  Bootstrap 4.5 CSS  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Our CSS Links-->
    <link href="css/lintas.css" rel="stylesheet">
    <link href="css/freelancer.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <style>
        #map {
            margin-top: 14%;
            height: 87%;
            width: 90%;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 5%;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        textarea {
            resize: none;
        }

        .container {
            display: none;
        }

    </style>
</head>

<body>
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

    <?php require('Navigation.php'); ?>

    <div class="shadow-lg" id="map"></div>

    <script>

        //Store user related information from php
        var isLoggedIn = <?php echo json_encode($hasSession); ?>;
        var selectedEventID = <?php echo json_encode($eventID); ?>;
        var selectedCountry = <?php echo json_encode($country); ?>;
        var hasFoundEvent = false;

        //Google map and geocoder variables
        var geocoder;
        var markerCluster;
        var map;

        //Spidefier variable
        var oms;

        //Array of stored markers
        var markers = [];

        //Countries already downloaded from
        var visitedCountries = [];

        //User made marker and location information related to it for form submission
        var newMarker;

        //Precondition: Method expects to recieve array of event information from DB
        //Postcondition : Method places markers on the map each containing their appropriate event information and event listeners
        function addEventMarkers(events) {

            var imagePath;
            for (const [key, value] of Object.entries(events)) {

            //Find lat/lng of event (geocoding)
            geocoder.geocode({
              componentRestrictions: {
                country: value.country_short
              },
                'address': value.street + " " + value.postcode
            }, function(result, status) {
                if (status == 'OK') {

                  //Check type of event
                  if(value.type == "Poison"){
                    imagePath = "images/map_icons/poison.png";
                  }
                  else if (value.type == "Lost Pet"){
                    imagePath = "images/map_icons/lost_pet.png";
                  }
                  else{
                    imagePath = "images/map_icons/unknown.png";
                  }

                  // Create new temporary marker variable
                  var marker = new google.maps.Marker({
                    position: result[0].geometry.location,
                    icon : imagePath
                  });

                  //Add marker to Spidefier manager
                  oms.addMarker(marker);

                  //Add event listener for displaying marker information on "click"
                  marker.addListener('click', function() {
                    hideForm();
                    showMarkerDetails(this);
                    newMarker.setMap(null);
                  });

                  //Add data to marker
                  marker.country = value.country_long;
                  marker.street = value.street;
                  marker.postcode = value.postcode;
                  marker.description = value.description;
                  marker.radius = value.radius;
                  marker.type = value.type;
                  marker.username = value.username;
                  marker.date_created = value.date_created;
                  marker.eventID = value.eventID;

                  //Add pet related data to marker if the event is of "Lost Pet"
                  if(value.type == "Lost Pet"){
                    marker.date_created = value.date_created;
                    marker.breedName = value.breedName;
                    marker.speciesName = value.speciesName;
                    marker.petName = value.petName;
                    marker.gender = value.petGender;
                    marker.health = value.health_status;
                    marker.age = value.petAge;
                    marker.photo = value.photo;
                    marker.colour1 = value.colour1;
                    marker.colour2 = value.colour2;
                    marker.colour3 = value.colour3;
                  }

                  //Check if the user has requested for a specific event and if it has already been found
                  if(!hasFoundEvent && selectedCountry && selectedEventID){
                    //Check if the event matches the requested event ID
                    if(value.eventID == selectedEventID){
                      //Display the event and center the map on it
                      var latLng = marker.getPosition();
                      map.setCenter(latLng);
                      hideForm();
                      showMarkerDetails(marker);
                      //Remove existing marker made by the user if any
                      if(newMarker != null){
                        newMarker.setMap(null);
                      }
                      hasFoundEvent = true;
                    }
                  }

                  //Push new Marker into markers array and add markers to google markerClusterer variable
                  markers.push(marker);
                  markerCluster.addMarkers(markers);
                }
                else {
                  console.log("Unable to get more events");
                }
            });
          }
        }


        //Precondition : Method expects to receive String of 2 char of a countries name (ISO 3166-1 alpha-2)
        //Postcondition : Method returns all events that can be found inside the provided country, these events are then
        //added to the map as markers with "addEventMarkers()".
        function updateMap(country) {

            //Get general events
            var xhttpGeneral = new XMLHttpRequest();
            var xhttpPet = new XMLHttpRequest();
            xhttpGeneral.responseType = "json";
            xhttpPet.responseType = "json";


            xhttpGeneral.open("GET", "UpdateGeneralEventsMap.php?country=" + country, true);
            xhttpGeneral.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    if (this.response != "null") {
                        addEventMarkers(this.response);
                    }
                    this.abort();
                }
            }

            xhttpGeneral.send();

            //Get lost pet events
            xhttpPet.open("GET", "UpdatePetEventsMap.php?country=" + country, true);
            xhttpPet.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    if (this.response != "null") {
                        addEventMarkers(this.response);
                    }
                    this.abort();
                }

            }
            xhttpPet.send();
        }

        /*
        Precondition : none
        Postcondition : Method creates a new map at a html elemtent with id of "map",
        Should the user be logged in the map defaults to their location information,
        otherwise the map defaults to an overview of greece.
        If the user has requested for a specific country and event though URL variables
        the default location will load to the requested country, this is achieved with the
        help of php.

        NOTE: The created map contains an event listener for when the map is moved "tilesloaded".
        In this event, the map will execute after 5 seconds a geocoding request in order to find
        the current country the user is above, upon success the code checks if the country has been
        visited before and if not, the method "updateMap()" is executed.
        */
        function initMap() {

          //Default Greece Lat/Lng
          var latlng = new google.maps.LatLng(39.0742, 21.8243);

          //Create geocoder instance
          geocoder = new google.maps.Geocoder();

          //Create map settings object
          var mapOptions = {
              zoom: 7,
              center: latlng
          }

          //Create map instance with "mapOptions" object
          map = new google.maps.Map(document.getElementById('map'), mapOptions);

          //Create markerClusterer instance
          markerCluster = new MarkerClusterer(map, markers, {
              maxZoom: 14,
              imagePath: 'images/cluster_images/m'
          });

          //Create Spidifier instance with options object as a parameter
          oms = new OverlappingMarkerSpiderfier(map, {
              markersWontMove: true,
              markersWontHide: true,
              basicFormatEvents: true,
              circleFootSeparation: 50
          });

          //Check if the user is logged in and has not make a request thorugh the URL
          if (isLoggedIn && !selectedEventID && !selectedCountry) {

            //Store user location information
            var userCountry = <?php echo json_encode($row['country_short']); ?>;
            var userPostcode = <?php echo json_encode($row['postcode']); ?>;
            var userStreet = <?php echo json_encode($row['street']); ?>;

            //Reverse Geocode the users location
            geocoder.geocode({
              componentRestrictions: {
                country: userCountry
              },
                'address': userStreet + " " + userPostcode
            }, function(result, status) {

                if (status == 'OK') {

                  //Display the users current vicinity on the map
                  map.setCenter(result[0].geometry.location);
                  map.setZoom(15);
                } else {
                  console.log("Unable to get user lat/lng");
                }
            });
          }
          else if (selectedEventID && selectedCountry) {
            //In the event the user has made a request, geocode the provided country
            geocoder.geocode({
              componentRestrictions: {
                country: selectedCountry
              }
            }, function(result, status) {

                if (status == 'OK') {
                  //Set map to display provided country from geocoding results
                  map.setCenter(result[0].geometry.location);
                  map.setZoom(15);
                }
                else {
                  console.log("Unable to get selected lat/lng");
                }
            });
          }

          //Create event listener for "dbclick" for when the user creates a new marker.
          map.addListener('dblclick', function(event) {
            //Check if the user is logged in
            if (isLoggedIn) {

              var countryShort;
              var countryLong;
              var street;
              var postcode;

              //Remove previous user marker if it exists
              if (newMarker != null) {
                  newMarker.setMap(null);
              }

              //Reverse geocode from Lat/Lng coordinates the user has selected
                geocoder.geocode({
                    'location': event.latLng
                }, function(results, status) {
                    if (status == 'OK') {

                        //Loop through result
                        for (var i = 0; i < results[0].address_components.length; i++) {
                            for (var j = 0; j < results[0].address_components[i].types.length; j++) {
                                if (results[0].address_components[i].types[j] == "country") {
                                    countryShort = results[0].address_components[i].short_name;
                                    countryLong = results[0].address_components[i].long_name;
                                } else if (results[0].address_components[i].types[j] == "route") {
                                    street = results[0].address_components[i].long_name;
                                } else if (results[0].address_components[i].types[j] == "postal_code") {
                                    postcode = results[0].address_components[i].long_name;
                                }
                            }
                        }

                        //Check if user selected LatLng is valid
                        if (countryShort == undefined || street == undefined || street == "Unnamed Road" || postcode == undefined) {
                          reportError("Unable to place marker here, please place near or on roads");
                          hideForm();
                        } else {

                          var locationInfo = {newMarkerCountryShort : countryShort, newMarkerPostcode : postcode, newMarkerStreet : street, newMarkerCountryLong : countryLong};

                          //Create new marker with reverse geocoding results
                          newMarker = new google.maps.Marker({
                              position: event.latLng,
                              map: map,
                              location : locationInfo
                          });

                          map.panTo(event.latLng);
                          hideMarkerDetails();
                          showForm();
                          var ele = document.getElementById("form");
                          window.scrollTo(ele.offsetLeft,ele.offsetTop/2);
                        }
                    }
                    else {
                      reportError("Unable to get address, please place marker near or on roads");
                    }
                });

              }
              else{
                reportError("Not logged in, Log in to be able to report lost pets or other events");
              }
          });

          //Check if the user has changed countries on the map (Reverse geocoding)
          map.addListener('tilesloaded', function() {
              setTimeout(function() {
                  var country;
                  geocoder.geocode({
                      'location': map.getCenter()
                  }, function(results) {
                        //find country name
                        for (var i = 0; i < results[0].address_components.length; i++) {
                            for (var j = 0; j < results[0].address_components[i].types.length; j++) {
                                if (results[0].address_components[i].types[j] == "country") {
                                  country = results[0].address_components[i].short_name;
                                  break;
                                }
                            }
                        }

                        //Check if the country has already been looked at
                        if (!visitedCountries.includes(country)) {
                          visitedCountries.push(country);
                          updateMap(country);
                        }
                      });
              }, 4000);
          });
        }

    </script>
    <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
    <!--Creidit to: https://github.com/jawj/OverlappingMarkerSpiderfier for the use of MarkerSpidifier -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OverlappingMarkerSpiderfier/1.0.3/oms.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAN_H8pZCcRbQePPiAXSoHfKQgxR2Ubqb0&callback=initMap"></script>
    <!-- Form for submitting lost animals or poisonous traps. -->
    <form action="MapProcess.php" method="POST" onsubmit="updateFormLocationData(); return checkInput(this);" enctype="multipart/form-data">
        <div class="container shadow-lg p-3 mb-5" id="form">
            <div class="col">
                <h5>Type of Report:</h5>
                <!-- The forms are seperated into two pieces which appear when appropriate, all the information of the poison form although is shared with the lost pet form so only the lost pest exclusive parts appear or dissapear on selection -->
                <div class="row ml-4">
                    <input class="form-check-input" onclick="poisonForm();" type="radio" name="form-input" value="2" checked>&nbsp;Poisonous Food Location<br>
                </div>
                <div class="row ml-4">
                    <input class="form-check-input" onclick="lostPetForm();" type="radio" name="form-input" value="1">&nbsp;Lost Pet<br>
                </div>
            </div>
            <br>
            <!-- Common Part/Poison Food Form -->
            <div class="row">
                <div class="col-6">
                    <h6 class="pl-3">Is this a specific spot or an area?</h6>
                    <span class="pl-3">
                        <select class="btn btn-light shadow-sm border" name="radius" id="radius">
                            <option value="0">Specific Spot</option>
                            <option value="5">5m Area</option>
                            <option value="10">10m Area</option>
                            <option value="15">15m Area</option>
                            <option value="20">20m Area</option>
                        </select>
                    </span>
                </div>
                <div class="col-6">
                    <h6>Description:</h6>
                    <textarea class="form-control shadow-sm" id="desc" name="description" onkeypress="checkMax(this,600);"></textarea>
                </div>
            </div>
            <br>
            <div>
                <!-- Lost Pet Form Exclusive Fields -->
                <div class="container pt-2" id="lostPetForm">
                    <div class="row">
                        <div class="col-6">
                            <h6>Pet Name: </h6>
                            <input class="shadow-sm" type="text" name="name" value="" id="name">
                            <br><br>
                            <h6>Picture: </h6>
                            <input type="file" name="eventImage" id="eventImage">
                            <br><br>
                            <h6>Gender: </h6>
                            <div class="ml-3">
                                <div class="row">
                                    <input type="radio" name="gender" value="Male">
                                    <h6 class="radio-container form-check-label">&nbsp; Male</h6>
                                </div>
                                <div class="row">
                                    <input type="radio" name="gender" value="Female">
                                    <h6 class="radio-container form-check-label">&nbsp; Female</h6>
                                </div>
                                <div class="row">
                                    <input type="radio" name="gender" value="Other">
                                    <h6 class="radio-container form-check-label">&nbsp; Other</h6>
                                </div>
                                <div class="row">
                                    <input type="radio" name="gender" value="Unknown">
                                    <h6 class="radio-container form-check-label">&nbsp; Unknown</h6>
                                </div>
                            </div><br>
                            <h6>Health Status:</h6>
                            <div class="ml-3">
                                <div class="row">
                                    <input type="radio" name="pet_hstatus" value="Injured">
                                    <h6 class="radio-container form-check-label">&nbsp; Injured</h6>
                                </div>
                                <div class="row">
                                    <input type="radio" name="pet_hstatus" value="In Recovery">
                                    <h6 class="radio-container form-check-label">&nbsp; In recovery</h6>
                                </div>
                                <div class="row">
                                    <input type="radio" name="pet_hstatus" value="Healthy">
                                    <h6 class="radio-container form-check-label">&nbsp; Healthy</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h6>Age: </h6>
                            <input class="shadow-sm" type=number name="age" id="age" min="0"><br><br>
                            <h6>Species: </h6>
                            <select class="form-control" name="species" id="species" onchange="updateBreed(this);">
                                <option selected="selected" value="null"> None </option>

                                <?php
                                  $speciesQuery = 'SELECT speciesID, name FROM species;';
                                  $result = $conn -> query($speciesQuery);

                                  if(mysqli_num_rows($result) > 0){
                                      while($row = mysqli_fetch_assoc($result)){
                                       echo "<option value=" . $row['speciesID'] .">" .$row['name'] . "</option>";
                                      }
                                  }
                                  mysqli_close($conn);
                                ?>
                            </select>
                            <br>
                            <h6 class="">Breed: </h6>
                            <select class="form-control" name="breed" id="breed">
                                <option selected="selected" value="null"> None </option>
                                <!--Code is updated based on species selection -->

                            </select>
                            <br>
                            <h6 class="">First Color: </h6>
                            <select class="form-control" name="firstColour" id="firstColour">
                              <option selected="selected" value="null">None</option>
                              <option value="null">None</option>
                              <option value="Green">Green</option>
                              <option value="Blue">Blue</option>
                              <option value="Black">Black</option>
                              <option value="White">White</option>
                              <option value="Grey">Grey</option>
                              <option value="Brown">Brown</option>
                              <option value="Orange">Orange</option>
                              <option value="Red">Red</option>
                              <option value="Yellow">Yellow</option>
                              <option value="Purple">Purple</option>
                            </select>
                            <br>
                            <h6 class="">Second Color: </h6>
                            <select class="form-control" name="secondColour" id="secondColour">
                              <option selected="selected" value="null">None</option>
                              <option value="null">None</option>
                              <option value="Green">Green</option>
                              <option value="Blue">Blue</option>
                              <option value="Black">Black</option>
                              <option value="White">White</option>
                              <option value="Grey">Grey</option>
                              <option value="Brown">Brown</option>
                              <option value="Orange">Orange</option>
                              <option value="Red">Red</option>
                              <option value="Yellow">Yellow</option>
                              <option value="Purple">Purple</option>
                            </select>
                            <br>
                            <h6 class="">Third Color: </h6>
                            <select class="form-control" name="thirdColour" id="thirdColour">
                              <option selected="selected" value="null">None</option>
                              <option value="null">None</option>
                              <option value="Green">Green</option>
                              <option value="Blue">Blue</option>
                              <option value="Black">Black</option>
                              <option value="White">White</option>
                              <option value="Grey">Grey</option>
                              <option value="Brown">Brown</option>
                              <option value="Orange">Orange</option>
                              <option value="Red">Red</option>
                              <option value="Yellow">Yellow</option>
                              <option value="Purple">Purple</option>
                            </select>
                            <br><br>
                        </div>
                    </div>

                    <br>
                    <!-- Hidden inputs used for location submission -->
                    <input type="hidden" name="country" id="country">
                    <input type="hidden" name="country_long" id="country_long">
                    <input type="hidden" name="street" id="street">
                    <input type="hidden" name="postcode" id="postcode">
                </div>
            </div>

            <div class="row">
                <button class="btn btn-primary" name="submit" type="submit" style="font-size:18px;margin-left: auto;margin-right: auto;">Submit</button>
            </div>
        </div>
    </form>
    <!-- Event Details Navigation Menu with Tabs-->
    <div id="event-details" class="container shadow-lg mb-5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist" style="font-size:20px;">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">Location Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu1">Event Details</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Pane 1 -->
            <div id="home" class="container tab-pane active">
                <div class="row text-center p-3">
                    <div class="col">
                        <h6>Country</h6>
                        <p id="markerCountry"></p>
                    </div>
                    <div class="col">
                        <h6>Street</h6>
                        <p id="markerStreet"></p>
                    </div>
                    <div class="col">
                        <h6>Postcode</h6>
                        <p id="markerPostcode"></p>
                    </div>
                    <div class="col">
                        <h6>Spot/Radius</h6>
                        <p id="markerRadius"></p>
                    </div>
                </div>
            </div>
            <!-- Pane 2 -->
            <div id="menu1" class="container tab-pane fade">
                <div class="row text-center p-3">
                    <div class="col-6 pb-5" idea id="markerImageDiv">
                        <img src="" class="img-fluid" id="markerImage" width="200px" height="200px" alt="User uploaded image for an event">
                    </div>
                    <div class="col-6 pb-5">
                        <h6>Description</h6>
                        <p class"text-wrap text-break" id="markerDescription"></p>
                    </div>
                    <div class="col overflow-auto">
                        <h6>From User</h6>
                        <p id="markerUser"></p>
                    </div>
                    <div class="col">
                        <h6>Date Created</h6>
                        <p class="font-weight-light text-monospace" id="markerDate"></p>
                    </div>
                    <div class="col overflow-auto">
                        <h6>Type of Event</h6>
                        <p id="markerType"></p>
                    </div>
                </div>
                <div id="lostPetInfoPane">
                    <div class="row text-center p-3">
                        <div class="col-4 pb-4">
                            <h6>Pet Name</h6>
                            <p id="markerPetName"></p>
                        </div>
                        <div class="col-4 pb-4">
                            <h6>Species</h6>
                            <p id="markerPetSpecies"></p>
                        </div>
                        <div class="col-4 pb-4">
                            <h6>Breed</h6>
                            <p id="markerPetBreed"></p>
                        </div>
                        <div class="col-4 pb-4">
                            <h6>Health Status</h6>
                            <p id="markerPetHealthStatus"></p>
                        </div>
                        <div class="col-4 pb-4">
                            <h6>Gender</h6>
                            <p id="markerPetGender"></p>
                        </div>
                        <div class="col-4 pb-4">
                            <h6>Age</h6>
                            <p id="markerPetAge"></p>
                        </div>
                        <div class="col-4">
                            <h6>Color 1</h6>
                            <p id="markerColour1"></p>
                        </div>
                        <div class="col-4">
                            <h6>Color 2</h6>
                            <p id="markerColour2"></p>
                        </div>
                        <div class="col-4">
                            <h6>Color 3</h6>
                            <p id="markerColour3"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php require('Footer.php'); ?>
    <!-- Bootstrap Javascript, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script>

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

      //Check user input for errors before submitting
      //Precondition : Method expects to receive form element
      //Postcondition : Method returns true if data from inputs and selected elementIDs are valid, otherwise false
      function checkInput(form) {

          var petNameTester = new RegExp("^[a-zA-Z0-9\d@ ]+$");
          var radius = document.getElementById("radius").value;

          //Get type of report
          var formType = getRadioVal(form, "form-input");

          //If the type is not chosen, error
          if (!formType) {
              reportError("Report type was not selected");
              return false;
          }

          if (!radius) {
              reportError("Radius is missing, please select the vicinity of the event");
              return false;
          }

          //Expand Checks if form is for lost pet
          if (formType == 1) {

              var health = getRadioVal(form, "pet_hstatus");
              var gender = getRadioVal(form, "gender");
              var name = document.getElementById("name").value;
              var age = document.getElementById("age").value;
              var species = document.getElementById("species").value;
              var breed = document.getElementById("breed").value;
              var firstColour = document.getElementById("firstColour").value;
              var image = document.getElementById('eventImage');

              if (!health) {
                  reportError("Missing pet health status");
                  return false;
              } else if (!gender) {
                  reportError("Missing pet gender");
                  return false;

              } else if (!age) {
                  reportError("Missing pet age status");
                  return false;

              } else if (species == "null") {
                  reportError("Missing pet species");
                  return false;

              } else if (breed == "null") {
                  reportError("Missing pet breed");
                  return false;

              } else if (firstColour == "null") {
                  reportError("Must provide first pet colour");
                  return false;
              } else if (!name) {
                  reportError("Must provide pet name");
                  return false;
              } else if (!petNameTester.test(name)) {
                  reportError("Invalid Pet name, Only Alphanumeric letters are allowed");
                  return false;
              }

          }

          // Check if a file exists
          if (image.files.length > 0) {

            //Array of acceptable file types
            var imageTypes = ["image/jpeg", "image/png", "image/jpg"];

            if(!imageTypes.includes(image.files.item(0).type)){
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

      //Precondition : Method expects to receive a string variable
      //Postcondition : Method displays a modal with the id of "myModal" in the html
      //page with the provided "message" string
      function reportError(message) {
        var targetDiv = document.getElementById("myModal").getElementsByTagName("P")[0];
        targetDiv.innerHTML = message;
        $(document).ready(function() {
            $("#myModal").modal();
        });
      }

      //hidelost pet submission form
      function poisonForm() {
        document.getElementById("lostPetForm").style.display = "none";
      }


      // Show lost pet form
      function lostPetForm() {
        document.getElementById("lostPetForm").style.display = "block";
      }

      //Show form for poison/lost pet submission
      function showForm() {
        document.getElementById("form").style.display = "block";
      }

      //Hide form for poison/lost pet submission
      function hideForm() {
        document.getElementById("form").style.display = "none";
      }

      //Precondition: Method expects to receive marker with additionally event Information
      //Postcondition : Method updates multiple html elements with marker information
      //and displays them
      function showMarkerDetails(marker){
        document.getElementById("markerCountry").innerHTML = marker.country;
        document.getElementById("markerStreet").innerHTML = marker.street;
        document.getElementById("markerPostcode").innerHTML = marker.postcode;
        document.getElementById("markerRadius").innerHTML = marker.radius;
        document.getElementById("markerUser").innerHTML = "<a href=\"profile_visit.php?username=\"" + marker.username + "\">" + marker.username + '</a>';
        document.getElementById("markerDate").innerHTML = marker.date_created;
        document.getElementById("markerType").innerHTML = marker.type;
        document.getElementById("markerDescription").innerHTML = marker.description;

        if(marker.type == "Lost Pet"){

          document.getElementById("markerImage").src = marker.photo;
          document.getElementById("markerPetName").innerHTML = marker.petName;
          document.getElementById("markerPetAge").innerHTML = marker.age;
          document.getElementById("markerPetBreed").innerHTML = marker.breedName;
          document.getElementById("markerPetSpecies").innerHTML = marker.speciesName;
          document.getElementById("markerColour1").innerHTML = marker.colour1;
          document.getElementById("markerColour2").innerHTML = marker.colour2;
          document.getElementById("markerColour3").innerHTML = marker.colour3;
          document.getElementById("markerPetGender").innerHTML = marker.gender;
          document.getElementById("markerPetHealthStatus").innerHTML = marker.health;
          document.getElementById("markerImageDiv").style.display = "block";
          document.getElementById("lostPetInfoPane").style.display = "block";
        }
        else{
          document.getElementById("markerImageDiv").style.display = "none";
          document.getElementById("lostPetInfoPane").style.display = "none";
        }
        document.getElementById("event-details").style.display = "block";
      }

      function hideMarkerDetails(){
        document.getElementById("event-details").style.display = "none";
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


      //Precondition : None
      //Postcondition : Method updates hidden inputs, values are obtained from
      // "newMarkerCountry", "newMarkerStreet", "newMarkerPostcode", "newMarkerCountry_long"
      function updateFormLocationData() {
        document.getElementById("country").value = newMarker.location.newMarkerCountryShort;
        document.getElementById("street").value = newMarker.location.newMarkerStreet;
        document.getElementById("postcode").value = newMarker.location.newMarkerPostcode;
        document.getElementById("country_long").value = newMarker.location.newMarkerCountryLong;
      }

      <?php
          if(isset($_GET['errorMessage'])){
              $error = $_GET['errorMessage'];
              echo "reportError(\"$error\");";
          }
      ?>

    </script>
</body>

</html>
