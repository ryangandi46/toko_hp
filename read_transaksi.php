<?php
session_start(); // start the session
if (!isset($_SESSION['login'])) {
    echo "<script>alert('Please login first !');window.location.replace('form_login.php');</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Berkah Jaya</title>
    <?php include "sidebar.php"; ?>
</head>

<body>
    <div class="main-content">

        <div id="menu-button">
            <input type="checkbox" id="menu-checkbox">
            <label for="menu-checkbox" id="menu-label">
                <div id="hamburger">Menu</div>
            </label>

        </div>
        <div class="content">
            <h1>Berkah Jaya</h1>
            <h3>Transaction</h3>

            <!-- Tambahkan tab Cash dan Credit -->
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'cash')">Cash</button>
                <button class="tablinks" onclick="openTab(event, 'credit')">Credit</button>
            </div>

            <div id="cash" class="tabcontent">
                <!-- Konten tab Cash -->
                <table border="1">
                    <!-- Isi tabel Cash -->
                    <tr>
                    <th rowspan="2">NO</th>
                    <th rowspan="2">Tanggal</th>
                    <th rowspan="2">Pembeli</th>
                    <th rowspan="2">Pegawai</th>
                    <th rowspan="2">Phone</th>
                    <th rowspan="2">Harga</th>
                    <th rowspan="2">Jumlah</th>
                    <th rowspan="2">Total Harga</th>
                    <th rowspan="2">Tunai</th>
                    <th colspan="2">Pembayaran</th>
                    <th rowspan="2" , colspan="3">Action</th>
                </tr>
                <tr>
                    <th>Tipe Pembayaran</th>
                    <th>Status</th>
                </tr>
                <?php
                include "connection.php"; // call connection
                $query = "SELECT * FROM transaksi 
                INNER JOIN buyer ON transaksi.id_buyer = buyer.id_buyer 
                INNER JOIN stock ON transaksi.id_stock = stock.id_stock 
                INNER JOIN users ON transaksi.userid = users.userid 
                WHERE transaksi.type_pembayaran = 'Cash'";
                $trans = mysqli_query($db_connection, $query);

                $i = 1; // initial counter for numbering
                foreach ($trans as $data) :
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?= date('l, d M Y H:i:s', strtotime($data['tanggal'])) ?></td>
                        <td><?= $data['name_buyer']; ?></td>
                        <td><?php echo $data['username']; ?></td>
                        <td><?php echo $data['phone']; ?></td>
                        <td>Rp <?= number_format($data['price'], 0, ',', '.'); ?></td> <!-- Format nominal rupiah -->
                        <td><?= $data['jumlah']; ?></td>
                        <td>Rp <?= number_format($data['total_harga'], 0, ',', '.'); ?></td> <!-- Format nominal rupiah -->
                        <td>Rp <?= number_format($data['tunai'], 0, ',', '.'); ?></td> <!-- Format nominal rupiah -->
                        <td>
                            <?php if ($data['type_pembayaran'] == 'Credit') { ?>
                                <a style="color : red; text-decoration: none;" href="credit.php?id_transaksi=<?= $data['id_transaksi'] ?>"><?= $data['type_pembayaran']; ?></a>
                            <?php } else { ?>
                                <?= $data['type_pembayaran']; ?>
                            <?php } ?>
                        </td>
                        <td><?= $data['status']; ?></td>
                        <td><a href="delete_transaksi.php?id=<?= $data['id_transaksi'] ?>" onclick="return confirm('Are you sure')"><input type="button" class="btn-delete" value="delete" style="border: 0;"></a></td>
                        <td><a href="cetak_transaksi.php?id=<?= $data['id_transaksi'] ?>"><input type="button" class="btn-cetak" value="cetak" style="border: 0;"></a></td>
                    </tr>
                <?php endforeach; ?>
                </table>
            </div>

            <div id="credit" class="tabcontent">
                <!-- Konten tab Credit -->
                <table border="1">
                    <!-- Isi tabel Credit -->
                    <tr>
                    <th rowspan="2">NO</th>
                    <th rowspan="2">Tanggal</th>
                    <th rowspan="2">Pembeli</th>
                    <th rowspan="2">Pegawai</th>
                    <th rowspan="2">Phone</th>
                    <th rowspan="2">Harga</th>
                    <th rowspan="2">Jumlah</th>
                    <th rowspan="2">Total Harga</th>
                    <th rowspan="2">Tunai</th>
                    <th colspan="2">Pembayaran</th>
                    <th rowspan="2" , colspan="3">Action</th>
                </tr>
                <tr>
                    <th>Tipe Pembayaran</th>
                    <th>Status</th>
                </tr>
                <?php
                include "connection.php"; // call connection
                $query = "SELECT * FROM transaksi 
                INNER JOIN buyer ON transaksi.id_buyer = buyer.id_buyer 
                INNER JOIN stock ON transaksi.id_stock = stock.id_stock 
                INNER JOIN users ON transaksi.userid = users.userid 
                WHERE transaksi.type_pembayaran = 'Credit'";
                $trans = mysqli_query($db_connection, $query);

                $i = 1; // initial counter for numbering
                foreach ($trans as $data) :
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?= date('l, d M Y H:i:s', strtotime($data['tanggal'])) ?></td>
                        <td><?= $data['name_buyer']; ?></td>
                        <td><?php echo $data['username']; ?></td>
                        <td><?php echo $data['phone']; ?></td>
                        <td>Rp <?= number_format($data['price'], 0, ',', '.'); ?></td> <!-- Format nominal rupiah -->
                        <td><?= $data['jumlah']; ?></td>
                        <td>Rp <?= number_format($data['total_harga'], 0, ',', '.'); ?></td> <!-- Format nominal rupiah -->
                        <td>Rp <?= number_format($data['tunai'], 0, ',', '.'); ?></td> <!-- Format nominal rupiah -->
                        <td>
                            <?php if ($data['type_pembayaran'] == 'Credit') { ?>
                                <a style="color : red; text-decoration: none;" href="credit.php?id_transaksi=<?= $data['id_transaksi'] ?>"><?= $data['type_pembayaran']; ?></a>
                            <?php } else { ?>
                                <?= $data['type_pembayaran']; ?>
                            <?php } ?>
                        </td>
                        <td><?= $data['status']; ?></td>
                        <td><a href="delete_transaksi.php?id=<?= $data['id_transaksi'] ?>" onclick="return confirm('Are you sure')"><input type="button" class="btn-delete" value="delete" style="border: 0;"></a></td>
                        <td><a href="cetak_transaksi.php?id=<?= $data['id_transaksi'] ?>"><input type="button" class="btn-cetak" value="cetak" style="border: 0;"></a></td>
                    </tr>
                <?php endforeach; ?>
                </table>
            </div>

            <!-- Script JavaScript untuk menangani tab -->
            <script>
                function openTab(evt, tabName) {
                    var i, tabcontent, tablinks;
                    tabcontent = document.getElementsByClassName("tabcontent");
                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                    }
                    tablinks = document.getElementsByClassName("tablinks");
                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].className = tablinks[i].className.replace(" active", "");
                    }
                    document.getElementById(tabName).style.display = "block";
                    evt.currentTarget.className += " active";                                    
                }
            </script>
            <!-- Akhir script JavaScript -->

         
            <a href="index.php"><input type="button" class="btn-back" value="Back to Home" style="border: 0;"></a>
        </div>
    </div>
    </div>

    <script src="script.js">
        function cetak() {
            window.print();
        }
    </script>
</body>

</html>