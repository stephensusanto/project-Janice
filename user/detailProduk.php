<!DOCTYPE html>
<?php 
    SESSION_START();
    include ("proses/koneksi.php");
    if(!$_SESSION['nama_u']){
        header("location:login.php");
    }
    $id = $_GET['id'];

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
                        <li><a href="#">Detail Produk</a> </li>
                        
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
                        <h4>Detail Produk</h4>
                    </div>
                    <div class="col-lg-6 text-right">
                        <div id="export_buttons" class="mt-2"></div>
                        
                    </div>
                </div>
                <div class="row">
                <?php
                        if (empty($_GET['alert'])) {
                            echo "";
                        } 

                        elseif ($_GET['alert'] == 1) {
                            echo "<div class='alert alert-danger alert-dismissable'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4>  <i class='icon fa fa-times-circle'></i> Gagal Melakukan Penambahan Ke Keranjang!</h4>
                                    Data Yang Anda Input Tidak Sesuai!
                                </div>";
                        }
                        elseif ($_GET['alert'] == 2) {
                            echo "<div class='alert alert-success alert-dismissable'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4>  <i class='icon fa fa-check-circle'></i> Success!</h4>
                                    Anda Telah Berhasil Memasukan Produk ke Keranjang Anda!
                                </div>";
                        }
                        elseif ($_GET['alert'] == 3) {
                          echo "<div class='alert alert-info alert-dismissable'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <h4>  <i class='icon fa fa-check-circle'></i> Gagal!</h4>
                                  Terjadi kesalahan pada server silahkan mencoba beberapa saat lagi!
                              </div>";
                      }
                    ?>
                  <?php 
                    $query = "SELECT * FROM produk WHERE id_produk = '$id'";
                    $execute = mysqli_query($koneksi,$query);
                    $output = mysqli_fetch_assoc($execute);
                    if($_SESSION['level'] == "4"){
                        $user = $_GET['user'];
                        $query2 = "SELECT * from user WHERE id_user = '$user'";
                        $exe = mysqli_query($koneksi, $query2);
                        $tarik = mysqli_fetch_assoc($exe);
                    }
                   
                  ?>
                <div class="col-sm-12" style ="float: right important!;">
					<div style ="margin-bottom: 40px;overflow: hidden;margin-top: 10px;"><!--product-details-->
						<div style ="float: left;" class="col-sm-5">
							<div style = "position: relative;">
								<img style ="vertical-align: middle;" width="300px" height = "300px" src="<?php echo getDirectoryProduct().$output['gambar_produk']; ?>"  alt="" />
							</div>
						</div>
                        <form method="post" action="proses/tambahKeranjang.php?id=<?php echo $id?>&&hb=<?php if($_SESSION['level'] == '3'){echo $output['harga_produk'];}else {echo $_GET['harga'];} ?>&&d=<?php if($_SESSION['level'] == "3"){ echo "1";}else { echo $tarik['id_user'];} ?>&stock=<?php  if($_SESSION['level'] == "3"){ echo "0";}else { echo $_GET['stock'];} ?>">
                            <div  style ="float: left;" class="col-sm-7">
                                <div style = "border: 1px solid #F7F7F0;overflow: hidden;padding-bottom: 60px;padding-left: 60px;padding-top: 60px;position: relative;"><!--/product-information-->
                                    <h2><?php echo $output['nama_produk'];?> </h2>
                                    <span style = "display: inline-block;margin-bottom: 8px;margin-top: 18px">
                                        <span style = "display: inline-block;margin-bottom: 8px;margin-top: 18px"><?php 
                                        if($_SESSION['level'] == '3'){
                                            echo rupiah($output['harga_produk']);  
                                        }
                                        else {
                                            echo rupiah($_GET['harga']);
                                        }
                                        ?> / pcs</span>
                                        <br>
                                        <label>Quantity:</label>
                                        <input type="text" size="3" id="qty" onkeypress='validate(event)'  name="qty" value="1" />
                                        <button id ="tombol"type="submit" name='submit' class="btn btn-fefault cart"> 
                                            <i class="fa fa-shopping-cart"></i>
                                            Add to cart
                                        </button>
                                    </span>
                                    <p><b>Stok:</b><?php 
                                     if($_SESSION['level'] == '3'){
                                        echo "No Limit";  
                                    }
                                    else {
                                        echo $_GET['stock']." pcs";
                                    }
                                    
                                    ?></p>
                                    <p><b>Seller:</b> <?php
                                     if($_SESSION['level'] == '3'){
                                        echo "Dak Dak";  
                                    }
                                    else {
                                        
                                        echo $tarik['nama_u'];
                                    }
                                    
                                    ?></p>
                                </div><!--/product-information-->
                            </div>
                        </form>
					</div><!--/product-details-->
					
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
    
       $("#tombol").change(function(){
        var level = <?php echo $_SESSION['level'];?>
        var stok = <?php echo $_GET['stock']; ?>;
        var qty = document.getElementById("qty").value; 
        if(level == "4"){
            
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