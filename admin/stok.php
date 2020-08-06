<!DOCTYPE html>
<html lang="en">
<?php
    include("header.php");
?>

       <!-- Begin Page Content -->
       <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Stok Barang Distributor</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
     
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
            <th>Nama Distributor</th>
            <th>Nama Barang</th>
            <th>Stock Barang</th>
     
          </tr>
        </thead>
        <tfoot>
          <tr>
          <th>Nomor</th>
            <th>Nama Distributor</th>
            <th>Nama Barang</th>
            <th>Stock Barang</th>
          </tr>
        </tfoot>
        <tbody>
        <?php
        include("proses/koneksi.php");
              $id_u = $_SESSION['id_user'];
              $sql  = "SELECT * FROM stock INNER JOIN produk on produk.id_produk = stock.fk_id_produk INNER JOIN user on stock.fk_id_user = user.id_user ORDER BY nama_u";
              $jalan =mysqli_query($koneksi, $sql);
              $no = 1;
              while($output = mysqli_fetch_assoc($jalan)){
                  $user = $output['nama_u'];
                  $nama = $output['nama_produk'];
                  $stock = $output['jumlah_stock'];
                  ?>
                  <tr>
                      <td><?php echo $no ;?></td>
                      <td><?php echo $user;?></td>
                      <td><?php echo $nama; ?> </td>
                      <td><?php echo $stock." pcs"; ?> </td>
                  </tr>
              <?php 
              $no+=1;
          } ?>

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
          <form id="form_send" action='proses/prosesEditProduk.php' method ='post'  enctype="multipart/form-data">	
          <input type='hidden' name='id_barang' id="id_barang">
          <label for="exampleInputEmail1">Nama Produk</label>
          <input type='text'class="form-control" name='nama_barang' id="nama_barang"> <br>

          <label for="exampleInputEmail1">Deskripsi Produk</label> <br>
          <input type='textarea' class="form-control" name='deskripsi_barang' id="deskripsi_barang"><br> 

          <label for="exampleInputEmail1">Harga Distributor</label>
          <input type='text' class="form-control" name='harga_barang' id="harga_barang"><br>
          <label for="exampleInputEmail1">Harga Reseller</label>

          <input type='text' class="form-control" name='harga_reseller' id="harga_reseller"><br>
          <label for="exampleInputEmail1">Gambar Produk</label> <br>
          <input type="file" name="berkas" id="berkas"> <br> <br>    
          <label for="exampleInputEmail1">Status</label>
          <Select class="form-control" name='status_barang' id="status_barang">
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
          var id_barang = $(this).data('id_barang');
          var nama_barang = $(this).data('nama_barang');
          var deskripsi_barang = $(this).data('deskripsi_barang');
          var harga_barang = $(this).data('harga_barang');
          var harga_reseller = $(this).data('harga_reseller');
          var status_barang = $(this).data('status_barang');
          
        
          $("#id_barang").val(id_barang);
          $("#nama_barang").val(nama_barang);
          $("#deskripsi_barang").val(deskripsi_barang);
          $("#harga_barang").val(harga_barang);
          
          $("#harga_reseller").val(harga_reseller);
          
          
          $("#status_barang").val(status_barang);
          
          
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