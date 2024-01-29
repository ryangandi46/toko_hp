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
            <h3>Form Add Transaksi</h3>
            <?php
            // call connection php mysql
            include "connection.php";
            $user_id = $_SESSION['login'];
            // make query SELECT FROM WHERE
            $querybuy = "SELECT * FROM buyer";

            // run query
            $buy = mysqli_query($db_connection, $querybuy);

            // EXTRACT data from QUERY result
            $data1 = mysqli_fetch_assoc($buy);

            $querystock = "SELECT * FROM stock WHERE id_stock ='$_GET[id_stock]'";
            $stock = mysqli_query($db_connection, $querystock);
            $data2 = mysqli_fetch_assoc($stock);

            $queryuse = "SELECT * FROM users WHERE userid";
            $user = mysqli_query($db_connection, $queryuse);
            $data3 = mysqli_fetch_assoc($user);

            ?>
            <form method="post" action="create_transaksi.php">
                <table>
                    <tr>
                        <td>Pegawai</td>
                        <td><input type="text" name="" value="<?= $_SESSION['username'] ?>" readonly></td>
                    </tr>
                    <tr>
                       <!-- //manipulasi  hidden field  -->
                        <td><input type="text"  name="user" value="<?= $_SESSION['userid'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Buyer</td>
                        <td>
                            <select name="buyer" required>
                                <option value="">-Pilih pembeli-</option>
                                <?php foreach ($buy as $data1) : ?>
                                    <option value="<?= $data1['id_buyer'] ?>"><?= $data1['name_buyer'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>Pegawai</td>
                        <td>
                            <select name="user" required>
                                <option value="">-Pilih pegawai-</option>
                                <?php foreach ($user as $data3) : ?>
                                    <option value="<?= $data3['userid'] ?>"><?= $data3['username']  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr> -->
                    <tr>
                        <td>ID Phone</td>
                        <td><input type="text" name="id_phone" value="<?= $data2['id_stock'] ?>" readonly></td>
                    </tr>

                    <tr>
                        <td>Phone</td>
                        <td><input type="text" name="phone" value="<?= $data2['phone'] ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Harga Satuan</td>
                        <td><input type="number" name="harga" id="harga" value="<?= $data2['price'] ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td><input type="number" name="jumlah" id="jumlah" required></td>
                    </tr>
                    <tr>
                        <td>Total Harga</td>
                        <td><input type="number" name="total_harga" id="totalharga" readonly>
                            <button onclick="hitungPesan ()">Hitung</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Tunai</td>
                        <td><input type="number" name="tunai" required></td>
                    </tr>
                    <tr>
                        <td>Tipe Pembayaran</td>
                        <td>
                            <input type="radio" name="type_pembayaran" value="Cash" required>Cash
                            <input type="radio" name="type_pembayaran" value="Credit" required>Credit
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <input type="radio" name="status" value="Lunas" required>Lunas
                            <input type="radio" name="status" value="Belum Lunas" required>Belum Lunas
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="save" value="SAVE" class="btn-save" onclick="confirmTransaction()" required>
                            <input type="submit" name="reset" value="RESET" class="btn-reset" required>
                            <input type="hidden" name="id_stock" value="<?= $data2['id_stock'] ?>">
                        </td>
                    </tr>
                </table>
            </form>
            <a href="read_stock.php"><input type="button" class="btn-cancel" value="Cancel"></a>
        </div>
    </div>
    </div>


    <script>
        function hitungPesan() {
            var inputHarga = parseInt(document.getElementById("harga").value);
            var jmlTiket = document.getElementById("jumlah").value;
            var result;
            var tiket = parseInt(jmlTiket);

            result = inputHarga * tiket;

            document.getElementById("totalharga").value = result;
            console.log(result);
        }

        function confirmTransaction() {
            if (confirm("Apakah Anda yakin ingin melakukan transaksi?")) {
                // Lakukan transaksi
                window.location.replace("read_transaksi.php");
            } else {
                // Batalkan transaksi
                window.location.replace("add_transaksi.php");
            }
        }
    </script>
    <script>
        function hideInput() {
            document.getElementById("user").style.display = "none";
        }

        hideInput();
    </script>
</body>

</html>