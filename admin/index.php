<!DOCTYPE html>
<html lang="en">
<?php
    include("header.php");
    
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pemesanan (Bulan Ini)</div>
                      <?php
                        include("proses/koneksi.php");
                        $tanggal = date("Y/m/d");
                        $bulan =  date("m");
                        $id_u = $_SESSION['id_user'];
                        if($_SESSION['level'] == '1' || $_SESSION['level'] == '2'){
                          $sql  = "SELECT * FROM sesi_transaksi INNER JOIN detail_transaksi on detail_transaksi.fk_id_sesi = sesi_transaksi.id_sesi INNER JOIN user on user.id_user = sesi_transaksi.id_distributor  WHERE (MONTH(tanggal_sesi) = '$bulan' AND status_sesi ='1' AND user.fk_id_level = '1') OR (MONTH(tanggal_sesi) = '$bulan' AND status_sesi ='1' AND user.fk_id_level = '2')";
                          }
                          else {
                           $sql  = "SELECT * FROM sesi_transaksi INNER JOIN detail_transaksi on detail_transaksi.fk_id_sesi = sesi_transaksi.id_sesi INNER JOIN user on user.id_user = sesi_transaksi.id_distributor  WHERE (MONTH(tanggal_sesi) = '$bulan' AND status_sesi ='1' AND sesi_transaksi.id_distributor= '$id_u') ";
                          } 
                          $cek=mysqli_query($koneksi,$sql);
                          $jumlah = mysqli_num_rows($cek);
                          $total = 0;
                          while($output = mysqli_fetch_array($cek)){
                            $jumlahBarang = $output['quantity_barang'];
                            $harga_barang = $output['harga_barang'];
                            $jumlahSemua = $jumlahBarang * $harga_barang;

                            $total += $jumlahSemua;
                          }

                      ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo rupiah($total); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pemesanan (Hari ini)</div>
                      <?php
                        
                          $tanggal = date("Y/m/d");
                          if($_SESSION['level'] == '1' || $_SESSION['level'] == '2'){
                            $sql  = "SELECT * FROM sesi_transaksi INNER JOIN detail_transaksi on detail_transaksi.fk_id_sesi = sesi_transaksi.id_sesi INNER JOIN user on user.id_user = sesi_transaksi.id_distributor WHERE (tanggal_sesi = '$tanggal' AND user.fk_id_level = '1' AND status_sesi ='1') OR (tanggal_sesi = '$tanggal' AND user.fk_id_level = '2' AND status_sesi ='1')  ";
                            }
                            else {
                              $sql  = "SELECT * FROM sesi_transaksi INNER JOIN detail_transaksi on detail_transaksi.fk_id_sesi = sesi_transaksi.id_sesi INNER JOIN user on user.id_user = sesi_transaksi.id_distributor WHERE (tanggal_sesi = '$tanggal' AND user.id_user = ' $id_u')";
                            } 
                        
                          $cek=mysqli_query($koneksi,$sql);
                          $jumlah = mysqli_num_rows($cek);
                          $total = 0;
                          while($output = mysqli_fetch_array($cek)){
                            $jumlahBarang = $output['quantity_barang'];
                            $harga_barang = $output['harga_barang'];
                            $jumlahSemua = $jumlahBarang * $harga_barang;

                            $total += $jumlahSemua;
                          }

                      ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo rupiah($total); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Produk yang Tersedia </div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                        <?php
                        
                        $tanggal = date("Y/m/d");
                          $sql  = "SELECT * FROM Produk Where status_produk = '1'";
                          $cek=mysqli_query($koneksi,$sql);
                          $jumlah = mysqli_num_rows($cek);
                        

                      ?>
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $jumlah; ?></div>
                        </div>
                        <div class="col">
                         
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Konfirmasi Pembayaran</div>
                      <?php
                          if($_SESSION['level']=='1'||$_SESSION['level']=='2'){
                            $sql  = "SELECT * FROM konfirmasi_pembayaran INNER JOIN sesi_transaksi on sesi_transaksi.id_sesi = konfirmasi_pembayaran.fk_id_sesi_transaksi  INNER JOIN user on sesi_transaksi.id_distributor = user.id_user WHERE (konfirmasi_status = '2' AND user.fk_id_level = '1') OR (konfirmasi_status = '2' AND user.fk_id_level = '2')";
                          }else {
                            $sql  = "SELECT * FROM konfirmasi_pembayaran INNER JOIN sesi_transaksi on sesi_transaksi.id_sesi = konfirmasi_pembayaran.fk_id_sesi_transaksi INNER JOIN user on sesi_transaksi.id_distributor = user.id_user WHERE (konfirmasi_status = '2' AND user.id_user = '$id_u')  ";
                          }
                          $cek=mysqli_query($koneksi,$sql);
                          $jumlah = mysqli_num_rows($cek);
                      ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlah;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-6 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-6 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Notifikasi</h6>
                
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Nomor</th>
                        <th>Notifikasi</th>
                        <th>Tanggal</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                      <th>Nomor</th>
                      <th>Notifikasi</th>
                      <th>Tanggal</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php
                                    $id_u = $_SESSION['id_user'];
                                    $sql  = "SELECT * FROM notifikasi WHERE notifikasi_untuk_id = '$id_u' ORDER BY notifikasi_tgl DESC";
                                    $jalan =mysqli_query($koneksi, $sql);
                                    $no = 1;
                                    while($output = mysqli_fetch_assoc($jalan)){
                                        $notifikasi = $output['notifikasi_isi'];
                                        $date = $output['notifikasi_tgl'];
                                        ?>
                                        <tr>
                                            <td><?php echo $no ;?></td>
                                            <td><?php echo $notifikasi;?></td>
                                            <td><?php echo date("d-m-Y h:i:s", strtotime($date)); ?> </td>
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

            <!-- Pie Chart -->
         
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
           

          
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

   <?php
     include("footer.php");
   ?>
