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
   function changeStock($koneksi,$produk,$stock, $user){
      $query = "Update stock SET jumlah_stock = '$stock' WHERE fk_id_produk = '$produk' AND fk_id_user = '$user' ";
      mysqli_query($koneksi,$query);
   }

   function dataBulan($koneksi, $bulan, $year, $id_u, $level){
      if($level == '1' || $level== '2'){
        $sql  = "SELECT * FROM sesi_transaksi INNER JOIN detail_transaksi on detail_transaksi.fk_id_sesi = sesi_transaksi.id_sesi INNER JOIN user on user.id_user = sesi_transaksi.distributor  WHERE (year(tanggal_sesi) = '$year' AND MONTH(tanggal_sesi) = '$bulan' AND status_sesi ='1' AND user.fk_id_level = '1') OR (MONTH(tanggal_sesi) = '$bulan' AND status_sesi ='1' AND user.fk_id_level = '2')";
        }
        else {
         $sql  = "SELECT * FROM sesi_transaksi INNER JOIN detail_transaksi on detail_transaksi.fk_id_sesi = sesi_transaksi.id_sesi INNER JOIN user on user.id_user = sesi_transaksi.distributor  WHERE (year(tanggal_sesi) = '$year' AND MONTH(tanggal_sesi) = '$bulan' AND status_sesi ='1' AND sesi_transaksi.distributor= '$id_u') ";
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
        return $total;
   }
  
?> 