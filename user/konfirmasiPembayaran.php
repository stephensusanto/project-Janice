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
    <title>Konfirmasi Pembayaran </title>
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
                        <li><a href="#">Konfirmasi Pembayaran</a> </li>
                        
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
            <th>Nomor</th>
            <th>Rekening Tujuan</th>
            <th>Rekening Pengirim</th>
            <th>Nama Pengirim</th>
            <th>Jumlah Transfer</th>
            <th>Tanggal Transfer</th>
            <th>Bukti Transfer</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Nomor</th>
            <th>Rekening Tujuan</th>
            <th>Rekening Pengirim</th>
            <th>Nama Pengirim</th>
            <th>Jumlah Transfer</th>
            <th>Tanggal Transfer</th>
            <th>Bukti Transfer</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
        <?php
                  $id_u = $_SESSION['id_user'];
                  if($_SESSION['level'] == "1" || $_SESSION['level'] == "2"){
                      //status 2  = menunggu konfirmasi
                    $query = "SELECT * FROM konfirmasi_pembayaran inner join sesi_transaksi on sesi_transaksi.id_sesi = konfirmasi_pembayaran.fk_id_sesi_transaksi INNER JOIN user on sesi_transaksi.id_distributor = user.id_user WHERE ( user.fk_id_level = '1') OR (  user.fk_id_level = '2') ";
                  } else {
                    $query = "SELECT * FROM konfirmasi_pembayaran inner join sesi_transaksi on sesi_transaksi.id_sesi = konfirmasi_pembayaran.fk_id_sesi_transaksi INNER JOIN user on sesi_transaksi.id_distributor = user.id_user inner join rekening on konfirmasi_pembayaran.fk_id_rekening = rekening.id_rekening  WHERE sesi_transaksi.id_distributor = '$id_u' ";
                  }
                  
                  $nomor =1;
                  $tampilin = mysqli_query($koneksi, $query);
                  while($output = mysqli_fetch_array($tampilin)){
                    $sesi = $output['id_sesi'];
                    $id = $output['id_konfirmasi'];
                    //rekening tujuan
                    if($_SESSION['level'] == "1" || $_SESSION['level'] == "2"){
                        $nomorRekeningTujuan = getNamaRekening($koneksi, $output['fk_id_rekening']);
                    }
                    else {
                        $namaBank = $output['bank_rekening'];
                        $noRekening = $output['nomor_rekening'];
                        $gabungan = $namaBank."-".$noRekening;
                        $nomorRekeningTujuan = $gabungan;
                    }
                    $bankPengirim = $output['bank_pengirim'];
                    $noRekPengirim = $output['nomor_rekening_pengirim'];
                    $dataPengirim = $bankPengirim."-".$noRekPengirim;
                    $namaPengirim = $output['nama_pengirim'];
                    $jumlahPengirim = $output['jumlah_transfer'];
                    $tTransfer = $output['tgl_transfer'];
                    $gambar = $output['bukti_transfer'];
                    $status = $output['konfirmasi_status'];
                    $tujuan = $output['fk_id_u']
                  
                  ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $nomorRekeningTujuan; ?></td>
                        <td><?php echo $dataPengirim; ?></td>
                        <td><?php echo $namaPengirim ?></td>
                        <td><?php echo rupiah($jumlahPengirim); ?></td>
                        <td><?php echo date("d-m-Y", strtotime($tTransfer)); ?></td>
                       
                        <td><image height ="100px" width ="100px" src="<?php echo getDirectoryBukti().$gambar ;?>"></td>
                        <td><?php 
                        if($status == '1'){
                            echo "Lunas"; 
                        }else if($status == '0') {
                            echo "Belum Diterima";
                        }else {
                            echo "Menunggu Konfirmasi";
                        }
                        ?></td>
                       <td>
                        <?php if($status == '2'){
                            ?>
                            <a href="proses/prosesKonfirmasi.php?d=<?php echo $tujuan;?>&u=<?php echo $id_u; ?>&code=1&level=<?php echo $_SESSION['level']; ?>&id=<?php echo $id;?>"><button type='submit'  class='btn btn-success btn-flat btn_edit'
                           > Sudah Terima</button></a>
                            <br>
                            <br>
                            <a href="proses/prosesKonfirmasi.php?d=<?php echo $tujuan;?>&u=<?php echo $id_u; ?>&code=2&level=<?php echo $_SESSION['level']; ?>&id=<?php echo $id;?>"><button type='submit'  class='btn btn-danger btn-flat btn_edit'
                           > Belum Terima</button>  </td></a>
                            <br>
                            <br>
                            <a data-toggle="modal" class="btn" href="#myModal" id="<?php echo $sesi; ?>">Detail</a>
                            <?php
                        }else {
                            ?>
                            <a data-toggle="modal" class="btn" href="#myModal" id="<?php echo $sesi; ?>">Detail</a>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                    $nomor +=1;
                 }
          ?>
        </tbody>
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