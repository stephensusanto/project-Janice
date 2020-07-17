<?php
include("koneksi.php");
    $email = $_POST['email'];
    $pass1 = md5($_POST['password']);
    $pass2 = md5($_POST['password2']);
    if(!$email || !$pass1 || !$pass2){
       header("location:../forgot-password.php?alert=1");
      
    }else {
        if($pass1 != $pass2){
            header("location:../forgot-password.php?alert=1");
        }else {
            $query = "UPDATE user SET password_u = '".$pass1."' WHERE email_u = '".$email."'";
            $hasil = mysqli_query($koneksi,$query);
            if($hasil)
            {
              header("location:../forgot-password.php?alert=2");   
              
            }
            else
            {
               header("location:../forgot-password.php?alert=1");
            }
        }
    }
?>