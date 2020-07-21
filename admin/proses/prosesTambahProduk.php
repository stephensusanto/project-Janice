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
if(!empty($_POST["status_barang"])){
  $status = $_POST['status_barang'];
}
if(!empty($_FILES["berkas"])){
  $gambar = $_FILES['berkas']['name'];
  $tipe = $_FILES['berkas']['type'];
  $temporary = $_FILES['berkas']['tmp_name'];
}
  $id_u = $_SESSION['id_user'];
    if(!$gambar){
        if(!$desc || !$harga || !$harga_reseller || !$status){
            header("Location:../produk.php?alert=1");
        }
    }else {
        
        if(!$desc || !$harga || !$harga_reseller || !$status){
            header("Location:../produk.php?alert=1");
        }else {
            $realName = $_SESSION['id_user'].$barang.".".explode("/",$tipe)[1];
            $loc = "http://localhost/gitHub/projectJanice/admin/img/produk/";
            $query = "INSERT INTO produk (fk_id_user, nama_produk,desc_produk,harga_produk,harga_reseller,gambar_produk,status_produk, tgl_masuk) VALUES
            ('$id_u','$barang',
            '$desc',
            '$harga',
           '$harga_reseller',
           '$loc$realName',
            '$status',now())";
           
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