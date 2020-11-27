<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <h1 style="color: darkred">Doctor's Informations Update</h1>
            <a href="index.php?e=doctor_view" class="btn btn-info">Doctor's Informations View</a><br><br>

            <?php
            if (isset($_POST['sub'])) {
                $ext = extension($_FILES['pic']['name']);

                $data = array(
                    "name" => $d->VD($_POST['name']),
                    "email" => $d->VD($_POST['email']),
                    //"password" => $d->VD($_POST['pass']),
                    "designationid" => $d->VD($_POST['digid']),
                    "fees" => $d->VD($_POST['fees']),
                    "contact" => $d->VD($_POST['contact']),
                    "picture" => $ext
                );

                if ($d->update("doctor", $data, array("id" => $_GET['id']))) {
                    if ($ext) {
                        move_uploaded_file($_FILES['pic']['tmp_name'], "images/doctor/pic/" . md5("ab-1" . $_GET['id'] . "idb") . ".$ext");
                    }
                    Redirect("index.php?e=doctor_view");
                } else {
                    echo $d->Error;
                }
            }
            ?>

            <?php
            $emp = $d->view('doctor', '*', '', ['id' => $_GET['id']]);
            ($row = $emp->fetch_object());
            ?>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Full name" name="name" value="<?php echo $row->name ?>">
                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Enter email" name="email" value="<?php echo $row->email ?>">
                </div>
                <!--                <div class="form-group">
                                    <label for="name">Password</label>
                                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Enter password" name="pass" value="">
                                </div>-->
                <div class="form-group">
                    <label for="cnt">Designationid</label>
                    <select value="<?php $des->name ?>" name="digid" class="wp-form-control wpcf7-text">

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
                    <label for="name">Fees</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Fees" name="fees" value="<?php echo $row->fees ?>">
                </div> 

                <div class="form-group">
                    <label for="name">Contact</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Contact" name="contact" value="<?php echo $row->contact ?>">
                </div> 

                <div class="form-group">
                    <label for="name">Picture</label>
                    <input type="file" id="name" placeholder="Uplode your Picture" name="pic"  value="">
                </div>
                <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-upload"></i><span>Update</span></button>


            </form><br /><br />
        </div>
    </div>
</section>