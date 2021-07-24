

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ASPURJAB</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" crossorigin="anonymous">

  <!-- Common Plugins -->
  <link href="<?php echo base_url('assets/lib/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

  <!-- DataTables -->
  <link href="<?php echo base_url('assets/lib/datatables/jquery.dataTables.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/lib/datatables/responsive.bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/lib/datatables/buttons.dataTables.css') ?>" rel="stylesheet" type="text/css">

  <!-- Custom Css-->
  <link href="<?php echo base_url('assets/css/style.css') ?> " rel="stylesheet">



   <style>
   

      .toggle-none {
        margin-top: -22px;
      }
  </style>
</head>

<body class="horizontal">
  <!-- ============================================================== -->
  <!-- 						Topbar Start 							-->
  <!-- ============================================================== -->
  <div class="top-bar light-top-bar">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <a class="admin-logo" href="#">
            <h1>
              <img alt="" src="<?php echo base_url('img/logo-header.png')  ?>" class="toggle-none">
            </h1>
          </a>

          <ul class="list-inline top-right-nav">

            <li class="dropdown avtar-dropdown">
              <a data-toggle="dropdown" href="<?php echo base_url('taspen/lookup?cari=all&year=all'); ?>">
                Non Aspurjab
              </a>
            </li>
            <li class="dropdown avtar-dropdown">
              <a data-toggle="dropdown" href="<?php echo base_url('taspen/lookupaspurjab?cari=all&year=all'); ?>">
                Aspurjab
              </a>
            </li>
            <li class="dropdown avtar-dropdown">
              <a data-toggle="dropdown" href="<?php echo base_url('taspen/lsparams'); ?>">
                Parameter
              </a>
            </li>
            <li class="dropdown avtar-dropdown">
              <lable>&nbsp;&nbsp;&nbsp;&nbsp;</lable>
            </li>
            <li class="dropdown avtar-dropdown">
              <lable>&nbsp;&nbsp;&nbsp;&nbsp;</lable>
            </li>
            <li class="dropdown avtar-dropdown">
              <lable>&nbsp;&nbsp;&nbsp;&nbsp;</lable>
            </li>
            <li class="dropdown avtar-dropdown">
              <lable>&nbsp;&nbsp;&nbsp;&nbsp;</lable>
            </li>
            <li class="dropdown avtar-dropdown">
              <lable>&nbsp;&nbsp;&nbsp;&nbsp;</lable>
            </li>
            <li class="dropdown avtar-dropdown">
              <lable>&nbsp;&nbsp;&nbsp;&nbsp;</lable>
            </li>
            <li class="dropdown avtar-dropdown">
              <lable>&nbsp;&nbsp;&nbsp;&nbsp;</lable>
            </li>
            <li class="dropdown avtar-dropdown">
              <lable>&nbsp;&nbsp;&nbsp;&nbsp;</lable>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!--                        Topbar End                              -->
  <!-- ============================================================== -->

  <section class="main-content" style="background-color: #E1E8EB">
    <table class="table table-responsive table-striped dt-responsive">
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


            <td><a class="btn btn-primary" href="<?php echo site_url('taspen/edparams/' . $dt->id); ?>">Edit</a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  </div>
  </div>


  <footer class="footer">
      <span>Copyright &copy; 2021 Taspenlife</span>
    </footer>
  </section>
</body>

</html>
