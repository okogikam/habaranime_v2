<?php
    $hn = 'localhost';
    $un = 'root';
    $pw = '';
    $db = 'habaranime';
    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn->connect_error)die("Akses Gagal : ". $conn->connect_error);
?>