
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">

            <div class="form-group">
                <form method="post" action="" class="form-group">
                    <h1>Add Installment</h1>


                    <?php
                    if (isset($_POST['sub'])) {
                        $cal_date = $_POST['date'];
                        $date = date('y-m-d', strtotime($cal_date));
                        $data = array(
                            "admissionid" => $d->VD($_POST['admid']),
                            "paymentid" => $d->VD($_POST['payid']),
                            "date" => $d->VD($date),
                            "employeeid" => $d->VD($_POST['empid']),
                            "amount" => $d->VD($_POST['amt'])
                        );

                        if ($d->insert("installment", $data)) {

                            echo "Save Successfully";
                        } else {
                            echo $d->Error;
                        }
                    }
                    ?>
                    <label for="exampleInputEmail1">Admission ID</label>

                    <select name="admid" class="wp-form-control wpcf7-email">
                        <option>Choose Admission ID</option>

                        <?php
                        $allAdm = $d->view("admission", "*", array("id", "asc"));
                        while ($des = $allAdm->fetch_object()) {
                            if (isset($_POST['admid']) && $_POST['admid'] == $des->id) {
                                echo "<option selected value='$des->id'>$des->id</option> ";
                            } else {
                                echo "<option value='$des->id'>$des->id</option> ";
                            }
                        }
                        ?>

                    </select><br><br>
                    <label for="exampleInputEmail1">Date</label>
                    <input type="text"  name="date" id="datepicker" placeholder="Date" class="wp-form-control wpcf7-email">
                    <label for="exampleInputEmail1">Amount</label>
                    <input type="text"  name="amt" id="exampleInputEmail1" class="wp-form-control wpcf7-email" placeholder="Amount">
                    <label for="exampleInputEmail1">Payment</label>

                    <select name="payid" class="wp-form-control wpcf7-email">
                        <option>Choose Payment</option>

                        <?php
                        $allPay = $d->view("payment", "*", array("name", "asc"));
                        while ($des = $allPay->fetch_object()) {
                            if (isset($_POST['payid']) && $_POST['payid'] == $des->id) {
                                echo "<option selected value='$des->id'>$des->name</option> ";
                            } else {
                                echo "<option value='$des->id'>$des->name</option> ";
                            }
                        }
                        ?>

                    </select><br><br>
                    <label for="exampleInputEmail1">Employee</label>

                    <select name="empid" class="wp-form-control wpcf7-email">
                        <option>Choose Employee</option>

                        <?php
                        $allEmp = $d->view("employee", "*",  array("id", "asc"));
                        while ($des = $allEmp->fetch_object()) {
                            if (isset($_POST['empid']) && $_POST['empid'] == $des->id) {
                                echo "<option selected value='$des->id'>$des->name</option> ";
                            } else {
                                echo "<option value='$des->id'>$des->name</option> ";
                            }
                        }
                        ?>

                    </select><br><br>
            

            <input type="submit" name="sub" value="Post" class="btn btn-success">
            <a href="index.php?e=installment-view" class="btn btn-info">view</a>
            </form>

        </div>

    </div>

    </div>

</section>
