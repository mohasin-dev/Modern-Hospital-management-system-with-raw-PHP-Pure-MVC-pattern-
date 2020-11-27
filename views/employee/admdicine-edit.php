<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <?php
            $d = new Database();
            if (isset($_GET['id'])) {
                $ee = $d->view("admedicine", "*", "", array("id" => $_GET['id']));
                $sq = $ee->fetch_object();
                $admissionid = $sq->admissionid;
                $medicineid = $sq->medicineid;
            }
            if (isset($_POST['sub'])) {

                $data = array(
                    "admissionid" => $d->VD($_POST['admid']),
                    "quantity" => $d->VD($_POST['quty']),
                    "medicineid" => $d->VD($_POST['medid'])
                );

                if ($d->update("admedicine", $data, array("id" => $_GET['id']))) {


                    Redirect("index.php?e=admdicine-view");
                } else {
                    echo $d->Error;
                }
            }
            ?>

            <div class="form-group">
                <form method="post" action="" class="form-group">
                    <h1>input</h1>



                    <label for="exampleInputEmail1">Admissionid</label>

                    <select name="admid" class="wp-form-control wpcf7-email">
                        <option>bb</option>

                        <?php
                        $allAdm = $d->view("admission", "*", array("id", "asc"));
                        while ($des = $allAdm->fetch_object()) {
                            if (isset($admissionid) && $admissionid == $des->id) {
                                echo "<option selected value='$des->id'>$des->disease</option> ";
                            } else {
                                echo "<option value='$des->id'>$des->disease</option> ";
                            }
                        }
                        ?>

                    </select><br><br>


                    <label for="exampleInputEmail1">Payment</label>

                    <select name="medid" class="wp-form-control wpcf7-email">
                        <option>bb</option>

                        <?php
                        $allMed = $d->view("medicine", "*", array("name", "asc"));
                        while ($des = $allMed->fetch_object()) {
                            if (isset($medicineid) && $medicineid == $des->id) {
                                echo "<option selected value='$des->id'>$des->name</option> ";
                            } else {
                                echo "<option value='$des->id'>$des->name</option> ";
                            }
                        }
                        ?>

                    </select><br><br>
                    <label for="exampleInputEmail1">Quantity</label>
                    <input type="text"class="wp-form-control wpcf7-email" name="quty" id="exampleInputEmail1" placeholder="quentity"><br>


                    <input type="submit" name="sub" value="Post" class="btn btn-success">
                    <a href="index.php?e=admdicine-view" class="btn btn-info">view</a>


                </form>
            </div>

        </div>
    </div>


</section>
