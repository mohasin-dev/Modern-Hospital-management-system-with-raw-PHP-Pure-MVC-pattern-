<?php
$d = new Database();
if (isset($_POST['sub'])) {
    $data = array(
        "name" => $d->VD($_POST['spe']),
        "amount" => $d->VD($_POST['amt'])
    );
    if ($d->insert("seat", $data)) {
        //echo "Save Successfully";
        Redirect("index.php?e=seat-view");
    } else {
        echo $d->Error;
    }
}
?>

<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <br><br><a href="index.php?e=seat-view" class="btn btn-info">Seat View</a><br><br>

            <form method="post" action="" class="form-group">
                <div class="form-group">
                    <label for="exampleInputEmail1">Seat</label>
                    <input type="text"class="wp-form-control wpcf7-email" name="spe" id="exampleInputEmail1" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Amount</label>
                    <input type="text" class="wp-form-control wpcf7-email" name="amt" id="exampleInputEmail1" placeholder="Amount">
                </div>

                <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-upload"></i><span>Save</span></button>

            </form>
        </div>
    </div>
</section>
