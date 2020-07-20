<!DOCTYPE html>
<html lang="en">
<?php
    include("header.php");
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Konfirmasi Pembayaran</h1>
          </div>

          <!-- Content Row -->
          <div >
          <form action="proses/prosesRegistrasi.php" method ="post" class="user">
                <div class="form-group">
                 <span>Nomor Rekening</span>
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
                 <span>Rekening yang dituju</span>
                </div>
                <div class="form-group row" >
                <select class="form-control " name="tipe">
                <option>Pilih Domisili</option>
                <?php
                  include("proses/koneksi.php");
                  $query = "SELECT * FROM rekening where status_rekening = '1'";
                  $tampilin = mysqli_query($koneksi, $query);
                  while($output = mysqli_fetch_array($tampilin)){
                    $id = $output['id_rekening'];
                    $nama = $output['bank_rekening']."-".$output['nomor_rekening'];
                
                  ?>
 
                    <option value="<?php echo $id; ?>"><?php echo $nama; ?></option>
                <?php
                  }
                ?>
                  </select>
                </div>
                <br>
                <Button  class="btn btn-primary btn-user btn-block"> Register Account </Button>
               
                
              </form>
              <br>
         



           
          </div>



         
            

           
        



            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

   <?php
     include("footer.php");
   ?>
