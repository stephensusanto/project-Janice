<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dak Dak - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                <?php
                        if (empty($_GET['alert'])) {
                            echo "";
                        } 

                        elseif ($_GET['alert'] == 1) {
                            echo "<div class='alert alert-danger alert-dismissable'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4>  <i class='icon fa fa-times-circle'></i> Gagal Melakukan Registrasi!</h4>
                                    Ada Data yang Kosong Mohon Mengisi Semua Data!
                                </div>";
                        }
                        elseif ($_GET['alert'] == 2) {
                            echo "<div class='alert alert-success alert-dismissable'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4>  <i class='icon fa fa-check-circle'></i> Success!</h4>
                                    Anda Telah Berhasil Melakukan Registrasi!
                                </div>";
                        }
                        elseif ($_GET['alert'] == 3) {
                          echo "<div class='alert alert-info alert-dismissable'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <h4>  <i class='icon fa fa-check-circle'></i> Success!</h4>
                                  Terjadi kesalahan pada server silahkan mencoba beberapa saat lagi!
                              </div>";
                      }
                    ?>
              </div>
              <form action="proses/prosesRegistrasi.php" method ="post" class="user">
                <div class="form-group">
                 <span>Nama</span>
                </div>
                <div class="form-group">
                 <input type="text" name="nama" class="form-control form-control-user" id="exampleLastName" placeholder="Name">
                </div>
                <div class="form-group">
                 <span>Email</span>
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                </div>
                <div class="form-group">
                 <span>Tanggal Lahir</span>
                </div>
                <div class="form-group">
                  <input type="date" name="dob" class="form-control form-control-user" id="exampleInputEmail" placeholder = "Date of birth">
                </div>
                <div class="form-group">
                 <span>Password</span>
                </div>
                <div class="form-group row">
                    <input type="password" name="pass" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                </div>
                <div class="form-group">
                 <span>Nomor Telpon</span>
                </div>
                <div class="form-group row">
                    <input type="text" name="telp" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                </div>
                <div class="form-group">
                 <span>Alamat</span>
                </div>
                <div class="form-group row">
                  <textarea name="alamat"  class="form-control form-control-user"> 
                  </textarea>
                </div>
                <div class="form-group">
                 <span>Sebagai</span>
                </div>
                <div class="form-group row">
                  <select class="form-control " name="tipe">
                    <option>Pilih</option>
                    <option value="3">Distributor</option>
                    <option value="4">Reseller</option>

                  </select>
                </div>
                <div class="form-group">
                 <span>Domisili</span>
                </div>
                <div class="form-group row" >
                <select class="form-control " name="domisili">
                <option>Pilih Domisili</option>
                <?php
                  include("proses/koneksi.php");
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
                <Button  class="btn btn-primary btn-user btn-block"> Register Account </Button>
                
                
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.php">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
