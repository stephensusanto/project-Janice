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
                        <li><a href="index.php">Home</a> </li>
                        <li><a href="profile.php">Profile</a> </li>  
                        
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
                
                        <h1>Profile Anda</h1>
                          <?php
                        if (empty($_GET['alert'])) {
                            echo "";
                        } 

                        elseif ($_GET['alert'] == 1) {
                            echo "<div class='alert alert-danger alert-dismissable'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4>  <i class='icon fa fa-times-circle'></i> Gagal Melakukan Perubahan Data!</h4>
                                    Ada Data yang Kosong Mohon Mengisi Semua Data!
                                </div>";
                        }
                        elseif ($_GET['alert'] == 2) {
                            echo "<div class='alert alert-success alert-dismissable'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4>  <i class='icon fa fa-check-circle'></i> Success!</h4>
                                    Anda Telah Berhasil Merubah Data Pribadi Anda!
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
               
                               <a href="gantiProfile.php"> <button class="btn btn-lg btn-slide " data-width="240" href="#">
                                    <i class="fa fa-cog"></i>
                                    <span>Ganti Profile</span>
                                </button> </a>
                
                     
                                <a href="gantiPass.php">  <button class="btn btn-lg btn-slide btn-dark" data-width="240" href="#">
                                    <i class="fa fa-lock"></i>
                                    <span>Ganti Password</span>
                                </button>
                                </a>
                                <?php 
                                    $id =$_SESSION['id_user'];
                                    $query = "SELECT * FROM user INNER JOIN domisili on domisili.id_dom = user.fk_id_domisili WHERE id_user = '$id'";
                                    $exe = mysqli_query($koneksi, $query);
                                    $tarik = mysqli_fetch_assoc($exe);
                                    $array = array();
                                    $array = explode(",",$tarik['alamat_u']);
                                ?>
                            <div class="row">
                                    <div class="col-lg-12 form-group">
                                        <label >Name</label>
                                        <input type="text" name="nama" value="<?php echo $tarik['nama_u'] ;?>" placeholder="Name" class="form-control" readonly>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label >Email</label>
                                        <input type="text" name="email" value="<?php echo $tarik['email_u']; ?>" placeholder="Email" class="form-control" readonly>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label>Password</label>
                                        <input type="password" name="pass" value="<?php echo $tarik['password_u']; ?>" placeholder="Password" class="form-control" readonly>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label >Birth Date</label>
                                        <input type="Date" name="dob" value="<?php echo $tarik['dob_u']; ?>" placeholder="Password" class="form-control" readonly>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label >Address</label>
                                        <input type="text" name="alamat" value="<?php echo $array[0]; ?>" placeholder="Address" class="form-control" readonly>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label >Delivery Address</label>
                                        <input type="text" name="alamat" value="<?php echo $tarik['alamat_pengiriman'];  ?>" placeholder="Address" class="form-control" readonly>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label >Apartment, suite, unit etc.</label>
                                        <input type="text" name = "blok" value="<?php echo $array[1]; ?>" placeholder="Apartment, suite, unit etc." class="form-control" readonly>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label >Domisili</label>
                                        <input type="text" name = "blok" value="<?php echo $tarik['nama_dom']; ?>" placeholder="Apartment, suite, unit etc." class="form-control" readonly>
                                    </div>
                                    
                                    <div class="col-lg-6 form-group">
                                        <label >Postcode / Zip</label>
                                        <input type="text" name = "kodepos" value="<?php echo $array[2]; ?>" placeholder="Postcode / Zip" class="form-control" readonly>
                                    </div>
                                   
                                    <div class="col-lg-6 form-group">
                                        <label >Phone</label>
                                        <input type="text" name="telp" value="<?php echo $tarik['telp_u']; ?>" placeholder="Phone" class="form-control" readonly>
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