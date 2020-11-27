<?php

require '../models/database.php';
$id = 1;
if ($d->delete('seat', $id)) {
    echo 1;
} else {
    echo 0;
}
?>