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
            <!--<p><a href="add_transaksi.php">Add Transaksi</a></p>-->
            <table border="1">
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
                // $query = ("SELECT transaksi.tanggal, transaksi.jumlah, transaksi.harga, transaksi.type_pembayaran, 
                //transaksi.status, buyer.name_buyer, stock.phone FROM transaksi JOIN buyer ON 
                //transaksi.id_buyer=buyer.id_buyer JOIN stock ON transaksi.id_stock=stock.id_stock");  // make a sql query         

                $query = "SELECT * FROM transaksi INNER JOIN buyer ON transaksi.id_buyer = buyer.id_buyer INNER JOIN stock ON transaksi.id_stock = stock.id_stock
            INNER JOIN users ON transaksi.userid = users.userid";
                //$query = "SELECT * FROM transaksi INNER JOIN buyer ON transaksi.id_buyer = buyer.id_buyer";
                $trans = mysqli_query($db_connection, $query); // run query             
                // EXTRACT data from QUERY result
                $data = mysqli_fetch_assoc($trans);

                $i = 1; // initial counter for numbering
                foreach ($trans as $data) : // loop to extract data from database           
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?= date('l, d M Y H:i:s', strtotime($data['tanggal'])) ?></td>
                        <td><?= $data['name_buyer']; ?></td>
                        <td><?php echo $data['username']; ?></td>
                        <td><?php echo $data['phone']; ?></td>
                        <!--cara lain untuk menampilkan data, tapi ketika hanya echo satu baris-->
                        <td><?= $data['price']; ?></td>
                        <td><?= $data['jumlah']; ?></td>
                        <td><?= $data['total_harga']; ?></td>
                        <td><?= $data['tunai']; ?></td>
                        <td>

                            <?php if ($data['status'] == 'Belum Lunas') { ?>
                                <a style="color : red; text-decoration: none;" href="credit.php?id_transaksi=<?= $data['id_transaksi'] ?>"><?= $data['type_pembayaran']; ?></a>
                            <?php } else { ?>
                                <?= $data['type_pembayaran']; ?>
                            <?php } ?>
                        </td>
                        <td><?= $data['status']; ?></td>
                        <!--<td><a href="edit_transaksi.php?id=<?= $data['id_transaksi'] ?>"><input type="button" class="btn-update" value="edit"></a></td>-->
                        <td><a href="delete_transaksi.php?id=<?= $data['id_transaksi'] ?>" onclick="return confirm('Are you sure')"><input type="button" class="btn-delete" value="delete" style="border: 0;"></a></td>
                        <td><a href="cetak_transaksi.php?id=<?= $data['id_transaksi'] ?>"><input type="button" class="btn-cetak" value="cetak" style="border: 0;"></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
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