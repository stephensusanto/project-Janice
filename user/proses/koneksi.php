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

   function changeStatusSesi($koneksi, $idSesi, $user){
     echo $query1 = "UPDATE sesi_transaksi SET status_sesi = '1' WHERE id_sesi = '$idSesi'";
      $cek1 = mysqli_query($koneksi, $query1);
     echo $query2 = "UPDATE user SET status_u = '1' WHERE id_user = '$user'";
      $cek2 = mysqli_query($koneksi, $query2);
      if($cek1 && $cek2){
         return "1";
      }else {
         return "0";
      }
   }
 

 
   
   function takeKonfirmasi($koneksi, $konfirmasi){
      $queryKonfirm = "SELECT * FROM konfirmasi_pembayaran Where id_konfirmasi = '$konfirmasi'";
      $jalankanQuery = mysqli_query($koneksi, $queryKonfirm);
      if($jalankanQuery){
         while($output = mysqli_fetch_array($jalankanQuery)){
            $idSesi = $output['fk_id_sesi_transaksi'];
         }
         return $idSesi;
      }else {
         return "0";
      }
   }
   
   function changeStockEveryProductDistributorToReseller($koneksi, $konfirmasi, $user, $reseller){
      
         $idSesi = takeKonfirmasi($koneksi,$konfirmasi) ;
         if($idSesi != '0'){
            $query = "SELECT * from detail_transaksi WHERE fk_id_sesi = '$idSesi'";
            $jalan = mysqli_query($koneksi, $query);
            $array = array();
            $array2 = array();
            if($jalan){
               while($output = mysqli_fetch_array($jalan)){
                  $produk = $output['fk_id_produk'];
                  $stock = $output['quantity_barang'];
                  $a = checkAllStock($koneksi,$produk,$stock, $user);
                  array_push($array,$a);
                 
               }
               
               //check jika di dalam array ada yang 0 maka stoknya ada yang kurang maka sistem akan meminta user untuk check kembali barangnya
               if(count(array_keys($array, '1')) == count($array)){
                  $jalan2 = mysqli_query($koneksi, $query);
                  while($output2 = mysqli_fetch_array($jalan2)){
                     $produk2 = $output2['fk_id_produk'];
                     $stock2 = $output2['quantity_barang'];
                     $b = changeStock($koneksi, $produk2, $stock2, $user);
                     array_push($array2,$b);
                  }
                  if(count(array_keys($array2, '1')) == count($array2)){
                     if(changeStatusSesi($koneksi, $idSesi, $reseller) != 0){ 
                        return "1";
                     }else {
                        return "0";
                     }
                  }else {
                     return "0";
                  }
               }else{
                  return "0";
               }  
            }
         }else {
            return "0";
         }
     

   }

   function changeStockEveryProductAdminToDistributor($koneksi, $konfirmasi, $user){
      
      $idSesi = takeKonfirmasi($koneksi,$konfirmasi) ;
      if($idSesi != '0'){
         $query = "SELECT * from detail_transaksi WHERE fk_id_sesi = '$idSesi'";
         $jalan = mysqli_query($koneksi, $query);
         if($jalan){
            while($output = mysqli_fetch_array($jalan)){
               $produk = $output['fk_id_produk'];
               $stock = $output['quantity_barang'];
               changeStock2($koneksi, $produk, $stock, $user);
            }
           if(changeStatusSesi($koneksi, $idSesi, $user) != 0){ 
               return "1";
           }else {
              return "0";
           }
         }
      }else {
         return "0";
      }
   }

   function checkAllStock($koneksi,$produk,$stock, $user){
      $query2 =  "SELECT * FROM stock WHERE fk_id_produk = '$produk' AND fk_id_user = '$user'";
      $cekStock = mysqli_query($koneksi,$query2);
      if($cekStock){
         while($output = mysqli_fetch_array($cekStock)){
            $sementara = $output['jumlah_stock'];
         }
         $stockBerubah = $sementara - $stock;
         if($stockBerubah < 0){
            return "0";
         }else {
            return "1";
         }
    }
   }
   

   function changeStock($koneksi,$produk,$stock, $user){
      $query2 =  "SELECT * FROM stock WHERE fk_id_produk = '$produk' AND fk_id_user = '$user'";
      $cekStock = mysqli_query($koneksi,$query2);
      if($cekStock){
         while($output = mysqli_fetch_array($cekStock)){
            $sementara = $output['jumlah_stock'];
         }
       echo  $stockBerubah = $sementara - $stock;
         $query = "Update stock SET jumlah_stock = '$stockBerubah' WHERE fk_id_produk = '$produk' AND fk_id_user = '$user' ";
         $cek = mysqli_query($koneksi,$query);
         if($cek){
            return "1";
         }else {
            return "0";
         }
         
         
      }
       
   }

   function changeStock2($koneksi,$produk,$stock, $user){
      $query =  "SELECT * FROM stock WHERE fk_id_produk = '$produk' AND fk_id_user = '$user'";
      $cekStock = mysqli_query($koneksi, $query );
      $count = mysqli_num_rows($cekStock);
      if($count == 1){
         while($output = mysqli_fetch_array($cekStock)){
            $sementara = $output['jumlah_stock'];
         }
         $stockBerubah = $sementara + $stock;
         $query = "Update stock SET jumlah_stock = '$stockBerubah' WHERE fk_id_produk = '$produk' AND fk_id_user = '$user' ";
         $cek = mysqli_query($koneksi,$query);
         if($cek){
            return "1";
         }else {
            return "0";
         }
      }else {
         $query = "INSERT INTO stock(fk_id_produk, fk_id_user, jumlah_stock) VALUES ('$produk', '$user', '$stock')";
         $cek = mysqli_query($koneksi, $query);
         if($cek){
            return "1";
         }else {
            return "0";
         }
      }
       
   }

   function dataBulan($koneksi, $bulan, $year, $id_u, $level){
      if($level == '1' || $level== '2'){
        $sql  = "SELECT * FROM sesi_transaksi INNER JOIN detail_transaksi on detail_transaksi.fk_id_sesi = sesi_transaksi.id_sesi INNER JOIN user on user.id_user = sesi_transaksi.id_distributor  WHERE (year(tanggal_sesi) = '$year' AND MONTH(tanggal_sesi) = '$bulan' AND status_sesi ='1' AND user.fk_id_level = '1') OR (MONTH(tanggal_sesi) = '$bulan' AND status_sesi ='1' AND user.fk_id_level = '2')";
        }
        else {
         $sql  = "SELECT * FROM sesi_transaksi INNER JOIN detail_transaksi on detail_transaksi.fk_id_sesi = sesi_transaksi.id_sesi INNER JOIN user on user.id_user = sesi_transaksi.id_distributor  WHERE (year(tanggal_sesi) = '$year' AND MONTH(tanggal_sesi) = '$bulan' AND status_sesi ='1' AND sesi_transaksi.id_distributor= '$id_u') ";
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

   function getNamaRekening($koneksi, $idRekening){
      $query = "SELECT * FROM rekening WHERE id_rekening = '$idRekening' ";
      $hasil = mysqli_query($koneksi, $query);
      while($output = mysqli_fetch_array($hasil)){
         $namaBank = $output['bank_rekening'];
         $noRekening = $output['nomor_rekening'];
         $gabungan = $namaBank."-".$noRekening;
       }
       return $gabungan;
   }

   function getDirectoryProduct(){
      $loc = "http://localhost/projectJanice/admin/img/bukti/";
      return $loc;
   }

   function getDirectoryBukti(){
      $loc = "http://localhost/projectJanice/admin/img/bukti/";
      return $loc;
   }
  
?> 