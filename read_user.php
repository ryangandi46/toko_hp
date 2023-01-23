<?php
session_start(); // start the session
if (!isset($_SESSION['login'])) {
    echo "<script>alert('Please login first !');window.location.replace('form_login.php');</script>";
}
if ($_SESSION['usertype'] != 'Admin') {
    echo "<script>alert('Accesss forbidden !');window.location.replace('index.php');</script>";
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
            <h3>User List</h3>
            <a href="add_user.php"><input type="button" class="btn-add" value="Add User" style="margin: 10px 0 10px 0"></a>
            <link rel="stylesheet" href="style.css">
            <table border="1">
                <tr>
                    <th>NO</th>
                    <th>Username</th>
                    <th>Usertype</th>
                    <th>Fullname</th>
                    <th colspan="3">Action</th>
                </tr>
                <?php
                include "connection.php"; // call connection
                $query = "SELECT * FROM users"; // make a sql query 
                $pets = mysqli_query($db_connection, $query); // run query 

                $i = 1; // initial counter for numbering
                foreach ($pets as $data) : // loop to extract data from database
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $data['username']; ?></td>
                        <td><?php echo $data['usertype']; ?></td>
                        <!--cara lain untuk menampilkan data, tapi ketika hanya echo satu baris-->
                        <td><?= $data['fullname']; ?></td>
                        <td><a href="edit_user.php?id=<?= $data['userid'] ?>"><input type="button" class="btn-update" value="edit" style="border: 0;"></a></td>
                        <td><a href="delete_user.php?id=<?= $data['userid'] ?>" onclick="return confirm('Are you sure')"><input type="button" class="btn-delete" value="delete" style="border: 0;"></a></td>
                        <td><a href="reset_password.php?id=<?= $data['userid'] ?>&type=<?= $data['usertype']; ?>" onclick="return 
            confirm('Are you sure reset the password?')"><input type="button" value="Reset password" class="btn-resetpass" style="border: 0;"></a></td>
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