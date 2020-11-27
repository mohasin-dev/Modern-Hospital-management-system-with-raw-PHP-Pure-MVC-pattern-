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
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    
                    <th>Apointment Time</th>
                    <th>Apointment Date</th>
                    <th>Apointment Time Start</th>
                    <th>Apointment Time Over</th>
                </tr>
                <?php
                $doctorid = 2;
                $table = "apointment, doctor, patient, visitingdays";
                $order = array("apointment.ap_date", "desc");
                $where = array("doctor.id" => $doctorid);
                $select = "apointment.id, apointment.slot, apointment.ap_date, visitingdays.starttime, visitingdays.endtime, patient.name, doctor.name dname";
                $rel = array(
                    "apointment.doctorid" => "doctor.id",
                    "apointment.patientid" => "patient.id",
                    "doctor.id" => "visitingdays.doctorid"
                );
                $data = $d->viewTwoTable($table, $order, $where, $select, $rel);

                while ($value = $data->fetch_object()) {
                    $start = $d->minutes($value->starttime);
                    $end = $d->minutes($value->endtime);
                    $time = explode(':', $value->starttime);
                    
                    $hour = $time[0];
                    $total = ($end - $start);
                    $html = "";
                    $c = 1;
                    for ($i = 0; $i < $total; $i+=20) {
                        if ($hour > 12) {
                            $ap = "PM";
                        } else {
                            $ap = "AM";
                        }

                        if ($i == $value->slot) {
                            $html .= "<div class='schedule active' id='$i'>" . ($hour % 12) . ":" . ($i % 60) . "$ap-" . ($hour % 12) . ":" . (($i + 19) % 60) . "$ap</div>";
                        }
                    }

                    echo "<tr>";
                    echo "<td>{$value->id} {$value->name}</td>";
                    echo "<td>{$value->dname}</td>";
                    echo "<td>{$html}</td>";
                    echo "<td>{$value->ap_date}</td>";
                    echo "<td>{$value->starttime}</td>";
                    echo "<td>{$value->endtime}</td>";

                    echo "</tr>";
                }
                ?>


            </table>

        </div>
    </div>
</section>

<style>
    .schedule{
        float: left;
        padding: 5px 10px;
        margin: 0 10px 10px 0;
        background-color: green;
        color: #FFF;
        cursor: pointer;
    }
</style>