<html lang="en">

<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

     <title>Edit Detail Invoice</title>
</head>

<body>
     <div class="container mt-2">


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

</body>

</html>