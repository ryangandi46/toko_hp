<?php
session_start();
if (!isset($_SESSION['login'])) {
	echo "<script>alert('Please login first !');window.location.replace('form_login.php');</script>";
}
?>
<!DOCTYPE HTML>
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
			<h3>Monthly Report</h3><br>
			<?php
			$months = array('January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
			$year = date('Y');
			?>
			<form>
				<p style="color : black;">Select
					<select name="month" required>
						<option value="">Month</option>
						<?php for ($m = 1; $m <= 12; $m++) { ?>
							<option value="<?= $m ?>"><?= $months[$m - 1] ?></option>
						<?php } ?>
					</select>
					<select name="year" required>
						<option value="">Year</option>
						<?php for ($y = 0; $y <= 2; $y++) { ?>
							<option value="<?= $year - $y ?>"><?= $year - $y ?></option>
						<?php } ?>
					</select>
					<input type="submit" value="View Report">
				</p>
			</form>
			<?php
			if (isset($_GET['year'])) {
				include 'connection.php';
				//$query="SELECT * FROM medicals";
				$query = "SELECT * FROM transaksi INNER JOIN buyer ON transaksi.id_buyer = buyer.id_buyer INNER JOIN stock ON transaksi.id_stock = stock.id_stock
            INNER JOIN users ON transaksi.userid = users.userid AND MONTH(tanggal)='$_GET[month]' AND YEAR(tanggal)='$_GET[year]'";
				$report = mysqli_query($db_connection, $query);

			?>
				<br>
				<h4>Report Periode <?= $months[$_GET['month'] - 1] ?> - <?= $_GET['year'] ?></h4><br>
				<table border="1">
					<tr>
						<th>No</th>
						<th align="center">Date</th>
						<th align="center">Pembeli</th>
						<th align="center">Phone</th>
						<th align="center">Harga</th>
						<th align="center">Jumlah</th>
						<th align="center">Total Harga</th>
						<th align="center">Tunai</th>
						<th align="center">Tipe Pembayaran</th>
						<th align="center">Status</th>
					</tr>
					<?php
					if (mysqli_num_rows($report) > 0) {
						$i = 1;
						$total = 0;
						foreach ($report as $data) :
							$total = $total + $data['total_harga'] + $data['tunai'];
					?>
							<tr>
								<td><?= $i++ ?></td>
								<td><?= date('D, d-M-Y H:i:s', strtotime($data['tanggal'])) ?></td>
								<td><?= $data['name_buyer'] ?></td>
								<td><?= $data['phone'] ?></td>
								<td><?= $data['price'] ?></td>
								<td><?= $data['jumlah'] ?></td>
								<td><?= $data['total_harga'] ?></td>
								<td><?= $data['tunai']; ?></td>
								<td><?= $data['type_pembayaran'] ?></td>
								<td><?= $data['status'] ?></td>
							</tr>
						<?php endforeach; ?>
						<tr>
							<th colspan="10" align="center">Total : RP <?= $total ?></th>
						</tr>
					<?php } else { ?>
						<tr>
							<th colspan="10" align="center">No Record </th>
						</tr>
					<?php } ?>
				</table><br>
			<?php } ?>
			<br>
			<a href="index.php"><input type="button" class="btn-back" value="Back to Home" style="border: 0;"></a>
		</div>
	</div>
	</div>

	<script src="script.js"></script>
</body>

</html>