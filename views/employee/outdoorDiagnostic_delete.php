<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>

<?php
if (isset($_POST['sub'])) {

    if ($d->delete('outdoordiagnostic', $_GET['id'])) {
        //echo 'delete';
        Redirect("index.php?e=outdoordiagnostic_view");
    } else {
        echo 'Oops something wrong!';
    }
}
?>
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">

            <h1 style="color: darkred">Outdoor Diagnostic Delete Info</h1>

            <a href="index.php?e=generic_view" class="btn btn-info">Outdoor Diagnostic Info view</a><br />
            <?php
            $outdiag = $d->view('outdoordiagnostic', '*', '', ['id' => $_GET['id']]);
            while ($row = $outdiag->fetch_object()) {
                if ($row->patientid) {
                    $alldiag = $d->view('patient', '*', '', ['id' => $row->patientid]);
                    while ($diag = $alldiag->fetch_object()) {
                        echo "<h4>Do you want to delete the outdoor diagnostic info of patient <b>" . $diag->name . "</b>?</h4>";
                    }
                }
            }
            ?>
            <br>
            <form action="" role="form"  method="post">

                <input name="genericid" type="hidden" value="<?php echo $_GET['id'] ?>">
                <button class="btn btn-success" type="button"  name="hudai"><a href="index.php?e=diagnostic-view">No</a></button>
                <input type="submit" class="btn btn-danger"  name="sub" value="Delete">


            </form>

        </div>
    </div>
</section>
