
<?php
require '../models/database.php';
    $d = new Database();
$output = '';
if(isset($_POST['searchVal'])){
    $searchq = $_POST['searchVal'];
   $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);
    $sql = $d->search($searchq);
    //echo '$sql';
    $count = mysqli_num_rows($sql);
    if($count == 0){
        $output = "there was no search result!";      
    }
    else{
        while ($row = $sql->fetch_object()){
            $name = $row->name;
            $email = $row->email;
            $deg = $row->designationid;
            $fees = $row->fees;
            $ins = $row->institute;
            $pic = $row->picture;
            $id = $row->id;
            $output .= "<a href='#'><div>$name<div></a>";
            $output .= '<div>'.$email.'<div>';
            $output .= '<div>'.$fees.'<div>';
            $output .= '<div>'.$deg.'<div>';
            $output .= '<div class=last>'.$ins.'<div>';
           
        }
    } 
}
echo ($output);
?>
<style>
    .last{
        margin-bottom: 20px;
    }
</style>