<?php
    include("koneksi.php");
    SESSION_START();
     $id = $_SESSION['id_user'];
     $a = md5($_POST['pass_a']);
     $b = md5($_POST['pass_b']);
   

    

    if ($a != $b){
        header("location:../profile.php?alert=1");
    }else {
       
        $query = "UPDATE user SET 
        password_u = '$a'
        WHERE id_user = '$id'";
        $jalan = mysqli_query($koneksi, $query);
        
        if($jalan){
            header("location:../profile.php?alert=2");
        }
        else {
            header("location:../profile.php?alert=3");
        }
    }
    
    
  
        
?>