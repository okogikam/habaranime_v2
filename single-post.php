<?php
$post_id = get_input($_GET['id']);
$post = openPost($post_id);
$kategori_list = explode(",",$post['kategori']);
?>
<!-- Main content -->
<section class="content col-md-8">
    <div class="container-fluid">
        <!-- post  -->
        <section class="single-post card">
<img src="<?= $post['gambar']; ?>" alt="" style="width: 100%;">            
            <div class="card-body">
	     <h2 class="news-title"><?= get_post($post['judul_artikel']); ?></h2>

<?php
foreach($kategori_list as $kat){
  if($kat == ''){ continue; }
  echo "<a class='btn btn-sm btn-primary' style='margin-right:3px;' href='?kat=$kat'>$kat</a>";
}
?>
<hr>
             <div><?= get_post($post['isi']); ?>
	     </div>   
            </div>
        </section>
    </div>
</section>
<!-- /.content -->