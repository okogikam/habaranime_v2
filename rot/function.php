<?php
// homepage 
function displayNewPost($page){
    global $conn;
    $page-= 1;
    // $query = "SELECT * FROM artikel WHERE status='1' ORDER BY waktu_artikel  DESC";
    $result = select_all("artikel","WHERE status='1' AND tag NOT LIKE '[%]' ORDER BY waktu_artikel  DESC");
    for($i = ($page * 10); $i < ($page + 1) * 10; $i++){
        if($i >= count($result) || $i < 0){
            return;
        }
        $id = get_post($result[$i]['no']);
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
                    <a href='?id=$id' class='icon-link gap-1 icon-link-hover stretched-link'>
                        Continue reading
                        <svg class='bi'><use xlink:href='#chevron-right'/></svg>
                    </a>
                </div>
            </div>
        </div>
      </article>";
    }       
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
      <p class="lead mb-0"><a href="?id='. get_post($result[$id1]['no']) .'" class="text-body-emphasis fw-bold">Continue reading...</a></p>
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
          <a href="?id='.get_post($result[$id2]['no']).'" class="icon-link gap-1 icon-link-hover stretched-link">
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
          <a href=?id='.get_post($result[$id3]['no']).' class="icon-link gap-1 icon-link-hover stretched-link">
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
        echo '<a class="nav-item nav-link link-body-emphasis" href="?id='. get_post($result[$i]['no']) .'">'.$result[$i]['kategori'].'</a>';
    }
}
function recentPosts(){
    global $conn;
    $result = select_all("artikel","WHERE status='1' AND tag NOT LIKE '[%]' ORDER BY waktu_artikel  DESC");
    echo '<h4 class="fst-italic">Recent posts</h4>
          <ul class="list-unstyled">';
    for($i=0;$i<5;$i++){
	echo '<li>
              <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="?id='.$result[$i]['no'].'">
		<img class="bd-placeholder-img" src="'.$result[$i]['gambar'].'" style="width:100%;">

                <div class="col-lg-8">
                  <h6 class="mb-0">'.get_post($result[$i]['judul_artikel']).'</h6>
                  <small class="text-body-secondary">'.get_post($result[$i]['waktu_artikel']) .'</small>
                </div>
              </a>
            </li>';
    }
}
function displayPerkategori($kategori,$page){
    global $conn;
    $page-= 1;
    // $query = "SELECT * FROM artikel WHERE status='1' ORDER BY waktu_artikel  DESC";
    $result = select_all("artikel","WHERE status='1' AND kategori LIKE '%$kategori%' AND tag NOT LIKE '[%]' ORDER BY waktu_artikel  DESC");
    for($i = ($page * 10); $i < ($page + 1) * 10; $i++){
        if($i >= count($result) || $i < 0){
            return;
        }
        $id = get_post($result[$i]['no']);
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
                    <a href='?id=$id' class='icon-link gap-1 icon-link-hover stretched-link'>
                        Continue reading
                        <svg class='bi'><use xlink:href='#chevron-right'/></svg>
                    </a>
                </div>
            </div>
        </div>
      </article>";
    }

}
function numberPage($page,$kategori){
   if($kategori != ''){
    $result = select_all("artikel","WHERE status='1' AND kategori LIKE '%$kategori%' AND tag NOT LIKE '[%]' ORDER BY waktu_artikel  DESC");
    $maks = count($result)%10;

    echo '<nav class="blog-pagination" aria-label="Pagination">';  
    if($page - 1 < 1){
        echo '<a class="btn btn-outline-primary rounded-pill disabled" aria-disabled="true">Newer</a>';	
        echo "<a class='btn btn-outline-secondary rounded-pill' href='?p=". $page+1 ."&kat=".$kategori."'>Older</a>";

    }else if($page > $maks){
        echo "<a class='btn btn-outline-primary rounded-pill' href='?p=".($page - 1) ."'>Newer</a>";
	echo '<a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">Older</a>';

    }else{
        echo "<a class='btn btn-outline-primary rounded-pill' href='?p=".($page - 1) ."&kat=".$kategori."'>Newer</a>";
	echo "<a class='btn btn-outline-secondary rounded-pill' href='?p=". $page+1 ."&kat=".$kategori."'>Older</a>";

        }
    echo  '</nav>';
   }else{
    $result = select_all("artikel","WHERE status='1' AND tag NOT LIKE '[%]' ORDER BY waktu_artikel  DESC");
    $maks = count($result)%10;

    echo '<nav class="blog-pagination" aria-label="Pagination">'; 
    if($page - 1 < 1){	
        echo '<a class="btn btn-outline-primary rounded-pill disabled" aria-disabled="true">Newer</a>';
        echo "<a class='btn btn-outline-secondary rounded-pill' href='?p=". $page+1 ."'>Older</a>";

    }else if($page > $maks){
        echo "<a class='btn btn-outline-primary rounded-pill' href='?p=".($page - 1) ."'>Newer</a>";
	echo '<a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">Older</a>';

    }else{
        echo "<a class='btn btn-outline-primary rounded-pill' href='?p=".($page - 1) ."'>Newer</a>";
	echo "<a class='btn btn-outline-secondary rounded-pill' href='?p=". $page+1 ."'>Older</a>";

     }
    echo  '</nav>';
   }
}
// akhir homepage 
?>