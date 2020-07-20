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
    
    if(!empty($_POST["alamat_p"])){
        $alamat_p =$_POST['alamat_p'];
    }
    if(!empty($_POST["tipe"])){
        $tipe = $_POST['tipe'];
    }
    if(!empty($_GET["level"])){
        $editedLevel =   $_GET['level'] ;
    }
    
    $status=$_POST['status'];

    $cari = "SELECT * FROM user WHERE id_user = '$id' ";
    $find = mysqli_query($koneksi, $cari);
    $findDataStatus = mysqli_fetch_assoc($find)['status_u'];
    if($findDataStatus == '3'){
        if($status == ''){
            if($editedLevel == '2'){
                header("location:../user.php?level=2&&alert=1");
            }elseif($editedLevel == '3'){
                header("location:../user.php?level=3&&alert=1");
            }elseif($editedLevel == '4'){
                header("location:../user.php?level=4&&alert=1");
            }
        }else {
            $query = "UPDATE user SET 
            status_u = '$status' WHERE id_user = '$id'";
            $jalan = mysqli_query($koneksi, $query);
            if($jalan){
                if($editedLevel == '2'){
                    header("location:../user.php?level=2&&alert=2");
                }elseif($editedLevel == '3'){
                    header("location:../user.php?level=3&&alert=2");
                }elseif($editedLevel == '4'){
                    header("location:../user.php?level=4&&alert=2");
                }
            }
            else {
                if($editedLevel == '2'){
                    header("location:../user.php?level=2&&alert=3");
                }elseif($editedLevel == '3'){
                    header("location:../user.php?level=3&&alert=3");
                }elseif($editedLevel == '4'){
                    header("location:../user.php?level=4&&alert=3");
                }
            }
        }
    }else {
        if(!$nama || !$email || !$dob || !$telp || !$alamat || !$alamat_p || $status == ''){
            if($editedLevel == '2'){
                header("location:../user.php?level=2&&alert=1");
            }elseif($editedLevel == '3'){
                header("location:../user.php?level=3&&alert=1");
            }elseif($editedLevel == '4'){
                header("location:../user.php?level=4&&alert=1");
            }
            
        }else {
            $query = "UPDATE user SET 
            nama_u= '$nama' ,
            email_u= '$email' , 
            dob_u= '$dob' , 
            telp_u= '$telp' , 
            alamat_u= '$alamat' , 
            alamat_pengiriman = '$alamat_p', 
            status_u = '$status' WHERE id_user = '$id'";
            $jalan = mysqli_query($koneksi,$query);
            if($jalan){
                if($editedLevel == '2'){
                    header("location:../user.php?level=2&&alert=2");
                }elseif($editedLevel == '3'){
                    header("location:../user.php?level=3&&alert=2");
                }elseif($editedLevel == '4'){
                    header("location:../user.php?level=4&&alert=2");
                }
            }
            else {
                if($editedLevel == '2'){
                    header("location:../user.php?level=2&&alert=3");
                }elseif($editedLevel == '3'){
                    header("location:../user.php?level=3&&alert=3");
                }elseif($editedLevel == '4'){
                    header("location:../user.php?level=4&&alert=3");
                }
            }
        }
    }
  
        
?>