

//if (isset($_GET['fdate'])) {
//    require '../models/database.php';
//    $d = new Database();
//    $where = "";
//    



/*
  if ($value->fromdate != "" || $value->todate != "") {

  if ($value->fromdate != "" && $value->todate != "") {
  $where .= " and admission.admissiondate >='" . $value->fromdate . " 00:00:00' and sales.date <='" . $value->todate . " 23:59:59'";
  } else if ($value->fromdate != "") {
  $where .= " and sales.date >='" . $value->fromdate . " 00:00:00' and sales.date <='" . $value->fromdate . " 23:59:59'";
  } else if ($value->todate != "") {
  $where .= " and sales.date >='" . $value->todate . " 00:00:00' and sales.date <='" . $value->todate . " 23:59:59'";
  }

  $sql = $db->query("
  select patient.name, admission.*  from patient, admission where patient.id = admission.admissionid $where order by admission.releasedate desc");
  while ($d = $sql->fetch_object()) {
  $arr[] = $d;
  }
  }


 * 
 */
//}



<?php
//echo 'okkkk';
if (isset($_GET['fdate'])) {
    require '../models/database.php';
    $d = new Database();
    //$output = '';
    $query = $d->wildcard("admission", "*", array("date", $_GET['fdate']));
    // $output .= '<ul class="list-unstyled">';
    if ($query->num_rows > 0) {
        echo '<table class=" table table-striped" border="2">';
        echo "<th>Name</th>";
        echo "<th>Date</th>";
        echo "<th>Diagnostic Name</th>";
        while ($value = $query->fetch_object()) {
            echo"<tr>";
            // print_r($row['name']);
            echo"<td>" . $value->name . "</td>";
            echo"<td>" . $value->date . "</td>";
            echo"<td>" . $value->diname . "</td>";

            echo"</tr>";
            echo"</table>";
        }
    } else {
        echo"Data is not found";
    }
}

//SELECT * FROM `admission` WHERE releasedate BETWEEN '2018-05-20 00:00:00' and '2018-05-24 00:00:00'
