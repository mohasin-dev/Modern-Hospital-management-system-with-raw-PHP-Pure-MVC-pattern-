<?php
if (isset($_GET['ids'])) {
    require '../models/database.php';
    $d = new Database();
    $where = array(
        "doctorid" => $d->VD($_GET['ids']),
        "name" => date("D")
    );
    $result = $d->view("visitingdays", "", "", $where);

    while ($dd = $result->fetch_object()) {
        $start = $d->minutes($dd->starttime);
        $end = $d->minutes($dd->endtime);
        $time = explode(':', $dd->starttime);
        $hour = $time[0];
    }
    
    $where = array(
        "ap_date"=>date("Y-m-d"),
        "doctorid"=>$d->VD($_GET['ids'])
    );
    $result = $d->view("apointment", "", "", $where);
    $usedSlot = array();
    while ($dd = $result->fetch_object()) {
        $usedSlot[] = $dd->slot;
    }
    
    $total = ($end - $start);
    $html = "";
    $c = 1;
    for ($i = 0; $i < $total; $i+=20) {
        if ($hour > 12) {
            $ap = "PM";
        } else {
            $ap = "AM";
        }
        
        if(in_array($i, $usedSlot)){
            $html .= "<div class='schedule active' id='$i'>" . ($hour % 12) . ":" . ($i % 60) . "$ap-" . ($hour % 12) . ":" . (($i + 19) % 60) . "$ap</div>";
        }
        else{
            $html .= "<div class='schedule' id='$i'>" . ($hour % 12) . ":" . ($i % 60) . "$ap-" . ($hour % 12) . ":" . (($i + 19) % 60) . "$ap</div>";
        }
        if ($c % 3 == 0) {
            $hour++;
        }
        $c++;
    }
    echo $html;
} else {
    echo "Uzzal";
}

