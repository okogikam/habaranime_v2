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

?>