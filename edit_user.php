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
    <title>Perkah Jaya</title>
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
            <h3>Form Add Users</h3>
            <?php
            // call connection php mysql
            include "connection.php";

            // make query SELECT FROM WHERE
            $query = "SELECT * FROM users WHERE userid = '$_GET[id]'";

            // run query
            $user = mysqli_query($db_connection, $query);

            // EXTRACT data from QUERY result
            $data = mysqli_fetch_assoc($user);

            ?>
            <form method="post" action="update_user.php">
                <table>
                    <tr>
                        <td>username</td>
                        <td><input type="text" name="username" value="<?= $data['username'] ?>" required></td>
                    </tr>

                    <tr>
                        <td>usertype</td>
                        <td>
                            <input type="radio" name="usertype" value="Kasir" <?= ($data['usertype'] == 'Kasir') ? 'checked' : '' ?> required>Kasir
                            <input type="radio" name="usertype" value="Admin" <?= ($data['usertype'] == 'Admin') ? 'checked' : '' ?> required>Admin
                        </td>
                    </tr>
                    <tr>
                        <td>fullname</td>
                        <td><input type="text" name="fullname" value="<?= $data['fullname'] ?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="save" value="SAVE" class="btn-save" required>
                            <input type="submit" name="reset" value="RESET" class="btn-reset" required>
                            <input type="hidden" name="userid" value="<?= $data['userid'] ?>" required>
                        </td>
                    </tr>
                </table>
            </form>
            <a href="read_user.php"><input type="button" class="btn-cancel" value="Cancel"></a>
        </div>
    </div>
    </div>

    <script src="script.js"></script>
</body>

</html>