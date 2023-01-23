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
            <form method="post" action="update_credit.php">
                <h3>Edit Credit</h3>
                <?php
                // call connection php mysql
                include "connection.php";

                // make query SELECT FROM WHERE
                $query = "SELECT * FROM transaksi AS t, buyer AS b, stock AS s, users AS u WHERE id_transaksi = '$_GET[id_transaksi]' AND t.id_buyer = b.id_buyer AND t.id_stock = s.id_stock AND t.userid = u.userid";

                // run query
                $trans = mysqli_query($db_connection, $query);
                // EXTRACT data from QUERY result
                $data2 = mysqli_fetch_assoc($trans);

                // make query SELECT FROM WHERE
                $query = "SELECT * FROM credit WHERE id_transaksi = '$_GET[id_credit]'";

                // run query
                $credit = mysqli_query($db_connection, $query);

                // EXTRACT data from QUERY result
                $data1 = mysqli_fetch_assoc($credit);

                ?>
                <table>
                    <tr>
                        <td>ID Transaksi</td>
                        <td><input type="number" name="id_transaksi" value="<?= $data1['id_transaksi'] ?>" required></td>
                    </tr>
                    <tr>
                        <td>Uang Muka</td>
                        <td><input type="number" name="uang_muka" value="<?= $data1['uang_muka'] ?>" required></td>
                    </tr>
                    <tr>
                        <td>Angsuran</td>
                        <td>
                            <select name="angsuran" required>
                                <option value="">Choose</option>
                                <option value="12" <?= ($data1['angsuran'] == '12') ? 'selected' : '' ?>>12</option>
                                <option value="24" <?= ($data1['angsuran'] == '24') ? 'selected' : '' ?>>24</option>
                                <option value="36" <?= ($data1['angsuran'] == '36') ? 'selected' : '' ?>>36</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Angsuran Berjalan</td>
                        <td><input type="number" name="angsuran_berjalan" value="<?= $data1['angsuran_berjalan'] ?>" required></td>
                    </tr>
                    <tr>
                        <td>Dana</td>
                        <td><input type="number" name="dana" value="<?= $data1['dana'] ?>" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input class="btn-save" type="submit" name="save" value="SAVE" class="btn-save" required>
                            <input class="btn-reset" type="submit" name="reset" value="RESET" class="btn-reset" required>
                            <input type="hidden" name="id_transaksi" value="<?= $data2['id_transaksi'] ?>">
                            <input type="hidden" name="id_credit" value="<?= $data1['id_credit'] ?>">
                        </td>
                    </tr>
                </table>
                <a class="btn" href="credit.php?id_transaksi=<?= $data2['id_transaksi'] ?>"><input type="button" class="btn-cancel" value="Cancel"></a>
            </form>            
        </div>
    </div>
    </div>

    <script src="script.js"></script>
</body>

</html>