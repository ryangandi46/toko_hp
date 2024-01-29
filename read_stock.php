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
    <link rel="stylesheet" href="style.css">
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
            <h3>Stock</h3>


            <form method="GET" class="box-search">
                <input type="text" name="keyword" placeholder="Search..." class="field-search">
                <input type="submit" value="Search" class="btn-search">
            </form>
            <a href="add_stock.php"><input type="button" class="btn-add" value="Add Stock" style="margin: 10px 0 10px 0"></a>
            <link rel="stylesheet" href="style.css">

            <table border="1">
                <tr>
                    <th>NO</th>
                    <th>Phone</th>
                    <th>Display</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Spek</th>
                    <th colspan="3">Action</th>
                </tr>
                <?php
                include "connection.php"; // call connection

                // Handle search query
                $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
                $query = "SELECT * FROM stock WHERE phone LIKE '%$keyword%'";
                $stock = mysqli_query($db_connection, $query);

                $i = 1; // initial counter for numbering
                foreach ($stock as $data) : // loop to extract data from database
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td>
                            <?php if ($data['stok'] > 0) { ?>
                                <a href="add_trans.php?id_stock=<?= $data['id_stock'] ?>"><?= $data['phone']; ?></a>
                              
                            <?php } else { ?>
                                <?= $data['phone']; ?>
                            <?php } ?>
                        </td>
                        <td align="center">
                            <img src="uploads/stock/<?php echo $data['photo_stock']; ?>" width="50" height="60"><br>
                        </td>
                        <td>Rp <?= number_format($data['price'], 0, ',', '.'); ?></td>

                        <!--cara lain untuk menampilkan data, tapi ketika hanya echo satu baris-->
                        <td><?= $data['stok']; ?></td>
                        <td><?= $data['spek']; ?></td>
                        <td><a href="edit_stock.php?id=<?= $data['id_stock'] ?>"><input type="button" class="btn-update" value="edit" style="border: 0;"></a></td>
                        <td><a href="delete_stock.php?id=<?= $data['id_stock'] ?>" onclick="return confirm('Are you sure')"><input type="button" class="btn-delete" value="delete" style="border: 0;"></a></td>
                        <td><a href="stock_photo.php?id=<?= $data['id_stock'] ?>"><input type="button" class="btn-change" value="Change Photo" style="border: 0;"></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <a href="index.php"><input type="button" class="btn-back" value="Back to Home" style="border: 0;"></a>
            
        </div>
    </div>

    </div>
    <script src="script.js"></script>
</body>

</html>