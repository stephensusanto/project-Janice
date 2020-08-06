<?php
    include("koneksi.php");
     $id = $_GET['id'];
     $sesi = $_GET['sesi'];  
        $query = "DELETE FROM detail_transaksi WHERE id_detail = '$id'";
        $jalan = mysqli_query($koneksi, $query);
        
        if($jalan){
            $query2 = "SELECT * FROM sesi_transaksi INNER JOIN detail_transaksi on detail_transaksi.fk_id_sesi = sesi_transaksi.id_sesi WHERE id_sesi = '$sesi'";
            $exe = mysqli_query($koneksi, $query2);
            $itung = mysqli_fetch_row($exe);
            if($itung == 0){
                $query3 = "DELETE FROM sesi_transaksi WHERE id_sesi = '$sesi'";
                $exe2 = mysqli_query($koneksi, $query3);
                if($exe2){
                    header("location:../pembayaran.php?alert=2");
                }else {
                    header("location:../pembayaran.php?alert=3");
                }
            }else {
                header("location:../pembayaran.php?alert=2");
            }
            
        }
        else {
            header("location:../pembayaran.php?alert=3");
        }
    
    
    
  
        
?>