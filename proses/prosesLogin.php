<?php
include("koneksi.php");
SESSION_START();
if(!$_POST['email'] || !$_POST['pass']){
   header("location:../login.php?alert=1");	
   
}else {
    $email  = $_POST['email'];
    $pass = md5($_POST['pass']);
    $sql  = "SELECT * FROM user WHERE email_u = '".$email."' AND password_u = '".$pass."' AND status_u='1'";
    $cek=mysqli_query($koneksi,$sql);
	$jumlah = mysqli_num_rows($cek);
    $hasil = mysqli_fetch_assoc($cek);
    if($jumlah == 0 ){
        header("location:../login.php?alert=1");
    }else {
        $_SESSION['id_user'] 			= $hasil ['id_user'];
        $_SESSION['id_roles']  	        = $hasil ['fk_id_al'];
        $_SESSION['nama_u']	    	= $hasil['nama_u'];  
        header("location:../index.php");
        }
    }


?>