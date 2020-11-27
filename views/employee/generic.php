<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>

<?php
if (isset($_POST['sub'])) {
    $data = array(
        "name" => $d->VD($_POST['name'])
    );
    if ($d->insert("generic", $data)) {
        $id = $d->Id;
    }
}
?>


<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">

            <h1 style="color: darkred">Medecine's Generic Informations</h1>
            <a href="index.php?e=generic_view" class="btn btn-info">Generic view</a>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Generic name" name="name" value="">
                </div>
                <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-upload"></i><span>Save</span></button>

            </form>
        </div>
    </div>
</div>
</section>