<?php

session_start();
require '../models/database.php';
$d = new Database();
date_default_timezone_set("Asia/Dhaka");


$disc = $_GET['disc'];

if (isset($_SESSION['mdid'])) {
    $sales = array(
        'employeeid' => $_SESSION['id'],
        'date' => date('y-m-d h:m:s'),
        'discount' => $disc
    );
//    print_r($sales);
//    die();

    if ($d->insert('sales', $sales)) {
        $id = $d->Id;

        foreach ($_SESSION['mdid'] as $key => $md) {


            $sdetails = array(
                'salesid' => $id,
                'medicineid' => $md,
                'quantity' => $_SESSION['qty'][$key]
            );
//        print_r($sdetails);
//        die();
            $d->insert('salesdetails', $sdetails);
        }

        unset($_SESSION['mdid']);
        unset($_SESSION['qty']);
        unset($_SESSION['price']);
        unset($_SESSION['name']);
        echo "Order placed successful";
    }
}
