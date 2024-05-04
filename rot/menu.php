<?php
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = "Dashboard";
}
if($user_status == "Admin"){
$menus = array(
    "Dashboard"=>"fa-tachometer-alt",
    "Post"=>array(
        "Semua Post"=>"fa-folder",
        "New Post"=>"fa-file-alt",
    ),
    "Komentar"=>"fa-comments",
    "Media"=>array(
        "Gallery"=>"fa-photo-video",
        "Tambah Media"=>"fa-file-image",
        "Wallpaper"=>"fa-file-image",
    ),
    "Pengguna"=>array(
        "Semua Pengguna"=>"fa-users",
        "Tambah Pengguna"=>"fa-user-plus",
        "Profil"=>"fa-user-edit",
    ),
    "Peralatan"=>array(
        "Backup"=>"fa-file-export",
        "Restort"=>"fa-file-import",
    ),
    "Pengaturan"=>"fa-cogs",
    "Email"=>"fa-envelope",
    "Plugin"=>array(
        "Plugin Terpasang"=>"fa-puzzle-piece",
        "Tambah Plugin"=>"fa-code",
    ),
);
}else{
    $menus = array(
    "Dashboard"=>"fa-tachometer-alt",
    "Post"=>array(
        "Semua Post"=>"fa-folder",
        "New Post"=>"fa-file-alt",
    ),
    "Komentar"=>"fa-comments",
    "Media"=>array(
        "Gallery"=>"fa-photo-video",
        "Tambah Media"=>"fa-file-image",
        "Wallpaper"=>"fa-file-image",
    ),
    "Pengguna"=>array(
        "Semua Pengguna"=>"fa-users",
        "Profil"=>"fa-user-edit",
    ),
    "Peralatan"=>array(
        "Backup"=>"fa-file-export",
        "Restort"=>"fa-file-import",
    ),
    "Pengaturan"=>"fa-cogs",
    
);
}
function Menu($menus,$page){
    $page = $page;
    $Menus = $menus;
    foreach($Menus as $Menu => $menu){
        if(is_array($menu)){
            $x=0;
            foreach($menu as $Men => $men){
                if($Men == $page){
                    $x =1;
                }
            }
            if($x == 1){
                echo "<li class='nav-item has-treeview menu-open'>";
            }else{
            echo "<li class='nav-item has-treeview'>";
            }
            echo "<a href='#' class='nav-link'>
              <i class='nav-icon fas fa-th'></i>
              <p>
                $Menu
                <i class='right fas fa-angle-left'></i>
              </p>
            </a>
            <ul class='nav nav-treeview'>";
            foreach($menu as $Men => $men){
                if($Men == $page){
                    echo "<li class='nav-item bg-primary'>";
                }else{
                echo "<li class='nav-item'>";
                }
                echo "<a href='?page=$Men' class='nav-link' id='$Men'>
                  <i class='fas $men nav-icon'></i>
                  <p>$Men</p>
                </a>
              </li>";
            }
           echo "</ul>
          </li>";
        }else{
            if($Menu == $page){
                echo "<li class='nav-item bg-primary'>";
            }else{
            echo "<li class='nav-item'>";
            }
            echo "<a href='?page=$Menu' class='nav-link' id='$Menu'>
              <i class='nav-icon fas $menu'></i>
              <p>
                $Menu                
              </p>
            </a>
          </li>";
        }
    }
}
?>