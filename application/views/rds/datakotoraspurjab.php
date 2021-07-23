<html>

<head>
  <title>List Data Kotor</title>

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
    iv.dataTables_wrapper  div.dataTables_filter {
  width: 100%;
  float: none;
  text-align: center;
}
$('.col-sm-6').css('margin','auto').css('width','60%')


.dataTables_filter {
   float: right !important;
}

#example_filter input {
  border-radius: 5px;
  border-color:red;
  float: left;
  margin-right:800px;
}
  </style>
</head>

<body>

  <div class="container my-4">


    <form action="<?php echo base_url('taspen/lookup') ?>" action="GET">
      <label for="bulan">Pilih Bulan</label>

      <?php
      //echo "Rp " . number_format("10000", 2, ",", ".");
      $monthArray = range(1, 12);
      ?>
      <select name="cari" id="cari">
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
        <?php 
        $year_start  = 2015;
        $year_end = date('Y'); // current Year
        $user_selected_year = $year_end; // user date of birth year
    
        echo '<select id="year" name="year">'."\n";
        for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
            $selected = ($user_selected_year == $i_year ? ' selected' : '');
            echo '<option value="'.$i_year.'"'.$selected.'>'.$i_year.'</option>'."\n";
        }
        echo '</select>'."\n";
        ?>

      <input type="submit" value="Submit">
    </form>

    <div class="table-responsive">

      <table id="example" class="table table-striped table-bordered" style="font-size:12px">
        <thead>
          <tr>
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
          </tr>
        </thead>
        <tbody>
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
            url: "<?php echo base_url(); ?>taspen/multiupdated",
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

    $('#example').DataTable({
      "ordering": true
    });

    $("#example_filter input").prop('id', 'search_box');
   
  
} );

  </script>
  

<script type="text/javascript">
    var table;
    $(document).ready(function() {
 
        //datatables
        table = $('#example').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('taspen/listdatakotoraspurjab')?>",
                "type": "POST"
            },
 
             
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            ],
 
        });
 
    });
 
</script>
 
</body>

</html>