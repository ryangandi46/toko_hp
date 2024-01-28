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
            <?php
            // call connection php mysql
            include "connection.php";

            // make query SELECT FROM WHERE

            $query = "SELECT * FROM transaksi AS t, buyer AS b, stock AS s, users AS u WHERE id_transaksi = '$_GET[id_transaksi]' AND t.id_buyer = b.id_buyer AND t.id_stock = s.id_stock AND t.userid = u.userid";

            // run query
            $trans = mysqli_query($db_connection, $query);

            // EXTRACT data from QUERY result
            $data1 = mysqli_fetch_assoc($trans);

            $query = "SELECT * FROM credit WHERE id_transaksi = '$_GET[id_transaksi]'";

            // run query
            $credit = mysqli_query($db_connection, $query);

            // EXTRACT data from QUERY result
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
                    <td style="text-align: left;">: <?= $data1['jumlah'] ?> / Rp <?= number_format($data1['total_harga'], 0, ',', '.'); ?> </td>
                </tr>
                <tr>
                    <td style="text-align: left;"> Tunai</td>
                    <td style="text-align: left;">: Rp <?= number_format($data1['tunai'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;"> Status</td>
                    <td style="text-align: left;">: <?= $data1['status'] ?></td>
                </tr>
                <?php
                    $harga = $data1['total_harga'];
                    $tunai = $data1['tunai'];
                    $sisa_dana = $harga - $tunai - $data2['dana'];
                    ?>
                <tr>
                    <td style="text-align: left;"> Angsuran Dibayarkan</td>
                    <td style="text-align: left;">: <?= $data2['angsuran_berjalan'] ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Sisa pembayaran</td>
                    <td style="text-align: left;">: Rp <?= number_format($sisa_dana, 0, ',', '.'); ?></td>
                </tr>
            </table>
            <h3>Add Credit</h3>
            <form method="post" action="create_credit.php">
                <table>
                    <tr>
                        <td>Uang Muka</td>
                        <td><input type="number" name="uang_muka" value="<?= number_format($data1['tunai'], 0, ',', '.'); ?>" readonly><?= number_format($data1['tunai'], 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td>Angsuran</td>
                        <td>
                            <select name="angsuran" required>
                                <option value="">Choose</option>
                                <?php if ($data2['angsuran'] == '12') { ?>
                                    <option value="12" <?= ($data2['angsuran'] == '12') ? 'selected' : '' ?>>12</option>
                                <?php }
                                if ($data2['angsuran'] == '24') { ?>
                                    <option value="24" <?= ($data2['angsuran'] == '24') ? 'selected' : '' ?>>24</option>
                                <?php }
                                if ($data2['angsuran'] == '36') { ?>
                                    <option value="36" <?= ($data2['angsuran'] == '36') ? 'selected' : '' ?>>36</option>
                                <?php } else { ?>
                                    <option value="12">12</option>
                                    <option value="24">24</option>
                                    <option value="36">36</option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>                   
                    <tr>
                        <td>Angsuran Berjalan</td>
                        <td><input type="number" name="angsuran_berjalan" required></td>
                    </tr>
                    <tr>
                        <td>Dana masuk</td>
                        <td><input type="number" name="dana" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input class="btn-save" type="submit" name="save" value="SAVE" class="btn-save" required>
                            <input class="btn-reset" type="submit" name="reset" value="RESET" class="btn-reset" required>
                            <input type="hidden" name="id_transaksi" value="<?= $data1['id_transaksi'] ?>">
                        </td>
                    </tr>
                </table>

            </form>
            <a class="btn" href="credit.php?id_transaksi=<?= $data1['id_transaksi'] ?>"><input type="button" class="btn-cancel" value="Cancel"></a>
        </div>
    </div>
    </div>

    <script src="script.js"></script>
</body>

</html>