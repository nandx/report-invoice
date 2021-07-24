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
    .removeRow {
      background-color: #77ACF1;
      color: #000;
    }


    body {
      font-size: 12px;
    }

    iv.dataTables_wrapper div.dataTables_filter {
      width: 100%;
      float: none;
      text-align: center;
    }

    $('.col-sm-6').css('margin', 'auto').css('width', '60%') .dataTables_filter {
      float: right !important;
    }

     #example_filter input {
      border-radius: 5px;
      float: left;
      margin-right: 1010px;
      height: 30px;
      width: 190px;
    }
    
    .toggle-none
    {
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

    <br />
    <form action="<?php echo base_url('taspen/lookupaspurjab') ?>" action="GET">
      <label for="bulan">Jatuh Tempo</label>

      <?php
      //echo "Rp " . number_format("10000", 2, ",", ".");
      $monthArray = range(1, 12);
      ?>
      <select name="cari" id="cari">
        <?php
        /*
  foreach ($monthArray as $month) {
    // padding the month with extra zero
    $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
    // you can use whatever year you want
    // you can use 'M' or 'F' as per your month formatting preference
    $fdate = date("F", strtotime("2015-$monthPadding-01"));
    echo '<option value="' . $monthPadding . '">' . $fdate . '</option>';
  }
  */
        ?>

        <option <?php if ($_GET['cari'] == 'all') { ?>selected="true" <?php }; ?>value="all">All</option>
        <option <?php if ($_GET['cari'] == '01') { ?>selected="true" <?php }; ?>value="01">Januari</option>
        <option <?php if ($_GET['cari'] == '02') { ?>selected="true" <?php }; ?>value="02">Februari</option>
        <option <?php if ($_GET['cari'] == '03') { ?>selected="true" <?php }; ?>value="03">Maret</option>
        <option <?php if ($_GET['cari'] == '04') { ?>selected="true" <?php }; ?>value="04">April</option>
        <option <?php if ($_GET['cari'] == '05') { ?>selected="true" <?php }; ?>value="05">Mei</option>
        <option <?php if ($_GET['cari'] == '06') { ?>selected="true" <?php }; ?>value="06">Juni</option>
        <option <?php if ($_GET['cari'] == '07') { ?>selected="true" <?php }; ?>value="07">Juli</option>
        <option <?php if ($_GET['cari'] == '08') { ?>selected="true" <?php }; ?>value="08">Agustus</option>
        <option <?php if ($_GET['cari'] == '09') { ?>selected="true" <?php }; ?>value="09">September</option>
        <option <?php if ($_GET['cari'] == '10') { ?>selected="true" <?php }; ?>value="10">Oktober</option>
        <option <?php if ($_GET['cari'] == '11') { ?>selected="true" <?php }; ?>value="11">November</option>
        <option <?php if ($_GET['cari'] == '12') { ?>selected="true" <?php }; ?>value="12">Desember</option>

      </select>
      <?php
      /*
          $year_start  = 2015;
          $year_end = date('Y'); // current Year
          $user_selected_year = $year_end; // user date of birth year

          echo '<select id="year" name="year">' . "\n";
          for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
            $selected = ($user_selected_year == $i_year ? ' selected' : '');
            echo '<option value="' . $i_year . '"' . $selected . '>' . $i_year . '</option>' . "\n";
          }
          echo '</select>' . "\n";
          */
      ?>
      <select name="year" id="year">

        <option <?php if ($_GET['year'] == 'all') { ?>selected="true" <?php }; ?>value="all">All</option>
        <option <?php if ($_GET['year'] == '2019') { ?>selected="true" <?php }; ?>value="2019">2019</option>
        <option <?php if ($_GET['year'] == '2020') { ?>selected="true" <?php }; ?>value="2020">2020</option>
        <option <?php if ($_GET['year'] == '2021') { ?>selected="true" <?php }; ?>value="2021">2021</option>
      </select>

      <input type="submit" value="Submit">
    </form>

    <?php
    $month = array(
      "January" => "1",
      "February" => "2",
      "March" => "3",
      "April" => "4",
      "May" => "5",
      "June" => "6",
      "July" => "7",
      "August" => "8",
      "September" => "9",
      "October" => "10",
      "November" => "11",
      "December" => "12"
    );
    ?>






    <table id="example" class="table table-responsive table-striped dt-responsive " style="font-size: 11px">
      <thead style="background-color: #EEEBDD">
        <tr>
          <th width="3%"><button onclick="document.getElementById('search_box').value = ''" type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-sm">
              <h6 style="font-size:10px">PAID</h6>
            </button></th>
          <th scope="col">Partner<br />Name</th>
          <th scope="col">Cabang</th>
          <th scope="col">Satker</th>
          <th width="col">Alamat</th>
          <th scope="col">Due<br />Date</th>
          <th scope="col">No<br />Invoice</th>
          <th scope="col">Cetakan <br />Ulang</th>
          <th scope="col">NOPOLIS</th>
          <th scope="col">Nama<br />Product</th>
          <th scope="col">Jml Premi<br /> Rp</th>
          <th scope="col">Jml Peserta</th>
          <th scope="col">Tanggal<br />Pembayaran</th>
          <th scope="col">Status</th>
          <th scope="col">Cetak</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (count($cari) > 0) {
          foreach ($cari as $dt) {
        ?>
            <tr>
              <td>
                <?php
                if ($dt->STATUS == '1') {
                ?><input type="checkbox" class="delete_checkbox" disabled />
                <?php } else {
                ?>
                  <input type="checkbox" class="delete_checkbox" value="<?php echo $dt->ID; ?>" />
                <?php  }
                ?>
              </td>
              <td><?php echo $dt->PARTNERNAME; ?></td>
              <td><?php echo $dt->NMDIVISION; ?></td>
              <td><?php echo $dt->NMSUB; ?></td>
              <td><?php echo $dt->ALAMAT; ?></td>
              <td><?php echo $dt->DUEDATE; ?></td>
              <td><?php echo $dt->NOINVOICE; ?></td>
              <td><?php echo $dt->REV; ?></td>
              <td><?php echo $dt->POLICYNO; ?></td>
              <td><?php echo $dt->PRODUCTNAME; ?></td>
              <td><?php
                  $x = $dt->JMLPREMI;
                  echo number_format($x, 0, ',', '.');
                  ?></td>
              <td><?php echo $dt->JMLPST; ?></td>
              <td><?php echo $dt->PAYMENTDATE; ?></td>
              <td><?php
                  if ($dt->STATUS == '1') {
                  ?><a href="#" class="btn btn-success btn-sm disabled" role="button" aria-disabled="true">
                    <h6 style="font-size:10px">PAID</h6>
                  </a>


                <?php } else {
                ?>
                  <a href="#" class="btn btn-danger btn-sm disabled" role="button" aria-disabled="true">
                    <h6 style="font-size:10px">UNPAID</h6>
                  </a>
                <?php }
                ?>
              </td>
              <td>
                <?php
                $individu = $this->db->query(
                  "SELECT COUNT(DISTINCT NAMA_PESERTA) as COUNTED
                			FROM tl_individu_standard 
                			WHERE
                				POLICYNO = '$dt->POLICYNO'
                				AND BULAN = '$dt->BULAN'
                				AND TAHUN = '$dt->TAHUN'
                				AND ID_CHILD = '$dt->ID_CHILD'"
                )->first_row()->COUNTED;
                if ($individu > 0 and $individu == $dt->JMLPST) { ?>
                  <a class="btn btn-sm btn-primary" href="readpdfaspurjab/<?php echo $dt->ID . '/' . $dt->ID_CHILD . '/' . $dt->POLICYNO . '/' . $dt->TEMP_BULAN . '/' . $dt->TEMP_TAHUN . '/' . $dt->IDDIVISION . '/' . $dt->IDSUB; ?>">
                    <h6 style="font-size:10px">invoice</h6>
                  </a>
                <?php } else { ?>
                  <a class="btn btn-sm btn-primary disabled" href="readpdfaspurjab/<?php echo $dt->ID . '/' . $dt->ID_CHILD . '/' . $dt->POLICYNO . '/' . $dt->TEMP_BULAN . '/' . $dt->TEMP_TAHUN . '/' . $dt->IDDIVISION . '/' . $dt->IDSUB; ?>">
                    <h6 style="font-size:10px">invoice</h6>
                  </a>
                <?php } ?>
              </td>
            </tr>
        <?php
          }
        } else {
          echo "Data tidak ditemukan";
        }
        ?>

      </tbody>
    </table>
    </div>
    </div>
    </div>


    <footer class="footer">
      <span>Copyright &copy; 2020 Taspenlife</span>
    </footer>
  </section>



  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>


  <script type="text/javascript">
    var e = document.getElementById("cari");

    function show() {
      var as = document.forms[0].ddlViewBy.value;
      var strUser = e.options[e.selectedIndex].value;
      console.log(as, strUser);
    }
    e.onchange = show;
    show();
  </script>

  <script>
    $(document).ready(function() {

      $('.delete_checkbox').click(function() {
        if ($(this).is(':checked')) {
          $(this).closest('tr').addClass('removeRow');
        } else {
          $(this).closest('tr').removeClass('removeRow');
        }
      });

      $('#delete_all').click(function() {
        var checkbox = $('.delete_checkbox:checked');
        if (checkbox.length > 0) {
          var checkbox_value = [];
          $(checkbox).each(function() {
            checkbox_value.push($(this).val());
          });
          $.ajax({
            url: "<?php echo base_url(); ?>taspen/multiupdatedaspur",
            method: "POST",
            data: {
              checkbox_value: checkbox_value
            },
            success: function() {
              $('.removeRow').fadeOut(1500);
              alert('Sukses !');
              $("#searchinput").val('');
              location.reload();
            }
          })
        } else {
          alert('Anda Belum Memilih !');
        }
      });

    });


    $('#example').dataTable({
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search..."
      },
      "order": [
        [5, "desc"]
      ],
      "lengthChange": true
    });
  </script>


</body>

</html>
