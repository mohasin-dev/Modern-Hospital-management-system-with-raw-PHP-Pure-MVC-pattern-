<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <h1 style="color: darkred">Ambulance Charge List</h1>
            <a href="index.php?e=ambulancecharge-view" class="btn btn-info">Ambulance Charge view</a>
            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="name">Customer Name</label>
                    <input type="text" class="wp-form-control" id="name" placeholder="Customer Name" name="name" value="">
                </div>
                <div class="form-group">
                    <label for="name">Date</label>
                    <input type="date" class="wp-form-control" id="date"  name="date" value="">
                </div>
                <div class="form-group">
                    <label for="name">Amount</label>
                    <input type="text" class="wp-form-control" id="amount" placeholder="Amount" name="amount" value="">
                </div>
                <div class="form-group">
                    <label for="name">Contact Number</label>
                    <input type="text" class="wp-form-control" id="phone" placeholder="Phone" name="phone" value="">
                </div>
                <div class="form-group">
                    <label for="name">Ambulance Contact</label>



                    <select name="ambid" class="wp-form-control">
                        <option value="0">Choose Ambulance Type</option>

                        <?php
                        $d = new Database();
                        $allamb = $d->view("ambulance");
                        while ($ambcharge = $allamb->fetch_object()) {

                            echo "<option value='$ambcharge->id'>$ambcharge->contactnumber</option>";
                        }
                        ?>

                    </select>
                </div>

                <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-envelope"></i><span>Save</span></button>                

        </div>
        </form>
    </div>
</div>
</section>
<?php
if (isset($_POST['sub'])) {
    $cal_date = $_POST['date'];
    $date = date('Y-m-d H:i:s', strtotime($cal_date));
    $data = array(
        "name" => $d->VD($_POST['name']),
        "amount" => $d->VD($_POST['amount']),
        "contact" => $d->VD($_POST['phone']),
        "ambulanceid" => $d->VD($_POST['ambid']),
        "date" => $d->VD($date)
    );
    if ($d->insert("ambulencecharge", $data)) {
        $id = $d->Id;
    }
}
?>







<!--$d = new Database();
if (isset($_POST['sub'])) {
$cal_date = $_POST['date'];
$date = date('Y-m-d', strtotime($cal_date));
$data = array(
"title" => $d->VD($_POST['title']),
"amount" => $d->VD($_POST['amount']),
"date" => $d->VD($date)
);
// print_r($data);
//die();
if ($d->insert("expense", $data)) {
echo "Save Successfull";
} else {
echo $d->Error;
}
}-->
