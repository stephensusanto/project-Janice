<!DOCTYPE html>
<html lang="en">
<?php
    include("header.php");
?>

       <!-- Begin Page Content -->
       <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Rekening</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
       <a href="tambahRekening.php"> <button style="float:right; background-color:#4295f5; color:white" class="btn btn-user">Tambah Data</button></a>
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
            <th>Nama Rekening</th>
            <th>Nomor Rekening</th>
            <th>Bank Rekening</th>
            <th>Status Rekening</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Nomor</th>
            <th>Nama Rekening</th>
            <th>Nomor Rekening</th>
            <th>Bank Rekening</th>
            <th>Status Rekening</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
        <?php
                  include("proses/koneksi.php");
                  if($_SESSION['level'] == "1" || $_SESSION['level'] == "2"){
                    $query = "SELECT * FROM rekening where fk_user_id = '0' ";
                  } 
                  
                  $nomor =1;
                  $tampilin = mysqli_query($koneksi, $query);
                  while($output = mysqli_fetch_array($tampilin)){
                   
                    $id = $output['id_rekening'];
                    $nama = $output['nama_rekening'];
                    $norek = $output['nomor_rekening'];
                    $bank = $output['bank_rekening'];
                    $status = $output['status_rekening'];
                  
                  ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $nama; ?></td>
                        <td><?php echo $norek; ?></td>
                        <td><?php echo $bank; ?></td>
                        <td><?php 
                        if($status =="0"){
                            echo "Tidak Aktif"; 
                        }
                        else {
                            echo "Aktif";
                        }
                       ?></td>
                        <td><button type='submit' data-toggle='modal' data-target='#myModal' class='btn btn-primary btn-flat btn_edit'
                            data-id='<?php echo $id ;?>'
                            data-nama='<?php echo $nama ;?>'
                            data-nomor='<?php echo $norek; ?>'
                            data-bank='<?php echo $bank; ?>'
                            data-status='<?php echo $status; ?>'> edit</button> </td>
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
          <form id="form_send" action='proses/prosesUbahRekening.php' method ='post'  enctype="multipart/form-data">	
          <input type='hidden' name='id' id="id">
          <label for="exampleInputEmail1">Nama Rekening</label>
          <input type='text'class="form-control" name='nama' id="nama"> <br>

          <label for="exampleInputEmail1">Nomor Rekening</label> <br>
          <input type='textarea' onkeypress='validate(event)'  class="form-control" name='nomor' id="nomor"><br> 

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