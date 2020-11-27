<link href="assets/css/fSelect.css" rel="stylesheet">
<script src="assets/js/fSelect.js"></script>
<script>
    (function ($) {
        $(function () {
            $('.test').fSelect();
        });
    })(jQuery);
</script>

<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>

<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">

            <?php
            if (isset($_POST['sub'])) {

                $ext = extension($_FILES['pic']['name']);

                $data = array(
                    "name" => $d->VD($_POST['name']),
                    "email" => $d->VD($_POST['email']),
                    "password" => $d->VD($_POST['pass']),
                    "designationid" => $d->VD($_POST['digid']),
                    "departmentid" => $d->VD($_POST['deptid']),
                    "fees" => $d->VD($_POST['fees']),
                    "contact" => $d->VD($_POST['contact']),
                    "institute" => $d->VD($_POST['institute']),
                    "picture" => $ext
                );
                print_r($data);

                if ($d->insert("doctor", $data)) {
                    $id = $d->Id;
                    if ($ext) {
                        if ($ext != "jpg" && $ext != "jpeg" && $ext != "png" && $ext != "gif") {
                            $ext = "";
                        } else {
                            move_uploaded_file($_FILES['pic']['tmp_name'], "images/doctor/pic/" . md5("ab-1" . $d->Id . "idb") . ".$ext");
                            echo "Save Successfully";

                            //Redirect("index.php?e=doctor_view");
                        }
                    } else {
                        echo $d->Error;
                    }
                    if ($_POST['degreeid']) {
                        foreach ($_POST['degreeid'] as $degid) {
                            //$id = $d->Id;
                            $arr = array(
                                "doctorid" => $id,
                                "degreesid" => $degid
                            );
                            $d->insert("doctordegree", $arr);
                            print_r($arr);
                        }
                    }

                    if ($_POST['speid']) {
                        foreach ($_POST['speid'] as $spid) {
                            //$id = $d->Id;
                            $arrr = array(
                                "doctorid" => $id,
                                "specialistid" => $spid
                            );
                            $d->insert("doctorspecialist", $arrr);
                            print_r($arrr);
                        }
                    }
                } else {
                    echo $d->Error;
                }
            }
            ?>





            <h1 style="color: darkred">Doctor's informations</h1>
            <a href="index.php?e=doctor_view" class="btn btn-info">Doctor's Informations View</a>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Full name" name="name" value="">
                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Enter email" name="email" value="">
                </div>
                <div class="form-group">
                    <label for="name">Password</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Enter password" name="pass" value="">
                </div>
                <div class="form-group">
                    <label for="cnt">Designation</label>
                    <select name="digid" class="wp-form-control wpcf7-text">
                        <option value="0">Chose designation</option>
                        <?php
                        $allDes = $d->view("designation", "*", array("name", "asc"));
                        while ($des = $allDes->fetch_object()) {
                            if (isset($_POST['digid']) && $_POST['digid'] == $des->id) {
                                echo "<option selected value='$des->id'>$des->name</option> ";
                            } else {
                                echo "<option value='$des->id'>$des->name</option> ";
                            }
                        }
                        ?>

                    </select>
                </div> 

                <div class="form-group">
                    <label for="Department">Department</label>
                    <select name="deptid" class="wp-form-control wpcf7-text">
                        <option value="0">Chose Department</option>
                        <?php
                        $allDept = $d->view("department", "*", array("name", "asc"));
                        while ($dept = $allDept->fetch_object()) {
                            if (isset($_POST['deptid']) && $_POST['deptid'] == $dept->id) {
                                echo "<option selected value='$dept->id'>$dept->name</option> ";
                            } else {
                                echo "<option value='$dept->id'>$dept->name</option> ";
                            }
                        }
                        ?>

                    </select>
                </div> 

                <div class="form-group">
                    <label for="cnt">Degrees</label>
                    <select name="degreeid[]" multiple="" class="test wp-form-control wpcf7-text">
                        <option value="0">Chose degrees</option>
                        <?php
                        $allDeg = $d->view("degrees", "*", array("name", "asc"));
                        while ($deg = $allDeg->fetch_object()) {
                            if (isset($_POST['digreeid']) && $_POST['digreeid'] == $deg->id) {
                                echo "<option selected value='$deg->id'>$deg->name</option> ";
                            } else {
                                echo "<option value='$deg->id'>$deg->name</option> ";
                            }
                        }
                        ?>

                    </select>
                </div> 

                <div class="form-group">
                    <label for="cnt">Specialist</label>
                    <select name="speid[]" multiple="" class= "test wp-form-control wpcf7-text">
                        <option value="0">Chose Specialist</option>
                        <?php
                        $allSpe = $d->view("specialist", "*", array("name", "asc"));
                        while ($spe = $allSpe->fetch_object()) {
                            if (isset($_POST['speid']) && $_POST['speid'] == $spe->id) {
                                echo "<option selected value='$spe->id'>$spe->name</option> ";
                            } else {
                                echo "<option value='$spe->id'>$spe->name</option> ";
                            }
                        }
                        ?>

                    </select>
                </div> 


                <div class="form-group">
                    <label for="name">Fees</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Fees" name="fees" value="">
                </div> 

                <div class="form-group">
                    <label for="name">Contact</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Contact" name="contact" value="">
                </div>

                <div class="form-group">
                    <label for="name">Institute</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Institute" name="institute" value="">
                </div>

                <div class="form-group">
                    <label for="name">Picture</label>
                    <input type="file" id="name" placeholder="Uplode your Picture" name="pic" value="">
                </div>
                <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-upload"></i><span>Submit</span></button>
            </form><br /><br />
        </div>
    </div>
