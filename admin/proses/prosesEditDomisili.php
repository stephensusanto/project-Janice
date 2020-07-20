<?php
    include("koneksi.php");
    if(!empty($_POST["id"])){
        $id = $_POST['id'];
    }
    if(!empty($_POST["nama"])){
        $nama = $_POST['nama'];
    }
        $status=$_POST['status'];
    
   

    if(!$nama || $status == ''){  
        header("location:../domisili.php?alert=1");
    }else {
        $ttl = date("Y/m/d H:m:s");
        $query = "UPDATE domisili SET nama_dom = '$nama', status_dom = '$status' WHERE id_dom = '$id'";
        $jalan = mysqli_query($koneksi,$query);
        if($jalan){
            header("location:../domisili.php?alert=2");
        }
        else {
            header("location:../domisili.php?alert=3");
        }
    }
?>