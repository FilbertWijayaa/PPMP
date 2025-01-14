<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Master Data Satuan Barang</title>
        <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    </head>
    <body>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-danger">
          <div class="box-header with-border color-header">
            <h3 class="box-title"><i class="fa fa-th"></i> Data Satuan Barang</h3>
            <div class="box-tools pull-right">
            <a class="btn btn-default btn-sm" href="<?php echo base_url('Satuan'); ?>">
            <span class="fa fa-refresh"></span> Refresh</a>
            <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                data-target="#form-add"> <span class="fa fa-plus"></span> Tambah</button>
          </div>
        </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-striped">
                <thead>
                <tr>
                  <th style='width:30px'>#</th>
                  <th style='width: 30px'>ID</th>
                  <th scope="col">Nama Satuan</th>
                </tr>
              </thead>
              <?php
              foreach ($data->result() as $i => $row)
              {
                ?>
                <tr>
                    <td><?= ++$i; ?></td>
                    <td><?= $row->id_satuan; ?></td>
                    <td><?= $row->nama_satuan; ?></td>
                </tr>
                <?php
              }?>
            </tbody>
        </table>
     </div>
    <!-- load jquery js file -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- load bootstrap js file -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    </body>
</html>