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
        header("location:../level.php?alert=1");
    }else {
        $ttl = date("Y/m/d H:m:s");
        $query = "UPDATE level SET nama_level = '$nama', status_level = '$status' WHERE id_level = '$id'";
        $jalan = mysqli_query($koneksi,$query);
        if($jalan){
            header("location:../level.php?alert=2");
        }
        else {
            header("location:../level.php?alert=3");
        }
    }
?>