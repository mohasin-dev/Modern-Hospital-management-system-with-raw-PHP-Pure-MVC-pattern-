
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">

            <h1 style="color: darkred">Diagnostic Information</h1>
            <a href="index.php?e=diagnostic-view" class="btn btn-info">Diagnostic Info view</a><br><br>

            <?php
            if (isset($_POST['sub'])) {
                $data = array(
                    "name" => $d->VD($_POST['dname']),
                    "amount" => $d->VD($_POST['aname']),
                    "doctorid" => $d->VD($_POST['mid'])
                );
                if ($d->insert("diagnostic", $data)) {
                    echo "Save Successful";
                    //$id = $d->Id;
                    //Redirect("index.php?e=diagnostic-view");
                }
            }
            ?>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="name">Diagnostic Name</label>
                    <input type="text" class="wp-form-control" id="dname" placeholder="Diagnostic Name" name="dname" value="">
                </div>
                <div class="form-group">   
                    <label for="name">Amount</label>
                    <input type="text" class="wp-form-control" id="aname" placeholder="Amount" name="aname" value="">
                </div>
                <div class="form-group">   
                    <label for="name">Doctor Name</label><br>
                    <select name="mid" class="wp-form-control">
                        <?php
                        $sql = $d->view("doctor");
                        print_r($sql);
                        while ($dd = $sql->fetch_object()) {
                            echo " <option value='{$dd->id}'>{$dd->name}</option>";
                        }
                        ?>

                    </select><br><br>
                </div>
                <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-upload"></i><span>Save</span></button>                      
            </form>
        </div>
    </div>
</section>

