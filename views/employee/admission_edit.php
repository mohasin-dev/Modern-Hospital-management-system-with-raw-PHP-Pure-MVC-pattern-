<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>

<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">

            <h1 style="color: darkred">Update your information</h1>
            <a href="index.php?e=admission_view" class="btn btn-info">Employees informations view</a>

            <?php
            if (isset($_POST['sub'])) {
                $data = array(
                    "patientid" => $d->VD($_POST['pid']),
                    "doctorid" => $d->VD($_POST['docid']),
                    "seatid" => $d->VD($_POST['seatid']),
                    "admissiondate" => $d->VD($_POST['adate']),
                    "releasedate" => $d->VD($_POST['rdate']),
                    "admissionfees" => $d->VD($_POST['fees']),
                    "disease" => $d->VD($_POST['disease']),
                    "relativecontact" => $d->VD($_POST['rcontact']),
                );

                if ($d->update("admission", $data, array("id" => $_GET['id']))) {
                    echo "Update Successfully";
                    Redirect("index.php?e=admission_view");
                } else {
                    echo $d->Error;
                }
            }
            ?>

            <?php
            $emp = $d->view('admission', '*', '', ['id' => $_GET['id']]);
            ($row = $emp->fetch_object());
            ?>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">

                    <label for="cnt">Patientid</label>
                    <select name="pid" class="wp-form-control wpcf7-text">
                        <option value="0">Chose patientid</option>
                        <?php
                        $allpat = $d->view("patient", "*", array("name", "asc"));
                        while ($patient = $allpat->fetch_object()) {
                            if (isset($_POST['pid']) && $_POST['pid'] == $patient->id) {
                                echo "<option selected value='$patient->id'>$patient->id - $patient->name</option> ";
                            } else {
                                echo "<option value='$patient->id'>$patient->name</option> ";
                            }
                        }
                        ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="docid">Doctorid</label>
                    <select name="docid" class="wp-form-control wpcf7-text">
                        <option value="0">Choose doctor</option>
                        <?php
                        $doc = $d->view("doctor", "*");
                        while ($did = $doc->fetch_object()) {
                            if (isset($_POST['docid']) && $_POST['docid'] == $did) {
                                echo "<option selected value='$did->id'>$did->name</option";
                            } else {
                                echo "<option value='$did->id'>$did->name</option> ";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="seatid">Seatid</label>
                    <select  name="seatid" class="wp-form-control wpcf7-text">
                        <option value="0">Chose seatid</option>
                        <?php
                        $seat = $d->view("seat", "*");
                        while ($sid = $seat->fetch_object()) {
                            if (isset($_POST['seatid']) && $_POST['seatid'] == $sid) {
                                echo "<option selected value='$sid->id'>$sid->name</option";
                            } else {
                                echo "<option value='$sid->id'>$sid->name</option> ";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Admission Date</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="datepicker" placeholder="Admission Date" name="adate" value="<?php echo $row->admissiondate ?>">
                </div>
                <div class="form-group">
                    <label for="name">Release Date</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="datepicker2" placeholder="Release Date" name="rdate" value="<?php echo $row->releasedate ?>">
                </div>
                <div class="form-group">
                    <label for="name">Admission Fees</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Admission Fees" name="fees" value="<?php echo $row->admissionfees ?>">
                </div>
                <div class="form-group">
                    <label for="name">Relative Contact</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Relative Contact" name="rcontact" value="<?php echo $row->relativecontact ?>">
                </div>
                <div class="form-group">
                    <label for="name">Disease</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Disease Name" name="disease" value="<?php echo $row->disease ?>">
                </div>

                <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-upload"></i><span>Update</span></button>               

            </form><br /><br />
        </div>
    </div>
</section>