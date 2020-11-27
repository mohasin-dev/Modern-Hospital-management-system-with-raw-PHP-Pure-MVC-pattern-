<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>
<?php
if (isset($_POST['sub'])) {
//    $cal_date = $_POST['dname'];
//    //echo $cal_date;
//    //die();
//    $date = date('Y-m-d', strtotime($cal_date));
    $data = array(
        "title" => $d->VD($_POST['title']),
        "amount" => $d->VD($_POST['amount']),
        "date" => $d->VD($_POST['dname']),
    );
    // print_r($data);
    //die();
    if ($d->insert("expense", $data)) {
        echo "Save Successfull";
    } else {
        echo $d->Error;
    }
}
?>
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">

            <h1 style="color: darkred">Hospital's Expenses Insert</h1>
            <a href="index.php?e=expense_view" class="btn btn-info">Expense view</a>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Expense issue" name="title" value="">
                </div>
                <div class="form-group">
                    <label for="name">Amount</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Amount" name="amount" value="">
                </div>
                <div class="form-group">
                    <label for="name">Date</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="datepicker" placeholder="" name="dname" value="">
                </div>
                <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-upload"></i><span>Save</span></button>
        </div>
        </form>
    </div>
</div>
</section>