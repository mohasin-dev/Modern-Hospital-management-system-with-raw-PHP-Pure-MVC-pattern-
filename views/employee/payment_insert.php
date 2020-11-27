<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <h1 style="color: darkred">Payment Information</h1>
            <a href="index.php?d=payment_view" class="btn btn-info">Payment view</a>
            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="wp-form-control" id="name" placeholder="Payment Method name" name="name" value="">
                </div>
                        <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-envelope"></i><span>Save</span></button>                                  

        </div>
        </form>
    </div>
    </div>
</section>
<?php
$d = new Database();
if (isset($_POST['sub'])) {
    $data = array(
        "name" => $d->VD($_POST['name'])
    );
    if ($d->insert("payment", $data)) {
        $id = $d->Id;
    }
}
?>
