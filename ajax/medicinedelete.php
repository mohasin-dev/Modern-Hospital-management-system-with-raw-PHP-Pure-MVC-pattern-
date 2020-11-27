<?php

session_start();
if (isset($_GET['did'])) {
    $id = $_GET['did'];
    if (count($_SESSION['mdid']) > 1) {

        $index = array_search($id, $_SESSION['mdid']);
        unset($_SESSION['mdid'][$index]);
        unset($_SESSION['qty'][$index]);
        unset($_SESSION['name'][$index]);
        unset($_SESSION['price'][$index]);

        $total = 0;
        if ($_SESSION['price']) {
            foreach ($_SESSION['price'] as $key => $price) {
                $total += ($_SESSION['qty'][$key] * $_SESSION['price'][$key]);
            }
        }

        $arr = array(
            "total" => $total
        );
    } else {

        unset($_SESSION['mdid']);
        unset($_SESSION['qty']);
        unset($_SESSION['name']);
        unset($_SESSION['price']);

        $arr = array(
            "total" => 0
        );
    }
}

header('Content-Type: application/json');
echo json_encode($arr);

