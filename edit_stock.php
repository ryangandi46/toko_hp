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
            <h3>Form Edit Stock</h3>
            <?php
            // call connection php mysql
            include "connection.php";

            // make query SELECT FROM WHERE
            $query = "SELECT * FROM stock WHERE id_stock = '$_GET[id]'";

            // run query
            $user = mysqli_query($db_connection, $query);

            // EXTRACT data from QUERY result
            $data = mysqli_fetch_assoc($user);

            ?>
            <form method="post" action="update_stock.php">
                <table>
                    <tr>
                        <td>Phone</td>
                        <td><input type="text" name="phone" value="<?= $data['phone'] ?>" required></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><input type="text" name="price_phone" value="<?= $data['price'] ?>" required></td>
                    </tr>
                    <tr>
                        <td>Stock</td>
                        <td><input type="text" name="stock_phone" value="<?= $data['stok'] ?>" required></td>
                    </tr>
                    <tr>
                        <td>Spek</td>
                        <td><textarea name="spek_phone" required><?= $data['spek'] ?></textarea>
                        <td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="save" value="SAVE" class="btn-save" required>
                            <input type="submit" name="reset" value="RESET" class="btn-reset" required>
                            <input type="hidden" name="id_stock" value="<?= $data['id_stock'] ?>" required>
                        </td>
                    </tr>
                </table>
            </form>
            <a href="read_stock.php"><input type="button" class="btn-cancel" value="Cancel"></a>
        </div>
    </div>
    </div>

    <script src="script.js"></script>
</body>

</html>