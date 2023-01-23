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
            <h1>Berkah Jaya</h1>
            <h3>Buyer</h3>
            <a href="add_buyer.php"><input type="button" class="btn-add" value="Add buyer" style="margin: 10px 0 10px 0"></a>
            <table border="1">
                <tr>
                    <th>NO</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>NO KTP</th>
                    <th>NO NPWP</th>
                    <th>Nomor Hp</th>
                    <th colspan="2">Action</th>
                </tr>
                <?php
                include "connection.php"; // call connection
                $query = "SELECT * FROM buyer"; // make a sql query 
                $pets = mysqli_query($db_connection, $query); // run query 

                $i = 1; // initial counter for numbering
                foreach ($pets as $data) : // loop to extract data from database
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $data['name_buyer']; ?></td>
                        <td><?php echo $data['address_buyer']; ?></td>
                        <td><?php echo $data['noktp']; ?></td>
                        <td><?php echo $data['npwp']; ?></td>
                        <td><?php echo $data['nohp_buyer']; ?></td>
                        <td><a href="edit_buyer.php?id=<?= $data['id_buyer'] ?>"><input type="button" class="btn-update" value="edit" style="border: 0;"></a></td>
                        <td><a href="delete_buyer.php?id=<?= $data['id_buyer'] ?>" onclick="return confirm('Are you sure')"><input type="button" class="btn-delete" value="delete" style="border: 0;"></a></td>
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