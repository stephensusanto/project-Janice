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

   function changeStatusSesi($koneksi, $idSesi){
      $query = "UPDATE sesi_transaksi SET status_sesi = '1'";
      $cek = mysqli_query($koneksi, $query);
      if($cek){
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
   
   function changeStockEveryProductDistributorToReseller($koneksi, $konfirmasi, $user){
      
         $idSesi = takeKonfirmasi($koneksi,$konfirmasi) ;
         if($idSesi != '0'){
            $query = "SELECT * from detail_transaksi WHERE fk_id_sesi = '$idSesi'";
            $jalan = mysqli_query($koneksi, $query);
            $array = array();
            if($jalan){
               while($output = mysqli_fetch_array($jalan)){
                  $produk = $output['fk_id_produk'];
                  $stock = $output['quantity_barang'];
                  $a = checkAllStock($koneksi,$produk,$stock, $user);
                  array_push($array,$a);
                  //changeStock($koneksi, $produk, $stock, $user);
                 
               }
               //check jika di dalam array ada yang 0 maka stoknya ada yang kurang maka sistem akan meminta user untuk check kembali barangnya
               if(count(array_keys($array, '1')) == count($array)){
                  while($output = mysqli_fetch_array($jalan)){
                     $produk = $output['fk_id_produk'];
                     $stock = $output['quantity_barang'];
                     changeStock($koneksi, $produk, $stock, $user);
                    
                  }
                  if(changeStatusSesi($koneksi, $konfirmasi) != 0){ 
                     return "1";
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
         $query = "SELECT * from detail_trasansaksi WHERE fk_id_sesi = '$idSesi'";
         $jalan = mysqli_query($koneksi, $query);
         if($jalan){
            while($output = mysqli_fetch_array($jalan)){
               $produk = $output['fk_id_produk'];
               $stock = $output['quantity_barang'];
               changeStock2($koneksi, $produk, $stock, $user);
            }
           if(changeStatusSesi($koneksi, $konfirmasi) != 0){ 
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
         $stockBerubah = $sementara - $stock;
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
      $cekStock = mysqli_query($koneksi, "SELECT * FROM stock WHERE fk_id_produk = '$produk' AND fk_id_user = '$user'");
      if($cekStock){
         while($output = mysqli_fetch_array($jalan)){
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
      }
       
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
  
?> 