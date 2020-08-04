<?php
include("proses/koneksi.php");
SESSION_START();

 $id = $_GET['id'];
 $query = "SELECT *, detail_transaksi.harga_barang as hb FROM detail_transaksi INNER JOIN produk on detail_transaksi.fk_id_produk = produk.id_produk WHERE fk_id_sesi = '$id'";
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
                             ?>
                                <tr>
                                    <td> <image height ="100px" width ="100px" src="<?php echo getDirectoryProduct().$gambar; ?>"></td>
                                    <td> <?php echo $output['nama_produk']; ?>  </td>
                                    <td> <?php echo $stok?>  </td>
                                    <td> <?php echo rupiah($harga); ?>  </td>
                                    <td> <?php echo  rupiah($total); ?>  </td>
                                </tr>
                                <?php
                                }
                            ?>
                            
                            <tr>
                                <td colspan = "4"><center>Total Semua</center></td>
                                <td><?php
                                    $_SESSION['harga_semua'] = $hargaSe;
                                    echo rupiah($hargaSe); ?>  </td>
                            </tr>        
                            </tbody>
                          
                        </table>

             
         </center>
     </div>
