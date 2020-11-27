<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <h1 style="color: darkred">Diagnostic Info Update</h1>
            <a href="index.php?e=diagnostic-view" class="btn btn-info">Diagnostic view</a><br><br>

            <?php
            if (isset($_GET['id'])) {
                $data = $d->view("diagnostic", "*", "", ["id" => $_GET['id']]);
                $value = $data->fetch_object();
            }
            if (isset($_POST['sub'])) {
                $data = array(
                    "name" => $d->VD($_POST['dname']),
                    "amount" => $d->VD($_POST['mname']),
                    "doctorid" => $d->VD($_POST['mid']),
                );

                if ($d->update("diagnostic", $data, array("id" => $_GET['id']))) {
                    //echo "Update Successfull";
                    Redirect("index.php?e=diagnostic-view");
                } else {
                    echo $d->Error;
                }
            }
            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Diagnostic Name</label>
                    <input type="text" class="wp-form-control" id="dname" placeholder="Diagnostic Name" name="dname" value="<?php if (isset($_GET['id'])) echo $value->name; ?>">
                </div>
                <div class="form-group">
                    <label for="name">Amount</label>
                    <input type="text" class="wp-form-control" id="aname" placeholder="Amount" name="mname" value="<?php if (isset($_GET['id'])) echo $value->amount; ?>">
                </div>
                <div class="form-group">
                    <label for="name">Doctor Name</label><br>
                    <select name="mid" class="wp-form-control">
                        <option value="0">Choose Doctor</option>
                        <?php
                        $hd = $d->view("doctor");
                        while ($dd = $hd->fetch_object()) {
                            if ($hd->id = $_GET['id']) {
                                echo "<option selected value='$dd->id'>$dd->name</option>";
                            }
                        }
                        ?>

                    </select><br><br>
                </div>
                <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-upload"></i><span>Update</span></button>              
        </div>
        </form>
    </div>
</div>
</section>