<?php
    include("koneksi.php");
    Session_start();
if(!empty($_POST["id_barang"])){
  $id =   $_POST['id_barang'] ;
}
if(!empty($_POST["nama_barang"])){
   $barang = $_POST['nama_barang'];
}
if(!empty($_POST["deskripsi_barang"])){
    $desc = $_POST['deskripsi_barang'];
}
if(!empty($_POST["harga_barang"])){
    $harga = $_POST['harga_barang'];
}
if(!empty($_POST["harga_reseller"])){
   $harga_reseller = $_POST['harga_reseller'];
}

  $status = $_POST['status_barang'];

if(!empty($_FILES["berkas"])){
  $gambar = $_FILES['berkas']['name'];
  $tipe = $_FILES['berkas']['type'];
  $temporary = $_FILES['berkas']['tmp_name'];
}
$id_u = $_SESSION['id_user'];
  
    if(!$gambar){
        if(!$desc || !$harga || !$harga_reseller || $status == ''){
            header("Location:../produk.php?alert=1");
        }else {
          echo  $query = "UPDATE produk
            SET
            id_produk 			= '$id',
            nama_produk 		= '$barang',
            desc_produk     	= '$desc',
            harga_produk		= '$harga',
            harga_reseller 		= '$harga_reseller',
            status_produk 		= '$status',
            fk_id_user         = '$id_u'
            WHERE id_produk		 = '".$id."'";
            $hasil = mysqli_query($koneksi, $query);
            if($hasil){
                header("Location:../produk.php?alert=2");
            }else {
                header("Location:../produk.php?alert=3");
            }
        }
    }else {
        $realName = $_SESSION['id_user'].$barang.".".explode("/",$tipe)[1];
        if(!$desc || !$harga || !$harga_reseller || $status == ''){
            header("Location:../produk.php?alert=1");
        }else {
            
            $query = "UPDATE produk
            SET
            id_produk 			= '$id',
            nama_produk 		= '$barang',
            desc_produk     	= '$desc',
            harga_produk		= '$harga',
            harga_reseller 		= '$harga_reseller',
            gambar_produk       = '$realName',
            status_produk 		= '$status',
            fk_id_user         = '$id_u'
            WHERE id_produk		 = '".$id."'";
            $hasil = mysqli_query($koneksi, $query);
            $upload = move_uploaded_file($temporary, '../img/produk/'.$realName);
            if($hasil && $upload){
                header("Location:../produk.php?alert=2");
            }else {
                header("Location:../produk.php?alert=3");
            }
        }
    }
?>
