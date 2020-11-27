<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>

<?php
if (isset($_POST['sub'])) {

    if ($d->delete('doctor', $_GET['id'])) {
        //echo 'delete successful';
        Redirect("index.php?e=doctor_view");
    } else {
        echo 'Opps something wrong!';
    }
}
?>
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">

            <h1 style="color: darkred">Doctor Delete Informations</h1>

            <a href="index.php?e=doctor_view" class="btn btn-info">Doctor's view</a><br />
            <?php
            $color = $d->view('doctor', '*', '', ['id' => $_GET['id']]);
            while ($row = $color->fetch_object()) {
                echo "<h4>Do you want to delete the <b>" . $row->name . "</b>?</h4>";
            }
            ?>
            <br>
            <form action="" role="form"  method="post">

                <input name="doctorid" type="hidden" value="<?php echo $_GET['id'] ?>">
                <button class="btn btn-success" type="button"  name="hudai"><a href="index.php?e=doctor_view">No</a></button>
                <input type="submit" class="btn btn-danger"  name="sub" value="Delete">
            </form><br><br>
        </div>
    </div>
</section>