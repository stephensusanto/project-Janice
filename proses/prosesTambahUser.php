<?php
    include("koneksi.php");
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
    if(!empty($_POST["status"])){
        $status=$_POST['status'];
    }
    if(!empty($_GET["level"])){
        $editedLevel =   $_GET['level'] ;
    }

    if(!$nama || !$email || !$dob || !$pass || !$telp || !$alamat || !$tipe || !$status){
        if($editedLevel == '2'){
            header("location:../user.php?level=2&&alert=1");
        }elseif($editedLevel == '3'){
            header("location:../user.php?level=3&&alert=1");
        }elseif($editedLevel == '4'){
            header("location:../user.php?level=4&&alert=1");
        }
    }else {
        $ttl = date("Y/m/d H:m:s");
        $query = "INSERT INTO user (nama_u, email_u, dob_u, telp_u, alamat_u, tanggal_daftar, password_u, level, fk_id_domisili, status_u)
        VALUES ('".$nama."', '".$email."', '".$dob."', '".$telp."','".$alamat."', now(),'".$pass."','".$tipe."','0','".$status."')";
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
?>