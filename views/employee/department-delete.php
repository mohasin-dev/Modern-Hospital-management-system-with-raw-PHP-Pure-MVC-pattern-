<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>


<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <?php
            if (isset($_POST['sub'])) {

                if ($d->delete('department', $_GET['id'])) {
                    //echo 'delete successful';
                    Redirect("index.php?e=department-view");
                } else {
                    echo 'Opps something wrong!';
                }
            }
            ?>

            <h1 style="color: darkred">Department Informations</h1>

            <a href="index.php?e=department-view" class="btn btn-info">Department view</a><br />
            <?php
            $color = $d->view('department', '*', '', ['id' => $_GET['id']]);
            while ($row = $color->fetch_object()) {
                echo "<h4>Do you want to delete the department <b>" . $row->name . "</b>?</h4>";
            }
            ?>
            <br>
            <form action="" role="form"  method="post">

                <input name="departmentid" type="hidden" value="<?php echo $_GET['id'] ?>">
                <button class="btn btn-success" type="button"  name="hudai"><a href="index.php?e=generic_view">No</a></button>
                <input type="submit" class="btn btn-danger"  name="sub" value="delete">


            </form><br><br>

        </div>
    </div>
</section>