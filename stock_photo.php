<?php
session_start(); // start the session
if (!isset($_SESSION['login'])) {
    echo "<script>alert('Please login first !');window.location.replace('form_login.php');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

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
            <h3>Change Stock Photo</h3>
            <?php
            // call connection php mysql
            include "connection.php";

            //make query SELECT FROM WHERE
            $query = "SELECT * FROM stock WHERE id_stock='$_GET[id]'";

            // run query
            $pet = mysqli_query($db_connection, $query);

            // extract data from query result
            $data = mysqli_fetch_assoc($pet);
            ?>
            <form method="post" action="stock_upload.php" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td></td>
                        <td><img src="uploads/stock/<?php echo $data['photo_stock']; ?>" width="100" height="100"></td>
                    </tr>
                    <tr>
                        <td>New Photo</td>
                        <td>: <input type="file" name="new_photo" required /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;
                            <input type="submit" name="upload" value="UPLOAD" class="btn-upload" />
                            <input type="hidden" name="photo_stock" value="<?= $data['photo_stock']; ?>" />
                            <input type="hidden" name="id_stock" value="<?= $data['id_stock']; ?>" />
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