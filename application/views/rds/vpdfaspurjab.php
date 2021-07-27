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



function penyebut($nilai)
{
	$nilai = abs($nilai);
	$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	$temp = "";
	if ($nilai < 12) {
		$temp = " " . $huruf[$nilai];
	} else if ($nilai < 20) {
		$temp = penyebut($nilai - 10) . " belas";
	} else if ($nilai < 100) {
		$temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
	} else if ($nilai < 200) {
		$temp = " seratus" . penyebut($nilai - 100);
	} else if ($nilai < 1000) {
		$temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
	} else if ($nilai < 2000) {
		$temp = " seribu" . penyebut($nilai - 1000);
	} else if ($nilai < 1000000) {
		$temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
	} else if ($nilai < 1000000000) {
		$temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
	} else if ($nilai < 1000000000000) {
		$temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
	} else if ($nilai < 1000000000000000) {
		$temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
	}
	return $temp;
}

function bulan($bln){
$bulan = $bln;
Switch ($bulan){
 case 1 : $bulan="Januari";
 Break;
 case 2 : $bulan="Februari";
 Break;
 case 3 : $bulan="Maret";
 Break;
 case 4 : $bulan="April";
 Break;
 case 5 : $bulan="Mei";
 Break;
 case 6 : $bulan="Juni";
 Break;
 case 7 : $bulan="Juli";
 Break;
 case 8 : $bulan="Agustus";
 Break;
 case 9 : $bulan="September";
 Break;
 case 10 : $bulan="Oktober";
 Break;
 case 11 : $bulan="November";
 Break;
 case 12 : $bulan="Desember";
 Break;
 }
return $bulan;
}


function terbilang($nilai)
{
	if ($nilai < 0) {
		$hasil = "minus " . trim(penyebut($nilai));
	} else {
		$hasil = trim(penyebut($nilai));
	}
	return $hasil;
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

	<div><img alt="image-taspen-logo" src="<?php echo base_url(); ?>img/header-logo-tl.png" class="float-left" width="50%" ;></div>
	<br />
	<h3>INVOICE</h3>
	<label>Jakarta, <?php echo tgl_indo(date('Y-m-d')); ?></label>
	<br /><br />
	<p>
		<?php foreach ($invoice as $dt) { ?>

			<label>Kepada YTH,</label><br />
			<label><?php 
						if (!empty($dt->PARTNERNAME))
							echo $dt->PARTNERNAME; 
						else
							echo '';
					?>
			</label><br />
			<label><?php 
						if (!empty($dt->NMDIVISION))
							echo $dt->NMDIVISION; 
						else
							echo '';
					?>
			</label><br />
			<label><?php 
						if (!empty($dt->ALAMAT))
							echo $dt->ALAMAT; 
						else
							echo '';
					?>
			</label><br />
			<label><?php 
						if (!empty($dt->KOTA))
							echo $dt->KOTA; 
						else
							echo '';
					?>
			</label><br />
			<label><?php 
						if (!empty($dt->NMSUB))
							echo $dt->NMSUB; 
						else
							echo '';
					?>
			</label><br />
			<label>Dengan Hormat,</label>
		<?php } ?>
	</p>

	<p align="justify">

		Terima kasih atas kepercayaan Instansi bapak/Ibu menjadi peserta program Asuransi Jiwa Taspen, dengan ini kami sampaikan tagihan premi program asuransi untuk pegawai pada <?php foreach ($invoice as $dt) {
																																														echo $dt->NMDIVISION;
																																													} ?> dengan rincian sebagai berikut:
	</p>


		<table style="border-style: none;">
				<?php foreach ($invoice as $dt) { ?>

			<tr>
				<td>No Invoice</td>
				<td>: <?php echo $dt->NOINVOICE;

						if ($dt->REV > '0') {
							echo " - Rev " . $dt->REV;
						} ?>
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
				<td>: <?php echo bulan($dt->DUEDATEMONTH);
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
				<td>: <?php }
					foreach ($jml as $dtx) { ?>
					IDR &nbsp;<?php echo number_format($dtx->jml, 2, ",", ".");
							} ?> </td>
			</tr>
			<tr>
				<td>Currency</td>
				<td>:

					<?php
					foreach ($invoice as $dt) {
						echo $dt->CURRENCY;
					}
					?></td>
			</tr>

		</table>

		<p></p>



		<table class="table">
			<tr>
				<td style="border: 1px solid #000;" align="center" colspan="3"><b>Rincian Tagihan</b></td>
			</tr>
			<tr>
				<td class="text-center atd">Uraian</td>
				<td class="text-center atd" align="center" style="size:20px;">Jml. Pst</td>
				<td class="text-center atd align=" center"">Premi (Rp)</td>
			</tr>
			<?php foreach ($individu as $i) {
				foreach ($invoice as $inv) { ?>
					<tr>
						<td style="border: 1px solid #000; size:10000px;" class="text-left"><?php echo $dt->PRODUCTNAME; ?><br />Premi Tahun <?php echo $i->TAHUN ?> Atas Nama : <br /><b><?php echo $i->NAMA_PESERTA; ?></b></td>
						<td style="border: 1px solid #000;" class="text-center">1</td>
						<td class="text-right atd"><?php echo $dt->CURRENCY; ?> &nbsp;<?php echo number_format($i->PREMI, 2, ",", "."); ?></td>
					</tr>
			<?php }
			} ?>

			<tr>
				<td style="border-top: 1px solid #000;" colspan="2" align="right">Jumlah</td>
				<?php foreach ($jml as $dtx) { ?>
					<td class="text-right atd">IDR &nbsp;<?php echo number_format($dtx->jml, 2, ",", ".");
														} ?> </td>
			</tr>
		</table>

		<br />

		<?php
		foreach ($invoice as $dtx) {
			echo "<i>Terbilang: " . $dtx->TERBILANG . "  </i>" . $dtx->CURRENCY;
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
				<?php foreach ($invoice as $dt) {
					echo $dt->ACCOUNTNAME . "<br />" . $dt->BANKNAME . "<br />" . $dt->ACCOUNTNUMBER;
				} ?>
			</li>
		</ul>

		<?php foreach ($listparams as $dt) { ?>
			<p class="text-justify"><?php echo $dt->params3; ?>
				<b style="padding-left: 60px;  font-weight: bold;"><?php echo $dt->params4; ?> </b> <br /><br /> Demikian kami sampaikan atas kerjasama yang baik kami ucapkan terima kasih
			</p>
		<?php } ?>



				<div><img alt="sign-bottom" src="<?php echo base_url(); ?>/img/sign-bottom.png" class="float-left" width="30%" ;></div>


				</div>


</body>

</html>
