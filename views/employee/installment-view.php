<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <?php
            $d = new Database();
            if (isset($_GET['id'])) {
                $d->delete("installment", $_GET['id']);
            }
            ?>
            <h1>view</h1>
            <a href="index.php?e=installment" class="btn btn-danger">Insert</a>
            <a href="index.php?e=installment-view" class="btn btn-info">View</a>
            <br><br>
            <table border="1" class="table table-striped table-hover">

                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>paymentid</th>
                    <th>admissionid</th>
                    <th>employeeid</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
//                $data = $d->view("installment");
//                while ($value = $data->fetch_object()) {
//                    echo "<tr>";
//                    echo "<td>{$value->	date}</td>";
//                     echo "<td>{$value->amount}</td>";
//                      echo "<td>{$value->paymentid}</td>";
//                        echo "<td>{$value->employeeid}</td>";
//                     echo "<td>{$value->admissionid}</td>";
//                   
//                    
//                    
//                    echo "<td><a href='index.php?f=installment-edit&id={$value->id}' class='btn btn-info'>Edit</a></td>";
//                    echo "<td><a href='index.php?f=installment-view&id={$value->id}' class='btn btn-danger'>Delete</a></td>";
//                    echo "</tr>";
                $table = "installment, payment, admission, employee";
                $sel = "installment.id, payment.name pname, admission.admissionfees, installment.date,installment.amount,admission.disease,employee.name ename ";

                $where = array(
                    "installment.admissionid" => "admission.id",
                    "installment.paymentid" => "payment.id",
                    "installment.employeeid" => "employee.id"
                );
                $order = array("installment.id", "desc");


                $data = $d->view($table, $sel, $order, $where);

                while ($value = $data->fetch_object()) {
                    echo "<tr>";
                    echo "<td>{$value->date}</td>";
                    echo "<td>{$value->amount}</td>";
                    echo "<td>{$value->pname}</td>";
                    echo "<td>{$value->disease}</td>";
                    echo "<td>{$value->ename}</td>";
                    
                      echo "<td><a href='index.php?e=installment-edit&id={$value->id}' class='btn btn-info'>Edit</a></td>";
                  echo "<td><a href='index.php?e=installment-view&id={$value->id}' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>

            </table>
        </div>
    </div>
</section>