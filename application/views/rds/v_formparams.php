<html>

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
          <a class="admin-logo" href="index.html">
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

<br/><br/>

          <div class="header">
               <div class="title">
                    <h3>Edit Detail Invoice</h3>
               </div>
          </div>
          <?php foreach ($edparams as $dt) { ?>

               <?php echo form_open("taspen/edit_simpan/" . $dt->id); ?>
               <div class="form-group">
                    <input type="hidden" id="id" value="<?php echo $dt->id; ?>">
               </div>

               <div class="form-group">
                    <label for="umur">Catatan</label>
                    <textarea class="form-control" id="param1" name="param1" rows="3"><?php echo $dt->param1; ?></textarea>
               </div>
               <div class="form-group">
                    <label for="umur">Detail Pembayaran</label>
                    <textarea class="form-control" id="params2" name="params2" rows="3"><?php echo $dt->params2; ?></textarea>
               </div>

               <div class="form-group">
                    <label for="umur">Setelah Pembayaran</label>
                    <textarea class="form-control" id="params3" name="params3" rows="3"><?php echo $dt->params3; ?></textarea>
               </div>
               <div class="form-group">
                    <label for="umur">Email</label>
                    <textarea class="form-control" id="params4" name="params4" rows="3"><?php echo $dt->params4; ?></textarea>
               </div>


               <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
               </form>
               <div class="action">

               <?php } ?>

               </div>

     </div>
 
    <footer class="footer">
      <span>Copyright &copy; 2020 Taspenlife</span>
    </footer>
  </section>


</body>

</html>
