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
</head>

<body>
    <h1>Berkah Jaya</h1>
    <h2>Struk Transaksi Penjualan :</h2>
    <table>
        <?php
        include "connection.php"; // call connection

        $query = "SELECT * FROM transaksi AS t, buyer AS b, stock AS s, users AS u WHERE id_transaksi = '$_GET[id]' AND t.id_buyer = b.id_buyer AND t.id_stock = s.id_stock AND t.userid = u.userid";
        $cetak = mysqli_query($db_connection, $query); // run query             
        $data1 = mysqli_fetch_assoc($cetak);
        ?>
        <tr>
            <td style="text-align: left;">Date</td>
            <td style="text-align: left;">: <?= date('l, d M Y H:i:s', strtotime($data1['tanggal'])) ?></td>
        </tr>
        <tr>
            <td style="text-align: left;">Nama Kasir</td>
            <td style="text-align: left;">: <?= $data1['username'] ?></td>
        </tr>
        <tr>
            <td style="text-align: left;">Nama Pembeli</td>
            <td style="text-align: left;">: <?= $data1['name_buyer'] ?> </td>
        </tr>
        <tr>
            <td style="text-align: left;">Handphone</td>
            <td style="text-align: left;">: <?= $data1['phone'] ?></td>
        </tr>
        <tr>
            <td style="text-align: left;">Harga</td>
            <td style="text-align: left;">: <?= $data1['price'] ?></td>
        </tr>
        <tr>
            <td style="text-align: left;">Jumlah</td>
            <td style="text-align: left;">: <?= $data1['jumlah'] ?></td>
        </tr>
        <tr>
            <td style="text-align: left;">Total Harga</td>
            <td style="text-align: left;">: <?= $data1['total_harga'] ?></td>
        </tr>
        <tr>
            <td style="text-align: left;">Total Harga</td>
            <td style="text-align: left;">: <?= $data1['total_harga'] ?></td>
        </tr>
        <tr>
            <td style="text-align: left;">Tunai</td>
            <td style="text-align: left;">: <?= $data1['tunai'] ?></td>
        </tr>
        <tr>
            <td style="text-align: left;">Metode Pembayaran</td>
            <td style="text-align: left;">: <?= $data1['type_pembayaran'] ?></td>
        </tr>
        <tr>
            <td style="text-align: left;">Status</td>
            <td style="text-align: left;">: <?= $data1['status'] ?></td>
        </tr>
    </table>

    <script>
        window.print();
    </script>
</body>

</html>