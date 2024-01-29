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
    <h2>Struk Transaksi Credit</h2>
    <table>
    <?php
        include "connection.php"; // call connection

        $query = "SELECT * FROM transaksi AS t, buyer AS b, stock AS s, users AS u WHERE id_transaksi = '$_GET[id]' AND t.id_buyer = b.id_buyer AND t.id_stock = s.id_stock AND t.userid = u.userid";
        $cetak = mysqli_query($db_connection, $query); // run query             
        $data1 = mysqli_fetch_assoc($cetak);        

        $querycredit = "SELECT * FROM credit WHERE id_transaksi = '$_GET[id]'";
        $credit = mysqli_query($db_connection, $querycredit);
        $data2 = mysqli_fetch_assoc($credit);
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
            <td style="text-align: left;">: Rp <?= number_format($data1['price'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td style="text-align: left;">Jumlah</td>
            <td style="text-align: left;">: <?= $data1['jumlah'] ?></td>
        </tr>
        <tr>
            <td style="text-align: left;">Total Harga</td>
            <td style="text-align: left;">: Rp <?= number_format($data1['total_harga'], 0, ',', '.'); ?></td>
        </tr>      
        <tr>
            <td style="text-align: left;">Tunai</td>
            <td style="text-align: left;">: Rp <?= number_format($data1['tunai'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td style="text-align: left;">Metode Pembayaran</td>
            <td style="text-align: left;">: <?= $data1['type_pembayaran'] ?></td>
        </tr>
        <tr>
            <td style="text-align: left;">Status</td>
            <td style="text-align: left;">: <?= $data1['status'] ?></td>
        </tr>        
        <tr>                                         
    </table>   
    <table border="1">
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Uang Muka</th>
                    <th>Total angsuran</th>
                    <th>Pembayaran ke :</th>
                    <th>Dana masuk</th>                 
                </tr>

                <!--- will loop if the data not empty-->
                <?php
                if (mysqli_num_rows($credit) > 0) {
                    $i = 1;
                    $sisa1 = $data2['angsuran'];
                    $harga = $data1['total_harga'];
                    $tunai = $data1['tunai'];
                    foreach ($credit as $data2) :
                        $sisa_angsuran = $sisa1 - $data2['angsuran_berjalan'];
                        $sisa_dana = $harga - $tunai - $data2['dana'];
                ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= date('l, d M Y H:i:s', strtotime($data2['date'])) ?></td>
                            <td>Rp <?=number_format($data2['uang_muka'], 0, ',', '.');  ?></td>
                            <td><?= $data2['angsuran'] ?></td>
                            <td><?= $data2['angsuran_berjalan'] ?></td>
                            <td>Rp<?=number_format($data2['dana'], 0, ',', '.');  ?></td>                            
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th colspan="9" align="center">Sisa angsuran = <?=$sisa_angsuran  ?>, Sisa pembayaran = Rp<?= number_format($sisa_dana, 0, ',', '.'); ?></th>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <th colspan="9" align="center">No Record </th>
                    </tr>
                <?php } ?>
            </table>        

    <script>
        window.print();        
    </script>
</body>

</html>