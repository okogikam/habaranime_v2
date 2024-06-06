<?php
header('Content-Type: application/json; charset=utf-8');
require_once "./fungsi.php";

$result = openAllKategori();
// $result["kategori"] = array(
//     "post"=>0,
//     "view"=>0
// );
echo json_encode($result);
?>