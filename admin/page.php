<?php
if(isset($_GET['p'])){
    $p = get_post(($_GET['p']));
}else{
    $p = "Dashboard";
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <!-- /.col -->
            <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><?php echo $p; ?></li>
            </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <?php
    $p2 = str_replace(" ","",$p);
    if(file_exists( "./pages/".$p2.".php")){
        include_once "./pages/".$p2.".php";
    }else{
        include_once "./pages/Error.php";
    }
    ?>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->