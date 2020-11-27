<?php

function new_files($name, $data){
    $fh = fopen($name, "w");
    fwrite($fh, $data);
    fclose($fh);
}

function extension($data) {
    $ext = "";
    if ($data) {
        $ext=pathinfo($data);
        $ext = stripslashes(strtolower($ext['extension']));
        if ($ext != "jpg" && $ext != "jpeg" && $ext != "png" && $ext != "gif") {
            $ext = "";
        }
    }
    return $ext;
}

function RandStr($length){
    $arr = array_merge(range("A", "Z"), range("a", "z"), range(0, 9));
    $str = "";
    while($length > 0){
        $str .= $arr[rand(0, count($arr) - 1)];
        $length--;
    }
    return $str;
}

function Redirect($url){
    echo "<script>self.location='$url';</script>";
}


/*function extension($data) {
    if ($data) {
        $ext = pathinfo($data);
        $ext = stripslashes(strtolower($ext['extension']));
        if ($ext != "jpg" && $ext != "jpeg" && $ext != "png" && $ext != "gif") {
            return "";
        } else {
            return $ext;
        }
    } else {
        return "";
    }
}*/


