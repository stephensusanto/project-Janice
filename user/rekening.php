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
    <title>Rekening </title>
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
                        <li><a href="#">Profile</a> </li>
                        <li><a href="#">Rekening</a> </li>
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
                        <h4>Data Rekening </h4>
                    </div>
                  
                </div>
                <a href = "tambahRekening.php"><button class="btn btn">Tambah Rekening</button></a>
                <div class="row">
              
                    <div class="col-lg-12">
                    <?php
                        if (empty($_GET['alert'])) {
                            echo "";
                        } 

                        elseif ($_GET['alert'] == 1) {
                            echo "<div class='alert alert-danger alert-dismissable'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4>  <i class='icon fa fa-times-circle'></i> Gagal Melakukan Penambahan Rekening!</h4>
                                    Data Yang Anda Input Tidak Sesuai!
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
                      }
                    ?>
                        <table id="datatable" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nomor Rekening</th>
                                    <th>Bank</th>
                                    <th>Nama Rekening</th>
                                    <th>Status Rekening</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $id_u = $_SESSION['id_user'];
                                    $sql  = "SELECT * FROM rekening where fk_user_id = '$id_u'";
                                    $jalan =mysqli_query($koneksi, $sql);

                                    while($output = mysqli_fetch_assoc($jalan)){
                                        $id = $output['id_rekening'];
                                        $namaPembeli = $output['nama_rekening'];
                                        $nomor = $output['nomor_rekening'];
                                        $bank = $output['bank_rekening'];
                                        $st =$output['status_rekening'];
                                        if($st == "0"){
                                          $status = "Tidak Digunakan";
                                        }else {
                                          $status = "Digunakan";
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $nomor ;?></td>
                                            <td><?php echo $bank;?></td>
                                            <td><?php echo $namaPembeli;?></td>
                                            <td><?php echo $status;?></td>
                                            <td><button type='submit' data-toggle='modal' data-target='#myModal' class='btn btn-primary btn-flat btn_edit'
                            data-id='<?php echo $id ;?>'
                            data-nama='<?php echo $namaPembeli ;?>'
                            data-nomor='<?php echo $nomor; ?>'
                            data-bank='<?php echo $bank; ?>'
                            data-status='<?php echo $st; ?>'> edit</button> </td>
                                          
                                        </tr>
                                   <?php } ?>

                            

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nomor Rekening</th>
                                    <th>Bank</th>
                                    <th>Nama Rekening</th>
                                    <th>Status Rekening</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- end: DataTable -->
            </div>
        </section>
        <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form id="form_send" action='proses/prosesUbahRekening.php' method ='post'  enctype="multipart/form-data">	
          <input type='hidden' name='id' id="id">
          <label for="exampleInputEmail1">Nama Rekening</label>
          <input type='text'class="form-control" name='nama' id="nama"> <br>

          <label for="exampleInputEmail1">Nomor Rekening</label> <br>
          <input type='textarea' class="form-control" name='nomor' id="nomor"><br> 

          <label for="exampleInputEmail1">Bank Rekening</label>
          <input type='text' class="form-control" name='bank' id="bank"><br>

          <label for="exampleInputEmail1">Status</label>
          <Select class="form-control" name='status' id="status">
          <option value='1'> Aktif </option>
          <option value='0'> Tidak Aktif</option> 
          </select><br>
          <input type='submit' class="btn btn-primary" value='submit'>


          </form>
        </div>
      </div>
    </div>
  </div>
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
       	 $(document).ready(function() {
        $(".btn_edit").click(function(event){
          var id = $(this).data('id');
          var nama = $(this).data('nama');
          var nomor = $(this).data('nomor');
          var bank = $(this).data('bank');
          var status = $(this).data('status');

        
          $("#id").val(id);
          $("#nama").val(nama);
          $("#nomor").val(nomor);
          $("#bank").val(bank);
          
          $("#status").val(status);;
          
          
          /*
          $('#form_send').form('clear');
          $("#myModal").modal({
            backdrop: "static"
          });
          */
          
        });
  });
    </script>
</body>

</html>