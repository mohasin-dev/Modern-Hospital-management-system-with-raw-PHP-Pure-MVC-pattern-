<section id="blogArchive">      
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="blog-breadcrumbs-area">
                <div class="container">
                    <div class="blog-breadcrumbs-left">
                        <h2>Contact</h2>
                    </div>
                    <div class="blog-breadcrumbs-right">
                        <ol class="breadcrumb">
                            <li>You are here</li>
                            <li><a href="#">Home</a></li>                  
                            <li class="active">Contact</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>        
    </div>      
</section>  

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-6">
                <div class="contact-form">
                    <div class="section-heading">
                        <h2>Contact Us</h2>
                        <div class="line"></div>
                    </div>
                    <?php
                    $d = new Database();
                    if (isset($_GET['id'])) {
                        $data =$d->view("degrees", "*", array("id", "asc"), ["id" => $_GET['id']]);
                        $value = $data->fetch_object();
                    }
//                    if (isset($_POST['sub'])){
//                    $cal_date = $_POST['date'];
//                    $date = date('Y-m-d', strtotime($cal_date));
//                    echo $date;} //gives date as 2012-08-17

                    if (isset($_POST['sub'])) {
                        $data = array(
                            "name" => $d->VD($_POST['nm'])
                        );
                        // print_r($data);
                        //die();
                        if ($d->update("degrees", $data, array("id" => $_GET['id']))) {
                            echo "Update Successfull";
                            redirect("index.php?e=degree-views");
                        } else {
                            echo $d->Error;
                        }
                    }
                    ?>
                    <a href="index.php?d=degree" class="btn btn-active">Insert</a>
                    <a href="index.php?d=degree-views" class="btn btn-info">View</a>
                    <p>Fill out all required Field to send a Message. Please don't spam,Thank you!</p>
                    <form class="submitphoto_form" action="#" method="post">
                        <input type="text"name="nm" class="wp-form-control wpcf7-text" value="<?php if (isset($_GET['id'])) echo $value->name; ?>" placeholder="Your title"> 
                        <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-envelope"></i><span>Update</span></button>                
                    </form>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-6">
                <div class="contact-address">
                    <div class="section-heading">
                        <h2>Contact Information</h2>
                        <div class="line"></div>
                    </div>
                    <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</p>
                    <address class="contact-info">               
                        <p><span class="fa fa-home"></span>305 Intergraph Way
                            Madison, AL 35758, USA</p>
                        <p><span class="fa fa-phone"></span>1.256.730.2000</p>
                        <p><span class="fa fa-envelope"></span>info@wpfmedinova.com</p>
                    </address>
                    <h3>Social Media</h3>
                    <div class="social-share">               
                        <ul>
                            <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                            <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                            <li><a href="#"><span class="fa fa-pinterest"></span></a></li>
                            <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                            <li><a href="#"><span class="fa fa-linkedin"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>