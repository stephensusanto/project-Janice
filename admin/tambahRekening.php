<!DOCTYPE html>
<html lang="en">
<?php
    include("header.php");
?>

       <!-- Begin Page Content -->
       <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tambah Data Rekening</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    
    </div>
  <div class="card-body">
    <div class="table-responsive">
    <form id="form_send" action='proses/prosesTambahRekening.php' method ='post'  enctype="multipart/form-data">	
          <input type='hidden' name='id' id="id">
          <label >Nama Rekening</label>
          <input type="text" name="nama"  placeholder="Nama Rekening" class="form-control" > <br>
          <label >Nomor Rekening</label>
          <input type="text" name="nomor" onkeypress='validate(event)'  placeholder="Nomor Rekening" class="form-control" ><br>

          <label >Bank Rekening</label>
          <input type="text" name="bank"  placeholder="Bank Rekening" class="form-control" > <br>

          <input type='submit' class="btn btn-primary" value='submit'>


          </form>
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