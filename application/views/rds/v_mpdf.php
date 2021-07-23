<?php

function tgl_indo($tanggal)
{
	$bulan = array(
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Generate</title>
	<!-- Common plugins  -->
	<link href="<?php echo base_url(); ?>/assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">



	<style>
		body {
			font-size: 11px;
			font-family: "Times New Roman", Times, serif;
			border: 1px solid #000;


		}

		.atd,
		.ath {
			border: 1px solid #000;
			text-align: left;
		}

		.atdx {
			border-bottom: collapse none solid #fff;
			border-top: collapse 1px solid #000;

		}

		.atdb {
			border-top: collapse 1px solid #000;



		}

		table {
			border-collapse: collapse;
			width: 100%;
			border: 1px solid #fff;


		}
	</style>


</head>

<body>
	<div><img alt="" src="<?php echo base_url(); ?>/img/header-logo-tl.png" class="float-left" width="50%" ;></div>
	<br />
	<h3>INVOICE</h3>
	<?php  ?>
	<label>Jakarta, <?php echo tgl_indo(date('Y-m-d'));
					foreach ($cari as $dt) { ?></label>
	<br /><br />
	<p>

		<label>Kepada YTH,</label><br />
		<label><?php echo $dt->PARTNERNAME; ?></label><br />
		<label><?php echo $dt->NMDIVISION; ?></label><br />
		<label><?php echo $dt->ALAMAT; ?></label> <br />
		<label><?php echo $dt->KOTA; ?></label> <br />
		<label><?php echo $dt->NMSUB; ?></label><br />
		<label>Dengan Hormat,</label>
	<?php } ?>
	</p>

	<p align="justify">

		Terima kasih atas kepercayaan Instansi bapak/Ibu menjadi peserta program Asuransi Jiwa Taspen, dengan ini kami sampaikan tagihan premi program asuransi untuk pegawai pada <?php foreach ($cari as $dt) {
																																														echo $dt->NMDIVISION;
																																													} ?> dengan rincian sebagai berikut:
	</p>
	<?php foreach ($cari as $dt) { ?>

		<table style="border-style: none;">
			<tr>
				<td>No Invoice</td>
				<td>: <?php echo $dt->NOINVOICE;

						if ($dt->REV != '0') {
							echo " - Rev " . $dt->REV;
						}
						?>
				</td>
			</tr>
			<tr>
				<td>No. Polis</td>
				<td>: <?php echo $dt->POLICYNO; ?></td>
			</tr>
			<tr>
				<td>Pemegang Polis</td>
				<td>: <?php echo $dt->PARTNERNAME; ?></td>
			</tr>
			<tr>
				<td>Bulan Invoice</td>
				<td>: <?php echo $dt->DUEDATEMONTH;
						echo " " . $dt->TAHUN; ?></td>
			</tr>
			<tr>
				<td>Tanggal Jatuh Tempo</td>
				<td>: <?php
						if (!empty($dt->DUEDATE)) {
							echo tgl_indo($dt->DUEDATE);
						} else {
							$current_date = date_create(date('Y-m-d'));
							$duedate = date_add($current_date, date_interval_create_from_date_string("30 days"));
							echo tgl_indo($duedate->format('Y-m-d'));
						}
						// echo $dt->DUEDATE;  
						?></td>
			</tr>
			<tr>
				<td>Jumlah Tagihan</td>
				<td>:&nbsp;<?php echo $dt->CURRENCY; ?> <?php echo number_format($dt->JMLPREMI, 2, ",", "."); ?></td>
			</tr>
			<tr>
				<td>Currency</td>
				<td>: <?php echo $dt->CURRENCY; ?></td>
			</tr>

		</table>
	<?php } ?>

	<p></p>



	<table class="table">
		<tr>
			<td style="border: 1px solid #000;" align="center" colspan="3"><b>Rincian Tagihan</b></td>
		</tr>
		<tr>
			<td class="text-center atd">Uraian</td>
			<td class="text-center atd" style="size:20px;">Jml. Pst</td>
			<td class="text-center atd">Premi (Rp)</td>
		</tr>
		<?php foreach ($cari as $dt) { ?>

			<tr>
				<td style="border: 1px solid #000; size:10000px;" class="text-left"><?php echo $dt->PRODUCTNAME; ?></td>
				<td style="border: 1px solid #000;" class="text-center"><?php echo $dt->JMLPST; ?></td>
				<td class="text-right atd"><?php echo $dt->CURRENCY; ?> &nbsp;<?php echo number_format($dt->JMLPREMI, 2, ",", "."); ?></td>
			</tr>
		<?php } ?>

		<tr>
			<td style="border-top: 1px solid #000;" colspan="2" align="right">Jumlah</td>
			<?php foreach ($jml as $dtx) { ?>
				<td class="text-right atd">IDR &nbsp;<?php echo number_format($dtx->jml, 2, ",", ".");
													} ?> </td>
		</tr>
	</table>

	<br />

	<?php
	foreach ($cari as $dt) {
		echo "<i>Terbilang: #" . $dt->TERBILANG . "#  </i>" . $dt->CURRENCY;
	}
	?>

	<br /><br />

    <?php foreach ($listparams as $dt) { ?>
	<label><?php echo $dt->param1; ?></label>
	<?php } ?>
	<br />
	<br />
    <?php foreach ($listparams as $dt) { ?>
	<p class="text-justify"><?php echo $dt->params2; ?></p>
    <?php } ?>
	<ul style="padding-left: 60px;  font-weight: bold;">
		<li>
			<?php foreach ($cari as $dt) {
				echo $dt->ACCOUNTNAME . "<br />" . $dt->BANKNAME . "<br />" . $dt->ACCOUNTNUMBER;
			} ?>
		</li>
	</ul>
     <?php foreach ($listparams as $dt) { ?>
	<p class="text-justify"><?php echo $dt->params3; ?>
		<b style="padding-left: 60px;  font-weight: bold;"><?php echo $dt->params4;?> </b> <br /><br /> Demikian kami sampaikan atas kerjasama yang baik kami ucapkan terima kasih
	</p>
	<?php } ?>



	<!--	<h5 style="font-weight: bold;">PT ASURANSI JIWA TASPEN<h5> -->

	<div><img alt="sign-bottom" src="<?php echo base_url(); ?>/img/sign-bottom.png" class="float-left" width="30%" ;></div>


	</div>
</body>

</html>