 <?php 
 if(isset($_GET['id'])){
     $id = get_input($_GET['id']);
     $filter = "no='$id'";
     $data = get_series($filter,$conn);
     $series = $data[0];
     
     $toc = get_toc(get_output($series['anime']),$conn);
     $navigasi = get_navigasi($series['anime'],$series['no'],$conn);
 }else{
     $id = "";
 }
 if($id != ""){
     $tambah_view = tambahView($id,$conn);
 ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header" style="background-image: url(<?php echo get_thumbnail($series['anime'],$conn); ?>) ;">

     </div>
     <!-- /.content-header -->

     <!-- Main content -->
     <div class="content page pt-3 pb-3 pl-0 pr-0">
         <div class="container">
             <div class="row">
                 <div class="col-lg-8">
                     <div class="card">
                         <div class="card-header">
                             <h3><?php echo get_output($series['judul_artikel']); ?>
                             <span class='btn btn-xs btn-info'><?php echo get_output($series['kategori']); ?></span>
                             </h3>
                             <h5 class="color-grey"><?php echo get_output($series['anime']); ?></h5>
                         </div>
                         <div class="card-body text-justify">
                             <?php echo get_output($series['isi']); ?>
                         </div>
                         <div class="row">
                         <div class="col-4 text-center pb-5">
                             <?php
                             if($navigasi['prev'] != 0){
                             ?>
                             <a href="?s=post&id=<?php echo $navigasi['prev']; ?>" class="btn btn-info">Prev</a>
                             <?php
                             }else{
                             ?>
                             <a href="?s=post&id=<?php echo $navigasi['prev']; ?>" class="btn btn-info disabled">Prev</a>
                             <?php
                             }
                             ?>
                         </div>
                         <div class="col-4 text-center pb-5">
                             <a href="?s=page&id=<?php echo get_output($toc['no']); ?>&j=<?php echo get_output($toc['judul_artikel']); ?>" class="btn btn-info">Toc</a>
                         </div>
                         <div class="col-4 text-center pb-5">
                             <?php
                             if($navigasi['next'] != 0){
                             ?>
                             <a href="?s=post&id=<?php echo $navigasi['next']; ?>" class="btn btn-info">Next</a>
                             <?php
                             }else{
                             ?>
                             <a href="?s=post&id=<?php echo $navigasi['next']; ?>" class="btn btn-info disabled">Next</a>
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
 <?php 
 }else{ header("location:./"); }
 ?>