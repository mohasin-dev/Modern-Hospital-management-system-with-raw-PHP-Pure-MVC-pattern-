<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <?php
            $d = new Database();
            if (isset($_GET['id'])) {
                $data = $d->view("ambulance","" ,array("id", "asc"), ["id" => $_GET['id']]);
                $value = $data->fetch_object();
            }

            if (isset($_POST['sub'])) {
                $data = array(
                    "contactnumber" => $d->VD($_POST['con']),
                    "type" => $d->VD($_POST['type']),
                    "distance" => $d->VD($_POST['dis']),
                    "fees" => $d->VD($_POST['abf']),
                    "minimumfees" => $d->VD($_POST['abmf'])
                );
                if ($d->update("ambulance", $data, array("id" => $_GET['id']))) {
                    echo "Update Successfull";
                    redirect("index.php?d=ambulance-view");
                } else {
                    echo $d->Error;
                }
            }
            ?>
            <div class="form-group">

                <h1  style="color: darkred">Update Ambulance Charge</h1>
                <form method="post" action="" class="form-group">
                    <div class="wp-form-group">
                        <label for="con">Contact</label>
                        <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Mobile/Phone Number" name="con" value="<?php if(isset($_GET['id'])) echo $value->contactnumber; ?>" required="">
                    </div>
                    <label for="cata">Ambulance Cetagory</label>
                    <div class="wp-form-control wpcf7-text">
                        
                        <input type="radio" id="name" name="type" value="1"> AC
                        <input type="radio" id="name" name="type" value="2"> Non-AC
                    </div>

                    <div>
                        <label for="dista">Distance</label>
                        <input type="text" class="wp-form-control wpcf7-text" id="name" name="dis" value="<?php if(isset($_GET['id'])) echo $value->distance; ?>" required="">
                    </div>
                    <div>
                        <label for="fees">Ambulace Fees</label>
                        <input type="text" class="wp-form-control wpcf7-text" id="name" name="abf" value="<?php if(isset($_GET['id'])) echo $value->fees; ?>" required="">
                    </div>
                    <label for="min-fes">Minimum Fees</label>
                    <select name="abmf" required="" class="wp-form-control wpcf7-text">
                        <option value="0">Choose Minimum Fees</option>
                         <?php
                        $allamb = $d->view("ambulance");
                        while ($ambcharge = $allamb->fetch_object()) {

                            if ($allamb->id = $_GET['id']) {
                                echo "<option selected value='$ambcharge->id'>$ambcharge->minimumfees</option>";
                            }
                        }
                        ?>
                    </select>
            </div>
            <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-envelope"></i><span>Update</span></button>

            </form>
        </div> 

    </div>
</section>