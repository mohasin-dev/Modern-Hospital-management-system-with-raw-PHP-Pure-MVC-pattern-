<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>

<section id="blogArchive">
    <div class="container">
        <div class="col-md-8">

            <h1 style="color: darkred">Admission Form</h1>
            <a href="index.php?e=admission_view" class="btn btn-info">Employees informations view</a>

            <?php
            if (isset($_POST['sub'])) {

                $data = array(
                    "name" => $d->VD($_POST['name']),
                    "doctorid" => $d->VD($_POST['docid']),
                    "starttime" => $d->VD($_POST['stime']),
                    "endtime" => $d->VD($_POST['etime'])
                );

                if ($d->insert("visitingdays", $data)) {

                    echo "Save Successfully";
                } else {
                    echo $d->Error;
                }
            }
            ?>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="wp-form-control wpcf7-text" placeholder="Visiting Days" name="name" value="">
                </div>
                <div class="form-group">
                    <label for="docid">Doctor Name</label>
                    <select name="docid" class="wp-form-control wpcf7-text">
                        <option value="0">Chose doctorid</option>
                        <?php
                        $doc = $d->view("doctor", "*", array("name", "asc"));
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
                    <label for="name">Start Time</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="datepicker3" placeholder="Start Time" name="stime" value="">
                </div>
                <div class="form-group">
                    <label for="name">End Time</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="datepicker4" placeholder="End Time" name="etime" value="">
                </div>




                <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-save"></i><span>Submit</span></button>               

            </form><br /><br />
        </div>
    </div>
</section>


<link >
<script>
    $('#datepicker3').timepicker();
    $('#datepicker4').timepicker();
</script>

