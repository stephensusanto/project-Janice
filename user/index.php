<!DOCTYPE html>
<?php 
    SESSION_START();
    include ("proses/koneksi.php");
    if(!$_SESSION['nama_u']){
        header("location:login.php");
    }

?>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="INSPIRO" />
    <meta name="description" content="Themeforest Template Polo">
    <!-- Document title -->
    <title>Home </title>
    <!-- DataTables css -->
    <link href='plugins/datatables/datatables.min.css' rel='stylesheet' />
    <!-- Stylesheets & Fonts -->
    <link href="css/plugins.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Body Inner -->
    <div class="body-inner">
        <!-- Header -->
        <header id="header" data-fullwidth="true">
            <div class="header-inner">
                <div class="container">
                    <!--Logo-->
                    
                    <div id="logo"> <a href="index.html"><span class="logo-default">DAKDAK SALTED EGG</span><span class="logo-dark">POLO</span></a> </div>
                    <!--End: Logo-->
                    <!-- Search -->
                    <div id="search"><a id="btn-search-close" class="btn-search-close" aria-label="Close search form"><i class="icon-x"></i></a>
                        <form class="search-form" action="search-results-page.html" method="get">
                            <input class="form-control" name="q" type="search" placeholder="Type & Search..." />
                            <span class="text-muted">Start typing & press "Enter" or "ESC" to close</span>
                        </form>
                    </div>
                    <!-- end: search -->
                    <!--Header Extras
                    <div class="header-extras">
                        <ul>
                            <li>
                                <a id="btn-search" href="#"> <i class="icon-search"></i></a>
                            </li>
                            <li>
                                <div class="p-dropdown">
                                    <a href="#"><i class="icon-globe"></i><span>EN</span></a>
                                    <ul class="p-dropdown-content">
                                        <li><a href="#">French</a></li>
                                        <li><a href="#">Spanish</a></li>
                                        <li><a href="#">English</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--end: Header Extras-->
                    <!--Navigation Resposnive Trigger-->
                    <?php 
                        include("header.php");
                    ?>
                    <!--end: Navigation-->
                </div>
            </div>
        </header>
        <!-- end: Header -->
        <!-- Page title -->
        <section id="page-title" data-bg-parallax="images/bg2.jpg" >
            <div class="container">
                <div class="page-title">
                <h1>Selamat Datang <?php if($_SESSION['level'] == "3"){
                        echo "Distributor ". $_SESSION['nama_u']; 
                    }else {
                        echo "Reseller ". $_SESSION['nama_u'];
                     } ?></h1>
                    <span>Inspiration comes of working every day.</span>
                </div>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">Home</a> </li>
                        
                    </ul>
                </div>
            </div>
        </section>
        <!-- end: Page title -->
        <!-- Page Menu -->
      <!-- end: Page Menu -->
        <!-- Page Content -->
        <section id="page-content" class="no-sidebar">
            <div class="container">
            <?php
            $level = $_SESSION['level'];
            $query ="SELECT * from konfigurasi WHERE fk_id_level = '$level'";
            $jalan2 = mysqli_query($koneksi, $query);
            $keluar = mysqli_fetch_assoc($jalan2);
            $minimum = $keluar['minimal_pembelian'];
                if (empty($_GET['alert'])) {
                    echo "<div class='alert alert-danger'>
                    <center><h4>Limit Pembelian!</h4>
                    Pembelian Minimal Anda adalah ".$minimum." pcs!</center>
                </div>";
                } 


            ?>
                <!-- DataTable -->
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <h4>Notifikasi</h4>
                    </div>
                    <?php
                    if($_SESSION['level'] == "3"){
                    ?>

                    <div class="col-lg-6">
                        <h4>Stock</h4>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="row">
                <?php 
                  if($_SESSION['level'] == "3"){
                      ?>
                    <div class="col-lg-6">
                    <?php 
                  }else {
                      ?>
                     <div class="col-lg-12"> 
                     <?php
                  }
                  ?>
                        <table id="datatable2" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Notifikasi</th>
                                    <th>Tanggal</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $id_u = $_SESSION['id_user'];
                                    $sql  = "SELECT * FROM notifikasi WHERE notifikasi_untuk_id = '$id_u' ORDER BY notifikasi_tgl DESC";
                                    $jalan =mysqli_query($koneksi, $sql);
                                    $no = 1;
                                    while($output = mysqli_fetch_assoc($jalan)){
                                        $notifikasi = $output['notifikasi_isi'];
                                        $date = $output['notifikasi_tgl'];
                                        ?>
                                        <tr>
                                            <td><?php echo $no ;?></td>
                                            <td><?php echo $notifikasi;?></td>
                                            <td><?php echo date("d-m-Y h:i:s", strtotime($date)); ?> </td>
                                        </tr>
                                   <?php 
                                   $no+=1;
                                } ?>

                            

                            </tbody>
                            <tfoot>
                                <tr>
                                <th>No</th>
                                <th>Notifikasi</th>
                                <th>Tanggal</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <?php 
                      if($_SESSION['level'] == "3"){
                          ?>
                    <div class="col-lg-6">
                        <table id="datatable" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Barang</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $id_u = $_SESSION['id_user'];
                                    $sql  = "SELECT * FROM stock INNER JOIN produk on produk.id_produk = stock.fk_id_produk WHERE stock.fk_id_user = '$id_u'";
                                    $jalan =mysqli_query($koneksi, $sql);
                                    $no = 1;
                                    while($output = mysqli_fetch_assoc($jalan)){
                                        $nama = $output['nama_produk'];
                                        $stock = $output['jumlah_stock'];
                                        ?>
                                        <tr>
                                            <td><?php echo $no ;?></td>
                                            <td><?php echo $nama;?></td>
                                            <td><?php echo $stock; ?> </td>
                                        </tr>
                                   <?php 
                                   $no+=1;
                                } ?>

                            

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Barang</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <?php
                      }
                      ?>
                </div>
                <!-- end: DataTable -->
            </div>
        </section>
        <!-- end: Page Content -->
        <!-- Footer -->
        <?php 
                        include("footer.php");
                    ?>
        <!-- end: Footer -->
    </div> <!-- end: Body Inner -->
    <!-- Scroll top -->
    <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
    <!--Popover plugin files-->
    <script src="plugins/popper/popper.min.js"></script>

    <!--Plugins-->
    <script src="js/jquery.js"></script>
    <script src="js/plugins.js"></script>

    <!--Template functions-->
    <script src="js/functions.js"></script>

    <!--Datatables plugin files-->
    <script src='plugins/datatables/datatables.min.js'></script>
    <script>
        $(document).ready(function () {
            var table = $('#datatable').DataTable({
                buttons: [{
                    extend: 'print',
                    title: 'Test Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'pdf',
                    title: 'Test Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'excel',
                    title: 'Test Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'csv',
                    title: 'Test Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'copy',
                    title: 'Test Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }]
            });
            var table = $('#datatable2').DataTable({
                buttons: [{
                    extend: 'print',
                    title: 'Test Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'pdf',
                    title: 'Test Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'excel',
                    title: 'Test Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'csv',
                    title: 'Test Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'copy',
                    title: 'Test Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }]
            });
            table.buttons().container().appendTo('#export_buttons');
            $("#export_buttons .btn").removeClass('btn-secondary').addClass('btn-light');
        });
    </script>
</body>

</html>