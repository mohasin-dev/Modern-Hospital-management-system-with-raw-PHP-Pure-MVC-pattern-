<?php
if(isset($_GET['email'])){
    require '../models/database.php';
    $d = new Database();
    $result = $d->view("patient", "", array("email"=>$d->VD($_GET['email'])));
    
    if($result->num_rows > 0){
        echo 100;
    }
    else{
        echo -1;
    }
}
else{
    echo "Uzzal";
}
