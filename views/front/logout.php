<?php
if(!isset($title)){
    header("Location: index.html");
}
?>
<?php

session_destroy();
Redirect("index.php?f=login");

?>