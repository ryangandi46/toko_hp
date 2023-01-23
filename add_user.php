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
            <h3>Form Add Users</h3>
            <form method="post" action="create_user.php">
                <table>
                    <tr>
                        <td>username</td>
                        <td><input type="text" name="username" required></td>
                    </tr>

                    <tr>
                        <td>usertype</td>
                        <td>
                            <input type="radio" name="usertype" value="Kasir" required>Kasir
                            <input type="radio" name="usertype" value="Admin" required>Admin
                        </td>
                    </tr>
                    <tr>
                        <td>fullname</td>
                        <td><input type="text" name="fullname"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="save" value="SAVE" class="btn-save" required>
                            <input type="submit" name="reset" value="RESET" class="btn-reset" required>
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