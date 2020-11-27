
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <?php
             $d = new Database();
            if (isset($_GET['id'])) {
                $ee = $d->view("specialist", "*", "", array("id" => $_GET['id']));
                $sq = $ee->fetch_object();
            }
            if (isset($_POST['sub'])) {
                $data = array(
                    "name" => $d->VD($_POST['spe'])
                );
                if ($d->update("specialist", $data, array("id" => $_GET['id']))) {
                    Redirect("index.php?e=specialist-view");
                } else {
                    echo $d->Error;
                }
            }
            ?>


            <div class="form-group">
                <form method="post" action="" class="form-group">
                    <h1>input</h1>

                    <label for="exampleInputEmail1">Specialist</label>
                    <input type="text" class="wp-form-control wpcf7-email" name="spe" value="<?php if (isset($_GET['id'])) echo $sq->name ?>" placeholder="Name">
                    </div>
                    <input type="submit" name="sub" value="Update" class="btn btn-success">
                </form>

            </div>

        </div>



</section>
