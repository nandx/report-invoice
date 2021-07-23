<html>

<head>
  <title>Non Aspurjab</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" crossorigin="anonymous">
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
      margin-right: 780px;
    }
    
    div.container {
        width: 80%;
    }
  </style>
</head>

<body>

  <div class="container my-4">
    <form action="<?php echo base_url('taspen/lookup') ?>" action="GET">
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
        $month = array("January" => "1",
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
            "December" => "12");
        ?>
        

        
    <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered" style="font-size:12px">
        <thead>
          <tr>
            <th width="3%"><button onclick="document.getElementById('search_box').value = ''" type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-sm">PAID</button></th>
            <th scope="col">Partner<br />Name</th>
            <th scope="col">Cabang</th>
            <th scope="col">Satker</th>
            <th scope="col">Alamat</th>
            <th scope="col">Due<br />Date</th>
            <th scope="col">No<br />Invoice</th>
            <th scope="col">Cetakan <br />Ulang</th>
            <th scope="col">NOPOLIS</th>
            <th scope="col">Nama<br />Product</th>
            <th scope="col">Jml Premi<br /> Rp</th>
            <th scope="col">Jml Peserta</th>
            <th scope="col">Tanggal<br />Pembayaran</th>
            <th scope="col">Status</th>
            <th scope="col">Cetak<br />PDF</th>
            <th scope="col">Cetak<br />Excel</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (count($cari) > 0) {
            foreach ($cari as $dt) {
          ?>
              <tr>
                <td><?php
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
                    ?><a href="#" class="btn btn-success btn-sm disabled" role="button" aria-disabled="true">PAID</a>


                  <?php } else {
                  ?>
                    <a href="#" class="btn btn-danger btn-sm disabled" role="button" aria-disabled="true">UNPAID</a>
                  <?php }
                  ?>
                </td>

                <td>
                  <!--  <button type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-xs">Updated</button><br/> -->
                  <a class="btn btn-sm btn-primary" href="readpdf/<?php echo $dt->ID; ?>" role="button">Invoice</a>

                </td>

                <td>
                  <?php 
                    if( ($dt->JMLPESERTA_PERDIVISI == $dt->JMLPST) or ($dt->JMLPESERTA_PUSAT == $dt->JMLPST))
                    { ?>
                      <a class="btn btn-sm btn-primary" href="excelstandard/<?php echo $dt->IDDIVISION; ?>/<?php echo $dt->IDSUB; ?>/<?php echo $dt->ID_CHILD; ?>/<?php echo $dt->POLICYNO; ?>/<?php echo $dt->BULAN; ?>/<?php echo $dt->TAHUN; ?>" role="button">Lampiran</a>
                  <?php } else { ?>
                    <a class="btn btn-sm btn-primary disabled" href="excelstandard/<?php echo $dt->IDDIVISION; ?>/<?php echo $dt->IDSUB; ?>/<?php echo $dt->ID_CHILD; ?>/<?php echo $dt->POLICYNO; ?>/<?php echo $dt->BULAN; ?>/<?php echo $dt->TAHUN; ?>" role="button">Lampiran</a>
                  <?php } ?>            
                </td>

                   <!-- <button type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-xs">Updated</button><br/> -->

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
    
    
    $('#example').dataTable( {
    language: {
        search: "_INPUT_",
        searchPlaceholder: "Search..."
    }
} );
    
    </script>

</body>

</html>