
<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>

<?php
if (isset($_POST['sub'])) {

    if ($d->delete("admission", $_GET['id'])) {
        //echo "delete successful";
        Redirect("index.php?e=admission_view");
    } else {
        echo "Opss something wrong!";
    }
}
?>

<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">



            <h1 style="color: darkred">Admission's Info Delete Confermation Message</h1>

            <a href="index.php?e=admission_view" class="btn btn-info">Patient's admission info view</a><br />
            <?php
            $adm = $d->view('admission', '*', '', ['id' => $_GET['id']]);
            while ($row = $adm->fetch_object()) {
                if ($row->patientid) {
                    $allpat = $d->view('patient', '*', '', ['id' => $row->patientid]);
                    while ($pat = $allpat->fetch_object()) {
                        echo "<h4>Do you want to delete the admission info of patient <b>" . $pat->name . "</b>?</h4>";
                    }
                }
            }
            ?>
            <br>
            <form action="" role="form"  method="post">
                <input name="admissionid" type="hidden" value="<?php echo $_GET['id'] ?>">
                <button class="btn btn-success" type="button"  name="hudai"><a href="index.php?e=admission_view">No</a></button>
                <input type="submit" class="btn btn-danger"  name="sub" value="delete">


            </form>

        </div>
    </div>
</section>
