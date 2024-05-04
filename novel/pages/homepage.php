 <?php
 if(isset($_GET['p'])){
     $now = get_output($_GET['p']);
 }else{
     $now = 1;
 }
 $numpage = pagenum($data_series,$now);
 ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Main content -->
     <div class="content pt-3">
         <div class="container">
             <h2>New Post</h2>
             <div class="row">
                 <div class="col-lg-8">
                     <div>
                     <?php 
                     $min = ($now-1) * 5;
                     $mak = $now * 5;
                     if($mak > count($data_series)){ $mak = count($data_series);}
                     for($x=$min;$x<$mak;$x++){
                          $series = $data_series[$x];
                     ?>
                     <a href="?s=post&id=<?php echo $series['no']; ?>">
                         <div class="card">
                             <div class="card-img" style="background-image:url(<?php echo get_thumbnail($series['anime'],$conn); ?>);">
                             </div>
                             <div class="card-body">
                                 <h5 class="card-title"><?php echo $series['judul_artikel']; ?></h5>
                                 <p class="card-text color-grey">
                                     <?php echo $series['anime']; ?>
                                 </p>
                             </div>
                         </div>
                     </a>
                     <?php } ?>
                     </div>
                     <div class="pagenum pb-3">
                         <div class="row">
                             <div class="col-6">
                                 <?php
                                 if($numpage['new'] != 0){
                                 ?>
                                 <a href="?p=<?php echo $numpage['new']; ?>">New Post</a>
                                 <?php
                                 }
                                 ?>
                             </div>
                             <div class="col-6 text-right">
                                 <?php
                                 if($numpage['old'] != 0){
                                 ?>
                                 <a href="?p=<?php echo $numpage['old']; ?>">Old Post</a>
                                 <?php
                                 }
                                 ?>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- /.col-md-6 -->
                 <div class="col-lg-4">
                     <?php include "pages/side_bar.php"; ?>
                 </div>
                 <!-- /.col-md-6 -->
             </div>
             <!-- /.row -->
         </div><!-- /.container-fluid -->
     </div>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->