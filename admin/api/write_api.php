<?php
require_once "./fungsi.php";
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
    $kategori = rtrim($kategori,",");
}
if(isset($_POST['topik'])){
    foreach($_POST['topik'] as $top){
        $topik .= $top . ",";
    }
    $topik = rtrim($topik,",");
}

$series = get_input($_POST['series']);
$result = "";

tambah_kategori($kategori);
tambah_tag($topik);

if(isset($_POST['post_id']) && $_POST['post_id'] != ""){
    $value = "$title#&#$isi#&#$url_gambar#&#$stat#&#Admin#&#$kategori#&#$topik#&#$series";    
    $result = updatePost($id,$value);
}else{
    $value = "'$title','$isi','$url_gambar',$stat,'Admin','$kategori','$topik','$series'";
    $result = simpanPost($value);
}

// send result 
echo json_encode($result);
?>