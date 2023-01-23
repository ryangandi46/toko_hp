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
    <title>Berkah Jaya</title>

    <!--fonts google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">

    <!--my style-->
    <link rel="stylesheet" href="style.css">
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
            <section class="services" id="services">

                <h1 class="heading" style="margin:0%; padding:0%;"> Dashboard </h1>

                <div class="box-container">

                    <div class="box">                      
                        <h3 style="margin-left: 0px">Stock</h3>
                        <p style="margin-left: 0px">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad, omnis.</p>
                        <a href="read_stock.php" class="btn"> lihat </a>
                    </div>                   
                    <div class="box">                      
                        <h3 style="margin-left: 0px">Pembeli</h3>
                        <p style="margin-left: 0px">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad, omnis.</p>
                        <a href="read_buyer.php" class="btn"> lihat  </a>
                    </div>                   
                    <div class="box">                      
                        <h3 style="margin-left: 0px">Transaksi</h3>
                        <p style="margin-left: 0px">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad, omnis.</p>
                        <a href="read_transaksi.php" class="btn"> lihat  </a>
                    </div>                   

                    <?php if ($_SESSION['usertype'] == 'Admin') { ?>
                        <div class="box">
                            <h3 style="margin-left: 0px">Pegawai</h3>
                            <p style="margin-left: 0px">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad, omnis.</p>
                            <a href="read_user.php" class="btn"> lihat  </a>
                        </div>


                        <div class="box">                      
                            <h3 style="margin-left: 0px">Data Report</h3>
                            <p style="margin-left: 0px">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad, omnis.</p>
                            <a href="report.php" class="btn"> lihat  </span> </a>
                        </div>
                    <?php } ?>

                </div>

            </section>
            <!-- services section ends -->
        </div>
    </div>
    </div>


    <script src="script.js"></script>
</body>

</html>