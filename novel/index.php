<?php
include_once "function.php";

$data_series  = all_series($conn);
$data_novel = all_novel($conn);
if(isset($_GET['s'])){
    $s = $_GET['s'];
}else{
    $s = "";
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $f = "no='$id'";
    $t = get_series($f,$conn);
    $title = $t[0]['judul_artikel'];
}else{
    $s = "";
    $title = "";
}
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Habar-Novel - <?php echo $title; ?></title>
    <link rel="icon" href="https://habaranime.info/ampunnya/dist/img/logo-blog1.png" type="image/x-icon" />
     <meta name='description' content='Website Novel terupdate'>
    <meta name='keywords' content='novel,ligth novel,web novel'>
    <meta name='author' content='habaranime'>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://habaranime.info/ampunnya/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://habaranime.info/ampunnya/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <!-- iklan google -->
    <!--Pemulihan pemblokiran iklan -->
    <script async src="https://fundingchoicesmessages.google.com/i/pub-9086552134201347?ers=1" nonce="Wj6qKpmWYrmlc5YriluonA"></script><script nonce="Wj6qKpmWYrmlc5YriluonA">(function() {function signalGooglefcPresent() {if (!window.frames['googlefcPresent']) {if (document.body) {const iframe = document.createElement('iframe'); iframe.style = 'width: 0; height: 0; border: none; z-index: -1000; left: -1000px; top: -1000px;'; iframe.style.display = 'none'; iframe.name = 'googlefcPresent'; document.body.appendChild(iframe);} else {setTimeout(signalGooglefcPresent, 0);}}}signalGooglefcPresent();})();</script>
    <!--iklan-->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9086552134201347"
     crossorigin="anonymous"></script>
     <!-- google analitic -->
     <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VD5ZZHNSKX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VD5ZZHNSKX');
</script>
</head>

<body class="hold-transition layout-top-nav fixed-navbar ">
    <div class="wrapper pb-3">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="./" class="navbar-brand">
                    <img src="https://habaranime.info/ampunnya/dist/img/logo-blog1.png" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Habar-Novel</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="./" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-toggle">Project</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <?php
                                foreach($data_novel as $novel){
                                   
                                ?>
                                <li><a href="?s=page&id=<?php echo get_output($novel['no']); ?>&j=<?php echo get_output($novel['judul_artikel']); ?>" class="dropdown-item"><?php echo get_output($novel['judul_artikel']); ?></a></li>
                                <?php 
                                }
                                ?>
                                <!-- End Level two -->
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="http://habaranime.info" class="nav-link">Blog</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <?php
        if($s != ""){
            if($s == "page"){
                include_once "./pages/page.php";
            }else{
                include_once "./pages/single_page.php";
            }
        }else{
            include "./pages/homepage.php";
        }
        ?>

        <!-- Main Footer -->
        <?php 
        // include_once "../footer.php"; 
        ?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="https://habaranime.info/ampunnya/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://habaranime.info/ampunnya/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://habaranime.info/ampunnya/dist/js/adminlte.min.js"></script>
    
</body>

</html>