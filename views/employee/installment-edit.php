<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <?php
            $d = new Database();
            if (isset($_GET['id'])) {
                $ee = $d->view("installment", "*", "", array("id" => $_GET['id']));
                $sq = $ee->fetch_object();
                $admissionid = $sq->admissionid;
                $paymentid = $sq->paymentid;
                $employeeid = $sq->employeeid;
                
            }
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
           
                if ($d->update("installment", $data, array("id" => $_GET['id']))) {
                    
               
                    Redirect("index.php?e=installment-view");
                } else {
                    echo $d->Error;
                }
            }
            ?>


            <div class="form-group">
                <form method="post" action="" class="form-group">
                    <h1>input</h1>

                    <label for="exampleInputEmail1">Admissionid</label>

                    <select name="admid" class="wp-form-control wpcf7-email">
                        <option value="0">bb</option>

                        <?php
                        $allAdm = $d->view("admission", "*", array("id", "asc"));
                        while ($des = $allAdm->fetch_object()) {
                            
                            if (isset($admissionid) && $admissionid == $des->id) {
                                echo "<option selected value='$des->id'>$des->disease</option> ";
                            } else {
                                echo "<option value='$des->id'>$des->disease</option> ";
                            }
                        }
                        ?>

                    </select><br><br>
                    
                    <label for="exampleInputEmail1">Date</label>
                    <input type="text" class="wp-form-control wpcf7-email" name="date" id="datepicker" value="<?php if (isset($_GET['id'])) echo $sq->date ?>"  placeholder="Amount">
                    <label for="exampleInputEmail1">Amount</label>
                    <input type="text" class="wp-form-control wpcf7-email" name="amt" value="<?php if (isset($_GET['id'])) echo $sq->amount ?>"  placeholder="Amount">
                    <label for="exampleInputEmail1">Payment</label>

                    <select name="payid" class="wp-form-control wpcf7-email">
                        <option>bb</option>

                        <?php
                        $allPay = $d->view("payment", "*", array("name", "asc"));
                        while ($des = $allPay->fetch_object()) {
                            if (isset($paymentid) && $paymentid == $des->id) {
                                echo "<option selected value='$des->id'>$des->name</option> ";
                            } else {
                                echo "<option value='$des->id'>$des->name</option> ";
                            }
                        }
                        ?>

                    </select><br><br>
                    <label for="exampleInputEmail1">Employee</label>

                    <select name="empid" class="wp-form-control wpcf7-email">
                        <option>bb</option>

                        <?php
                        $allEmp = $d->view("employee", "*", array("id", "asc"));
                        while ($des = $allEmp->fetch_object()) {
                            if (isset($employeeid) && $employeeid == $des->id) {
                                echo "<option selected value='$des->id'>$des->name</option> ";
                            } else {
                                echo "<option value='$des->id'>$des->name</option> ";
                            }
                        }
                        ?>

                    </select><br><br>

                    <input type="submit" name="sub" value="Update" class="btn btn-success">
                </form>

            </div>

        </div>
    </div>


</section>
