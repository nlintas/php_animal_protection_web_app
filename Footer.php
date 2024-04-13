<style>
    a {
        font-size: 19px;
    }
</style>
<?php

  //Echo html footer code for pages
  echo '
        <!-- Footer -->
        <footer class="footer font-small blue pt-3 pb-2 bg-dark shadow">
            <!-- Footer Links -->
            <div class="container-fluid text-center text-md-justify">
                <!-- Grid row -->
                <div class="row">
                    <!-- Grid column -->
                    <div class="col-5 col-md-4">
                        <!-- Links -->
                        <h5 class="text-uppercase text-white">Legal Documentation</h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="privacy_policy.php" class="text-primary">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="terms_and_conditions.php" class="text-primary">Terms and Conditions</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Grid column -->
                    <div class="col-2 col-md-4">
                        <!-- Links -->
                        <h5 class="text-uppercase text-white" class="text-primary">Our Website</h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="sitemap.php" class="text-primary">Sitemap</a>
                            </li>
                            <li>
                                <a href="about_us.php" class="text-primary">About us</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-5 col-md-4">
                        <h5 class="text-uppercase text-white">accessibility</h5>
                        <ul class="list-unstyled">
                            <li>
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-primary bg-transparent p-3" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                                        Language
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">English</a>
                                        <a class="dropdown-item" href="#">German</a>
                                        <a class="dropdown-item" href="#">French</a>
                                        <a class="dropdown-item" href="#">Spanish</a>
                                        <a class="dropdown-item" href="#">Italian</a>
                                        <a class="dropdown-item" href="#">Portugese</a>
                                        <a class="dropdown-item" href="#">Chinese</a>
                                        <a class="dropdown-item" href="#">Japanese</a>
                                        <a class="dropdown-item" href="#">Korean</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <!-- Copyright -->
                    <div class="footer-copyright text-center text-white">
                        © 2020 Copyright: Poujot.com, all rights reserved.
                    </div>
                </div>
            </div>
        </footer>
        ';
?>
