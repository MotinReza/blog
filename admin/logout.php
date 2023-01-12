<?php

require_once "../config/dbcon.php";

session_destroy();

header("location: login.php");

?>