<?php
include("proses/koneksi.php");
SESSION_START();

 $sesi = $_GET['id'];
 $query = "SELECT *, detail_transaksi.harga_barang as hb FROM detail_transaksi INNER JOIN sesi_transaksi on sesi_transaksi.id_sesi = detail_transaksi.fk_id_sesi INNER JOIN produk on detail_transaksi.fk_id_produk = produk.id_produk WHERE fk_id_sesi = '$sesi'";
 $execute = mysqli_query($koneksi, $query);
 
     ?>
      <div class = "col-lg-12">
         <center>
         <table id="datatable" class="table " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Gambar Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Barang </th>
                                    <th>Harga Barang</th>
                                    <th>Total Harga</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                             <?php 
                             $hargaSe = 0;
                             while($output = mysqli_fetch_assoc($execute)){
                                $id =  $output['id_produk'];
                                $gambar = $output['gambar_produk'];
                                $stok = $output['quantity_barang'];
                                $harga = $output['hb'];
                                $total = $stok * $harga;
                                $hargaSe += $total;
                                $tipe = $output['tipe_sesi'];
                                $detail = $output['id_detail'];
                             ?>
                                <tr>
                                    <td> <image height ="100px" width ="100px" src="<?php echo getDirectoryProduct().$gambar; ?>"></td>
                                    <td> <?php echo $output['nama_produk']; ?>  </td>
                                    <td> <?php echo $stok?>  </td>
                                    <td> <?php echo rupiah($harga); ?>  </td>
                                    <td> <?php echo  rupiah($total); ?>  </td>
                                    <td> <a href="proses/prosesDeleteProduk.php?sesi=<?php echo $sesi; ?>&id=<?php echo $detail;?>"> <p class="btn btn-danger">X</p>  </a></td>
                                </tr>
                                <?php
                                }
                                if($tipe == "1" || $tipe =="2"){
                                    $level = $_SESSION['level'];
                                    $query3 = "SELECT * FROM konfigurasi WHERE fk_id_level ='$level'";
                                    $exe3 = mysqli_query($koneksi, $query3);
                                    $trik = mysqli_fetch_assoc($exe3);
                                    $deposit = $trik['deposit'];
                            ?>
                             <tr>
                                <td colspan = "4"><center>Deposit Pendaftaran Pertama</center></td>
                                <td><?php
                                    echo rupiah($deposit); ?>  </td>
                            </tr> 
                            <?php 
                                }else {
                                    $deposit = 0;
                                }
                                ?>    
                            <tr>
                                <td colspan = "4"><center>Total Semua</center></td>
                                <td> <input type = "hidden" id="aaaaa" value="<?php echo  $hargaSe+$deposit; ?>">
                                <?php
                                    echo rupiah($hargaSe+$deposit); ?>  </td>
                            </tr>        
                            </tbody>
                          
                        </table>

             
         </center>
     </div>
