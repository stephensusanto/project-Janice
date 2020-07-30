<?php
include("proses/koneksi.php");
    $id = $_GET['dom'];
    $query = "SELECT * FROM user WHERE fk_id_level = '3' AND fk_id_domisili = '$id' AND status_u = '1'";
    $exe = mysqli_query($koneksi,$query);
    echo "<option> Pilih User </option>";
    while($data = mysqli_fetch_array($exe)){
        echo '<option value="'.$data['id_user'].'">'.$data['nama_u'].'</option>';
   }
?>