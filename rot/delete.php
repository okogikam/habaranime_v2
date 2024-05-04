<?php
//delete post
function deletePost($n){
    global $data;
    global $conn;
    $Posts = $data->delete("artikel","no",$n,$conn);
    return $Posts;
}
//delete komentar
function deleteKomentar($n){
    global $data;
    global $conn;
    $Komen = $data->delete("komentar","no",$n,$conn);
    return $Komen;
}
//delete photo
function deletePhoto($n){
    global $data;
    global $conn;
    $photo = $data->delete("galery","no",$n,$conn);
    return $photo;
}
//delete user
//delete photo
function deleteUser($n){
    global $data;
    global $conn;
    $user = $data->delete("user","no",$n,$conn);
    return $user;
}
?>