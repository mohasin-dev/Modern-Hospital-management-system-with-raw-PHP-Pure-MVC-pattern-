<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">

         

       
            <br /><br /><br />
            <table class="table table-striped table-hover" border="1px" style="border: 1px solid #970001">
                <tr>
                    <th>patient Name</th>
                    <th>Doctor Name</th>
                    <th>Slot</th>
                    <th>apointment Date</th>
                    <th>apointment Time</th>
                </tr>
                <?php
                
               $id = $_SESSION['id'];
                $data = $d->view("apointment", "*", "", array("id"=>$id));
               
                while ($value = $data->fetch_object()) {
                    echo "<tr>";
                    echo "<td>{$value->patientid}</td>";
                    echo "<td>{$value->doctorid}</td>";
                    echo "<td>{$value->slot}</td>";
                    echo "<td>{$value->ap_date}</td>";

                    echo "</tr>";
                }
                ?>


            </table>

        </div>
    </div>
</section>