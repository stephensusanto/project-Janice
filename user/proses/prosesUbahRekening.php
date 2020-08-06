<?php
    include("koneksi.php");
     $id = $_POST['id'];
     $nama = $_POST['nama'];  
     $bank = $_POST['bank'];  
     $nomor = $_POST['nomor'];
     $stat = $_POST['status']; 
     if($id == '' || $nama == '' || $bank == '' || $nomor == '' || $stat ==''){
        header("location:../rekening.php?alert=1");
     }else {
         $query = "UPDATE rekening 
        SET 
        bank_rekening = '$bank',
        nama_rekening = '$nama',
        nomor_rekening = '$nomor',
        status_rekening = '$stat' WHERE id_rekening = '$id'";
        $jalan = mysqli_query($koneksi, $query);
        
        if($jalan){
            header("location:../rekening.php?alert=2");
        }
        else {
            header("location:../rekening.php?alert=3");
        }
    }
    
    
    
  
        
?>