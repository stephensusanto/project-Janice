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
    <title>Pembayaran </title>
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
                        <li><a href="#">Pembayaran</a> </li>  
                        
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
                
                        <h1>Pembayaran</h1>

                                </a>
                               
                                <form action = "proses/prosesPembayaran.php" method = "POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                        <?php
                                            if (empty($_GET['alert'])) {
                                                echo "";
                                            } 

                                            elseif ($_GET['alert'] == 1) {
                                                echo "<div class='alert alert-danger alert-dismissable'>
                                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                        <h4>  <i class='icon fa fa-times-circle'></i> Gagal Melakukan Pembayaran!</h4>
                                                        Data Anda Ada yang kosong!
                                                    </div>";
                                            }
                                            elseif ($_GET['alert'] == 2) {
                                                echo "<div class='alert alert-success alert-dismissable'>
                                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                        <h4>  <i class='icon fa fa-check-circle'></i> Success!</h4>
                                                        Anda Telah Berhasil Mengubah Data Anda!
                                                    </div>";
                                            }
                                            elseif ($_GET['alert'] == 3) {
                                            echo "<div class='alert alert-info alert-dismissable'>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <h4>  <i class='icon fa fa-check-circle'></i> Gagal!</h4>
                                                    Terjadi kesalahan pada server silahkan mencoba beberapa saat lagi!
                                                </div>";
                                            } elseif ($_GET['alert'] == 4) {
                                                echo "<div class='alert alert-danger alert-dismissable'>
                                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                        <h4>  <i class='icon fa fa-times-circle'></i> Gagal Melakukan Pembayaran!</h4>
                                                        Data Pembelian anda belum sesuai limit!
                                                    </div>";
                                            }
                                        ?>
                                            <label >Detail Order</label>
                                            <select class="form-control" id="keranjang"  name="keranjang">
                                                <option>Pilih ID Order</option>
                                                <?php
                                                $user = $_SESSION['id_user'];
                                                $query = "SELECT * FROM sesi_transaksi INNER JOIN user on id_user = sesi_transaksi.id_distributor where fk_id_u = '$user' AND status_sesi != '1'";
                                                $tampilin = mysqli_query($koneksi, $query);
                                                while($output = mysqli_fetch_array($tampilin)){
                                                    $id = $output['id_sesi'];
                                                    $nama = "#".$id."-".$output['fk_id_u']."-".$output['nama_u'];
                                                
                                                ?>
                                                    <option value="<?php echo $id; ?>"><?php echo $nama; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <div id="produk" class="col-lg-12 form-group">
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <label >Rekening yang dituju</label>
                                                <select class="form-control" id="rekening" name="rekening">
                                                    <option>Pilih Rekening</option>
                                                </select>
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <label >Rekening Pengirim</label>
                                            <input type="text" onkeypress='validate(event)' name="rekP" placeholder="Rekening Pengirim" class="form-control" >
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <label >Bank Pengirim</label>
                                            <input type="text" name="bank"  placeholder="Bank Pengirim" class="form-control" >
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <label >Nama Pengirim</label>
                                            <input type="text" name="namaP"  placeholder="Nama Pengirim" class="form-control" >
                                        </div>
                                        <div id="" class="col-lg-6 form-group">
                                            <label >Jumlah Transfer</label>
                                            <input type="text" onkeypress='validate(event)' name = "trasfer" id= "transfer"  placeholder="Jumlah Transfer" class="form-control" >
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label >Tanggal Transfer</label>
                                            <input type="date" name = "dot"  placeholder="Jumlah Transfer" class="form-control" >
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <label >Bukti Transfer</label>
                                            <input type="file"  accept='image/*' name="berkas" id="berkas"  class="form-control" >
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <button id="bt" class="btn" type="input">Konfirmasi</button>
                                        </div>
                                    </div> 
                           </form>
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
       $("#keranjang").change(function(){
       var user = $(this).val(); 
       $.ajax({
          type: "POST",
          dataType: "html",
          url: "detailKeranjang.php?id="+user,
          success: function(msg){
             $("div#produk").html(msg);                                                                                                          
          }
       });
                           
     });  
     $("#keranjang").change(function(){
       var user = $(this).val(); 
       
       $.ajax({
          type: "POST",
          dataType: "html",
          url: "dataRekening.php?id="+user,
          success: function(msg){
             $("select#rekening").html(msg);                                                                                                           
          }
       });                    
     });  
    $('#transfer').change(function(e){
       var user = $(this).val(); 
       var data = $("#aaaaa").val();
       
       if(user == data == true){
         $("#bt").prop('disabled', false);
            
       } else {
         $("#bt").prop('disabled', true);
       }         
    });
 
    </script>
     <script>
        function validate(evt) {
            var theEvent = evt || window.event;
            
            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
            // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }
  </script>
</body>

</html>