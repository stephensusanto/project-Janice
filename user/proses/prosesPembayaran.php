<?php
    include("koneksi.php");
    SESSION_START();
     $order = $_POST['keranjang'];
      $rek = $_POST['rekening'];
      $rekP = $_POST['rekP'];
      $bank = $_POST['bank'];
      $nama = $_POST['namaP'];
      $transfer = $_POST['trasfer'];
      $dot = $_POST['dot'];
    if(!empty($_FILES["berkas"])){
        $gambar = $_FILES['berkas']['name'];
        $tipeGambar = $_FILES['berkas']['type'];
        $temporary = $_FILES['berkas']['tmp_name'];
    }
    

    if($order == '' || $rek == '' || $rekP == '' || $bank == '' || $nama == '' || $transfer == '' ||$dot == '' || $tipeGambar == ''){
        header("Location:../pembayaran.php?alert=1");
    }else {
        $query = "SELECT * FROM sesi_transaksi INNER JOIN detail_transaksi on detail_transaksi.fk_id_sesi = sesi_transaksi.id_sesi WHERE id_sesi = '$order' AND status_sesi ='0'";
        $exe = mysqli_query($koneksi, $query);
        $qty = 0;
        while($o = mysqli_fetch_assoc($exe)){
            $qty += $o['quantity_barang'];
            $tipe = $o['tipe_sesi'];
        }
        //jika tipe transaksi nya register distributor / reseller maka tarik data dari konfigurasi
        if($tipe == "1" || $tipe =="2"){
            $level = $_SESSION['level'];
            $query3 = "SELECT * FROM konfigurasi WHERE fk_id_level ='$level'";
            $exe3 = mysqli_query($koneksi, $query3);
            $trik = mysqli_fetch_assoc($exe3);
            $stokMinim = $trik['minimal_pembelian'];
            if($qty < $stokMinim){
                header("Location:../pembayaran.php?alert=1");
            }else {
                $ttl = date("d-m-Y", strtotime($dot));
                $tg = explode("/",$tipeGambar)[1];
                $realName = $order.$ttl.".".$tg;
                //jika terisi semua
                $query2 = "INSERT INTO konfirmasi_pembayaran (fk_id_sesi_transaksi, fk_id_rekening, nomor_rekening_pengirim, bank_pengirim, nama_pengirim, jumlah_transfer, tgl_transfer, bukti_transfer, konfirmasi_status) VALUE 
                ('$order', '$rek', '$rekP', '$bank', '$nama', '$transfer', '$dot', '$realName', '2')";
                $exe2 = mysqli_query ($koneksi, $query2);
                if($exe2){
                    $upload = move_uploaded_file($temporary, '../../admin/img/bukti/'.$realName);
                    header("Location:../pembayaran.php?alert=2");
                }else {
                    header("Location:../pembayaran.php?alert=3");
                }
            }
            //jika tipe transaksinya biasa maka langsung bisa order
        }else {
            $ttl = date("d-m-Y", strtotime($dot));
            $tg = explode("/",$tipeGambar)[1];
            $realName = $order.$ttl.".".$tg;
            //jika terisi semua
           echo $query2 = "INSERT INTO konfirmasi_pembayaran (fk_id_sesi_transaksi, fk_id_rekening, nomor_rekening_pengirim, bank_pengirim, nama_pengirim, jumlah_transfer, tgl_transfer, bukti_transfer, konfirmasi_status) VALUE 
            ('$order', '$rek', '$rekP', '$bank', '$nama', '$transfer', '$dot', '$realName', '2')";
            $exe2 = mysqli_query ($koneksi, $query2);
            if($exe2){
                $upload = move_uploaded_file($temporary, '../../admin/img/bukti/'.$realName);
                header("Location:../pembayaran.php?alert=2");
            }else {
                header("Location:../pembayaran.php?alert=3");
            }
        }
        
        
    }
   
    
 
?> 