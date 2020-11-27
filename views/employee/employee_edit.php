<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <h1 style="color: darkred">Employee Informations Update</h1>

            <?php
           
            if (isset($_POST['sub'])) {
                $ext = extension($_FILES['pic']['name']);

                $data = array(
                    "name" => $d->VD($_POST['name']),
                    "email" => $d->VD($_POST['em']),
                    "password" => md5($_POST['pass']),
                    "designationid" => $d->VD($_POST['digid']),
                    "salary" => $d->VD($_POST['salary']),
                    "joiningdata" => $d->VD($_POST['jdname']),
                    "type" => $d->VD($_POST['type']),
                    "contact" => $d->VD($_POST['contact']),
                    "picture" => $ext
                );

                if ($d->update("employee", $data, array("id" => $_GET['id']))) {
                    if ($ext) {
                        move_uploaded_file($_FILES['pic']['tmp_name'], "images/employee/pic/" . md5("ab-1" . $_GET['id'] . "idb") . ".$ext");
                    }
                    Redirect("index.php?e=employee_view");
                } else {
                    echo $d->Error;
                }
            }
            ?>
            
            <?php
            $emp = $d->view('employee', '*', '', ['id' => $_GET['id']]);
            ($row = $emp->fetch_object());

            ?>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Full name" name="name" value="<?php echo $row->name ?>">
                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Enter email" name="em" value="<?php echo $row->email ?>">
                </div>
<!--                <div class="form-group">
                    <label for="name">Password</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Enter password" name="pass" value="">
                </div>-->
                <div class="form-group">
                    <label for="cnt">Designationid</label>
                    <select name="digid" class="wp-form-control wpcf7-text">
                        <option value="0">Chose designation</option>
                        <?php
                        $allCnt = $d->view("designation", "*", array("name", "asc"));
                        while ($des = $allCnt->fetch_object()) {
                            if (isset($_POST['digid']) && $_POST['digid'] == $des->id) {
                                echo "<option selected value='$des->id'>$des->name</option> ";
                            } else {
                                echo "<option value='$des->id'>$des->name</option> ";
                            }
                        }
                        ?>

                    </select>
                    <div class="form-group">
                        <label for="name">Salary</label>
                        <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Salary" name="salary" value="<?php echo $row->salary ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Joining Date</label>
                        <input type="date" class="wp-form-control wpcf7-text" id="name" placeholder="" name="jdname" value="<?php echo $row->joiningdata ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Type</label>
                        <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Employee type" name="type" value="<?php echo $row->type ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Contact</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Employee type" name="contact" value="<?php echo $row->contact ?>">
                </div>
                <div class="form-group">
                    <label for="name">Picture</label>
                    <input type="file" id="name" placeholder="Uplode your Picture" name="pic" value="<?php echo $row->picture ?>">
                </div>
                <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-upload"></i><span>Update</span></button>
                <br /><br />
        </div>
        </form>
    </div>
</div>
</section>