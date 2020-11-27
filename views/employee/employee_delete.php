
<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>

<?php
if (isset($_POST['sub'])) {

    if ($d->delete("employee", $_GET['id'])) {
        echo "delete";
        Redirect("index.php?e=employee_view");
    } else {
        echo "delete hoy nai";
    }
}
?>

<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">

            <h1 style="color: darkred">Medecine's Employee Delete Informations</h1>

            <a href="index.php?e=generic_view" class="btn btn-info">Generic view</a><br />
            <?php
            $color = $d->view('employee', '*', '', ['id' => $_GET['id']]);
            while ($row = $color->fetch_object()) {
                echo "<h4>Do you want to delete the employee <b>" . $row->name . "</b>?</h4>";
            }
            ?>
            <br>
            <form action="" role="form"  method="post">

                <input name="genericid" type="hidden" value="<?php echo $_GET['id'] ?>">
                <button class="btn btn-success" type="button"  name="hudai"><a href="index.php?e=employee_view">No</a></button>
                <input type="submit" class="btn btn-danger"  name="sub" value="delete">


            </form><br><br>

        </div>
    </div>
</section>
