<?php
header('Content-Type: application/json; charset=utf-8');
require_once "./fungsi.php";

$result = array(
    "status"=>"0",
    "pesan"=>"gagal"
);
if($_POST['tag'] != ""){
    $tag = $_POST['tag'];
    if($_FILES['gambar']['error'] == 0){
        $url = uploadImg($_FILES['gambar']);
        $result['status'] = '1';
    }else{
        $url = $_POST['gambarUrl'];
        $upload =  simpanImg($tag,$url);
        $result['status'] = $upload['status'];
    }
}else if(isset($_GET['tag'])){
    $tag = get_input($_GET['tag']);
    $data_gambar = openAllImage($tag);
    $result['pesan'] = $data_gambar;
    $result['status'] = '1';
}else if(isset($_POST['update'])){
    $updateUrl = updateImg($_POST['no'],"gambar",$_POST['gambar']);
    $updateTag = updateImg($_POST['no'],"tag",$_POST['topik']);
    if($updateUrl['status'] > 0 && $updateTag['status'] > 0){
        $result['status'] = '1';
        $result['pesan'] = "Berhasil diupdate";
    }    
}else if(isset($_POST['delete'])){
    $deleteImg = updateImg($_POST['no'],"status","0");
    if($deleteImg['status'] > 0){
        $result['status'] = '1';
        $result['pesan'] = "Berhasil dihapus";
    }  
}
// send result 
echo json_encode($result);
?>