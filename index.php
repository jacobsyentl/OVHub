<?php include_once("ShowFunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Belgian railway up to date time services.">
    <meta name="author" content="Yentl Jacobs">
    <link rel="icon" type="image/png" href="img/train.png">
    <title>OV Hub</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/stylesheet.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
</head>

<body id="page-top" class="index">
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Search for a station</h2>
                    <form id="search-region center-block">
                        <input type="text" id="search" class="center-block" placeholder="Station"></input>
                        <input type="submit" class="btn btn-warning btn-block" value="Search" id="submit">
                    </form>
                    <h2>Or select one on this map</h2>
                    <?php
                    ShowMap();
                    ShowInfo();
                    ?>
                </div>
            </div>
        </div>

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>
                        Ov Hub is a project started out of interest for open data. It enables you to retrieve train departure info of any station in Belgium. That in combination with an intuitive map makes this an ideal trip planner for traveling with the Belgian railway system.
                    </p>
                </div>
                <div class="col-lg-4">
                    <p>This project uses the open data from the irail api. Irail is a part of the open knowledge Belgium association. Irail api makes it possible to retrieve real-time information about the Belgian railway system. For more info about the irail api, visit the link below. </p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="https://hello.irail.be/api/" target="_blank" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> irail page
                    </a>
                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="http://arrow.scrolltotop.com/arrow52.js"></script>
<noscript>Not seeing a <a href="http://www.scrolltotop.com/">Scroll to Top Button</a>? Go to our FAQ page for more info.</noscript>

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Creator of this handy app: <a href="https://be.linkedin.com/in/yentljacobs" target="_blank">Yentl Jacobs</a>
                        Theme used: <a href="http://startbootstrap.com/template-overviews/freelancer/" target="_blank">Freelancer</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/jquery-scrollTo.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWloZ-PsFFaW0Uziv_y31s-qZKL8HEtko&language=nl"></script>
    <script type="text/javascript" src="js/MapStyles.js"></script>
    <script type="text/javascript" src="js/Gmaps.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>

</body>

</html>
