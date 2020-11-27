<?php

$title = "Hospital";
$act = "home";

if (isset($_GET['f'])) {
    if ($_GET['f'] == "home") {
        $title = "Hospital";
        $act = "home";
    } else if ($_GET['f'] == "login") {
        $title = "Login";
        $act = "ln";
    } else if ($_GET['f'] == "sign_up") {
        $title = "Sign up";
        $act = "su";
    }else if ($_GET['f'] == "logout") {
        $title = "Logout";
        $act = "lo";
    }
	else if ($_GET['f'] == "contact") {
        $title = "Contact";
        $act = "con";
    }
	
}

