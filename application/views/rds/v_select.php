<html>
<head>
<title></title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"  crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css"  crossorigin="anonymous">

 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

 <script type="text/javascript">
 	
 	$(document).ready(function() {
    $('#example').DataTable();
} );
 </script>

</head>
<body>

<div class="container">

<form action="<?php echo base_url('taspen/lookup')?>" action="GET">

  <label for="bulan">Pilih Bulan</label>
  <select name="cari" id="cari">
  			<option value="1">JANUARI</option>
  			<option value="2">FEBRUARI</option>
  			<option value="3">MARET</option>
  			<option value="4">APRIL</option>
  			<option value="5">MEI</option>
  			<option value="6">JUNI</option>
  			<option value="7">JULY</option>
  			<option value="8">AGUSTUS</option>
  			<option value="9">SEPTEMBER</option>
  			<option value="10">OKTOBER</option>
  			<option value="11">NOVEMBER</option>
  			<option value="12">DESEMBER</option>
  </select>
  <br><br>
  <input type="submit" value="Submit">
</form>



<table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th scope="col">NAMASUB</th>
      <th scope="col">ALAMAT</th>
      <th scope="col">DUEDATE</th>
      <th scope="col">NOINVOICE</th>
      <th scope="col">NOPOLIS</th>
      <th scope="col">JMLPREMI</th>
    </tr>
  </thead>
  <tbody>
  	  	<?php foreach ($list as $dt) { ?>

    <tr>
      <td><?php echo $dt->NAMASUB; ?></td>
      <td><?php echo $dt->ALAMAT; ?></td>
      <td><?php echo $dt->DUEDATE; ?></td>
      <td><?php echo $dt->NOINVOICE; ?></td>
   	  <td><?php echo $dt->NOPOLIS; ?></td>
      <td><?php echo $dt->JMLPREMI; ?></td>

    </tr>
    <?php } ?>

  </tbody>
</table>

</div>

</body>
</html>