<?php
session_start(); // start the session
if (!isset($_SESSION['login'])) {
    echo "<script>alert('Please login first !');window.location.replace('form_login.php');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <h3>Credit</h3>
            <?php
            // call connection php mysql
            include "connection.php";

            // make query SELECT FROM WHERE
            $query = "SELECT * FROM transaksi AS t, buyer AS b, stock AS s, users AS u WHERE id_transaksi = '$_GET[id_transaksi]' AND t.id_buyer = b.id_buyer AND t.id_stock = s.id_stock AND t.userid = u.userid";

            // run query
            $trans = mysqli_query($db_connection, $query);

            // EXTRACT data from QUERY result
            $data1 = mysqli_fetch_assoc($trans);

            //query two table
            $querycredit = "SELECT * FROM credit  WHERE id_transaksi = '$_GET[id_transaksi]'";
            $credit = mysqli_query($db_connection, $querycredit);
            $data2 = mysqli_fetch_assoc($credit);

            ?>
            <table style=" width:fit-content;">
                <tr>
                    <td style="text-align: left;">Id Transaksi / Name Buyer</td>
                    <td style="text-align: left;">: <?= $data1['id_transaksi'] ?> / <?= $data1['name_buyer'] ?> </td>
                </tr>
                <tr>
                    <td style="text-align: left;">Date / Pegawai</td>
                    <td style="text-align: left;">: <?= $data1['tanggal'] ?> / <?= $data1['username'] ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Handphone / Harga</td>
                    <td style="text-align: left;">: <?= $data1['phone'] ?> / Rp <?= number_format($data1['price'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Jumlah / Total harga</td>
                    <td style="text-align: left;">: <?= $data1['jumlah'] ?> / Rp <?= number_format($data1['total_harga'], 0, ',', '.');?></td>
                </tr>
                <tr>
                    <td style="text-align: left;"> Tunai</td>
                    <td style="text-align: left;">: Rp <?= number_format($data1['tunai'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;"> Status</td>
                    <td style="text-align: left;">:<?= $data1['status'] ?></td>
                </tr>
            </table>         
            <?php if ($data1['status'] == 'Belum Lunas') { ?>   
                <a href="add_credit.php?id_transaksi=<?= $data1['id_transaksi'] ?>"><input type="button" class="btn-add" value="Tambah Credit" style="position: absolute; width:100px; margin: 0 0 10px 0;"></a>                        
                <?php } ?>
                <a href="cetak_credit.php?id=<?= $data1['id_transaksi'] ?>"><input type="button" class="btn-cetak" value="cetak" style="position: relative; height:35px; left:93%; margin: 0 0 10px 0;"></a>            
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
                            <td>Rp<?=number_format($data2['uang_muka'], 0, ',', '.');  ?></td>
                            <td><?= $data2['angsuran'] ?></td>
                            <td><?= $data2['angsuran_berjalan'] ?></td>
                            <td>Rp<?=number_format($data2['dana'], 0, ',', '.');  ?></td>                           
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th colspan="9" align="center">Sisa angsuran = <?= $sisa_angsuran ?>, Sisa pembayaran = Rp <?= number_format($sisa_dana, 0, ',', '.');?></th>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <th colspan="9" align="center">No Record </th>
                    </tr>
                <?php } ?>
            </table>
            <a href="read_transaksi.php"><input type="button" class="btn-back" value="Back to Transaksi" style="border: 0; width:113px;"></a>
        </div>
    </div>
    </div>

    <script src="script.js"></script>
</body>

</html>