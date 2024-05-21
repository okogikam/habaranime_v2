<?php
require "./fungsi.php";
header('Content-Type: application/json; charset=utf-8');

// get form value
$id = get_input($_POST['post_id']);
$title = get_input($_POST['title']);
$isi = get_input($_POST['isi']);
$url_gambar = get_input($_POST['url-gambar']);
$stat = get_input($_GET['stat']);
$kategori = "";
$topik = "";
if(isset($_POST['kategori'])){
    foreach($_POST['kategori'] as $kat){
        $kategori .= $kat . ",";
    }
}
if(isset($_POST['topik'])){
    foreach($_POST['topik'] as $top){
        $topik .= $top . ",";
    }
}

$series = get_input($_POST['series']);

// data 
$result = array(
    "status"=>1,
    "data"=>array($title,$isi,$url_gambar,$stat,$kategori,$topik,$series)
);

// send result 
echo json_encode($result);
?>