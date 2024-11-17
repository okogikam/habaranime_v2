<?php
include './admin/rot/function-v2.php';

function displayNewPost(){
    $query = "SELECT * FROM artikel WHERE status='1' ORDER BY waktu_artikel  DESC";
    $result = dataquery($query);
    // for($i = 0; $i < count($result); $i++){
    //     echo "<article class='blog-post mb-3'>
    //     <div class='card'>
    //         <div class='row'>
    //             <div class='col-3'>
    //             <svg class='bd-placeholder-img' width='100%' height='100%' xmlns='http://www.w3.org/2000/svg' aria-hidden='true' preserveAspectRatio='xMidYMid slice' focusable='false'><rect width='100%' height='100%' fill='#777'/></svg>
    //             </div>
    //             <div class='col-9 card-body'>
    //                 <strong class='d-inline-block mb-2 text-primary-emphasis'>World</strong>
    //                 <h3 class='mb-0'>$result[$i][judul_artikel]</h3>
    //                 <div class='mb-1 text-body-secondary'>Nov 12</div>
    //                 <p class='card-text mb-auto'>This is a wider card with supporting text below as a natural lead-in to additional content.</p>
    //                 <a href='#' class='icon-link gap-1 icon-link-hover stretched-link'>
    //                     Continue reading
    //                     <svg class='bi'><use xlink:href='#chevron-right'/></svg>
    //                 </a>
    //             </div>
    //         </div>
    //     </div>
    //   </article>";
    // }
    test($result);
}
?>