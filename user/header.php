<div id="mainMenu-trigger">
                        <a class="lines-button x"><span class="lines"></span></a>
                    </div>
                    <!--end: Navigation Resposnive Trigger-->
                    <!--Navigation-->
                    <div id="mainMenu">
                        <div class="container">
                            <nav>
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="pemesanan.php">Pesan Stock</a></li>
                                    <li><a href="pembayaran.php">Pembayaran</a></li>
                                    <?php 
                                    if($_SESSION['level'] == "3"){
                                    ?>
                                    <li class="dropdown"><a href="#">Konfirmasi</a>
                                        <ul class="dropdown-menu">
                                            
                                            <li><a href="konfirmasiPembayaran.php">Pembayaran</a></li>
                                            <li><a href="konfirmasiPembelian.php">Pembelian</a></li>
                                            
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#">Lihat Laporan</a>
                                        <ul class="dropdown-menu">
                                            
                                            <li><a href="laporanPenjualan.php">Laporan Pemesanan Reseller</a></li>
                                            <li><a href="laporanPembelian.php">Laporan Pembelian Distributor</a></li>
                                            
                                        </ul>
                                    </li>
                                    <?php 
                                    }else {
                                        ?>
                                        <li><a href="konfirmasiPembelian.php">Konfirmasi Pembelian</a></li>
                                        <li><a href="laporanPembelian.php">Laporan Pembelian</a></li>
                                        <?php
                                    }
                                    ?>
                                    <li><a href="profile.php">Profil Saya</a></li>
                                    <li><a href="proses/prosesLogout.php">Log Out</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>