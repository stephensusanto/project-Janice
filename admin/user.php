<!DOCTYPE html>
<html lang="en">
<?php
    include("header.php");
    $levelRow = $_GET['level'];
?>

       <!-- Begin Page Content -->
       <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data User</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <?php 
    if($levelRow == '2' && $_SESSION['level'] == '1'){
        ?>
        <a href="tambahUser.php?level=<?php echo $levelRow; ?>"> <button style="float:right; background-color:#4295f5; color:white" class="btn btn-user">Tambah Data</button></a>
   <?php
   }
    ?>
    </div>
  <div class="card-body">
  <?php  
      if (empty($_GET['alert'])) {
        echo "";
      } 
  
      elseif ($_GET['alert'] == 1) {
        echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-times-circle'></i> Gagal Memasukan Data</h4>
                Data yang anda masukan salah, silahkan di check kembali.
              </div>";
      }
      elseif ($_GET['alert'] == 2) {
        echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Success!</h4>
                Anda telah berhasil mengupdate data.
              </div>";
    }
    elseif ($_GET['alert'] == 3) {
      echo "<div class='alert alert-info alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Gagal!</h4>
              Terjadi Kesalahan Pada Server Mohon Dicoba Kembali
            </div>";
  }
      ?>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nomor</th>
            <th>Nama </th>
            <th>Email</th>
            <th>Tanggal lahir</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Alamat Pengiriman</th>
            <th>Domisili</th>
            <th>Level</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
             <th>Nomor</th>
            <th>Nama </th>
            <th>Email</th>
            <th>Tanggal lahir</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Alamat Pengiriman</th>
            <th>Domisili</th>
            <th>Level</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
        <?php
                  include("proses/koneksi.php");
                 
                  if($_SESSION['level'] == "1" || $_SESSION['level'] == "2"){
                    $query = "SELECT * FROM user LEFT JOIN domisili on domisili.id_dom = user.fk_id_domisili WHERE fk_id_level = '".$levelRow."'";
                  } 
                  $nomor =1;
                  $tampilin = mysqli_query($koneksi, $query);
                  while($output = mysqli_fetch_array($tampilin)){
                   
                    $id = $output['id_user'];
                    $nama = $output['nama_u'];
                    $email = $output['email_u'];
                    $dob = $output['dob_u'];
                    $telp = $output['telp_u'];
                    $alamat_u = $output['alamat_u'];
                    $alamat_p = $output['alamat_pengiriman'];
                    $level = $output['fk_id_level'];
                    $domisili = $output['fk_id_domisili'];
                    $namaDom = $output['nama_dom'];
                    $status = $output['status_u'];
                   
                  
                  ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $nama; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($dob)); ?></td>
                        <td><?php echo $telp; ?></td>
                        <td><?php echo $alamat_u; ?></td>
                        <td><?php echo $alamat_p; ?></td>
                        <td><?php 
                        if($domisili == "0"){
                            echo "Semua Domisili"; 
                        }else {
                            echo $namaDom;
                        }
                       
                        ?></td>
                        <td><?php 
                        if($level == "1"){
                            echo "Super Admin"; 
                        }
                        else if($level == "2"){
                            echo "Admin";
                        }else if($level == "3"){
                            echo "Distributor";
                        }else {
                            echo "Reseller";
                        }
                        ?></td>
                        <td><?php 
                        if($status =="0"){
                            echo "Tidak Aktif"; 
                        }
                        else if($status =="1") {
                            echo "Aktif";
                        }if($status =="2") {
                            echo "on Progress";
                        }
                        
                       ?></td>
                        
                       <td> 
                       <?php 
                       if($status == "2"){

                       }else {
                           ?>
                       <button type='submit' data-toggle='modal' data-target='#myModal' class='btn btn-primary btn-flat btn_edit'
                            data-id='<?php echo $id ;?>'
                            data-nama='<?php echo $nama ;?>'
                            data-email='<?php echo $email ;?>'
                            data-dob='<?php echo $dob; ?>'
                            data-telp='<?php echo $telp; ?>'
                            data-alamat='<?php echo $alamat_u; ?>'
                            data-alamat_p='<?php echo $alamat_p; ?>'
                            data-level='<?php echo $level; ?>'
                            data-domisili='<?php echo $domisili; ?>'
                            data-status='<?php echo $status; ?>'> edit</button>  </td>
                       <?php }
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
</div>

</div>
<!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <form id="form_send" action='proses/prosesEditUser.php?level=<?php echo $levelRow; ?>' method ='post'  enctype="multipart/form-data">	
          <input type='hidden' name='id' id="id">
          <label for="exampleInputEmail1">Nama User</label>
          <input type='text'class="form-control" name='nama' id="nama" > <br>

          <label for="exampleInputEmail1">Email User</label> <br>
          <input type='textarea' class="form-control" name='email' id="email" ><br> 

          <label for="exampleInputEmail1">Tanggal Lahir</label>
          <input type='date' class="form-control" name='dob' id="dob"><br>
          <label for="exampleInputEmail1">No. Telpon</label>

          <input type='text' class="form-control" name='telp' id="telp"><br>
          <label for="exampleInputEmail1">Alamat</label> <br>
          <textarea class="form-control" name="alamat" id="alamat"></textarea> <br>  

          <label for="exampleInputEmail1">Alamat Pengiriman</label> <br>
          <textarea class="form-control" name="alamat_p" id="alamat_p"></textarea> <br>    
        
          <label for="exampleInputEmail1">Status</label>
          <Select class="form-control" name='status' id="status" >
          <option value='1'> Aktif </option>
          <option value='0'> Tidak Aktif</option> 
          </select><br>
          <input type='submit' class="btn btn-primary" value='submit'>


          </form>
        </div>
      </div>
    </div>
  </div>



   <!-- Footer -->
   <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?php echo "Dak Dak";?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="proses/prosesLogout.php">Logout</a>
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

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <script src="js/demo/datatables-demo.js"></script>
  <script>
		 $(document).ready(function() {
        $(".btn_edit").click(function(event){
          var id = $(this).data('id');
          var nama = $(this).data('nama');
          var dob = $(this).data('dob');
          var email = $(this).data('email');
          var telp = $(this).data('telp');
          var alamat = $(this).data('alamat');
          var alamatP = $(this).data('alamat_p');
          var tipe = $(this).data('level');
          var status = $(this).data('status');
        
            if(tipe == "3" || tipe == "4"){
                $("#id").val(id);
                $("#nama").val(nama);
                $("#dob").val(dob);
                $("#email").val(email);
                $("#telp").val(telp);
                $("#alamat").val(alamat);
                $("#alamat_p").val(alamatP);
                $("#tipe").val(tipe);
                $("#status").val(status);
                document.getElementById("nama").readOnly = true; 
                document.getElementById("dob").readOnly = true; 
                document.getElementById("email").readOnly = true; 
                document.getElementById("telp").readOnly = true; 
                document.getElementById("alamat").readOnly = true;
                document.getElementById("alamat_p").readOnly = true;
                 
                document.getElementById("tipe").disabled = true; 
               
                
                
            }else {
                $("#id").val(id);
                $("#nama").val(nama);
                $("#dob").val(dob);
                $("#email").val(email);
                $("#telp").val(telp);
                $("#alamat").val(alamat);
                $("#alamat_p").val(alamatP);
                $("#tipe").val(tipe);
                $("#status").val(status);
                document.getElementById("nama").readOnly = false; 
                document.getElementById("dob").readOnly = false; 
                document.getElementById("email").readOnly = false; 
                document.getElementById("telp").readOnly = false; 
                document.getElementById("alamat").readOnly = false; 
                document.getElementById("alamat_p").readOnly = false;
                document.getElementById("tipe").disabled = false; 
            }
         
          
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