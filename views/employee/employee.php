<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>

<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">

            <h1 style="color: darkred">Employee's informations</h1>
            <a href="index.php?e=employee_view" class="btn btn-info">Employees informations view</a>

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

                if ($d->insert("employee", $data)) {
                    if ($ext) {
                        if ($ext != "jpg" && $ext != "jpeg" && $ext != "png" && $ext != "gif") {

                            $ext = "";
                        } else {
                           
                            move_uploaded_file($_FILES['pic']['tmp_name'], "images/employee/pic/" . md5("ab-1" . $d->Id . "idb") . ".$ext");
                            //echo "Save Successfully";
                            Redirect("index.php?e=employee_view");
                        }
                    } else {
                        echo $d->Error;
                    }
                }
            }
                ?>

                <form action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Full name" name="name" value="">
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Enter email" name="em" value="">
                    </div>
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" class="wp-form-control wpcf7-text" id="name" placeholder="Enter password" name="pass" value="">
                    </div>
                    <div class="form-group">
                        <label for="cnt">Designationid</label>
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
                    <div class="form-group">
                        <label for="name">Salary</label>
                        <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Salary" name="salary" value="">
                    </div>
                    <div class="form-group">
                        <label for="name">Joining Date</label>
                        <input type="text" class="wp-form-control wpcf7-text" id="datepicker" placeholder="Joining Date" name="jdname" value="">
                    </div>
                    <div class="form-group">
                        <label for="name">Type</label>
                        <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Employee type" name="type" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Contact</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Employee Contact" name="contact" value="">
                </div>
                <div class="form-group">
                    <label for="name">Picture</label>
                    <input type="file" id="name" placeholder="Uplode your Picture" name="pic" value="">
                </div>
                <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-upload"></i><span>Submit</span></button>
                <br /><br />
        </div>
        </form>
    </div>
</div>
</section>