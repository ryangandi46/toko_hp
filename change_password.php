<?php
session_start(); // start the session
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
            <h3>Change Password<h3>
                    <form method="post" action="update_password.php">
                        <table>
                            <tr>
                                <td>New Password</td>
                                <td>: <input type="password" name="new_password" id="new" required /></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;<input type="checkbox" onclick="show()"> Show Password</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;
                                    <input type="submit" name="change" value="CHANGE" class="btn-save" />
                                    <input type="reset" name="Reset" value="RESET" class="btn-reset" />
                                </td>
                        </table>
                    </form>
                    <a href="index.php"><input type="button" class="btn-cancel" value="Cancel"></a>
        </div>
    </div>
    </div>

    <script>
        function show() {
            var x = document.getElementById("new");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>