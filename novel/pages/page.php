<?php
if(isset($_GET['id'])){
    $id = get_output($_GET['id']);
    $filter = "no='$id'";
    $data = get_series($filter,$conn);
    $nov = $data[0];
    $nov_series = all_novel_series($nov['anime'],$conn);
    $kategori = buatArray(",",$nov['kategori']);
    $tambah_view = tambahView($id,$conn);

?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header" style="background-image: url(<?php echo gambar($nov['gambar']); ?>) ;">

     </div>
     <!-- /.content-header -->

     <!-- Main content -->
     <div class="content page p-2">
         <div class="container">
             <div class="row">
                 <div class="col-lg-8">
                     <div class="card">
                         <div class="card-body">
                             <div class="row">
                                 <div class="col-sm-5 cover-img">
                                     <div class="card-img">
                                         <img src="<?php echo $nov['gambar']; ?>" alt="" sizes="" srcset="">
                                     </div>
                                     <div class='kategori' style="padding-top: 300px;">
                                         <p>Kategory</p>
                                         <?php
                                         foreach($kategori as $kat){
                                             
                                         ?>
                                         <button class='btn btn-sm btn-default'><?php echo get_output($kat); ?></button>
                                         <?php
                                         }
                                         ?>
                                     </div>
                                 </div>
                                 <div class="col-sm-7 ringkasan">
                                     <h5 class="card-title"><?php echo get_output($nov['judul_artikel']); ?></h5>

                                     <p class="card-text">
                                         <?php echo get_output($nov['isi']); ?>
                                     </p>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="card">
                         <div class="card-header">
                             <h4>Series List</h4>
                         </div>
                         <div class="card-body">
                             <table class='table able-hover'>
                                 <?php
                                 foreach($nov_series as $seri){
                                     
                                 
                                 ?>
                                 <tr>
                                     <td>
                                     <a class="nav-link" href="?s=post&id=<?php echo get_output($seri['no']); ?>"><?php echo get_output($seri['judul_artikel']); ?></a>
                                     </td>
                                 </tr>
                                 <?php
                                 }
                                 ?>

                             </table>
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
}else{
    header("location:./");
}
?>