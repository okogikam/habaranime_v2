<?php
require_once 'connect.php';
    session_start();
    if(isset($_SESSION['username']))
    {
        $username = $_SESSION['username']; // session variabel
        $password = $_SESSION['password'];
        $user_status = $_SESSION['status'];
        $user_id = $_SESSION['user_id'];
    }else{
        header('Location:login.php');
    }
?>