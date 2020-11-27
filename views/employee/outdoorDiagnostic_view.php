<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">



            <h1 style="color: darkred">Outdoor Dianostic Info view</h1>
            <a href="index.php?e=outdoordiagnostic" class="btn btn-info">Add New Outdoor Diagnostic Info</a>
            <a href="index.php?e=outdoordiagnostic_view" class="btn btn-info">Outdoor Diagnostic  View</a>
            <br /><br />
            <table class="table table-striped table-hover" border="1px" style="border: 1px solid #970001">
                <tr>
                    <th>Patientid</th>
                    <th>Diagnosticid</th>
                    <th>Amount</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                $data = $d->view("outdoordiagnostic", "*");
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

                    if ($value->diagnosticid) {
                        $allDia = $d->view("diagnostic", "*", "", ['id' => $value->diagnosticid]);
                        while ($rows = $allDia->fetch_object()) {
                            ?>
                            <td><?php echo $rows->name ?></td>
                            <?php
                        }
                    }
                    echo "<td>{$value->amount}</td>";
                    echo "<td><a href='index.php?e=outdoordiagnostic_update&id={$value->id}' class='btn btn-danger'>Edit</a></td>";
                    echo "<td><a href='index.php?e=outdoordiagnostic_delete&id={$value->id}' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>


            </table>

        </div>
    </div>
</section>