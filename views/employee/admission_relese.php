<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <h1 style="color: darkred">Admission's Informations View</h1>
            <a href="index.php?e=admission" class="btn btn-info">Admission's Informations Insert</a>
            <a href="index.php?e=admission_view" class="btn btn-info">Admission's Informations View</a>
            <br /><br /><br />

            <table class="table table-striped table-hover" border="1px" style="border: 1px solid #970001">
                <tr>
                    <th >Admission ID</th>
                    <th>Patient Name</th>
                    <th>Doctor name</th>                    
                    <th>Admission Date</th>                   
                    <th>Admission Fees</th>
                    <th>Seat rent</th>
                    <th>Doctor Fees</th>
                    <th>Medicine Fees</th>
                    <th>Diagnostic Fees</th>

                </tr>
                <?php
                $data = $d->view("admission", "*");
                while ($value = $data->fetch_object()) {
                    echo "<tr>";
                    echo "<td>{$value->id}</td>";

                    if ($value->patientid) {
                        $allPat = $d->view("patient", "*", '', ['id' => $value->patientid]);
                        while ($row = $allPat->fetch_object()) {
                            ?>
                            <td><?php echo $row->name ?></td>
                            <?php
                        }
                    }

                    if ($value->doctorid) {
                        $allDoc = $d->view("doctor", "*", '', ['id' => $value->doctorid]);
                        while ($row = $allDoc->fetch_object()) {
                            ?>
                            <td><?php echo $row->name ?></td>
                            <?php
                        }
                    }
                    echo "<td>{$value->admissiondate}</td>";
                    echo "<td>{$value->admissionfees}</td>";

                    if ($value->seatid) {
                        $dataDeg = $d->view("seat", "*", "", ['id' => $value->seatid]);
                        while ($valueDeg = $dataDeg->fetch_object()) {
                            ?>
                            <td>
                                <?php echo $valueDeg->amount
                                ?>
                            </td>
                            <?php
                        }
                    }

                    echo "<td>1000</td>";


                    $alladmedicine = $d->view("admedicinefees");
                    while ($admedi = $alladmedicine->fetch_object()) {
                        ?><td>
                            <?php
                            echo $admedi->price;
                            
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $admedi->amount;
                           
                            ?>
                        </td>
                        <?php
                    }




                    echo "</tr>";
                }
                ?>


            </table>
        </div>
    </div>
</section>