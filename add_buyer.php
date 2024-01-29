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
            <h3>Form Add Buyer</h3>
            <form method="post" action="create_buyer.php">
                <table>
                    <tr>
                        <td>Name</td>
                        <td><input type="text" name="name_buyer" required></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><textarea name="address_buyer" required></textarea>
                        <td>
                    </tr>
                    <tr>
                        <td>NO KTP</td>
                        <td><input type="text" name="noktp" required maxlength="16"></td>
                    </tr>
                    <tr>
                        <td>NO NPWP</td>
                        <td><input type="text" name="npwp" required maxlength="16"></td>
                    </tr>
                    <tr>
                        <td>handphone</td>
                        <td><input type="text" name="phone_buyer" required maxlength="12"></td>
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
            <a href="read_buyer.php"><input type="button" class="btn-cancel" value="Cancel"></a>
        </div>
    </div>
    </div>

    <script src="script.js"></script>
</body>

</html>