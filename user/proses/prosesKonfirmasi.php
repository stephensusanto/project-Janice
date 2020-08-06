<?php
    include("koneksi.php");
    $id = $_GET['id'];
    $id_user = $_GET['u'];
    $distributor = $_GET['d'];
    //1 approve, else tolak
    if($_GET['code']=='1'){
        $query = "UPDATE konfirmasi_pembayaran SET konfirmasi_status = '1', konfirmasi_tgl = now() WHERE id_konfirmasi = '$id' ";
        if($_GET['level'] == '1' || $_GET['level'] == '2'){
            if(changeStockEveryProductAdminToDistributor($koneksi, $id, $distributor) == '1'){
                $cek = mysqli_query($koneksi, $query);
                $query3 = "INSERT INTO notifikasi (notifikasi_untuk_id, notifikasi_isi,notifikasi_status, notifikasi_tgl) VALUES('$distributor', 'Pembayaran Sudah Diterima oleh Pihak Terkait Produk Anda Akan Dikirim Sesuai Dengan Alamat yang didaftarkan', '1', now())";
                $cek2 = mysqli_query($koneksi, $query3);
                if($cek && $cek2){
                 header("location:../konfirmasiPembayaran.php?alert=2");
                }else {
                    header("location:../konfirmasiPembayaran.php?alert=3");
                }
            }else {
                header("location:../konfirmasiPembayaran.php?alert=3");
            }
        }else { //ketika transaksi yang login adalah admin maka admin ke distributor (penambahan stock) selain itu pengurangan stock di tabel stock
            if(changeStockEveryProductDistributorToReseller($koneksi, $id, $id_user, $distributor) == '1'){
               $cek = mysqli_query($koneksi, $query);
               $query3 = "INSERT INTO notifikasi (notifikasi_untuk_id, notifikasi_isi,notifikasi_status, notifikasi_tgl) VALUES('$distributor', 'Pembayaran Sudah Diterima oleh Pihak Terkait Produk Anda Akan Dikirim Sesuai Dengan Alamat yang didaftarkan', '1', now())";
               $cek2 = mysqli_query($koneksi, $query3);
               if($cek && $cek2){
                    header("location:../konfirmasiPembayaran.php?alert=2");
                   }else {
                       header("location:../konfirmasiPembayaran.php?alert=3");
                   }
            }else {
                header("location:../konfirmasiPembayaran.php?alert=3");
            }
        
        }
    }else {
        $query = "UPDATE konfirmasi_pembayaran SET konfirmasi_status = '0', konfirmasi_tgl = now() WHERE id_konfirmasi = '$id'";
        $cek = mysqli_query($koneksi, $query);
        $query3 = "INSERT INTO notifikasi (notifikasi_untuk_id, notifikasi_isi,notifikasi_status, notifikasi_tgl) VALUES('$distributor', 'Pembayaran Belum Diterima oleh Pihak Terkait ', '1', now())";
        $cek2 = mysqli_query($koneksi, $query3);
        if($cek && $cek2){
         header("location:../konfirmasiPembayaran.php?alert=2");
        }else {
            header("location:../konfirmasiPembayaran.php?alert=3");
        }
    }
    
   
   
       
    
?>