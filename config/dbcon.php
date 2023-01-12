<?php

$con = mysqli_connect("localhost", "root", "", "blog");

session_start();

if(!$con){
    echo "Die!";
}

?>