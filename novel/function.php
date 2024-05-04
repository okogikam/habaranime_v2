<?php
include_once "connect.php";
function dataQuery($conn,$query){
        $result = $conn->query($query);
        if(!$result){
            return $conn->error;
        }else{
            $rows = $result->num_rows;
            if($rows>1){
                $hasil_akhir = array();
                for($x=0;$x<$rows;$x++){
                $result->data_seek($x);
                $data = $result->fetch_array(MYSQLI_ASSOC);
                $hasil_sm = array();
                foreach($data as $item =>$isi){
                  $hasil_sm  += array($item => $isi);
                }
                $hasil_akhir += array("$x"=>$hasil_sm);
                $hasil = $hasil_akhir;
             }
            }if($rows == 1){
             $result->data_seek(0);
              $hasil_akhir = $result->fetch_array(MYSQLI_BOTH);
              $hasil[0] = $hasil_akhir;
            }
            return $hasil;
        }
}
function tambahView($id,$conn){
    $post = dataQuery($conn, "SELECT * FROM artikel WHERE no='$id'");
    $post_view = $post[0]['view'];
    $post_view += 1;
    $tambah_view = dataQuery($conn, "UPDATE artikel SET view='$post_view' WHERE no='$id'");
    return $tambah_view;
}
function buatArray($sintak,$isi){
        $result = explode($sintak,$isi);
        return $result;
    }
function pagenum($list,$pg_now){
    $jml = count($list);
    $jml_pg = ceil($jml / 5);
    
    if($jml > 5){
        if($pg_now == 1){
            $num['old'] = $pg_now + 1;
            $num['new'] = 0;
        }if($pg_now >= $jml_pg){
             $num['new'] = $pg_now - 1;
            $num['old'] = 0;
        }
        else{
            $num['old'] = $pg_now + 1;
            $num['new'] = $pg_now - 1;
        }
    }else{
        $num['old'] = 0;
        $num['new'] = 0;
    }
    return $num;
}
function all_series($conn){
    $query = "SELECT * FROM artikel WHERE tag='[series]' AND status='1' ORDER BY waktu_artikel DESC";
    $hasil = dataQuery($conn,$query);
    return $hasil;
}
function all_novel($conn){
    $query = "SELECT * FROM artikel WHERE tag='[novel]' AND status='1' ORDER BY waktu_artikel DESC";
    $hasil = dataQuery($conn,$query);
    return $hasil;
}
function all_novel_series($anime,$conn){
    $query = "SELECT * FROM artikel WHERE tag='[series]' AND status='1' AND anime='$anime' ORDER BY waktu_artikel";
    $hasil = dataQuery($conn,$query);
    return $hasil;
}
function get_series($filter,$conn){
    $query = "SELECT * FROM artikel WHERE $filter";
    $hasil = dataQuery($conn,$query);
    return $hasil;
}
function gambar($img){
    if($img == "#"){
        $img = "./img.jpeg";
        return $img;
    }else{
        return $img;
    }
}
function get_toc($anime,$conn){
    $filter = "anime='$anime' AND tag='[novel]'";
    $hasil = get_series($filter,$conn);
    return $hasil[0];
}
function get_navigasi($anime,$id,$conn){
    $series = all_novel_series($anime,$conn);
    for($x=0;$x<count($series);$x++){
        $seri = $series[$x];
        if($seri['no'] == $id){
            $now = $x;
        }
    }
    
    if($now == 0){
        $nav['prev'] = 0;
        $nav['next'] = $series[$now+1]['no'];
    }else if($now == count($series)-1){
        $nav['prev'] = $series[$now-1]['no'];
        $nav['next'] = 0;
    }else{
        $nav['prev'] = $series[$now-1]['no'];
        $nav['next'] = $series[$now+1]['no'];
    }
    return $nav;
}
function get_thumbnail($anime,$conn){
    $query = "SELECT * FROM artikel WHERE anime='$anime' AND tag='[novel]'";
    $hasil = dataQuery($conn,$query);
    $img = gambar($hasil[0]['gambar']);
    return $img;
}
function get_input($var){
    $var = stripslashes($var); // untuk membuang slashes yang tidak diinginkan
        $var = strip_tags($var); // to strip HTML entirely fron an input, gunakan sebelum htmlentities
        $var = htmlentities($var); // untuk membuang semua HTML dari string
        $var = str_replace("'","td_ptk",$var);
        return $var;
}
 function get_output($var)
    {
        $var = str_replace("td_ptk","'",$var);
         $var = html_entity_decode($var);
         return $var;
    }
?>