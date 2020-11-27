<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <h1 style="color: darkred">Ambulance Charge Update</h1>


            <?php
            $d = new Database();
            if (isset($_GET['id'])) {
                $data = $d->view("ambulencecharge", array("id", "asc"), ["id" => $_GET['id']]);
                $value = $data->fetch_object();
            }
//                    if (isset($_POST['sub'])){
//                    $cal_date = $_POST['date'];
//                    $date = date('Y-m-d', strtotime($cal_date));
//                    echo $date;} //gives date as 2012-08-17

            if (isset($_POST['sub'])) {
                $cal_date = $_POST['date'];
                $date = date('Y-m-d H:i:s', strtotime($cal_date));
                $data = array(
                    "name" => $d->VD($_POST['abcname']),
                    "date" => $d->VD($date),
                    "amount" => $d->VD($_POST['amount']),
                    "contact" => $d->VD($_POST['con']),
                    "ambulanceid " => $d->VD($_POST['ambid'])
                );
                // print_r($data);
                //die();
                if ($d->update("ambulencecharge", $data, array("id" => $_GET['id']))) {
                    echo "Update Successfull";
                    Redirect("index.php?d=ambulancecharge-view");
                } else {
                    echo $d->Error;
                }
            }
            ?>
 
           
            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="name">Customer Name</label>
                    <input type="text" class="wp-form-control" id="name" placeholder="Customer Name" name="abcname" value="<?php if (isset($_GET['id'])) echo $value->name; ?>">
                </div>
                <div class="form-group">
                    <label for="name">Date</label>
                    <input type="datetime" class="wp-form-control" id="date"  name="date" value="<?php if (isset($_GET['id'])) echo $value->date; ?>">
                </div>
                <div class="form-group">
                    <label for="name">Amount</label>
                    <input type="text" class="wp-form-control" id="amount" placeholder="Amount" name="amount" value="<?php if (isset($_GET['id'])) echo $value->amount; ?>">
                </div>
                <div class="form-group">
                    <label for="name">Contact Number</label>
                    <input type="text" class="wp-form-control" id="phone" placeholder="Phone" name="con" value="<?php if (isset($_GET['id'])) echo $value->contact; ?>">
                </div>
                <div class="form-group">
                    <label for="name">Ambulance Type</label>

                    <select name="ambid" class="wp-form-control">
                        <option value="0">Choose Ambulance Type</option>

                        <?php
                        $allamb = $d->view("ambulance");
                        while ($ambcharge = $allamb->fetch_object()) {

                            if ($allamb->id = $_GET['id']) {
                                echo "<option selected value='$ambcharge->id'>$ambcharge->contactnumber</option>";
                            }
                        }
                        ?>

                    </select>
                </div>

                <input type="submit" name="sub" value="Update" class="btn btn-success">
                <a href="index.php?d=ambulancecharge-view" class="btn btn-info" >Cancel</a>
        </div>
        </form>
    </div>
</div>
</section>