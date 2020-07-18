<?php
   $host = "localhost";
   $user = "root";
   $pass = "";
   $db = "janice";	
   $koneksi = mysqli_connect($host,$user,$pass,$db);
   
   function rupiah($angka){
	
      $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
      return $hasil_rupiah;
    
   }

   function changeStock($produk,$stock, $user){
      $query = "Update stock SET jumlah_stock = '$stock' WHERE fk_id_produk = '$produk' AND fk_id_user = '$user' ";
      mysqli_query($koneksi,$query);
   }
?> 