<?php
    include("koneksi.php");
    if(!empty($_POST["id"])){
        $id = $_POST['id'];
    }
    if(!empty($_POST["pembelian"])){
        $minimal_pembelian = $_POST['pembelian'];
    }
    if(!empty($_POST["deposit"])){
        $deposit=$_POST['deposit'];
    }
        
    
   

    if(!$deposit || !$minimal_pembelian){  
        header("location:../konfig.php?alert=1");
    }else {
        $ttl = date("Y/m/d H:m:s");
        $query = "UPDATE konfigurasi SET minimal_pembelian = '$minimal_pembelian', deposit = '$deposit' WHERE id_konfig = '$id'";
        $jalan = mysqli_query($koneksi,$query);
        if($jalan){
            header("location:../konfig.php?alert=2");
        }
        else {
            header("location:../konfig.php?alert=3");
        }
    }
?>