<?php
$connect = mysqli_connect("localhost","root","","to_do_list") or die("Connection Failed");

session_start();
$_SESSION["user_id"] = "1";
?>