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

   function getDirectoryProduct(){
      $loc = "http://localhost/gitHub/projectJanice/admin/img/produk/";
      return $loc;
   }
 
?> 