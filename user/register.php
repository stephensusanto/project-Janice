<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="INSPIRO" />
    <meta name="description" content="Themeforest Template Polo">
    <!-- Document title -->
    <title>Register Dak Dak Distributor System</title>
    <!-- Stylesheets & Fonts -->
    <link href="css/plugins.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Body Inner -->
    <div class="body-inner">
        <!-- Section -->
        <section class="fullscreen" style="background-image: url(images/bg1.jpg)">
            <div class="container container-fullscreen">
                <div class="text-middle">
                    <div class="text-center m-b-30">
                        <a href="index.html" class="logo">
                            
                        </a>
                    </div>
                    <div class="row">
                        
                        <div class="col-lg-6 center p-40 background-white b-r-6">
                            <center>    
                                   
                                <img style="width:40%" src="images/logo.jpeg" alt="Polo Logo"> 
                                <?php
                                if (empty($_GET['alert'])) {
                                    echo "";
                                } 

                                elseif ($_GET['alert'] == 1) {
                                    echo "<div class='alert alert-danger alert-dismissable'>
                                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                            <h4>  <i class='icon fa fa-times-circle'></i> Gagal Melakukan Registrasi!</h4>
                                            Mohon memeriksa kembali semua data Anda!
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
                            </center>
                                <form action ="proses/prosesRegistrasi.php" method="POST" class="form-transparent-grey">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3>Register New Account</h3>
                                        <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label >Name</label>
                                        <input type="text" name="nama" value="" placeholder="Name" class="form-control">
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label >Email</label>
                                        <input type="email" name="email" value="" placeholder="Email" class="form-control">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label>Password</label>
                                        <input type="password" name="pass" value="" placeholder="Password" class="form-control">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label >Birth Date</label>
                                        <input type="Date" name="dob" value="" placeholder="Password" class="form-control">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label>Re-Enter Password</label>
                                        <input type="password" name="passb" value="" placeholder="Password" class="form-control">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label >Sebagai</label>
                                        <select class="form-control " name="level">
                                            <option>Pilih Pendaftaran</option>
                                            <?php
                                            include("proses/koneksi.php");
                                            $query = "SELECT * FROM level where status_level = '1' AND id_level = '3' OR id_level = '4'";
                                            $tampilin = mysqli_query($koneksi, $query);
                                            while($output = mysqli_fetch_array($tampilin)){
                                                $id = $output['id_level'];
                                                $nama = $output['nama_level'];
                                            
                                            ?>
                            
                                                <option value="<?php echo $id; ?>"><?php echo $nama; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label >Address</label>
                                        <input type="text" name="alamat" value="" placeholder="Address" class="form-control">
                                    </div>
                                    
                                    <div class="col-lg-6 form-group">
                                        <label >Apartment, suite, unit etc.</label>
                                        <input type="text" name = "blok" value="" placeholder="Apartment, suite, unit etc." class="form-control">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label >Town / City</label>
                                        <select class="form-control " name="domisili">
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
                                    
                                    <div class="col-lg-6 form-group">
                                        <label >Postcode / Zip</label>
                                        <input type="text" name = "kodepos" value="" onkeypress='validate(event)' placeholder="Postcode / Zip" class="form-control">
                                    </div>
                                   
                                    <div class="col-lg-6 form-group">
                                        <label >Phone</label>
                                        <input type="text" name="telp" onkeypress='validate(event)' value="" placeholder="Phone" class="form-control">
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label >Delivery Address</label>
                                        <textarea name="deliv" value="" placeholder="Address" class="form-control"></textarea>
                                        
                                    </div>
                                  
                                    <div class="col-lg-12 form-group">
                                        <button class="btn" type="input">Register New Account </button>
                                        <a href ="login.php" ><button type="button" class="btn btn-danger m-l-10">Cancel</button></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: Section -->
    </div>
    <!-- end: Body Inner -->
    <!-- Scroll top -->
    <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
    <!--Plugins-->
    <script src="js/jquery.js"></script>
    <script src="js/plugins.js"></script>
    <!--Template functions-->
    <script src="js/functions.js"></script>
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