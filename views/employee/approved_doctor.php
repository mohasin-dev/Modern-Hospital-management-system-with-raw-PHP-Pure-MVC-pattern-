<section id="blogArchive">
    <div class="row">

        <div class="col-sm-12">

            <h1 style='color: darkred; text-align: center'>Approved Doctor's List
                <a class="btn btn-success pull-left" href="index.php?e=approval">Pending Doctor</a> 
                <a class="btn btn-danger pull-right" href="index.php?e=approve_cancle">Unapproved Doctor</a></h1><br><br>


            <?php
            if (isset($_POST['submit'])) {
                $data = array(
                    "status" => "2"
                );

                if ($d->update("doctor", $data, array("id" => $_POST['can_id']))) {
                    //Redirect("index.php?e=generic_view");
                    echo 'The approval is Canceled';
                } else {
                    echo $d->Error;
                }
            }
            ?>

            <?php
// doctor view and load who are unaprroved
            $data = $d->view("doctor", "*", "", ['status' => '1']);
            $_SESSION['approve'] = count($data);
            while ($value = $data->fetch_object()) {
                if ($value->picture) {
                    ?>
                    <div class="col-sm-3">
                        <div class="thumbnail">
                            <img src='images/doctor/pic/<?php echo md5("ab-1" . $value->id . "idb") ?>.<?php echo ($value->picture) ?>' width='300' />
                            <?php
                        } else {
                            echo "<img src='images/doctor/pic/no-image.png' width='300' />";
                        }
                        ?>
                        <div class="caption">
                            <h3><?php echo "<td>{$value->name}</td>"; ?></h3>
                            <p>
                                <?php
                                if ($value->designationid) {
                                    $dataDeg = $d->view("designation", "*", '', ['id' => $value->designationid]);
                                    while ($valueDeg = $dataDeg->fetch_object()) {


                                        echo $valueDeg->name;
                                    }
                                }
                                ?>
                            </p>
                            <p>
                            <form action="" method="post">

                                <input type="hidden" value="<?php echo $value->id; ?>" name="can_id" class="btn btn-primary">

                                <input type="submit" name="submit" value="Cancel " class="btn btn-danger" placeholder="">                              
                            </form>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?> 
        </div>
    </div>
</section>

