<?php
header('Content-Type: application/json; charset=utf-8');
require_once "./fungsi.php";

$result = openAllTag();

echo json_encode($result);
?>