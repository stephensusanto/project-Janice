<?php
include("koneksi.php");
SESSION_START();
$id = $_GET['id'];
$user =$_SESSION['id_user'];
$harga = $_GET['hb'];
$distributor = $_GET['d'];
$stock = $_GET['stock'];

if(!empty($_POST["qty"])){
    $qty = $_POST['qty'];
}
if($stock == "0"){
    $stock = $qty+1;
}else {
    $stock = $stock;
}

    if(!$qty){
        header("location:../detailProduk.php?id=$id&&alert=1");
    }else {
        if($stock < $qty){
            header("location:../detailProduk.php?id=$id&&alert=1&&user=$distributor&&stock=$stock&&harga=$harga");   
        }else {
            $queryCek = "SELECT * FROM user WHERE id_user = '$user'";
            $executeCek = mysqli_query($koneksi, $queryCek);
            $ambil = mysqli_fetch_assoc($executeCek);
            //dapetin status dan level untuk menentukan tipe sesi transaksi
            $status = $ambil['status_u'];
            $level = $ambil['fk_id_level'];
            if($status == "2"){
                if($level == "3"){//jika sebagai distributor
                    $tipeSesi = "1";
                }
                else { //atau sebagai reseller
                    $tipeSesi = "2";
                }
            }else { //transaksi lain
                if($level == "3"){
                    $tipeSesi = "3";
                }
                else {
                    $tipeSesi = "4";
                } 
            }
            //untuk cek sesi transaski sudah terigister atau belum
            $queryCekk2 = "SELECT * FROM sesi_transaksi WHERE id_distributor = '$distributor' AND fk_id_u ='$user' AND status_sesi = '0'";
            $exe = mysqli_query($koneksi, $queryCekk2);
            $ambil2 = mysqli_fetch_assoc($exe);
            $itung = mysqli_num_rows($exe);
            //jika teregister
            if($itung > 0){
                $idSesi = $ambil2['id_sesi'];
                //untuk cek di detail ada barang yang sama atau tidak
                $queryCek3 = "SELECT * FROM detail_transaksi WHERE fk_id_sesi = '$idSesi' AND fk_id_produk = '$id'";
                $exe2 = mysqli_query($koneksi, $queryCek3);
                $ambil2 = mysqli_fetch_assoc($exe2);
                $itung2 = mysqli_num_rows($exe2);
                if($itung2 > 0){ //jika ada update
                    $idDetail = $ambil2['id_detail'];
                    $dbQty = $ambil2['quantity_barang'];
                    $totalBarang = $dbQty + $qty;
    
                    $query = "UPDATE detail_transaksi SET quantity_barang = '$totalBarang', harga_barang = '$harga' WHERE id_detail = '$idDetail'";
                    $execute = mysqli_query($koneksi, $query);
                    if($execute){
                        header("location:../detailProduk.php?id=$id&&alert=2&&user=$distributor&&stock=$stock&&harga=$harga");
                    }else {
                        header("location:../detailProduk.php?id=$id&&alert=3&&user=$distributor&&stock=$stock&&harga=$harga");
                    }
                }else { //jika tidak ada insert
                    $query = "INSERT into detail_transaksi (fk_id_sesi,fk_id_produk,quantity_barang,harga_barang) VALUES('$idSesi', '$id', '$qty', '$harga')";
                    $execute = mysqli_query($koneksi, $query);
                    if($execute){
                        header("location:../detailProduk.php?id=$id&&alert=2&&user=$distributor&&stock=$stock&&harga=$harga");
                    }else {
                        header("location:../detailProduk.php?id=$id&&alert=3&&user=$distributor&&stock=$stock&&harga=$harga");
                    }
                }
               //jika tidak teregister
            }else {
                //check sesi tipe sesinya jika 1 atau 2
                if($tipeSesi == "1" || $tipeSesi == "2"){
                    //ambil data dari konfigurasi
                    $queryCek4 = "SELECT * FROM konfigurasi WHERE fk_id_level = '$level'";
                    $exe4 = mysqli_query($koneksi, $queryCek4);
                    $ambilData = mysqli_fetch_assoc($exe4);
                    $deposit = $ambilData['deposit'];
                }else { //jika tidak maka null
                    $deposit = "NULL";
                }
                $query = "INSERT INTO sesi_transaksi (fk_id_u, id_distributor,tipe_sesi,tanggal_sesi, status_sesi, deposit) VALUES('$user', '$distributor', '$tipeSesi', now(), '0', $deposit) ";
                $execute = mysqli_query($koneksi, $query);
                if($execute){
                    $queryCekk5 = "SELECT * FROM sesi_transaksi WHERE id_distributor = '$distributor' AND fk_id_u ='$user' AND status_sesi = '0'";
                    $exe5 = mysqli_query($koneksi, $queryCekk5);
                    $ambil5 = mysqli_fetch_assoc($exe5);
                    $itung5 = mysqli_num_rows($exe5);
                    if($itung5 > 0){
                        $idSesi = $ambil5['id_sesi'];
                        //untuk cek di detail ada barang yang sama atau tidak
                        $queryCek3 = "SELECT * FROM detail_transaksi WHERE fk_id_sesi = '$idSesi' AND fk_id_produk = '$id'";
                        $exe2 = mysqli_query($koneksi, $queryCek3);
                        $ambil2 = mysqli_fetch_assoc($exe2);
                        $itung2 = mysqli_num_rows($exe2);
                        if($itung2 > 0){ //jika ada update
                            $idDetail = $ambil2['id_detail'];
                            $dbQty = $ambil2['quantity_barang'];
                            $totalBarang = $dbQty + $qty;
            
                            $query = "UPDATE detail_transaksi SET quantity_barang = '$totalBarang', harga_barang = '$harga' WHERE id_detail = '$idDetail'";
                            $execute = mysqli_query($koneksi, $query);
                            if($execute){
                                header("location:../detailProduk.php?id=$id&&alert=2&&user=$distributor&&stock=$stock&&harga=$harga");
                            }else {
                                header("location:../detailProduk.php?id=$id&&alert=3&&user=$distributor&&stock=$stock&&harga=$harga");
                            }
                        }else { //jika tidak ada insert
                            $query = "INSERT into detail_transaksi (fk_id_sesi,fk_id_produk,quantity_barang,harga_barang) VALUES('$idSesi', '$id', '$qty', '$harga')";
                            $execute = mysqli_query($koneksi, $query);
                            if($execute){
                                header("location:../detailProduk.php?id=$id&&alert=2&&user=$distributor&&stock=$stock&&harga=$harga");
                            }else {
                                header("location:../detailProduk.php?id=$id&&alert=3&&user=$distributor&&stock=$stock&&harga=$harga");
                            }
                        }
                    }
    
                }else {
                    header("location:../detailProduk.php?id=$id&&alert=3&&user=$distributor&&stock=$stock&&harga=$harga"); 
                }
    
            }
        }
    }

?>