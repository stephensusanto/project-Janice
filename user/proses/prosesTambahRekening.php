<?php
    include("koneksi.php");
    SESSION_START();
    $user = $_SESSION['id_user'];
    $nama =$_POST['nama'];
    $bank = $_POST['bank'];
    $nomor = $_POST['nomor'];
    if($nama == '' || $bank == '' || $nomor == ''){
        header("location:../rekening.php?alert=1");
    }else {
        $query = "INSERT INTO rekening (fk_user_id, nama_rekening, nomor_rekening, bank_rekening, status_rekening) VALUES('$user', '$nama','$nomor', '$bank', '1')";
        $jalan = mysqli_query($koneksi, $query);
        
        if($jalan){
            header("location:../rekening.php?alert=2");
        }
        else {
            header("location:../rekening.php?alert=3");
        }
    }
    
    
    
  
        
?>