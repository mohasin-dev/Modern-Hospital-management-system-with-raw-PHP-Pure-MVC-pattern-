<?php

if (isset($_GET['fdate']) && isset($_GET['tdate'])) {
    require '../models/database.php';
    $d = new Database();

    
    $command = "SELECT * FROM `admission` WHERE releasedate BETWEEN '{$_GET['fdate']}' and '{$_GET['tdate']}'";
//   echo $command;
//    die();
    $test = $d->query($command);
    if ($test->num_rows > 0) {
        
        while ($value = $test->fetch_object()) {
            echo"<tr class= 'mm'>";
// print_r($row['name']);
            echo"<td>" . $value->patientid . "</td>";
            echo"<td>" . $value->seatid . "</td>";
            echo"<td>" . $value->doctorid . "</td>";
            echo"<td>" . $value->seatid . "</td>";
            echo"<td>" . $value->admissiondate . "</td>";
            echo"<td>" . $value->releasedate . "</td>";
            echo"<td>" . $value->doctorid . "</td>";
            echo"<td>" . $value->doctorid . "</td>";
            echo"<td>" . $value->doctorid . "</td>";
            echo"<td>" . $value->doctorid . "</td>";

            echo"</tr>";
            
        }
    } else {
        echo"Data is not found";
    }
} else {
    echo 0;
}


