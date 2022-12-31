<!-- partial -->
<div class="container-fluid mt-xl-50 mt-sm-30 mt-15 px-xxl-65 px-xl-20">
  <div class="row ">
    <div class="col-md-8 offset-md-2 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <?php if ($this->session->flashdata()) : ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $this->session->flashdata('demo'); ?>
            </div>
          <?php endif; ?>
          <h4 class="card-title">Tambah Paket</h4>
          <?= form_open_multipart('paket/addpaket'); ?>
          <div class="form-group">
            <label for="status_berita">Ikon Paket</label><br>
            <input type="file" class="dropify" name="ikon" data-max-file-size="3mb" required />
          </div>
          <div class="form-group">
            <label for="title">Jenis</label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Jenis Paket" required>
          </div>
          <div class="form-group">
            <label for="title">Keterangan</label>
            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="keterangan" required>
          </div>
          <div class="form-group">
            <label for="title">Biaya</label>
            <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga Paket" required>
          </div>

          <div class="form-group">
            <label for="status_berita">Status</label>
            <select class="form-control custom-select  mt-15" style="width:100%" name="status" id="status">
              <option value="1">Active</option>
              <option value="0">NonActive</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success mr-2">Submit</button>
          <button class="btn btn-light">Cancel</button>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end of content wrapper -->