<?php
include_once "config/dbconnect.php";
session_destroy();

redirect("login.php");

?>