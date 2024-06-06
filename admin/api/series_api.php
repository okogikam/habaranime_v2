<?php
header('Content-Type: application/json; charset=utf-8');
require_once "./fungsi.php";

$result = openAllSeries();

echo json_encode($result);
?>