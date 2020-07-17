<?php
include("koneksi.php");
SESSION_START();
if(!$_POST['email'] || !$_POST['pass']){
   header("location:../login.php?alert=1");	
   
}else {
    $email  = $_POST['email'];
    $pass = md5($_POST['pass']);
    $sql  = "SELECT * FROM user WHERE email_u = '".$email."' AND password_u = '".$pass."'";
    $cek=mysqli_query($koneksi,$sql);
	$jumlah = mysqli_num_rows($cek);
    $hasil = mysqli_fetch_assoc($cek);
    if($jumlah == 0 ){
        header("location:../login.php?alert=1");
    }else {
        $_SESSION['id_user'] 			= $hasil ['id_user'];
        $_SESSION['level']  	        = $hasil ['level'];
        $_SESSION['nama_u']	    	    = $hasil['nama_u'];  
        $_SESSION['status']	    	    = $hasil['status_u'];  
        if($hasil['status_u'] == "2"){
            header("location:../pendaftaranBaru.php");
        }else if($hasil['status_u'] == "1"){
            header("location:../index.php");
        }else {
            header("location:../login.php");
        }
    }
}


?>