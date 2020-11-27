<?php

if(isset($_GET['query'])){
    require '../models/database.php';
    $d = new Database();
    $output = '';
    $query = $d->wildcard("medicine", "*", array("name" ,$_GET['query']));
    $output .= '<ul class="list-unstyled">';
    if($query->num_rows > 0){
        while($value = $query->fetch_object()){
            $_SESSION['medid'] = $value->id;
            $output .= "<li class='list' id='m-{$value->id}'>{$value->name}</li>";
        }
    }else{
        $output .= '<li>Medicine Not Found</li>';
    }
    
    $output .= '</ul>';
    echo $output;
    
}

