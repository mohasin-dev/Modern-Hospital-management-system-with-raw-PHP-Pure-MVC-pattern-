<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>
<section id="blogArchive">
    <div class="container">
        <div class="col-md-12">
            <h1 style="color: darkred">Patient's Admission Info View</h1>
            <a href="index.php?e=admission" class="btn btn-info">Admission's Informations Insert</a>
            <a href="index.php?e=admission_view" class="btn btn-info">Admission's Informations View</a><br /><br />

            <table class="table table-striped table-hover" border="1px" style="border: 1px solid #970001">
                <tr>
                    <th >Patient name and ID</th>
                    <th>Doctor name</th>                  
                    <th>Seat name</th>
                    <th>Admission Date</th>
                    <th>Relese Date</th>
                    <th>Admission Fees</th>
                    <th>Relative Contact</th>
                    <th>Disease </th>                   
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
                <?php
                $data = $d->view("admission", "*", array("id", "asc"), array("releasedate"=> "0000-00-00 00:00:00"));
                while ($value = $data->fetch_object()) {
                    echo "<tr>";
                    if ($value->patientid) {
                        $allPat = $d->view("patient", "*", '', ['id' => $value->patientid]);
                        while ($row = $allPat->fetch_object()) {
                            ?>
                            <td><?php echo $row->id . " - " . $row->name ?></td>
                            <?php
                        }
                    }
                    //echo "<td>{$value->doctorid}</td>";
                    if ($value->doctorid) {
                        $allDoc = $d->view("doctor", "*", "", ['id' => $value->doctorid]);
                        while ($rows = $allDoc->fetch_object()) {
                            ?>
                            <td><?php echo $rows->name ?></td>
                            <?php
                        }
                    }
                    //echo "<td>{$value->seatid}</td>";
                    if ($value->seatid) {
                        $dataDeg = $d->view("seat", "*", "", ['id' => $value->seatid]);
                        while ($valueDeg = $dataDeg->fetch_object()) {
                            ?>
                            <td>
                                <?php echo $valueDeg->name
                                ?>
                            </td>
                            <?php
                        }
                    }
                    echo "<td>{$value->admissiondate}</td>";
                    echo "<td>{$value->releasedate}</td>";
                    echo "<td>{$value->admissionfees}</td>";
                    echo "<td>{$value->relativecontact}</td>";
                    echo "<td>{$value->disease}</td>";

                    echo "<td><a href='index.php?e=admission_edit&id={$value->id}' class='btn btn-success'>Edit</a></td>";
                    echo "<td><a href='index.php?e=admission_delete&id={$value->id}' class='btn btn-danger'>Delete</a></td>";


                    echo "</tr>";
                }
                ?>


            </table>
        </div>
    </div>
</section>