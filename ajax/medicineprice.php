<?php
echo 'ok';
die();

session_start();
require '../models/database.php';
$d = new Database();

$id = $_GET['id'];
$qty = $_GET['qty'];

$data = $d->view('medicine', '*', '', ['id' => $id]);
if ($data->num_rows > 0) {
    $value = $data->fetch_object();
}

if (isset($_SESSION['mdid'])) {
    $index = array_search($id, $_SESSION['mdid']);
    if ($index !== false) {
        $_SESSION['qty'][$index] = $qty;
        
        $total = 0;
        if ($_SESSION['price']) {
            foreach ($_SESSION['price'] as $key => $price) {
                $total += ($_SESSION['qty'][$key] * $_SESSION['price'][$key]);
            }
        }

        $arr = array(
            "status" => 2,
            "stotal" => ($value->price * $qty),
            "total" => $total
        );
    } else {
        $_SESSION['mdid'][] = $id;
        $_SESSION['qty'][] = $qty;
        $_SESSION['name'][] = $value->name;
        $_SESSION['price'][] = $value->price;

        $total = 0;

        if ($_SESSION['price']) {
            foreach ($_SESSION['price'] as $key => $price) {
                $total += ($_SESSION['qty'][$key] * $_SESSION['price'][$key]);
            }
        }

        $arr = array(
            "name" => $value->name,
            "price" => $value->price,
            "status" => 1,
            "stotal" => ($value->price * $qty),
            "total" => $total
        );
        // echo count($_SESSION['mdid']);
    }
} else {
    $_SESSION['mdid'][] = $id;
    $_SESSION['qty'][] = $qty;
    $_SESSION['name'][] = $value->name;
    $_SESSION['price'][] = $value->price;

    $arr = array(
        "name" => $value->name,
        "price" => $value->price,
        "status" => 1,
        "stotal" => ($value->price * $qty),
         "total" => ($value->price * $qty)
    );
    //echo count($_SESSION['mdid']);
}

//$arr = array(
//    $_GET['id'],
//    $_GET['qty']
//);
header('Content-Type: application/json');
echo json_encode($arr);
