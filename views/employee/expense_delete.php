<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>
<?php
if (isset($_POST['sub'])) {

    if ($d->delete('expense', $_GET['id'])) {
        //echo 'delete successful';
        Redirect("index.php?e=expense_view");
    } else {
        echo 'Opps something wrong!';
    }
}
?>
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">

            <h1 style="color: darkred">Hospital's Expenses Insert</h1>
            <a href="index.php?e=expense_view" class="btn btn-info">Expense view</a>
            <?php
            $data = $d->view("expense", "*", '', ['id' => $_GET['id']]);
            while ($value = $data->fetch_object()) {
                echo "<h4>Do you want to delete the expense of <b>" . $value->title . "</b>?</h4>";
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <input name="expenseid" type="hidden" value="<?php echo $_GET['id'] ?>">
                <button class="btn btn-success" type="button"  name="hudai"><a href="index.php?e=expense_view">No</a></button>
                <input type="submit" name="sub" class="btn btn-danger" value="Delete" />

            </form>
        </div>
    </div>
</div>
</section>