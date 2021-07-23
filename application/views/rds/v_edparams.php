<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>Edit Keterangan Invoice</title>
</head>

<body>

  <div class="container mt-4">
    <table class="table">
      <thead>
        <tr>

          <th>Catatan</th>
          <th>Detail Pembayaran</th>
          <th>Setelah Pembayaran</th>
          <th>Email</th>

        </tr>
      </thead>
      <tbody>
        <?php foreach ($listparams as $dt) { ?>
          <tr>
            <td><?php echo $dt->param1;   ?></td>
            <td><?php echo $dt->params2;   ?></td>
            <td><?php echo $dt->params3;   ?></td>
            <td><?php echo $dt->params4;   ?></td>


            <td><a class="btn btn-primary" href="<?php echo base_url('taspen/edparams/' . $dt->id); ?>">Edit</a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>

</html>
