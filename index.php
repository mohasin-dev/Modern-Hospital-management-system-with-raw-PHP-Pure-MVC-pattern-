<?php
session_start();
require 'helpers/my-helper.php';
require 'models/database.php';
require 'views/title.php';


$d = new Database();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!--=============================================== 
        Template Design By WpFreeware Team.
        Author URI : http://www.wpfreeware.com/
        ====================================================-->

        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title ?></title>

        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/icon" href="images/favicon.ico"/>

        <!-- CSS
        ================================================== -->       
        <!-- Bootstrap css file-->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font awesome css file-->
        <link href="assets/css/font-awesome.min.css" rel="stylesheet">       
        <!-- Default Theme css file -->
        <link id="switcher" href="assets/css/themes/dark-red-theme.css" rel="stylesheet">   
        <!-- Slick slider css file -->
        <link href="assets/css/slick.css" rel="stylesheet"> 
        <!-- Photo Swipe Image Gallery -->     
        <link rel='stylesheet prefetch' href='css/photoswipe.css'>
        <link rel='stylesheet prefetch' href='css/default-skin.css'>    
        <!-- Main structure css file -->
        <link href="style.css" rel="stylesheet">
        <link href="assets/css/jquery-ui.css" rel="stylesheet"> 
        <link href="assets/css/jquery.timepicker.css" rel="stylesheet"> 

       

        <script src="assets/js/jquery.js"></script>
<!--        <script src="assets/js/jquery-3.2.1.min.js"></script>-->
        <script src="assets/js/jquery-ui.js"></script>
        <!-- Google fonts -->
        <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>  
        <link href='http://fonts.googleapis.com/css?family=Habibi' rel='stylesheet' type='text/css'>   
        <link href='http://fonts.googleapis.com/css?family=Cinzel+Decorative:900' rel='stylesheet' type='text/css'>
        <!--.php5 shim and Respond.js for IE8 support of.php5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com.php5shiv/3.7.2.php5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]--> 
    </head>
    <body>  

        <!-- BEGAIN PRELOADER -->
        <!--<div id="preloader">
          <div id="status">&nbsp;</div>
        </div>-->
        <!-- END PRELOADER -->

        <!-- SCROLL TOP BUTTON -->
        <a class="scrollToTop" href="#"><i class="fa fa-heartbeat"></i></a>
        <!-- END SCROLL TOP BUTTON -->

        <!--=========== BEGIN HEADER SECTION ================-->
        <header id="header">
            <!-- BEGIN MENU -->
            <div class="menu_area">
                <nav class="navbar navbar-default navbar-fixed-top" role="navigation">  
                    <div class="container">
                        <div class="navbar-header">
                            <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <!-- LOGO -->              
                            <!-- TEXT BASED LOGO -->
                            <a class="navbar-brand" href="index.php"><i class="fa fa-hospital-o"></i>WpF <span>Medinova</span></a>              
                            <!-- IMG BASED LOGO  -->
                            <!--  <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="logo"></a>   -->                    
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
                                <li<?php if ($act == 'home') echo " class='active'" ?>><a href="index.php">Home</a></li>
                                <!--                                <li><a href="features.php">Features</a></li>
                                                                <li><a href="about-us.php">About Us</a></li>-->
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Find A Doctor <span class="fa fa-angle-down"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="index.php?f=search-doctor">Search by Doctor Name</a></li>
                                        <li><a href="medical-research.php">Search by Department</a></li>
                                        <li><a href="index.php?f=find_doctor">Search by Specialist</a></li>
                                    </ul>
                                </li>

                                <!--                                <li><a href="gallery.php">Gallery</a></li>-->

                                <?php
                                if (isset($_SESSION['type']) && ($_SESSION['type'] == 2 || $_SESSION['type'] == 3)) {
                                    ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Management<span class="fa fa-angle-down"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <?php
                                            if ($_SESSION['type'] == 3) {
                                                echo '<li><a href="index.php?a=authority">Authority</a></li>';
                                            }
                                            ?>                                           
                                            <li><a href="index.php?e=generic_view">Generic</a></li>
                                            <li><a href="index.php?e=expense_view">Expense</a></li>
                                            <li><a href="index.php?e=employee_view">Employee</a></li>
                                            <li><a href="index.php?e=admission_view">Admission</a></li>
                                            <li><a href="index.php?e=doctor_view">Doctor</a></li>
                                            <li><a href="index.php?e=approval">Appoval</a></li>
                                            <li><a href="index.php?e=degree-views">Degrees</a></li>
                                            <li><a href="index.php?e=outdoorDiagnostic_view">Outdoor Diagnostic</a></li>
                                            <li><a href="index.php?e=ambulancecharge_view">Ambulance Charge</a></li>
                                            <li><a href="index.php?e=diagnostic-view">Diagnostic</a></li>
                                            <li><a href="index.php?e=customer_view">Customer</a></li>
                                            <li><a href="index.php?e=ambulance_view">Ambulance</a></li>
                                            <li><a href="index.php?e=department-view">Department</a></li>
                                            <li><a href="index.php?e=seat-view">Seat</a></li>
                                            <li><a href="index.php?e=admdicine-view">Admission Medicine</a></li>
                                            <li><a href="index.php?e=installment-view">Installment</a></li>
                                            <li><a href="index.php?e=addiagnostic">Admission Diagnostic</a></li>


                                        </ul>
                                    </li>
                                    <?php
                                }
                                ?>


                                <?php
                                if (isset($_SESSION['type']) && ($_SESSION['type'] == 2 || $_SESSION['type'] == 3)) {
                                    ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Management-2<span class="fa fa-angle-down"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <?php
                                            if ($_SESSION['type'] == 3) {
                                                echo '<li><a href="index.php?a=authority">Authority</a></li>';
                                            }
                                            ?>                                           
                                            <li><a href="index.php?e=specialist-view">Doctor Specialist</a></li>
                                            <li><a href="index.php?e=admission_report">Admission Report</a></li>  
                                            <li><a href="index.php?e=admission_hudai">Admission Report</a></li>  
                                        </ul>
                                    </li>
                                    <?php
                                }
                                ?>   



                                <!--<li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Page <span class="fa fa-angle-down"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="404.php">404 Page</a></li>
                                        <li><a href="#">Link Two</a></li>
                                        <li><a href="#">Link Three</a></li>               
                                    </ul>
                                </li>-->




                                <li<?php if ($act == 'con') echo " class='active'" ?>><a href="index.php?f=contact">Contact</a></li>




                                <?php
                                if (isset($_SESSION['id'])) {
                                    ?>

                                    <li<?php if ($act == 'lo') echo " class='active'" ?>><a href="index.php?f=logout">Logout</a></li>
                                    <?php
                                }
                                else {
                                    ?>
                                    <li<?php if ($act == 'su') echo " class='active'" ?>><a href="index.php?f=sign_up">Sign up</a></li>
                                    <li<?php if ($act == 'ln') echo " class='active'" ?>><a href="index.php?f=login">Login</a></li>
                                    <?php
                                }
                                ?>



                            </ul>           
                        </div><!--/.nav-collapse -->
                    </div>     
                </nav>  
            </div>
            <!-- END MENU -->    
        </header>
        <!--=========== END HEADER SECTION ================-->   
        <?php
        require 'controlers/controler.php';
        ?>
        <!--=========== Start Footer SECTION ================-->
        <footer id="footer">
            <!-- Start Footer Top -->
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="single-footer-widget">
                                <div class="section-heading">
                                    <h2>About Us</h2>
                                    <div class="line"></div>
                                </div>           
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="single-footer-widget">
                                <div class="section-heading">
                                    <h2>Our Service</h2>
                                    <div class="line"></div>
                                </div>
                                <ul class="footer-service">
                                    <li><a href="#"><span class="fa fa-check"></span>Service 1</a></li>
                                    <li><a href="#"><span class="fa fa-check"></span>Service 2</a></li>
                                    <li><a href="#"><span class="fa fa-check"></span>Service 3</a></li>
                                    <li><a href="#"><span class="fa fa-check"></span>Service 4</a></li>
                                    <li><a href="#"><span class="fa fa-check"></span>Service 5</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="single-footer-widget">
                                <div class="section-heading">
                                    <h2>Tags</h2>
                                    <div class="line"></div>
                                </div>
                                <ul class="tag-nav">
                                    <li><a href="#">Dental</a></li>
                                    <li><a href="#">Surgery</a></li>
                                    <li><a href="#">Pediatric</a></li>
                                    <li><a href="#">Cardiac</a></li>
                                    <li><a href="#">Ophthalmology</a></li>
                                    <li><a href="#">Diabetes</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="single-footer-widget">
                                <div class="section-heading">
                                    <h2>Contact Info</h2>
                                    <div class="line"></div>
                                </div>
                                <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</p>
                                <address class="contact-info">
                                    <p><span class="fa fa-home"></span>305 Intergraph Way
                                        Madison, AL 35758, USA</p>
                                    <p><span class="fa fa-phone"></span>1.256.730.2000</p>
                                    <p><span class="fa fa-envelope"></span>info@wpfmedinova.com</p>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Footer Middle -->
            <div class="footer-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="footer-copyright">
                                <p>&copy; Copyright 2015 <a href="index.php">WpF Medinova</a></p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="footer-social">              
                                <a href="#"><span class="fa fa-facebook"></span></a>
                                <a href="#"><span class="fa fa-twitter"></span></a>
                                <a href="#"><span class="fa fa-google-plus"></span></a>
                                <a href="#"><span class="fa fa-linkedin"></span></a>     
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Footer Bottom -->
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Design & Developed By <a rel="nofollow" href="http://www.wpfreeware.com/">WpF Freeware</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--=========== End Footer SECTION ================-->


        <!-- Bootstrap default js -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- slick slider -->
        <script src="assets/js/slick.min.js"></script>    
        <script type="text/javascript" src="assets/js/modernizr.custom.79639.js"></script>      
        <!-- counter -->
        <script src="assets/js/waypoints.min.js"></script>
        <script src="assets/js/jquery.counterup.min.js"></script>
        <!-- Doctors hover effect -->
        <script src="assets/js/snap.svg-min.js"></script>
        <script src="assets/js/hovers.js"></script>
        <!-- Photo Swipe Gallery Slider -->
        <script src='assets/js/photoswipe.min.js'></script>
        <script src='assets/js/photoswipe-ui-default.min.js'></script>    
        <script src="assets/js/photoswipe-gallery.js"></script>

        <!-- Custom JS -->
        <script src="assets/js/custom.js"></script>
        <script src="assets/js/jquery-ui.js"></script> 
        <script src="assets/js/jquery.timepicker.min.js"></script>
        <script>
            $(function () {
                $("#datepicker").datepicker({dateFormat: 'yy-mm-dd'});
                $("#datepicker2").datepicker({dateFormat: 'yy-mm-dd'});
                $('#datepicker3').timepicker();
                $('#datepicker4').timepicker();

            });
        </script>  

    </body>
</html>


