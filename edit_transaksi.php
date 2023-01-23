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
            <h3>Form Edit Transaksi</h3>
            <?php
            // call connection php mysql
            include "connection.php";
            //*
            // make query SELECT FROM WHERE
            $query = "SELECT * FROM transaksi WHERE id_transaksi = '$_GET[id]'";

            // run query
            $user = mysqli_query($db_connection, $query);

            // EXTRACT data from QUERY result
            $data4 = mysqli_fetch_assoc($user);

            // make query SELECT FROM WHERE
            $querybuy = "SELECT * FROM buyer";

            // run query
            $buy = mysqli_query($db_connection, $querybuy);

            // EXTRACT data from QUERY result
            $data1 = mysqli_fetch_assoc($buy);

            $querystock = "SELECT * FROM stock";
            $stock = mysqli_query($db_connection, $querystock);

            $querypgw = "SELECT * FROM users";
            $pgw = mysqli_query($db_connection, $querypgw);


            ?>
            <form method="post" action="create_transaksi.php">
                <table>
                    <tr>
                        <td>Buyer</td>
                        <td>
                            <select name="buyer" required>
                                <option value="name_buyer">choose</option>
                                <?php foreach ($buy as $data1) : ?>
                                    <option value="<?= $data1['id_buyer'] ?>"><?= $data1['name_buyer'] ?></option>
                                    <!-- <option value="id_buyer" <?= ($data1['name_buyer'] == $data1['id_buyer']) ? 'selected' : '' ?>><?= $data1['id_buyer'] ?></option>-->
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Pegawai</td>
                        <td>
                            <select name="pegawai" required>
                                <option value="">Choose</option>
                                <?php foreach ($pgw as $data3) : ?>
                                    <option value="<?= $data3['userid'] ?>"><?= $data3['username'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><select name="phone" required>
                                <option value="">Choose</option>
                                <?php foreach ($stock as $data2) : ?>
                                    <option value="<?= $data2['id_stock'] ?>"> <?= $data2['phone'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td><input type="number" name="harga" id="harga" value="<?= $data2['price'] ?>" required></td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td><input type="number" name="jumlah" id="jumlah" value="<?= $data4['jumlah'] ?>" required></td>
                    </tr>
                    <tr>
                        <td>Total Harga</td>
                        <td><input type="number" name="harga" id="totalharga" value="<?= $data4['total_harga'] ?>" required>
                            <button onclick="hitungPesan ()">Hitung</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Tipe Pembayaran</td>
                        <td>
                            <input type="radio" name="type_pembayaran" value="Cash" <?= ($data4['type_pembayaran'] == 'Cash') ? 'checked' : '' ?> required>Cash
                            <input type="radio" name="type_pembayaran" value="Credit" <?= ($data4['type_pembayaran'] == 'Credit') ? 'checked' : '' ?> required>Credit
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <input type="radio" name="status" value="Lunas" <?= ($data4['status'] == 'Lunas') ? 'checked' : '' ?> required>Lunas
                            <input type="radio" name="status" value="Belum Lunas" <?= ($data4['status'] == 'Belum Lunas') ? 'checked' : '' ?> required>Belum Lunas
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="save" value="SAVE" class="btn-save" required>
                            <input type="submit" name="reset" value="RESET" class="btn-reset" required>
                            <input type="hidden" name="id_transaksi" value="<?= $data4['id_transaksi'] ?>" required>
                        </td>
                    </tr>
                </table>
            </form>
            <a href="read_transaksi.php"><input type="button" class="btn-cancel" value="Cancel"></a>
        </div>
    </div>
    </div>

    <script src="script.js">
        function hitungPesan() {
            var inputHarga = parseInt(document.getElementById("harga").value);
            var jmlTiket = document.getElementById("jumlah").value;
            var result;
            var tiket = parseInt(jmlTiket);

            result = inputHarga * tiket;

            document.getElementById("totalharga").value = result;
            console.log(result);
        }
    </script>
</body>

</html>