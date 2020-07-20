<?php
    include("koneksi.php");
    //1 approve, else tolak
    if($_GET['code']=='1'){
        $query = "UPDATE konfirmasi_pembayaran SET konfirmasi_status = '1' ";
    }else {
        $query = "UPDATE konfirmasi_pembayaran SET konfirmasi_status = '0' ";
    }
    $cek = mysqli_query($koneksi, $query);
    if($cek){
        header("location:../konfirmasiPembayaran.php?alert=2");
    }else {
        header("location:../konfirmasiPembayaran.php?alert=3");
    }
    
?>