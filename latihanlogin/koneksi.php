<?php
$con = mysqli_connect("localhost", "root", "", "logindb");
if (mysqli_connect_errno()){
    echo "failed to connect database" .mysqli_connect_error();
    exit();
}
?>