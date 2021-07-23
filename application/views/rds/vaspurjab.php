<html>

<head>
  <title>ASPURJAB</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">

</head>

<body>

  <div class="container my-4">

    <form action="<?php echo base_url('taspen/lookupaspurjab') ?>" action="GET">

      <label for="bulan">Pilih Bulan</label>

        <?php
        //echo "Rp " . number_format("10000", 2, ",", ".");
        $monthArray = range(1, 12);
        ?>
        <select name="cari" id="cari">
          <option value="">Select Month</option>
          <?php
          foreach ($monthArray as $month) {
            // padding the month with extra zero
            $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
            // you can use whatever year you want
            // you can use 'M' or 'F' as per your month formatting preference
            $fdate = date("F", strtotime("2015-$monthPadding-01"));
            echo '<option value="' . $monthPadding . '">' . $fdate . '</option>';
          }
          ?>
        </select>
      <input type="submit" value="Submit">
    </form>



    <table id="example" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th scope="col">Partner<br /> Name</th>
          <th scope="col">Cabang</th>
          <th scope="col">Satker</th>
          <th scope="col">Alamat</th>
          <th scope="col">Due Date</th>
          <th scope="col">BULAN</th>
          <th scope="col">TAHUN</th>
          <th scope="col">ALAMAT</th>
          <th scope="col">NOINVOICE</th>
          <th scope="col">POLICYNO</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($list as $dt) { ?>

          <tr>
            <td><?php echo $dt->PARTNERNAME; ?></td>
            <td><?php echo $dt->BULAN; ?></td>
            <td><?php echo $dt->TAHUN; ?></td>
            <td><?php echo $dt->ALAMAT; ?></td>
            <td><?php echo $dt->NOINVOICE; ?></td>
            <td><?php echo $dt->POLICYNO; ?></td>

          </tr>
        <?php } ?>

      </tbody>
    </table>

  </div>


  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>

</body>

</html>