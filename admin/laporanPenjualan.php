<!DOCTYPE html>
<html lang="en">
<?php
    include("header.php");
?>

       <!-- Begin Page Content -->
       <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Penjualan</h1>


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
       <div class="row mb-3">
            <div class="col-lg-6">
                
            </div>
            <div class="col-lg-6 text-right">
                <div id="export_buttons" class="mt-2"></div>
            </div>
        </div>
    <div class="table-responsive">
      <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Distributor</th>
            <th>Nama Barang</th>
            <th>Total Harga</th>
            <th>Tanggal Pembelian</th> 
            <th>Status Pembelian</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
          <th>No</th>
            <th>Distributor</th>
            <th>Nama Barang</th>
            <th>Total Harga</th>
            <th>Tanggal Pembelian</th> 
            <th>Status Pembelian</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
        <?php
                include("proses/koneksi.php");
                                    $id_u = $_SESSION['id_user'];
                                    
                                    $sql  = "SELECT * FROM sesi_transaksi INNER JOIN detail_transaksi on detail_transaksi.fk_id_sesi = sesi_transaksi.id_sesi INNER JOIN produk on detail_transaksi.fk_id_produk = produk.id_produk INNER JOIN konfirmasi_pembayaran on konfirmasi_pembayaran.fk_id_sesi_transaksi = sesi_transaksi.id_sesi INNER JOIN rekening on rekening.id_rekening = konfirmasi_pembayaran.fk_id_rekening INNER JOIN user on user.id_user =  sesi_transaksi.fk_id_u WHERE (id_distributor = '1') OR ( id_distributor = '1') AND konfirmasi_pembayaran.konfirmasi_status = '1' ";
                                    $jalan =mysqli_query($koneksi, $sql);
                                    $no = 1;
                                    while($output = mysqli_fetch_assoc($jalan)){
                                        $id = $output['id_sesi'];
                                        $detail = $output['id_detail'];
                                        $nama = $output['nama_u'];
                                       
                                        //$orderId = "#".$output['id_sesi']."-".$id_u."-".$nama;
                                        
                                        $tgl = $output['tanggal_sesi'];
                                        $status = $output['status_sesi'];
                                        $produk = $output['nama_produk'];
                                        $harga = $output['harga_barang'];
                                        $qty = $output['quantity_barang'];
                                        $totalHarga = $harga * $qty;
                                        $rekening = $output['bank_rekening']."-".$output['nomor_rekening'];
                                        if($status == 0){
                                            $st ="Belum Lunas";
                                        }else {
                                            $st = "Sudah Lunas";
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $no ;?></td>
                                            <td><?php echo $nama;?></td>
                                            <td><?php echo $produk;?></td>
                                            <td><?php echo rupiah($totalHarga);?></td>
                                            <td><?php echo date("d-m-Y", strtotime($tgl));?></td>
                                            <td><?php echo $st;?></td>
                                            <td> <a data-toggle="modal" class="btn" href="#myModal" id="<?php echo $detail ; ?>">Detail</a></td>
                                        </tr>
                                   <?php $no+=1; } ?>
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
                <div id="modal-body" class="modal-body">
                    
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

  <script src='plugins/datatables/datatables.min.js'></script>
  <script>
	$(document).ready(function() {
        var table = $('#datatable').DataTable({
                buttons: [{
                    extend: 'print',
                    title: 'Data Pembelian',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'pdf',
                    title: 'Data Pembelian',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'excel',
                    title: 'Data Pembelian',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'csv',
                    title: 'Data Pembelian',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'copy',
                    title: 'Data Pembelian',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }]
            });
            table.buttons().container().appendTo('#export_buttons');
            $("#export_buttons .btn").removeClass('btn-secondary').addClass('btn-light');
          $("a[data-toggle=modal]").click(function() {
            var id_beli = $(this).attr('id');
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "proses/detailBarang.php?id="+id_beli,
                success: function(msg){
                    $('#myModal').show();
                    $('#modal-body').show().html(msg); //this part to pass the var                                                                                                       
                }
            });       
        });   
  });
  </script>
  
</body>

</html>