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
                        <li><a href="#">Pemesanan</a> </li>
                        
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
                        <h4>Pemesanan</h4>
                    </div>
                    <div class="col-lg-6 text-right">
                        <div id="export_buttons" class="mt-2"></div>
                        
                    </div>
                </div>
    <div class="form-group">
		<?php
			if($_SESSION['level'] == "4"){

		?>
		<label class="sr-only">Domisili</label>
			<select class="form-control " name="domisili" id="domisili">
				<option>Pilih Domisili</option>
				<?php
				$query = "SELECT * FROM domisili where status_dom = '1'";
				$tampilin = mysqli_query($koneksi, $query);
				while($output = mysqli_fetch_array($tampilin)){
					$id = $output['id_dom'];
					$nama = $output['nama_dom'];
				
				?>
					<option value="<?php echo $id; ?>"><?php echo $nama; ?></option>
				<?php
				}
				?>
			</select>
	</div>
		<div class="form-group m-b-5">
			<label class="sr-only">User</label>
			<select class="form-control " name="list_user" id="list_user">
					<option>Pilih User</option>
				  
			</select>
		</div>
				<?php
				}
				?>
                   

               
                <div class="row" id="produk">
                    <?php 
                    if($_SESSION['level'] == "3"){ //jika sebagai distributor
                        $query = "SELECT * FROM produk WHERE status_produk ='1'";
                        $execute = mysqli_query($koneksi, $query);
                        while($output = mysqli_fetch_assoc($execute)){
                            $id =  $output['id_produk'];
                            $gambar = $output['gambar_produk'];
                            ?>
                             <div class = "col-lg-4">
                                <center>
                                    <image height ="300px" width ="300px" src="<?php echo getDirectoryProduct().$gambar; ?>">
                                    <div class="col-lg-12 form-group">
                                        <b> <?php echo $output['nama_produk']; ?> </b>
                                        <p> <?php echo $output['desc_produk']; ?> </p>
                                       <a href= "detailProduk.php?id=<?php echo $id;?>"> <button class="btn" type="input">Detail Produk</button></a>
                                    </div>
                                </center>
                            </div>
                        <?php
                        }
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
    $("#domisili").change(function(){
       var id_dom = $(this).val(); 
       $.ajax({
          type: "POST",
          dataType: "html",
          url: "data_user.php?dom="+id_dom,
          success: function(msg){
             $("select#list_user").html(msg);                                                                                                           
          }
       });                    
     });  
     $("#list_user").change(function(){
       var user = $(this).val(); 
       $.ajax({
          type: "POST",
          dataType: "html",
          url: "data_produk.php?id="+user,
          success: function(msg){
             $("div#produk").html(msg);                                                                                                           
          }
       });                    
     });  
    </script>
</body>

</html>