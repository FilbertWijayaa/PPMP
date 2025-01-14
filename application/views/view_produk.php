<div class="row">
    <div class="col-md-12">
      <div class="box box-danger">
        <div class="box-header with-border color-header">
          <h3 class="box-title"><i class="fa fa-th"></i> Data  Barang</h3>
          <div class="box-tools pull-right">
           <a class="btn btn-default btn-sm" href="<?php echo base_url('produk'); ?>">
           <span class="fa fa-refresh"></span> Refresh</a>
           <button type="button" class="btn btn-sm btn-success btnTambah" id="btnTambah">
             <span class="fa fa-plus"></span> Tambah</button>
         </div>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-bordered table-condensed" id="mydata">
                <thead>
                  <tr>
                    <th style="width: 30px;text-align: center;">No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th style='width:90px; text-align: right;'> Harga Bell</th>
                    <th style='width:80px; text-align: right;'>Harga Pokok</th>
                    <th style='width:80px;text-align: right;'> Harga Jual</th>
                    <th style="width:120px;text-align: center;"> Action</thr>
                  </tr>
                </thead>
                <tbody id="tbl_data">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Data Barang</h4>
          </div>
          <form action="" method="post" id="form_add">
            <div class="modal-body">
              <input type="hidden" id="id_produk" name="id_produk">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Kategori <span class="text-danger">*</span></label>
                    <select name="id_kategori" id="id_kategori" class="form-control">
                      <option value=""> Pilih Kategori </option>
                      <?php foreach ($kategori as $row) {
                        echo "<option value= '$row->id_kategori'>$row->nama_kategori</option>";
                      } ?>
                  </select>
                  <span class="help-block"></span>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="">Nama Barang <span class="text-danger">*</span></label>
                  <input type="text" id="nama_produk" name="nama_produk" autocomplete="off" class="form-control input-sm"
                  placeholder="Nama Barang">
                </div>
              </div>
            </div>
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="">Satuan<span class="text-danger">*</span></label>
                          <select name="id_satuan" id="id_satuan" class="form-control">
                              <option value="">Pilih Satuan</option>
                              <?php foreach ($satuan as $row) { 
                                 echo "<option value= '$row->id_satuan'>$row->nama_satuan</option>";
                              } ?>
                          </select>
                          <span class="help-block"></span>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="barcode">Barcode</label>
                          <input type="text" id="barcode" name="barcode" autocomplete="off" class="form-control input-sm" 
                          placeholder="Nomor Kontak">
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                          <label for="harga_beli">Harga Beli <span class="text-danger">*</span></label>
                          <input type="text" id="harga_beli" name="harga_beli" autocomplete="off"
                              class="form-control input-sm" onkeypress="return isNumber(this, event);" placeholder="Harga Beli">
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label for="harga_pokok">Harga Pokok <span class="text-danger">*</span></label>
                          <input type="text" id="harga_pokok" name="harga_pokok" autocomplete="off"
                              class="form-control input-sm" onkeypress="return isNumber(this, event);" placeholder="Harga Pokok">
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label for="harga_jual">Harga Jual <span class="text-danger">*</span></label>
                          <input type="text" id="harga_jual" name="harga_jual" autocomplete="off"
                              class="form-control input-sm" onkeypress="return isNumber(this, event);" placeholder="Harga Jual">
                      </div>
                  </div>
              </div>
          </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary " id="btnSimpan"
              data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing ">Simpan Data</button>
          </div>
          </div>
        </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    var btnEdit=false;
    tampil_data();
    //Menampilkan Data di tabel
    function tampil_data(){
      $.ajax({
        url: '<?php echo base_url(); ?>produk/tampilkanData',
        type: 'POST',
        dataType: 'json',
        success: function(response){
          console.log(response)
          var i;
          var no = 0;
          var html = "";
          for(i=0;i < response.length ; i++){
                no++;
                html = html + '<tr>' 
                + '<td>' + no + '</td>'
                + '<td>' + response[i].nama_produk + '</td>' 
                + '<td>' + response[i].nama_kategori + '</td>' 
                + '<td>' + response[i].nama_satuan + '</td>' 
                + '<td style="text-align: right:">' + Intl.NumberFormat('id-ID').format(response[i].harga_beli) + '</td>' 
                + '<td style="text-align: right:">' + Intl.NumberFormat('id-ID').format(response[i].harga_pokok) + '</td>' 
                + '<td style="text-align: right:">' + Intl.NumberFormat('id-ID').format(response[i].harga_jual) + '</td>' 
                + '<td><center>' + '<span><button edit-id="'+response[i].id_produk+
                  '" class="btn btn-success btn-xs btn_edit"><i class="fa fa-edit"></i> Edit</button><button style="margin-left: 5px;" data-id="' 
                  + response[i].id_produk + 
                  '" class="btn btn-danger btn-xs btn_hapus"><i class="fa fa-trash"></i> Hapus</button></span>' + '</td>'
                + '</tr>';
                }
                $('#tbl_data').html(html);
                $('#mydata').DataTable();
            },
            error: function(xhr, ajaxOptions, thrownError) {
              alert(xhr.status);
              alert(thrownError);
            }
      });
    }
  


// Memanggil Modal Satuan
$(document).on("click", "#btnTambah", function(e){
      e.preventDefault();
      bEdit=false;
      $('#form_add')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#formModal').modal('show'); // Tampilkan bootstrap modal
      $('.modal-title').text('Tambah Barang'); // Set Judul modal
    });

// Edit Produk
$('#tbl_data').on('click', '.btn_edit', function(){
    var id_produk = $(this).attr('edit-id');
    bEdit = true;
    $.ajax({
        url: '<?php echo base_url(); ?>produk/tampilkanDataByID',
        type: 'POST',
        data: {id_produk:id_produk},
        datatype: 'json',
        success: function(response){
            $('form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clean error class
            $('.help-block').empty(); // clear error string
            $('#modal_form .modal-title').text('Edit Barang'); // Set Title to Bootstrap modal title
            $('input[name="id_produk"]').val(response.id_produk);
            $('input[name="id_kategori"]').val(response.id_kategori);
            $('input[name="nama_produk"]').val(response.nama_produk);
            $('input[name="id_satuan"]').val(response.id_satuan);
            $('input[name="barcode"]').val(response.barcode);
            $('input[name="harga_beli"]').val(parseFloat(response.harga_beli).toFixed(0));
            $('input[name="harga_pokok"]').val(parseFloat(response.harga_pokok).toFixed(0));
            $('input[name="harga_jual"]').val(parseFloat(response.harga_jual).toFixed(0));
            $('#formModal').modal('show');
        }
    })
});

    //Kirim Data Proses Save/Update ke Controller
    $(document).on("click", "#btnSimpan", function(e){
      e.preventDefault();
      var $this = $(this);
      var formData = new FormData($('#form_add')[0]);
      if (bEdit){
        //Jika Edit, Update Data
        var sURL='<?php echo base_url(); ?>produk/perbaruiData';
      }else{
        var sURL='<?php echo base_url(); ?>produk/tambahData';
      }
      $.ajax({
          url: sURL,
          type: "post",
          dataType: "json",
          data: formData,
          contentType: false,
          processData: false,
          beforeSend: function () {
            $this.button('loading');
          },
          complete: function () {
            $this.button('reset');
          },
          success: function(data){
            if (data.responce == "success") {
              $("#form_add")[0].reset();
              $('.form-group').removeClass('has-error'); // clear error class
              $('.help-block').empty(); // clear error string
              $('#formModal').modal('hide');
              Swal.fire({
                text: 'Data berhasil di Simpan',
                icon: 'success',
                title: 'Saving Succes',
                showConfirmButton: false,
                timer: 1500
              });
              $('#mydata').dataTable({"bDestroy": true}).fnDestroy();
              tampil_data();
            }else{
              Swal.fire('Error!','Ops! <br>' + data.message,'error');
            }
          }
        });
    });

    //Hapus Data
    $("#tbl_data").on('click','.btn_hapus',function(e){
      e.preventDefault();
      var id_produk = $(this).attr('data-id');
      Swal.fire({
        title: 'Hapus Data?',
        text: 'Anda Yakin menghapus Data Supplier ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Tidak',
        confirmButtonText: 'Ya',
        showLoaderOnConfirm: true,
        preConfirm: () => {
          return new Promise(function(resolve,reject) {
            $.ajax({
              url: '<?php echo base_url(); ?>produk/hapusData',
              type: 'POST',
              dataType: "json",
              data: {id_produk: id_produk}
            })
            .done(function(data) {
              resolve(data)
            })
            .fail(function() {
              reject()
            });
          })
        },
        allowOutsideClick: () => !swal.isLoading()
      }).then((result) => {
        if (result.value) {
          
         $('#mydata').dataTable({"bDestroy": true}).fnDestroy();
          tampil_data();
          Swal.fire({
            icon: 'success',
            title: 'Data Telah Berhasil di Hapus',
            showConfirmButton: false,
            timer: 1500
          })
      }
    })
  });
});
</script>