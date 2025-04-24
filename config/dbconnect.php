<?php
session_start();

$connect = mysqli_connect("localhost","root","","foodPanda") or die("db failed");

//redirect function
function redirect($page): void{
    echo "<script>window.open('$page','_self')</script>";
}
function msg($msg): void{
    echo "<script>alert('$msg')</script>";
}

function countData($query){
    global $connect;
    $run = mysqli_query($connect, "$query");
    $count = mysqli_num_rows($run);
    return $count;
}

function checkifNotLogin(){
    if(!isset($_SESSION['admin'])){
        redirect("../login.php");
    }
}

?>