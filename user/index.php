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
                    <h1>Selamat Datang Distributor <?php echo $_SESSION['nama_u']; ?></h1>
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
                <!-- DataTable -->
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <h4>Data Penjualan Anda</h4>
                    </div>
                    <div class="col-lg-6 text-right">
                        <div id="export_buttons" class="mt-2"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="datatable" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama Pembeli</th>
                                    <th>Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Harga</th>
                                    <th>Tanggal Pembelian</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $id_u = $_SESSION['id_user'];
                                    $sql  = "SELECT * FROM sesi_transaksi 
                                    INNER JOIN detail_transaksi on detail_transaksi.fk_id_sesi = sesi_transaksi.id_sesi 
                                    INNER JOIN user on user.id_user = sesi_transaksi.fk_id_u 
                                    INNER JOIN produk on produk.id_produk = detail_transaksi.fk_id_produk
                                    WHERE (status_sesi ='1' 
                                    AND sesi_transaksi.id_distributor= '$id_u') ";
                                    $jalan =mysqli_query($koneksi, $sql);

                                    while($output = mysqli_fetch_assoc($jalan)){
                                        $namaPembeli = $output['nama_u'];
                                        $barang = $output['nama_produk'];
                                        $jml = $output['quantity_barang'];
                                        $harga =$output['harga_barang'];
                                        $total = $jml * $harga;
                                        $tgl = $output['tanggal_sesi'];
                                        ?>
                                        <tr>
                                            <td><?php echo $namaPembeli ;?></td>
                                            <td><?php echo $barang;?></td>
                                            <td><?php echo $jml;?></td>
                                            <td><?php echo rupiah($harga);?></td>
                                            <td><?php echo rupiah($total);?></td>
                                            <td><?php echo date("d-m-Y", strtotime($tgl));?></td>
                                        </tr>
                                   <?php } ?>

                            

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama Pembeli</th>
                                    <th>Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Harga</th>
                                    <th>Tanggal Pembelian</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
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
            table.buttons().container().appendTo('#export_buttons');
            $("#export_buttons .btn").removeClass('btn-secondary').addClass('btn-light');
        });
    </script>
</body>

</html>