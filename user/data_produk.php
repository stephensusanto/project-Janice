<?php
include("proses/koneksi.php");
SESSION_START();

 $id = $_GET['id'];
 $query = "SELECT * FROM produk INNER JOIN stock on produk.id_produk = stock.fk_id_produk  WHERE status_produk ='1'";
 $execute = mysqli_query($koneksi, $query);
 while($output = mysqli_fetch_assoc($execute)){
     $id =  $output['id_produk'];
     $gambar = $output['gambar_produk'];
     $stok = $output['jumlah_stock'];
     $harga = $output['harga_reseller'];
     $user = $output['fk_id_user'];
     ?>
      <div class = "col-lg-4">
         <center>
             <image height ="300px" width ="300px" src="<?php echo getDirectoryProduct().$gambar; ?>">
             <div class="col-lg-12 form-group">
                 <b> <?php echo $output['nama_produk']; ?> </b>
                 <p> <?php echo $output['desc_produk']; ?> </p>
                <a href= "detailProduk.php?id=<?php echo $id;?>&stock=<?php echo $stok; ?>&harga=<?php echo $harga; ?>&user=<?php echo $user; ?>"> <button class="btn" type="input">Detail Produk</button></a>
             </div>
         </center>
     </div>
<?php
     }
?>