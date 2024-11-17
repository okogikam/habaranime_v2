<?php 
// include '../rot/connect.php';
$hn = 'localhost';
$un = 'root';
$pw = '';
$db = 'habaranime';
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error)die("Akses Gagal : ". $conn->connect_error);

//init function
    function dataquery($query){
        global $conn;
        $result = $conn->query($query);
        return $result;
    }
    function select_all($tabel,$option){
        global $conn;
        $hasil_akhir = array();
        if(isset($option)){
            $query = "SELECT * FROM $tabel $option";
        }else{
            $query = "SELECT * FROM $tabel";
        }
        $result = $conn->query($query);
        $rows = $result->num_rows;
            for($x=0;$x<$rows;$x++){
                $result->data_seek($x);
                $data = $result->fetch_array(MYSQLI_ASSOC);
                $hasil = array();
                foreach($data as $item =>$isi){
                $hasil  += array($item => $isi);
                }
                $hasil_akhir += array("$x"=>$hasil);
            }
            return $hasil_akhir; //hasil berupa array
    }
    function tampilan_angka($angka){
        switch($angka){
            case $angka >= 1000000:
                $int = round($angka / 1000000, 2);
                $int = $int . "M";
                break;
            case $angka >= 1000:
                $int = round($angka / 1000,2);
                $int = $int . "K";
                break;
            default:    
            $int = $angka;
            break;
        }
        return $int;
    }
    function test($data){
        if(is_array($data)){
            echo "<pre>";
            print_r($data);
            echo "</pre>";
        }else{
            echo "<pre>$data</pre>";
        }
    }
    function get_post($var)
    {
        $var = str_replace("td_ptk","'",$var);
         $var = html_entity_decode($var);
         return $var;
    }


    // fungsi untuk membersihkan variabel masukan dalam string
    function get_input ($var)
    {
        // $var = stripslashes($var); // untuk membuang slashes yang tidak diinginkan
        // $var = strip_tags($var); // to strip HTML entirely fron an input, gunakan sebelum htmlentities
        $var = htmlentities($var); // untuk membuang semua HTML dari string
        $var = str_replace("'","td_ptk",$var);
        return $var;
    }
// akhir init function
// post
  function tabel_daftar_post(){
    $data = select_all("artikel"," ORDER BY no DESC");
    if(!is_array($data)){
        return;
    }
    foreach($data as $d){
        $judul = get_post($d['judul_artikel']);
        $view = tampilan_angka($d['view']);
        if($d['status'] > 0){ 
            $status = "Publish";
        }else{
            $status = "Draft";
        }
        echo "<tr class='post-$d[no]'>
        <td class='row'>
          <div class='col-10'>
          <h4>$judul</h4>
          <p class='mb-1'>            
              <span class='btn btn-sm btn-default'
                ><i class='nav-icon fa-solid fa-user-pen'></i>
                $d[oleh]</span
              >
              <span class='btn btn-sm btn-default'
                ><i class='nav-icon fa-solid fa-eye'></i>
                $view</span
              >
              <span class='btn btn-sm btn-default'
                ><i class='nav-icon fa-solid fa-globe'></i>
                $status</span
              >
              <span class='btn btn-sm btn-default'><i class='fa-solid fa-calendar'></i>$d[waktu_artikel]</span>
            </p>
            </div>
            <div class='col-2 opsi'>
              <a href='?p=Write&id=$d[no]'><span class='btn btn-sm btn-info'
                ><i
                  class='nav-icon fa-solid fa-pen-to-square'
                ></i>
                <span>Edit</span
              ></a>
              <span class='btn btn-sm btn-danger' onclick='return konfirmasi($d[no])'
                ><i class='nav-icon fa-solid fa-trash'></i>
                <span>Del</span
              >              
            </div>
        </td>
      </tr>";
        
    }
  }
// akhir post
// write
    function openPost($post_id){
        $query = "SELECT * FROM artikel WHERE no='$post_id'";
        $result = dataquery($query);
        $data = $result->fetch_array(MYSQLI_BOTH);
        
        return $data;
    }
    function displayKategori($kategori){
        $kategoris = explode(",",$kategori);
        $data_kategori = select_all("kategori","");
        foreach($data_kategori as $kat){
            if(in_array($kat['kategori'],$kategoris) && $kat['kategori'] != ""){
                echo "<option selected>$kat[kategori]</option>";
            }else{
                echo "<option>$kat[kategori]</option>";
            }
        }
    }
    function displaytopik($tag){
        $tags = explode(",",$tag);
        $data_tag = select_all("tag","");
        foreach($data_tag as $tg){
            if(in_array($tg['tag'],$tags) && $tg['tag'] != ""){
                echo "<option selected>$tg[tag]</option>";
            }else{
                echo "<option>$tg[tag]</option>";
            }
        }
    }
    function displayseris($seri){
        $seris = array();
        $query = "SELECT anime FROM artikel GROUP BY anime";
        $result = dataquery($query);
        $rows = $result->num_rows;
        for($x = 0; $x < $rows; $x++){
            $result->data_seek($x);
            $data_anime = $result->fetch_array(MYSQLI_ASSOC);
            $seris += array($x=>$data_anime['anime']);
        }
        
        foreach($seris as $s){
            if($s == $seri && $s != ""){
                echo "<option selected>$s</option>";
            }else{
                echo "<option>$s</option>";
            }
        }
    }
// akhir write
//image
    function displayTagImage(){
        $data_gambar = select_all("galery","GROUP BY tag");
        echo "<div class='col-12'><button class='btn btn-sm btn-primary filter'>All</button>";
        foreach($data_gambar as $gambar){
            echo"
            <button class='btn btn-sm btn-primary filter'>
                $gambar[tag]
            </button>";
        }
        echo "</div>";
    }
    function displayAllImage(){
        $data_gambar = select_all("galery","ORDER BY no DESC");
        foreach($data_gambar as $gambar){
            echo"
            <div class='col-1 card m-1 p-0 gambar-item' data-tag='$gambar[tag]'>
                <img src='$gambar[gambar]' alt=''>
            </div>";
        }
    }
// akhir image
// user 
    function displayTabelUser(){
        $data_user = select_all("user","ORDER BY no DESC");
        foreach($data_user as $us){
            echo "<tr>";
            echo "<td>$us[user_name]</td>";
            echo "<td>$us[email]</td>";
            echo "<td>$us[status]</td>";
            echo "<td></td>";
            echo "</tr>";
        }
    }
// akhir user 

// homepage 
function displayNewPost($page){
    global $conn;
    // $query = "SELECT * FROM artikel WHERE status='1' ORDER BY waktu_artikel  DESC";
    $result = select_all("artikel","WHERE status='1' AND tag NOT LIKE '[%]' ORDER BY waktu_artikel  DESC");
    for($i = ($page * 10); $i < ($page + 1) * 10; $i++){
        if($i >= count($result) || $i < 0){
            return;
        }
        $judul = get_post($result[$i]['judul_artikel']);
        $waktu = explode(" ",$result[$i]['waktu_artikel']);
        $privew = explode("</p>",get_post($result[$i]['isi']));
        $gambar = get_post($result[$i]['gambar']);
        $kat = explode(",",get_post($result[$i]['kategori']));
        echo "<article class='blog-post mb-3'>
        <div class='card '>
            <div class='row'>
                <div class='col-sm-4 thumbnail card-header' style='background-image:url($gambar);'>
                   <span class='d-inline-block mb-2'>$kat[0]</span>
                </div>
                <div class='col-sm-8 card-body'>
                    <h4 class='mb-0'>$judul</h4>
                    <div class='mb-1 text-body-secondary'>$waktu[0]</div>
                     <p class='card-text mb-auto'></p>
                    <a href='#' class='icon-link gap-1 icon-link-hover stretched-link'>
                        Continue reading
                        <svg class='bi'><use xlink:href='#chevron-right'/></svg>
                    </a>
                </div>
            </div>
        </div>
      </article>";
    }
    // displayTabelUser();
    // echo "<pre>";
    // print_r($result);
    // echo "</pre>";
}
function displayTopPost(){
    global $conn;
    $result = select_all("artikel","WHERE status='1' AND tag NOT LIKE '[%]' ORDER BY waktu_artikel  DESC");
    $id1 = rand(1,50);
    $id2 = rand(1,50);
    $kat2 = explode(",",get_post($result[$id2]['kategori']));
    $id3 = rand(1,50);
    $kat3 = explode(",",get_post($result[$id3]['kategori']));
    // post 1
    echo'<div class="p-4 p-lg-6 mb-4 rounded text-body-emphasis bg-body-secondary thumbnail" style="background-image:url('.get_post($result[$id1]['gambar']).')">
    
    <div class="col-lg-6 px-0" >
      <h1 class="display-4 fst-italic">'.get_post($result[$id1]['judul_artikel']).'</h1>
      <p class="lead mb-0"><a href="#" class="text-body-emphasis fw-bold">Continue reading...</a></p>
    </div>
  </div>';
    // post 2
    echo '<div class="row mb-2">
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary-emphasis">'.$kat3[0].'</strong>
          <h3 class="mb-0">'.get_post($result[$id2]['judul_artikel']).'</h3>
          <div class="mb-1 text-body-secondary">'.$result[$id2]['waktu_artikel'].'</div>
          <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
            Continue reading
            <svg class="bi"><use xlink:href="#chevron-right"/></svg>
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success-emphasis">'.$kat3[0].'</strong>
          <h3 class="mb-0">'.get_post($result[$id3]['judul_artikel']).'</h3>
          <div class="mb-1 text-body-secondary">'.$result[$id3]['waktu_artikel'].'</div>
          <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
            Continue reading
            <svg class="bi"><use xlink:href="#chevron-right"/></svg>
          </a>
        </div>
      </div>
    </div>
  </div>';
}
function displayRekomendasiKategori(){
    global $conn;
    $result = select_all("kategori","ORDER BY banyak  DESC");
    for($i=0;$i<10;$i++){
        echo '<a class="nav-item nav-link link-body-emphasis" href="#">'.$result[$i]['kategori'].'</a>';
    }
}
// akhir homepage 
?>