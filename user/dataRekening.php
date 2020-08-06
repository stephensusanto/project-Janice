<?php
include("proses/koneksi.php");
SESSION_START();
$id = $_GET['id'];
    if($_SESSION['level'] == "3"){
        $query = "SELECT * FROM rekening WHERE fk_user_id = '0'";
    }else if($_SESSION['level'] == '4') {
      echo  $query2 = "SELECT * FROM sesi_transaksi WHERE id_sesi = '$id'";
        $exe2 = mysqli_query($koneksi, $query2);
        $ambil = mysqli_fetch_assoc($exe2);
      echo  $distributor = $ambil['id_distributor'];
        $query = "SELECT * FROM rekening WHERE fk_user_id = '$distributor' AND status_rekening = '1'";
    }
    $exe = mysqli_query($koneksi,$query);
    echo "<option> Pilih Rekening </option>";
    while($data = mysqli_fetch_array($exe)){
        echo '<option value="'.$data['id_rekening'].'">'.$data['nama_rekening'].'-'.$data['bank_rekening'].'-'.$data['nomor_rekening'].'</option>';
   }
?>