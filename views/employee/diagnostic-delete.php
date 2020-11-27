<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>

<?php
if (isset($_POST['sub'])) {

    if ($d->delete('diagnostic', $_GET['id'])) {
        //echo 'delete successful';
        Redirect("index.php?e=diagnostic-view");
    } else {
        echo 'Opps something wrong!';
    }
}
?>
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">

            <h1 style="color: darkred">Diagnostic Delete Informations</h1>

            <a href="index.php?e=diagnostic-view" class="btn btn-info">Diagnostic view</a><br />
            <?php
            $color = $d->view('diagnostic', '*', '', ['id' => $_GET['id']]);
            while ($row = $color->fetch_object()) {
                echo "<h4>Do you want to delete the diagnostic <b>" . $row->name . "</b>?</h4>";
            }
            ?>
            <br>
            <form action="" role="form"  method="post">

                <input name="diagnosticid" type="hidden" value="<?php echo $_GET['id'] ?>">
                <button class="btn btn-success" type="button"  name="hudai"><a href="index.php?e=generic_view">No</a></button>
                <input type="submit" class="btn btn-danger"  name="sub" value="delete">
            </form><br><br>

        </div>
    </div>
</section>