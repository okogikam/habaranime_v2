<?php
include "../../rot/connect.php";

function dataquery($query){
    global $conn;   
    try{
        $result = $conn->query($query);
        return array(
            "status"=>1,
            "pesan"=>$result
        );
    }catch(Exception  $e){
        return array(
            "status"=>0,
            "pesan"=>$e->getMessage()
        );
    }
}

function get_input ($var){
        $var = htmlentities($var); // untuk membuang semua HTML dari string
        $var = str_replace("'","td_ptk",$var);
        return $var;
}

//kategori
function tambah_kategori($kategori){
    $kategori_baru = array();
    $query = "SELECT * FROM kategori";
    $KATEGORIS = dataquery($query);
    $kategoris = array();
    foreach($KATEGORIS['pesan'] as $x_kat){
        $kategoris += array($x_kat['kategori']);
    }
    $kategori_1 = explode(",",$kategori);
    
    $kategori_baru = array_diff($kategori_1,$kategoris);
    foreach($kategori_baru as $kat_baru){
        $query_2 = "INSERT INTO kategori(kategori) VALUES('$kat_baru')";
        $kat = dataquery($query_2);
    }
    return $kat;
}
//tag
function tambah_tag($tag){
    $Tag_baru = array();
    $query = "SELECT * FROM tag";
    $TAGS = dataquery($query);
    $Tags = array();
    foreach($TAGS['pesan'] as $x_tag){
        $Tags += array($x_tag['tag']);
    }
    $tag_1 = explode(",",$tag);
    
    $Tag_baru = array_diff($tag_1,$Tags);
    foreach($Tag_baru as $tag_baru){
        $query_2 = "INSERT INTO tag(tag) VALUES('$tag_baru')";
        $tag = dataquery($query_2);
    }
    return $tag;
}

// simpan post
function simpanPost($value){
    // judul_artikel,isi,gambar,status,oleh,kategori,tag,anime
    $rows = "judul_artikel,isi,gambar,status,oleh,kategori,tag,anime";
    $query = "INSERT INTO artikel($rows) VALUES($value)";
    $result = dataquery($query);
    return $result;
}
// update post
function updatePost($id,$value){
    // urutan value harus sesuai diipisahkan dengan #&#
    // judul_artikel,isi,gambar,status,oleh,kategori,tag,anime
    $row = array("judul_artikel","isi","gambar","status","oleh","kategori","tag","anime");
    $data = explode("#&#",$value);
    for($x = 0; $x < count($data); $x++){
        $query = "UPDATE artikel SET $row[$x] = '$data[$x]' WHERE no = '$id'";
        $result = dataquery($query);
    }
    return $result;
}
?>