<?php
include_once "./rot/function-v2.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AdminLTE 3 | Dashboard 2</title>

    <!-- Google Font: Source Sans Pro -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    />
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css" />
    <script
      src="https://kit.fontawesome.com/a121d47811.js"
      crossorigin="anonymous"
    ></script>
    <!-- overlayScrollbars -->
    <link
      rel="stylesheet"
      href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css"
    />
    <!-- summernote -->
    <link
      rel="stylesheet"
      href="../plugins/summernote/summernote-bs4.min.css"
    />
    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css" />
    <link
      rel="stylesheet"
      href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"
    />
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css" />
    <!-- costume css  -->
    <link rel="stylesheet" href="./admin_style.css">
  </head>
  <body
    class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"
  >
    <div class="wrapper">
      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img
          class="animation__wobble"
          src="../dist/img/AdminLTELogo.png"
          alt="AdminLTELogo"
          height="60"
          width="60"
        />
      </div>

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"
              ><i class="fas fa-bars"></i
            ></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="../index.html" class="nav-link">Webpage</a>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <?php include_once "./sidebar.php"; ?>

      <!-- Content Wrapper. Contains page content -->
      <?php include_once "./page.php"; ?>
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <strong
          >Copyright &copy; 2014-2021
          <a href="https://adminlte.io">AdminLTE.io</a>.</strong
        >
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 3.2.0
        </div>
      </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>

    <!-- PAGE ../plugins -->
    <!-- jQuery Mapael -->
    <script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="../plugins/raphael/raphael.min.js"></script>
    <script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <!-- datatable  -->
    <!-- DataTables  & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Summernote -->
    <script src="../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- Select2 -->
    <script src="../plugins/select2/js/select2.full.min.js"></script>
    <script>
      $(function () {
        // Get context with jQuery - using jQuery's .get() method.
        var salesChartCanvas = $("#salesChart").get(0).getContext("2d");

        var salesChartData = {
          labels: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
          ],
          datasets: [
            {
              label: "Digital Goods",
              backgroundColor: "rgba(60,141,188,0.9)",
              borderColor: "rgba(60,141,188,0.8)",
              pointRadius: false,
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [28, 48, 40, 19, 86, 27, 90],
            },
            {
              label: "Electronics",
              backgroundColor: "rgba(210, 214, 222, 1)",
              borderColor: "rgba(210, 214, 222, 1)",
              pointRadius: false,
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [65, 59, 80, 81, 56, 55, 40],
            },
          ],
        };

        var salesChartOptions = {
          maintainAspectRatio: false,
          responsive: true,
          legend: {
            display: false,
          },
          scales: {
            xAxes: [
              {
                gridLines: {
                  display: false,
                },
              },
            ],
            yAxes: [
              {
                gridLines: {
                  display: false,
                },
              },
            ],
          },
        };

        // This will get the first returned node in the jQuery collection.
        // eslint-disable-next-line no-unused-vars
        var salesChart = new Chart(salesChartCanvas, {
          type: "line",
          data: salesChartData,
          options: salesChartOptions,
        });
      });
      $(".tabel").DataTable({
          destroy: true,
          responsive: true,
          autoWidth: false,
          ordering: false,
          lengthMenu: [
              [10, 50, 100, -1],
              [10, 50, 100, "ALL"],
          ],
          buttons: ["copy", "excel", "pdf",
              {
                  extend: 'print',
                  autoPrint: true,
                  title: '<?php echo $p; ?>',

              }
          ]
        }).buttons().container().appendTo('#tabel_1_wrapper .col-md-6:eq(0)');

      $(function () {
        // Summernote
        $("#summernote").summernote();
        //Initialize Select2 Elements
        $("#select1").select2();
        $("#select2").select2();
        $("#select3").select2();
      });

    </script>
    <script>
      let navlink = document.querySelectorAll(".nav-link");
      navlink.forEach(link => {
        link.classList.remove("active");
        let queryString = window.location.search;
        let urlParams = new URLSearchParams(queryString);
        let nowAktif = urlParams.get('p');
        if(link.dataset.nav === nowAktif){
          link.classList.add("active")
        }
      });
    </script>
  </body>
</html>
