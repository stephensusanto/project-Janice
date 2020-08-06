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
    <title>Konfirmasi Pembelian </title>
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
                        <li><a href="#">Konfirmasi Pembelian</a> </li>
                        
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
                        <h4>Data Pembelian Anda</h4>
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
                                    <th>Order ID</th>
                                    <th>Distributor</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Total Harga</th>
                                    <th>Rekening Tujuan</th>
                                    <th>Tanggal Pembelian</th> 
                                    <th>Status Pembelian</th>
                                                              
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $id_u = $_SESSION['id_user'];
                                    if($_SESSION['level'] == "3"){
                                        $sql  = "SELECT * FROM sesi_transaksi INNER JOIN detail_transaksi on detail_transaksi.fk_id_sesi = sesi_transaksi.id_sesi INNER JOIN produk on detail_transaksi.fk_id_produk = produk.id_produk INNER JOIN konfirmasi_pembayaran on konfirmasi_pembayaran.fk_id_sesi_transaksi = sesi_transaksi.id_sesi INNER JOIN rekening on rekening.id_rekening = konfirmasi_pembayaran.fk_id_rekening WHERE (tipe_sesi = '1' AND fk_id_u = '$id_u') OR (tipe_sesi ='3' AND fk_id_u = '$id_u') AND konfirmasi_pembayaran.konfirmasi_status = '1' ";
                                    }else {
                                        $sql  = "SELECT * FROM sesi_transaksi INNER JOIN detail_transaksi on detail_transaksi.fk_id_sesi = sesi_transaksi.id_sesi INNER JOIN produk on detail_transaksi.fk_id_produk = produk.id_produk INNER JOIN user on sesi_transaksi.id_distributor = user.id_user INNER JOIN konfirmasi_pembayaran on konfirmasi_pembayaran.fk_id_sesi_transaksi = sesi_transaksi.id_sesi INNER JOIN rekening on rekening.id_rekening = konfirmasi_pembayaran.fk_id_rekening  WHERE (tipe_sesi = '2' AND fk_id_u = '$id_u') OR (tipe_sesi ='4' AND fk_id_u = '$id_u') AND konfirmasi_pembayaran.konfirmasi_status = '1'";
                                    }
                                    
                                    $jalan =mysqli_query($koneksi, $sql);

                                    while($output = mysqli_fetch_assoc($jalan)){
                                        $id = $output['id_sesi'];
                                        if($_SESSION['level'] == "4"){
                                            $nama = $output['nama_u'];
                                        }
                                        else {
                                            $nama = "Dak Dak";
                                        }
                                        $orderId = "#".$output['id_sesi']."-".$id_u."-".$nama;
                                        
                                        $tgl = $output['tanggal_sesi'];
                                        $status = $output['status_sesi'];
                                        $produk = $output['nama_produk'];
                                        $harga = $output['harga_barang'];
                                        $qty = $output['quantity_barang'];
                                        $totalHarga = $harga * $qty;
                                        $rekening = $output['bank_rekening']."-".$output['nomor_rekening'];
                                        if($status == 0){
                                            $st ="Belum Lunas";
                                        }else {
                                            $st = "Sudah Lunas";
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $orderId ;?></td>
                                            <td><?php echo $nama;?></td>
                                            <td><?php echo $produk;?></td>
                                            <td><?php echo rupiah($harga);?></td>
                                            <td><?php echo $qty." pcs";?></td>
                                            <td><?php echo rupiah($totalHarga);?></td>
                                            <td><?php echo $rekening;?></td>
                                            <td><?php echo date("d-m-Y", strtotime($tgl));?></td>
                                            <td><?php echo $st;?></td>
                                           
                                        </tr>
                                   <?php } ?>

                            

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Distributor</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Total Harga</th>
                                    <th>Rekening Tujuan</th>
                                    <th>Tanggal Pembelian</th> 
                                    <th>Status Pembelian</th>
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
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div id="modal-body" class="modal-body">
                    
                </div>
            </div>
            </div>
        </div>
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
                    title: 'Data Pembelian',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'pdf',
                    title: 'Data Pembelian',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'excel',
                    title: 'Data Pembelian',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'csv',
                    title: 'Data Pembelian',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'copy',
                    title: 'Data Pembelian',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }]
            });
            table.buttons().container().appendTo('#export_buttons');
            $("#export_buttons .btn").removeClass('btn-secondary').addClass('btn-light');
        });
        $("a[data-toggle=modal]").click(function() {
            var id_beli = $(this).attr('id');
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "proses/detailProdukBelanja.php?id="+id_beli,
                success: function(msg){
                    $('#myModal').show();
                    $('#modal-body').show().html(msg); //this part to pass the var                                                                                                       
                }
            });       
        });
    </script>
</body>

</html>