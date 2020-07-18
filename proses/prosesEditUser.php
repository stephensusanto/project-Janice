<?php
    include("koneksi.php");
    if(!empty($_POST["id"])){
        $id = $_POST['id'];
    }
    if(!empty($_POST["nama"])){
        $nama = $_POST['nama'];
    }
    if(!empty($_POST["email"])){
        $email = $_POST['email'];
    }
    if(!empty($_POST["dob"])){
        $dob = $_POST['dob'];
    }
    if(!empty($_POST["pass"])){
        $pass = md5($_POST['pass']);
    }
    if(!empty($_POST["telp"])){
        $telp = $_POST['telp'];
    }
    if(!empty($_POST["alamat"])){
        $alamat =$_POST['alamat'];
    }
    if(!empty($_POST["tipe"])){
        $tipe = $_POST['tipe'];
    }
    
    $status=$_POST['status'];

    $cari = "SELECT * FROM user WHERE id_user = '$id' ";
    $find = mysqli_query($koneksi, $cari);
    $findDataStatus = mysqli_fetch_assoc($find)['status_u'];
    if($findDataStatus == '3'){
        if($status == ''){
            //header("location:../user.php?alert=1");
        }else {
            $query = "UPDATE user SET 
            status_u = '$status' WHERE id_user = '$id'";
            $jalan = mysqli_query($koneksi, $query);
            if($jalan){
                header("location:../user.php?alert=2");
            }
            else {
                header("location:../user.php?alert=3");
            }
        }
    }else {
        if(!$nama || !$email || !$dob || !$telp || !$alamat || $status == ''){
            header("location:../user.php?alert=1");
            
        }else {
            $query = "UPDATE user SET 
            nama_u= '$nama' ,
            email_u= '$email' , 
            dob_u= '$dob' , 
            telp_u= '$telp' , 
            alamat_u= '$alamat' ,  
            status_u = '$status' WHERE id_user = '$id'";
            $jalan = mysqli_query($koneksi,$query);
            if($jalan){
                header("location:../user.php?alert=2");
            }
            else {
                header("location:../user.php?alert=3");
            }
        }
    }
  
        
?>