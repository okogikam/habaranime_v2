<?php
require_once "./fungsi.php";
header('Content-Type: application/json; charset=utf-8');
$id_post = get_input($_GET['id']);

$query = "DELETE FROM artikel WHERE no = '$id_post' ";
$result = dataquery($query);

echo json_encode($result);
?>